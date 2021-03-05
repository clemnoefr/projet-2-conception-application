<?php

include ('includes/header.php');

echo"
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js'></script>
    <div class='bloc_tableau_de_bord'>
        Tableau de bord Station Meteo
    </div>
    <div class='bloc_infos'>
";
$login=0;

$sql = "SELECT adresse FROM users WHERE id_user = ".$_SESSION['id']."";
$sql2 = "SELECT * FROM releves INNER JOIN capteurs ON releves.numero_serie_capteur = capteurs.numero_serie_capteur INNER JOIN stations ON capteurs.numero_serie_station = stations.numero_serie_station	WHERE stations.id_user = ".$_SESSION['id']."";

foreach  ($bdd->query($sql) as $row) {
    $adresse = '';

    if(isset($row['adresse'])){
		$adresse = $row['adresse'];
    }
    
}
foreach  ($bdd->query($sql2) as $row2) {

    $temp = '';
    $humi = '';

	if(isset($row['temperature'])){
		$temp = $row['temperature'];
    }
    if(isset($row['humiditer'])){
		$humi = $row['humiditer'];
    }
}
	echo "	
        <div class='flex'>
            <div class='bloc_temp_humi'>
                <div class='title_temp_humi'>Capteur Température et Humidité</div>
                <div class='bloc_temp'>
                    <div class='temp_title'>
                        Température
                    </div>
                    <div class='circle'>
                        <div class='temp'>
                            $temp
                        </div>
                    </div>
                </div>
                <div class='bloc_humi'>
                    <div class='humi_title'>
                        Humiditer
                    </div>
                    <div class='circle' style='right:37%'>
                        <div class='humi'>
                            $humi
                        </div>
                    </div>
                </div>
            </div>
            <div class='bloc_meteo'>
                <div class='meteo_title'>Météo Actuel</div>
                <a href='modif_adresse.php' class='adresse'>
		    		$adresse
                </a>
            </div>
        </div>
        <div class='bloc_graph_jour'>
            <div class='title_graph'>
                Relevé des Température et d'humiditer pendant la journée
            </div>
            <canvas id='myChart' width='400' height='400'></canvas>
            <script src='js/jour_graph.js'></script>
        </div>
        <div class='bloc_graph_semaine'>
            <div class='title_graph'>
                Relevé des Température et d'humiditer de la semaine
            </div>
            <canvas id='myChart2' width='400' height='400'></canvas>
            <script src='js/semaine_graph.js'></script>
        </div>
        
    ";

    
include ('includes/footer.php');
?>