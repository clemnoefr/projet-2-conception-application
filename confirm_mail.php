<?php

include('includes/header.php');

if(isset($_GET['login'])){
	$sql = "UPDATE `users` SET `validation`= '1' WHERE mail ='".addslashes($_GET['mail'])."' ";
	$bdd->query($sql);
}

echo "
	<div class='bloc_central'>
		<h3>Email Confirmer</h3>
		Votre email vient d'etre confirmer, vous pouver maintenant acceder au site<br/><br/>
		<a href='index.php'>Accueil</a>
	</div>";

include('includes/footer.php');
?>