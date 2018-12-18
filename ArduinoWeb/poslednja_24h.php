<?php

if ($korisnik -> Prijavljen())
{
	$str = $_GET['str'];
	$podaci_24h = $merenje -> Poslednja24h($_SESSION['id_arduina'], $str);

	switch ($str) 
	{
		case 'temperatura':
			$naslov = 'Temperatura';
			break;

		case 'vlaznost_vazduha':
			$naslov = 'Vla\u017Enost vazduha';
			break;

		case 'vlaznost_zemljista':
			$naslov = 'Vla\u017Enost zemlji\u0161ta';
			break;

		case 'vazdusni_pritisak':
			$naslov = 'Vazdu\u0161ni pritisak';
			break;

		default:
			$naslov = 'Neimenovana stranica';
			break;
	}
	echo "<div id = 'grafik'></div>";
}
else
{
	header("location: prijava.php");
}

?>