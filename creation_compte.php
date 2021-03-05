<?php header('Content-type: text/html; charset=UTF-8');

include ('includes/header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = 1;


//creation d'un pré-compte si le form est valide

if(isset($_POST['nom'])){
	$mdp = "";
    $sql = "SELECT login FROM users WHERE login = '".addslashes($_POST['login'])."'" ;
    if (is_array($bdd->query($sql))){
		foreach  ($bdd->query($sql) as $row) {
    }
    }
	if(!isset($row['login'])){
		$login = 0;
	}
	if( strlen($_POST['nom']) == 0){
		$login = 13;
	}
	if( strlen($_POST['prenom']) == 0){
		$login = 14;
	}
	if(empty($_POST['mailrecup'])){
		$login = 10;
	}
	if( empty($_POST['mdp']) ){
		$login = 4;
	}
	if( empty($_POST['login'])){
		$login = 3;
	}
	if(strlen($_POST['login']) >= 20){
		$login = 5;
	}
	if( strlen($_POST['mdp']) > 30){
		$login = 6;
	}
	if( strlen($_POST['mdp']) < 7){
		$login = 7;
	}
	if( strlen($_POST['login']) < 5){
		$login = 8;
    }
    if( strlen($_POST['entreprise']) == 0){
		$login = 11;
	}
	if( !isset($_POST['conditions'])){
		$login = 9;
	}
	if( $_POST['mdp'] != $_POST['mdp2'] ){
		$login = 2;
	}
}
// req nouveau pré-compte
if(isset($_POST['login']) && $login == 0 && isset($_POST['conditions'])){
	$sql = "INSERT INTO `users` (`login`, `mdp`, `mailrecup`, `nom`, `prenom`, `entreprise`, `validation`) VALUES ('".addslashes($_POST['login'])."', '".addslashes($_POST['mdp'])."', '".addslashes($_POST['mailrecup'])."', '".addslashes($_POST['nom'])."', '".addslashes($_POST['prenom'])."', '".addslashes($_POST['entreprise'])."', '0')";
	$bdd->exec($sql);
	$email = $_POST['mailrecup'];
    $headers = "From: Animation <admin@gleam-session.com>\r\n".
		   "MIME-Version: 1.0" . "\r\n" .
           "Content-type: text/html; charset=UTF-8" . "\r\n";
	$message = "Cliquer sur le bouton <a href='https://www.gleam-session.com/animation/confirm_mail.php?login=".$_POST['login']."> valider</a> pour confirmer votre adresse mail sur le site Animation.

	\n\n";
	mail($email, '[Animation] - Confirmation Mail', $message, $headers);


	echo "
		<div class='bloc_central'>
			<h3>Confirmation mail</h3>
			Veuillez confirmer le mail de vérification que nous vous avons envoyer, vous pourrez vous-y connecter dès que l'adresse mail sera valide<br/><br/>
			<a href='index.php'>Se connecter</a>
		</div>
";
}

if(!isset($_POST['nom']) || $login != 0 || !isset($_POST['conditions'])){

//---pass the data from a textarea input into an input type = text---
echo "<script>
function Pass_candidature(){
	document.getElementById('form_candidature').submit();
}
</script>";
echo "	<div class='bloc_central_inscription'>
			<form method='post' charset='UTF-8' enctype='multipart/form-data' id='form_candidature' name='form_candidature' action='#'>

			<br/><div class='bienvenue' style='font-size:40px'>Création de compte</div><br/>
			<br/><input type='text' name='nom'  placeholder='Nom' class='input_login_page crea_nom'/><br/>
			<br/><input type='text' name='prenom'  placeholder='Prenom' class='input_login_page crea_prenom'/><br/>
			<br/><input type='text' name='mailrecup' placeholder='Mail' class='input_login_page crea_mail'/><br/>
			<br/><input type='password' name='mdp'  placeholder='Mot de passe' class='input_login_page crea_mdp1'/><br/>
			<br/><input type='password' name='mdp2'  placeholder='Confirmer le mot de passe' class='input_login_page crea_mdp2'/><br/>
			<br/><input type='text' name='stations'  placeholder='Numero de Serie de la stations' class='input_login_page crea_stations'/><br/>
			<br/><input type='text' name='adresse' placeholder='Adresse' class='input_login_page crea_adresse'/><br/>
			<br/><input type='text' name='ville' placeholder='Ville' class='input_login_page crea_ville'/><br/>
			<br/><input type='text' name='codepostal' placeholder='Code Postal' class='input_login_page crea_codepostal'/><br/>
";
			
			//----simple passage de login à autre chose que 0 selon le pb-----
			if($login == 1 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Ce login est déja utilisé</div>";}
			if($login == 2 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Les deux mots de passe ne sont pas identiques</div>";}
			if($login == 3 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Le login ne peut pas être vide</div>";}
			if($login == 4 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Le mot de passe ne peut pas être vide</div>";}
			if($login == 5 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Login trop long</div>";}
			if($login == 6 && isset($_POST['login'])){echo "<br/><br/><div class='error'>La longueur maximum du mot de passe est de 30 caractères</div>";}
			if($login == 7 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Votre mot de passe doit faire au moins 7 caractères</div>";}
			if($login == 8 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Votre login doit faire au moins 5 caractères</div>";}
			if($login == 9 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Veuillez accepter les conditions générales d'utilisation</div>";}
            if($login == 10 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Veuillez renseigner une adresse mail pour récupérer votre mot de passe</div>";}
            if($login == 11 && isset($_POST['login'])){echo "<br/><br/><div class='error'>L'entreprise ne peut pas être vide</div>";}
			if($login == 13 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Vous devez renseigner votre Nom</div>";}
			if($login == 14 && isset($_POST['login'])){echo "<br/><br/><div class='error'>Vous devez renseigner votre Prenom</div>";}
			
echo "
			<div class='autre'>
				<label>
					<input type='checkbox' name='conditions'>
					<span></span>
				</label>J'accepte les
				<a href='CGU.php' target='_BLANK' class = 'link_green'>Conditions Générales d'Utilisation</a>
				<br/>
				<br/><input type='button' value='Soumettre ma demande' name='creation_compte' class='link_white' onclick='Pass_candidature()'/><br/><br/>
				</form>
				<a href='index.php' class = 'link_green'>Retour</a>
			</div>
		</div>
";}



include ('includes/footer.php');

?>