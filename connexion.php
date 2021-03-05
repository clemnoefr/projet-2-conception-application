<?php
include ('includes/header.php');

//auth
$secure = 1;
//----------authentification--------------
if(isset($_POST['mail']) && !empty($_POST['mail'])){
    $password = $_POST['mdp'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
	$mdp = "";
	$sql = "SELECT mdp, id_user, nom, prenom FROM users WHERE mail = '".addslashes($_POST['mail'])."'" ;
	foreach  ($bdd->query($sql) as $row) {
		if(isset($row['mdp'])){
			$mdp = $row['mdp'];
        }
		if($_POST['mdp'] == $mdp){
            $secure = 0;
            $_SESSION['login'] = 'true';
            $_SESSION['id'] = $row['id_user'];
            $_SESSION['nom'] = $row['nom'];
		}
	}
}
if($secure == 1 ){

    echo "
            <script>
            
                function mailF(){
                    document.getElementById('mailForm').submit();				
                }
                
                function mailEnter(event){
                    if(event.keyCode == 13){
                        document.getElementById('mailForm').submit();
                    }
                }
                
            </script>
            <div class='bloc_central'>
                <form method='post' id='mailForm'>
                <br/><div class='bienvenue'>Bienvenue</div>
                <div class='bienvenue_desc'>Connectez vous pour continuer</div>
                <br/><input type='text' name='mail' placeholder='Adresse mail' class='input_mail_page' onkeypress='mailEnter(event)'/><br/>
                <br/><input type='password' placeholder='Mot de passe' name='mdp' class='input_mail_page' onkeypress='mailEnter(event)'/>";
                
                
                
                if($secure == 1 && isset($_POST['mail'])){echo "<br/><br/><div class='error'>Mot de passe ou mail incorrect</div>";}
    echo "
                <br/><br/><input type='button' value='     SE CONNECTER      ' class='link_white' onClick = 'mailF()'/><br/>
                </form>
				<div>
					<div class='ligne_gauche'></div>
					<text class='ou'>OU</text>
					<div class='ligne_droite'></div>
				</div>
				<a href='creation_compte.php' class='link_white' style='margin-top:20px;display: block;width: 50%;white-space: normal;margin-left: 22%;'>
					<text>INSCRIVEZ-VOUS<text>
				</a>
			</div>
		
	";}
//quand tout est bon, affichage de la page normale
if(isset($_POST['mail']) && $secure == 0){
    header('Location: espaceclient.php');
}
include ('includes/footer.php');
?>