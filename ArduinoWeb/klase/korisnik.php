 <?php

include "konekcija.php";

class Korisnik
{
    function __construct($konekcija)
    {
		$this -> db = $konekcija;
    }
	public function Prijava($korisnicko_ime, $lozinka)
	{
		$pretraga = $this -> db -> prepare ("SELECT *
				 							 FROM `korisnici`
											 WHERE `ime` = ? AND `lozinka` = ?
			    							");
		$pretraga -> execute (array ($korisnicko_ime, $lozinka));

		if ($pretraga -> rowCount() == 1)
		{
			$id = $pretraga -> fetch(PDO::FETCH_ASSOC);
			$_SESSION['korisnik'] = $id['id_korisnika'];
			$_SESSION['id_arduina'] = $id['id_arduina'];
			return true;
		}
	}
	public function Prijavljen()
	{
		if(isset($_SESSION['korisnik']))
		{
			return true;
		}
	}
	public function Registracija($korisnicko_ime, $lozinka, $ponovi_lozinku, $id, $kod, $provera)
	{
		if ($kod == $provera)
		{
			if ($lozinka == $ponovi_lozinku)
			{
				$korisnik = $this -> db -> prepare ("SELECT *
													 FROM korisnici
													 WHERE ime = :korisnicko_ime
													");
				$korisnik -> bindParam (':korisnicko_ime', $korisnicko_ime);
				$korisnik -> execute ();

				if ($korisnik -> rowCount() == 0)
				{
					$br_korisnika = $this -> db -> prepare ("SELECT *
															 FROM korisnici
															 WHERE id_arduina = :id
															");
					$br_korisnika -> bindParam (':id', $id);
					$br_korisnika -> execute ();

					if ($br_korisnika -> rowCount() <= 10)
					{
						$kreiraj = $this -> db -> prepare ("INSERT INTO korisnici
															SET ime = ?,
																lozinka = ?,
																id_arduina = ?
														   ");
						$kreiraj -> execute (array ($korisnicko_ime, $lozinka, $id));
					}
					else
					{
						return 'maks_korisnika';
					}
				}
				else
				{
					return 'isto_ime';
				}

			}
			else
			{
				return 'razlicite_lozinke';
			}
		}
		else
		{
			return 'razlicit_kod';
		}
	}
	public function Odjava()
	{
		session_unset('korisnik');
		session_unset('id_arduina');
		session_destroy();
	}
}

$korisnik = new Korisnik($konekcija);

?>