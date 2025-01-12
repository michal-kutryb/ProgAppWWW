<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	include('cfg.php');
	include('showpage.php');

	if($_GET['idp'] == '') $strona = 1;
 	if($_GET['idp'] == 'czymsa') $strona = 2;
 	if($_GET['idp'] == 'seriale') $strona = 3;
 	if($_GET['idp'] == 'gry') $strona = 4;
 	if($_GET['idp'] == 'karty') $strona = 5;
 	if($_GET['idp'] == 'ulubione') $strona = 6;
 	if($_GET['idp'] == 'kontakt') $strona = 7;
 	if($_GET['idp'] == 'lab2') $strona = 8;
 	if($_GET['idp'] == 'lab3') $strona = 9;
 	if($_GET['idp'] == 'lab4') $strona = 10;
 	if($_GET['idp'] == 'lab5') $strona = 11;
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="pl" />
		<meta name="Author" content="Michał Kutryb" />
		<link rel="stylesheet" href="css/styles.css"/>
		<script src="js/timedate.js" type="text/javascript"></script>
		<script src="js/kolorujtlo.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<title>Moje hobby to Pokemony</title>
	</head>
	<body onload="startclock()">
		<header>
			<a href="index.php"><h1>Moje hobby to <b>Pokemony</b></h1></a>
		</header>
		<table>
			<tr>
				<td class = "menu">
					<a href="index.php?idp=czymsa">Czym są Pokemony</a>
					<a href="index.php?idp=seriale">Seriale Pokemon</a>
					<a href="index.php?idp=gry">Gry Pokemon</a>
					<a href="index.php?idp=karty">Karty Pokemon</a>
					<a href="index.php?idp=ulubione">Moje ulubione Pokemony</a>
					<a href="index.php?idp=kontakt">Kontakt</a>
					<div class="dropdown">
						<a href="#" class="dropbtn">Laboratoria</button>
						<div class="dropdown-content">
						  <a href="index.php?idp=lab2">Lab 2</a>
						  <a href="index.php?idp=lab3">Lab 3</a>
						  <a href="index.php?idp=lab4">Lab 4</a>
						  <a href="index.php?idp=lab5">Lab 5</a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class = "content">
					<?php
						echo PokazPodstrone($strona);
					?>
				</td>
			</tr>
			<tr>
				<td class = "footer">
					Autor: Michał Kutryb 169326
				</td>
			</tr>
		</table>
		<?php
 			$nr_indeksu = '169326';
 			$nrGrupy = '2';
 			echo 'Autor: Michał Kutryb '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
		?>
	</body>
</html>