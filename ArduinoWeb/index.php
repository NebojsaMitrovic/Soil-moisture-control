<?php

session_start();

include "klase/korisnik.php";
include "klase/merenje.php";

$merenje -> Brisanje();

?>

<!doctype html>
<html>
	<head>
		<title>Merenje temperature, vazdu&#353;nog pritiska, vla&#382;nosti vazduha i vla&#382;nosti zemlji&#353;ta.</title>
		<link rel="icon" type="image/png" href="img/icon.png"/>
		<meta http-equiv = 'refresh' content = '120'> 
		<link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<script>var CANV_GAUGE_FONTS_PATH = 'fonts/'</script>
	</head>
	<body>

<?php

if ($korisnik -> Prijavljen())
{

?>
		<button class = 'meni' onclick = menu_load('meni')><h2>Meni &#9776;</h2></button>

		<form action = 'index.php' method = 'POST'>
			<button name = 'odjava' class = 'odjava'><h2>Odjavite se</h2></button>
		</form>

		<header>
			<h3>Merenje temperature, vazdu&#353;nog pritiska, vla&#382;nosti vazduha i vla&#382;nosti zemlji&#353;ta.</h3>
		</header>
		
		<nav id = 'meni'>
			<a href = 'index.php'><h2> &#9898; Trenutne izmerene vrednosti</h2></a>
			<a href = 'index.php?strana=poslednja_24h&str=temperatura'><h2> &#9898; Grafik temperature u poslednja 24 &#269;asa</h2></a>
			<a href = 'index.php?strana=poslednja_24h&str=vlaznost_vazduha'><h2> &#9898; Grafik vla&#382;nosti vazduha u poslednja 24 &#269;asa</h2></a>
			<a href = 'index.php?strana=poslednja_24h&str=vlaznost_zemljista'><h2> &#9898; Grafik vla&#382;nosti zemlji&#353;ta u poslednja 24 &#269;asa</h2></a>
			<a href = 'index.php?strana=poslednja_24h&str=vazdusni_pritisak'><h2> &#9898; Grafik vazdu&#353;nog pritiska u poslednja 24 &#269;asa</h2></a>
		</nav>
<?php

	if( isset($_POST['odjava']))
	{
		$korisnik -> Odjava();
		header("Location: prijava.php");
	}

	if (  isset ($_GET['strana']))
	{
		$strana = $_GET['strana'];
		$fajl = $strana.".php";

		if(file_exists($fajl))
		{
			include ($fajl);
		}

		else
		{
			echo "<div class = 'greska404'>Greska 404<br>Stranica ne postoji.</div>";
			header("refresh : 5; url=index.php");
		}
	}
	else
	{
		$podaci_merenja = $merenje -> PoslednjaMerenja($_SESSION['id_arduina']);

		$nadmorska_visina = $podaci_merenja[0];
		$temperatura = $podaci_merenja[1];
		$vlaznost_vazduha = $podaci_merenja[2];
		$vlaznost_zemljista = $podaci_merenja[3];
		$vazdusni_pritisak = $podaci_merenja[4];
		$navodnjavanje = $podaci_merenja[5];
		$kontrola_navodnjavanja = $podaci_merenja[6];
		$vreme = $podaci_merenja[7];

?>

		<table class = 'tabela'>
			<tr>
				<td>
					<canvas id = 'temperatura'></canvas>
				</td>
				<td>
					<canvas id = 'vlaznost_vazduha'></canvas>				
				</td>
				<td>
					<canvas id = 'vlaznost_zemljista'></canvas>   
				</td>
			</tr>
			<tr>
				<td>
					<canvas id = 'vazdusni_pritisak'></canvas>
				</td>
				<td>
					<div class = 'displej'>
						<p>nadmorska visina<br><br> <?php echo $nadmorska_visina; ?> m</p>
						<p style = 'border-top: dashed white;'>Vreme merenja<br><br> <?php echo $vreme; ?> </p>
					</div>
				</td>
				<td>
					<canvas id = 'navodnjavanje'></canvas>
				</td>	
			</tr>
		</table>

<?php

	}		

?>

		<footer>
			<div id = 'sat'>
				<p>
					<span style = 'float: left;'>
						<?php echo date('d.m.Y.'); ?>
					</span>
					<span style = 'float: right;'>
						<?php echo date('H:i:s'); ?>
					</span>
				</p>
			</div>
		</footer>
	</body>
</html>

<?php
	
	include "js/red_na_mob.php";
	include "js/meni_slide.php";
	include "js/gauges.php";
	include "js/sat.php";
}
else
{
	header("location: prijava.php");		
}

?>