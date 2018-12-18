<?php

try
{
	$konekcija = new PDO("mysql:host=localhost;dbname=arduino_db", 'root', '');
	$konekcija -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $greska)
{
	echo $greska -> getMessage();
}

?>
