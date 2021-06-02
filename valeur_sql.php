<?php
include ('includes/header.php');

$i = 1;
$heure = 1;
$nb_date = 1;


while ($i <= 250) {
    
    $temp = rand(0, 40);
    $humi = rand(1, 100);

    
    $date='2002-02-'.$nb_date.'';

    $sql = "INSERT INTO `releves`(`temperature`, `humidite`, `numero_serie_capteur`, `date`, `heure`) VALUES ('".$temp."', '".$humi."', '2', '$date', '$heure')";
	$bdd->exec($sql);
    
    echo"$date - $heure <br/>";

    if($heure == 24){
        $heure = 1;
        $nb_date = $nb_date + 1;
    }else{
        $heure = $heure + 1;
    }

    $i = $i + 1;
    
}

?>