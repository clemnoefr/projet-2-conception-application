<?php
session_start();
if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
	$_SESSION["nom"]=false;
}

//--- doc at : http://gitserver/dev/webapp/gleamsession/wikis/Documentation ---
global $bdd;
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8', 'root', '');
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
	<title>Station Meteo</title>
	<body>
		<link rel='stylesheet' href='includes/styles_new.css' type='text/css' media='screen' />
		<link rel='stylesheet' href='includes/leaflet.css' type='text/css' media='screen' />
		<div class='parent_links' style='min-height:2%'>
		<div class='bar_acceuil'>
		<div class='button_header float-right'>
			<a href='index.php' class='home'>
				Accueil
			</a>";
			if ($_SESSION["login"] == "true"){
				echo "
				<a href='espaceclient.php' class='button_infos'>
					Tableau de bord
				</a>";
			}else{
				echo"
				<a href='connexion.php' class='button_infos'>
					Tableau de bord
				</a>";
			}
			if ($_SESSION["login"] == "true"){
				echo "
				<style>.button_header{margin-top: 2px;}</style>
				<div class='compte'>
						<nav>
						  	<ul>
						    	<li class='deroulant'><a href='#' style='width:91px;margin-top: 8px;'>".ucfirst($_SESSION['nom'])."</a>
						      		<ul class='sous'>
										<li><a href='deconnexion.php' class='compte'>Deconnecter</a></li>
						      		</ul>
						    	</li>
						  	</ul>
						</nav>
					</div>";
			}else{
				echo"
				<a href='connexion.php' class='button_connection'>
					Se Connecter
				</a>
				";
			}
			
		echo"
		</div>
		</div>
		</div>
		<div class='parent_links'>";
?>