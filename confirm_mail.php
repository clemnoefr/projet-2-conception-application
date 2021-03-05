<?php

//--- doc at : http://gitserver/dev/webapp/gleamsession/wikis/Documentation ---
global $bdd;
try
{
	$bdd = new PDO('mysql:host=gleamsesroot.mysql.db;dbname=gleamsesroot;charset=utf8', 'gleamsesroot', 'Solidanim2017');
	$bdd->exec('SET NAMES utf8');
}
catch(Exception $e)
{
        die('Erreur '.$e->getMessage());
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<title>Animation Solidanim</title>
	<body>
		<link rel='stylesheet' href='includes/styles_new.css' type='text/css' media='screen' />
		<div class='parent_links'>
		<div class='bar_acceuil'>
		<img src='includes/solidanim.png' class='solidanim'>
		<div class='button_header float-right'>
			<a href='vrai_index.php?id=".$sess."' class='home'>
				<text>Accueil<text>
			</a>
			<a href='connexion.php?id=".$sess."' class='button_connection'>
				<text>Se Connecter<text>
			</a>
		</div>
		</div>";

echo "
<div class='bloc_central'>
	<h3>Email Confirmer</h3>
	Votre email vient d'etre confirmer, vous pouver maintenant acceder au site<br/><br/>
	<a href='index.php'>Accueil</a>
</div>
";

?>