<?php

$css = "map.css";
$js = "map.js";
$title = "Map";
$morecss = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>';
$morejs = ' <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="crossorigin=""></script>';

require "./ressources/template/_header.php";

?>

<div id="map"></div>

<!-- <div class="info"></div> -->


<?php

require "./ressources/template/_footer.php"

?>