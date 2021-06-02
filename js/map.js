

$(function () {

    // à l'aide de l'API IPapi on récupère les coordonnées GPS de l'utilisateur

    $.getJSON('https://ipapi.co/json/', function (data) {

        // géolocalisation pour centrer la map
        var latitude = data.latitude;
        var longitude = data.longitude;

        // initialisation de la map
        var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
        let map = L.map("mapid").setView([latitude, longitude], 14).addLayer(osm);

       

        // création d'un marqueur sur la map à l'emplacement de géolocalisation
        var marker = L.marker([latitude, longitude]).addTo(map);       

    });
});
