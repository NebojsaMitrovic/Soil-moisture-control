<?php

session_start();

include "klase/korisnik.php";
include "klase/merenje.php";

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

if (isset($_SESSION['korisnik']))
{

?>

	<button class = 'meni-mobilni' onclick = menu_load('meni-mobilni')> <img src = 'img/menu.png'>	</button>

	<form action = 'index.php' method = 'POST'>
		<button name = 'odjava' class = 'odjava-m'>	<img src = 'img/logout.png'> </button>
	</form>

	<header>
		<h1>Merenje temperature, vazdu&#353;nog pritiska,<br>vla&#382;nosti vazduha i vla&#382;nosti zemlji&#353;ta.</h1>
	</header>

	<nav id = 'meni-mobilni'>
		<a href = 'm.index.php'><h1> &#9898; Trenutne izmerene vrednosti</h1></a>
		<a href = 'm.index.php?strana=m.poslednja_24h&str=temperatura'><h1> &#9898; Grafik temperature u poslednja 24 &#269;asa</h1></a>
		<a href = 'm.index.php?strana=m.poslednja_24h&str=vlaznost_vazduha'><h1> &#9898; Grafik vla&#382;nosti vazduha u poslednja 24 &#269;asa</h1></a>
		<a href = 'm.index.php?strana=m.poslednja_24h&str=vlaznost_zemljista'><h1> &#9898; Grafik vla&#382;nosti zemlji&#353;ta u poslednja 24 &#269;asa</h1></a>
		<a href = 'm.index.php?strana=m.poslednja_24h&str=vazdusni_pritisak'><h1> &#9898; Grafik vazdu&#353;nog pritiska u poslednja 24 &#269;asa</h1></a>
	</nav>


<?php
	
	if (isset ($_GET['strana']))
	{
		$strana = $_GET['strana'];
		$fajl = $strana.".php";

		if(file_exists($fajl))
		{
			include ($fajl);
		}

		else
		{
			echo "<div class = 'greska404-mobilni'>Greska 404<br>Stranica ne postoji.</div>";
			header("refresh : 5; url=m.index.php");
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
		<div class = "nadmorska_visina">
			<h1>Nadmorska visina<br>
			<?php echo $nadmorska_visina; ?> m</h1>
		</div>
		
		<center>
			<table class = 'tabela-m'>
				<tr>
					<td>
						<canvas id = 'temperatura'></canvas>
					</td>
				</tr>					
				<tr>
					<td>
						<canvas id = 'vlaznost_vazduha'></canvas>							
					</td>
				</tr>					
				<tr>	
					<td>
						<canvas id = 'vazdusni_pritisak'></canvas>
					</td>
				</tr>
				<tr>
					<td>
						<canvas id = 'vlaznost_zemljista'></canvas>
					</td>
				</tr>
				<tr>
					<td>
						<canvas id = 'navodnjavanje'></canvas>
					</td>	
				</tr>
			</table>
		</center>

		<div class = "vreme_merenja">
			<h1>Vreme poslednjeg merenja: <?php echo $vreme; ?></h1>
		</div>
<?php

	}

?>

		<div class = 'footer-m'>
			<div id = 'sat'>
				<h1>
					<?php echo date('d. m. Y.') . "&nbsp;&nbsp;&nbsp;&nbsp;" . date('H : i : s') ; ?> 
				</h1>
		  	</div>
		</div>
	</body>
</html>

<?php

	include "js/red_na_rac.php";
	include "js/meni_slide.php";
	include "js/m.gauges.php";
	include "js/sat.php";
}
else
{
	include "prijava.php";		
}
?>