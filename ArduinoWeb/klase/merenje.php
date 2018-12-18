<?php

include "konekcija.php";

class Merenje
{
	function __construct($konekcija)
	{
		$this -> db = $konekcija;
	}
	public function PoslednjaMerenja($id_arduina)
	{
		$merenja = $this -> db -> prepare ("SELECT *
											FROM merenja
											WHERE id_arduina = :id_arduina
											ORDER BY id_merenja DESC
											LIMIT 1
										   ");
		$merenja -> bindParam (':id_arduina', $id_arduina);
		$merenja -> execute ();
		$merenja = $merenja -> fetch(PDO::FETCH_ASSOC);

		$temperatura = $merenja['temperatura'];
		$vlaznost_vazduha = $merenja['vlaznost_vazduha'];
		$vazdusni_pritisak = $merenja['vazdusni_pritisak'];
		$nadmorska_visina = $merenja['nadmorska_visina'];
		$vlaznost_zemljista = $merenja['vlaznost_zemljista'];
		$navodnjavanje = $merenja['navodnjavanje'];
		$vreme = $merenja['vreme_datum'];

		if (empty($temperatura))
		{
			$temperatura = 0;
		}
		if (empty($vlaznost_vazduha))
		{
			$vlaznost_vazduha = 0;
		}
		if (empty($vazdusni_pritisak))
		{
			$vazdusni_pritisak = 0;
		}
		if (empty($nadmorska_visina))
		{
			$nadmorska_visina = 0;
		}
		if (empty($vlaznost_zemljista))
		{
			$vlaznost_zemljista = 0;
		}
		if ($navodnjavanje == "")
		{
			$navodnjavanje = -0.25;
		}
		if ($navodnjavanje == 1)
		{
			$kontrola_navodnjavanja	= "Ukljuceno";
		}
		else
		{
			$kontrola_navodnjavanja	= "Iskljuceno";
		}
		return array ($nadmorska_visina, $temperatura, $vlaznost_vazduha, $vlaznost_zemljista, $vazdusni_pritisak, $navodnjavanje, $kontrola_navodnjavanja, $vreme);
	}
	public function Poslednja24h($id_arduina, $vrednost)
	{
		$merenja24h = $this -> db -> prepare ("SELECT *
											   FROM merenja
											   WHERE vreme_datum >= now() - INTERVAL 1 DAY
											   AND id_arduina = :id_arduina
											   ORDER BY id_merenja ASC
											   LIMIT 1440
											  ");
		$merenja24h -> bindParam (':id_arduina', $id_arduina);
		$merenja24h -> execute ();
		$brojac = 1;

		while ($podatak = $merenja24h -> fetch(PDO::FETCH_ASSOC))
		{
			if ($brojac == 1)
			{
				$niz_podataka_24h[] = "['" . $podatak['vreme_datum'] . "', " . $podatak[$vrednost] . "]";
			}
			if ($brojac == 15)
			{
				$brojac = 0;
			}
			$brojac ++;
		}
		@$podaci_24h = implode(',', $niz_podataka_24h);
		return $podaci_24h;
	}
	public function Azuriranje()
	{
		$temperatura = $_POST['t'];
		$vlaznost_vazduha = $_POST['v'];
		$vazdusni_pritisak = $_POST['p'];
		$vlaznost_zemljista = $_POST['z'];
		$nadmorska_visina = $_POST['l'];
		$navodnjavanje = $_POST['n'];
		$id_arduina = sha1($_POST['i']);

		if ($navodnjavanje == "Ukljuceno")
		{
			$navodnjavanje = 1;
		}
		else
		{
			$navodnjavanje = 0;
		}

		$prebaci = $this -> db -> prepare ("INSERT INTO merenja
											SET id_arduina = ?,
												temperatura = ?,
												vlaznost_vazduha = ?,
												vazdusni_pritisak = ?,
												nadmorska_visina = ?,
												vlaznost_zemljista = ?,
												navodnjavanje = ?
										   ");
		$prebaci -> execute (array ($id_arduina, $temperatura, $vlaznost_vazduha, $vazdusni_pritisak, $nadmorska_visina, $vlaznost_zemljista, $navodnjavanje));
	}
	public function Brisanje()
	{
		$obrisi = $this -> db -> prepare ("DELETE FROM merenja
										   WHERE vreme_datum < (NOW() - INTERVAL 1 DAY)
										  ");
		$obrisi -> execute();
	}
	public function AzuriranjeSimulacija()
	{
		$temperatura = rand (10, 20);
		$vlaznost_vazduha = rand (40, 70);
		$vazdusni_pritisak = rand (990, 1000);
		$vlaznost_zemljista = rand(10, 70);
		$nadmorska_visina = rand (245, 255);
		$id_arduina = 1;

		if ($vlaznost_zemljista <= 30)
		{
			$navodnjavanje = 1;
		}
		else
		{
			$navodnjavanje = 0;
		}

		$prebaci = $this -> db -> prepare ("INSERT INTO merenja
											SET id_arduina = ?,
												temperatura = ?,
												vlaznost_vazduha = ?,
												vazdusni_pritisak = ?,
												nadmorska_visina = ?,
												vlaznost_zemljista = ?,
												navodnjavanje = ?
											 ");
		$prebaci -> execute (array ($id_arduina, $temperatura, $vlaznost_vazduha, $vazdusni_pritisak, $nadmorska_visina, $vlaznost_zemljista, $navodnjavanje));
	}
}

$merenje = new Merenje($konekcija);

?>
