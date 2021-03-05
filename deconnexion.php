<?php

include ('includes/header.php');
	session_destroy();
	echo "
		<div class='bloc_central'>
			<h3>Vous avez été déconnecté</h3>
			<br/>
			<a href='index.php'>Retour</a>
		</div>
";
include ('includes/footer.php');
?>