<?php

$css = "map.css";
$js = "map.js";
$title = "Map";
$morecss = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>
    <link rel="stylesheet" href="./ressources/css/card.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />';

$morejs = '<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="crossorigin=""></script>
    <script src="./ressources/js/card.js" defer></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>';

require "./ressources/template/_header.php";

require "./ressources/service/_pdo.php";

$pdo = connexionPDO();
$sql = $pdo->query("SELECT * FROM lieu l LEFT JOIN quizz q ON l.idLIeu = q.idLieu");
$lieu = $sql->fetchAll();
$json = json_encode($lieu);
$file = file_put_contents("./ressources/js/lieu.json", $json);

?>

<div id="map"></div>

<?php

require "./ressources/template/_footer.php"

?>
