<?php

session_start();

include "klase/korisnik.php";

if (! $korisnik -> Prijavljen()) 
{	
	if (isset($_POST['prijava']))
	{
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = sha1($_POST['lozinka']);

		if($korisnik -> Prijava($korisnicko_ime, $lozinka))
		{
			header("Location: index.php");
		}
		else
		{

?>

			<div class = 'prijava_poruka' style = 'background-color: DarkRed;'>
				<span style = 'cursor: pointer; float: left; text-align: left;' onclick = "this.parentElement.style.display = 'none';">&times;</span>
				Korisnik sa unetim podacima ne postoji, poku&#353;ajte ponovo.
			</div>

<?php

		}
	}

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
		<center>
			<div class = 'prijava'>
				<h1>Prijava</h1>
				<form action = 'prijava.php' method = 'POST'>
					<input type = 'text' name = 'korisnicko_ime' placeholder = 'Unesite ime' required>			
					<input type = 'password' name = 'lozinka' placeholder = 'Unesite lozinku' required>
					<button name = 'prijava'>Prijavite se</button>
				</form>
				<a href = 'registracija.php'>Registrujte se</a>
			</div>
		</center>
	</body>
</html>

<?php

}
else
{
	header("location: index.php");
}

?>