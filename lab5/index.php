<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	if($_GET['idp'] == '') $strona = 'html/glowna.html';
 	if($_GET['idp'] == 'czymsa') $strona = 'html/czymsa.html';
 	if($_GET['idp'] == 'seriale') $strona = 'html/seriale.html';
 	if($_GET['idp'] == 'gry') $strona = 'html/gry.html';
 	if($_GET['idp'] == 'karty') $strona = 'html/karty.html';
 	if($_GET['idp'] == 'ulubione') $strona = 'html/ulubione.html';
 	if($_GET['idp'] == 'kontakt') $strona = 'html/kontakt.html';
 	if($_GET['idp'] == 'lab2') $strona = 'html/lab2.html';
 	if($_GET['idp'] == 'lab3') $strona = 'html/lab3.html';
 	if($_GET['idp'] == 'lab4') $strona = 'html/lab4.php';
 	if($_GET['idp'] == 'lab5') $strona = 'html/filmy.html';


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
						if($strona !== null && file_exists($strona))
							include($strona);
						else
							echo "Strona nie istnieje";
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