<?php

@session_start();

include "klase/korisnik.php";

if (! $korisnik -> Prijavljen()) 
{

?>

<!doctype html>
<html>
	<head>
		<title>Merenje temperature, vazdu&#353;nog pritiska, vla&#382;nosti vazduha i vla&#382;nosti zemlji&#353;ta.</title>
		<link rel="icon" type="image/png" href="img/icon.png"/>
		<link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<script>var CANV_GAUGE_FONTS_PATH = 'fonts/'</script>
	</head>
	<body>
		<a href = 'prijava.php' class = 'nazad_na_prijavu'> << Prijava</a>
		<center>
			<div class = 'prijava' style = 'margin-top: 0;'>
				<h1>Registracija</h1>
				<form action = 'registracija.php' method = 'POST' enctype = 'multipart/form-data'>
					<input type = 'text' name = 'ime' placeholder = 'Unesite korisni&#269;ko ime' minlength = 5 maxlength = 20 required>
					<input type = 'password' name = 'lozinka' placeholder = 'Unesite lozinku' minlength = 5 maxlength = 20 required>
					<input type = 'password' name = 'ponovi_lozinku' placeholder = 'Ponovo unesite lozinku' minlength = 5 maxlength = 20 required>
					<input type = 'password' name = 'id_arduina' placeholder = 'Unesite ID' maxlength = 20 required>
					<textarea readonly rows='4'>Potrebno je da unesete korisni&#269;ko ime, lozinku, ponovo unesete istu lozinku da bi proverili da nije do&#353;lo do gre&#353;ke prilikom kucanja, ID ure&#273;aja i sigurnosni kod. Korisni&#269;ko ime i lozinku birate sami, dok je ID definisan u okviru samog programa i predstavlja jedinstveni identifikator mernog ure&#273;aja.
					</textarea>
					<input type = 'text' name = 'provera' maxlength = 50 style = 'width: 45%;' readonly value = <?php echo substr(sha1(microtime()) . md5(microtime()),rand(0,52),5); ?> >
					<input type = 'text' name = 'kod' placeholder = 'Unesite kod' maxlength = 50 required style = 'width: 45%;'>
					<button name = 'registracija'>Registrujte se</button>
				</form>
			</div>
		</center>
	</body>
</html>

<?php

	if (isset($_POST['registracija']))
	{
		$korisnicko_ime = $_POST['ime'];
		$lozinka = sha1($_POST['lozinka']);
		$ponovi_lozinku = sha1($_POST['ponovi_lozinku']);
		$id = sha1($_POST['id_arduina']);
		$kod = $_POST['kod'];
		$provera = $_POST['provera'];

		switch ($korisnik -> Registracija($korisnicko_ime, $lozinka, $ponovi_lozinku, $id, $kod, $provera))
		{
			case 'maks_korisnika':
?>
				<div class = 'prijava_poruka' style = 'background-color: DarkRed;'>
					<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
					Merenja sa ovog Arduina prati maksimalan broj korisnika.
				</div>
<?php
				break;

			case 'isto_ime':
?>
				<div class = 'prijava_poruka' style = 'background-color: DarkRed;'>
					<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
					Postoji korisnik sa istim imenom,<br> poku&#353;ajte ponovo sa drugim korisni&#269;kim imenom.
				</div>
<?php
				break;
			
			case 'razlicite_lozinke':
?>
				<div class = 'prijava_poruka' style = 'background-color: DarkRed;'>
					<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
					Lozinke nisu iste.
				</div>
<?php
				break;

			case 'razlicit_kod':
?>
				<div class = 'prijava_poruka' style = 'background-color: DarkRed;'>
					<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
					Unesite  tacan kod.
				</div>
<?php
				break;

			default:
?>
				<div class = 'prijava_poruka' style = 'background-color: DarkGreen;'>
					<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
					Uspe&#353;na registracija.
				</div>
<?php
				header("refresh:3; url = index.php");
				break;
		}
	}
}
else
{
	header("Location: index.php");
}

?>