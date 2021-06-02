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

//graph 24H
$url = "http://127.0.0.1:5000/releve_capteur/".$_SESSION['id']."";
$raw = file_get_contents($url);
$json = json_decode($raw);
$temp = $json[0] -> temperature;
$humi = $json[0] -> humidite;
$temperature=[];
$humidite=[];
$heure=[];

for($i=count($json)-24; $i< count($json); $i++){
    
    $temperature[]=$json[$i] -> temperature;
    $humidite[]=$json[$i] -> humidite;
    
    
    $heure[]=$json[$i] -> heure .'H';
  
}

$temperatureWeek=[];
$humiditeWeek=[];
$jourWeek=[];
$j=1;

$temperatureMoyenne=[];
$humiditeMoyenne=[];

for($i=count($json)-168; $i< count($json); $i++){        
    if($json[$i] -> heure == 6 || $json[$i] -> heure == 12 || $json[$i] -> heure == 18 || $json[$i] -> heure == 24){
        $temperatureMoyenne[]=$json[$i] -> temperature;
        $humiditeMoyenne[]=$json[$i] -> humidite;    
        if($j ==4){
            // moyenne
            $temperatureWeek[]= array_sum($temperatureMoyenne)/4;
            $humiditeWeek[]=array_sum($humiditeMoyenne)/4;
            $jourWeek[]=$json[$i] -> date;
            $j=1;
            unset($temperatureMoyenne);
            unset($humiditeMoyenne);
        }else{
            $j++;
        }
    
    }
   
  
}


$url2 = "http://127.0.0.1:5000/users/".$_SESSION['id']."";
$raw2 = file_get_contents($url2);
$json2 = json_decode($raw2);
$adresse = $json2[0] -> adresse;



echo "	
    <div class='bloc_temp_humi'>
        <div class='title_temp_humi'>Capteur Température et Humidité</div>
        <div class='temp_title'>
            Température
        </div>
        <div class='bloc_temp'>
            $temp
        </div>
        <div class='humi_title'>
            humidité
        </div>
        <div class='bloc_humi'>
            $humi%
        </div>
    </div>
    <div class='bloc_meteo'>
        <div class='meteo_title'>Météo Actuel</div>
        <a href='modif_adresse.php' class='adresse'>
            $adresse
        </a>";
        if($humi <= 10){
            echo"<img class='img_meteo' src='includes/soleil.png'/>";
        }elseif($humi > 10 & $humi <= 25){
            echo"<img class='img_meteo' src='includes/soleil_nuageux.png'/>";
        }elseif($humi > 25 & $humi <= 35){
            echo"<img class='img_meteo' src='includes/nuageux.png'/>";
        }elseif($humi > 35 & $humi <= 55){
            echo"<img class='img_meteo' src='includes/petite_averse.png'/>";
        }elseif($humi > 55 & $humi <= 85){
            echo"<img class='img_meteo' src='includes/pluie.png'/>";
        }elseif($humi > 85 & $humi <= 100){
            echo"<img class='img_meteo' src='includes/orage.png'/>";
        }
        echo"
        <div id='mapid' class='map'></div>
    </div>";
    ?>
    <script>
        var temperature= <?= json_encode($temperature);?>;
        var humidite= <?=json_encode($humidite);?>;
        var heure= <?= json_encode($heure);?>;

        var jourWeek= <?=json_encode($jourWeek);?>;
        var temperatureWeek= <?=json_encode($temperatureWeek);?>;
        var humiditeWeek= <?=json_encode($humiditeWeek);?>;
       
    </script>
     <script src="js/jquery.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/map.js"></script>
   
    <?php  
    echo"
    <div class='bloc_graph_jour'>
        <div class='title_graph'>
            Relevé des Température et d'humidité pendant la journée
        </div>
        <canvas id='myChart' width='400' height='400'></canvas>
        <script src='js/jour_graph.js'></script>
    </div>
    <div class='bloc_graph_semaine'>
        <div class='title_graph'>
            Relevé des Température et d'humidité de la semaine
        </div>
        <canvas id='myChart2' width='400' height='400'></canvas>
        <script src='js/semaine_graph.js'></script>
    </div>

    
";

  
include ('includes/footer.php');
?>
