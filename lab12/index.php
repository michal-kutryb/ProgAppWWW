<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	include('cfg.php');
	include('showpage.php');

	$query = "SELECT id, page_title FROM page_list LIMIT 100";
    $result = mysqli_query($link, $query);

	if($_GET['idp'] == '') $strona = 1;

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		if($_GET['idp'] == $row['page_title']) $strona = (int)$row['id'];
	}
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
					<a href="index.php?idp=sklep">Sklep</a>
					<a href="admin.php">Admin Panel</a>
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
						if($_GET['idp'] == 'sklep') include('shop.php');
						else
						{
							echo PokazPodstrone($strona);
						}
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