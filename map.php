<?php

$css = "map.css";
$js = "map.js";
$title = "Map";
$morecss = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>';
$morejs = ' <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="crossorigin=""></script>';

require "./ressources/template/_header.php";

require "./ressources/service/_pdo.php";

$pdo = connexionPDO();
$sql = $pdo->query("SELECT * FROM lieu");
$lieu = $sql->fetchAll();

$json = json_encode($lieu);
$file = file_put_contents("./ressources/js/lieu.json", $json);

?>

<div id="map"></div>

<!-- <div class="infol">
    <h2>Nom du lieu</h2>
    <div id="image">
        <img src="./ressources/img/placeholder.png" alt="placeholder">
    </div>
    <div>Contact ? Horaires ? Adresse</div>
</div>

<div class="infor">

</div> -->


<?php

require "./ressources/template/_footer.php"

?>