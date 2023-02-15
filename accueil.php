<?php

$css = "accueil.css";
$title = "Accueil";
require "./ressources/template/_header.php";

?>
<div class="acceuil">
    <h1>Bienvenue à Lille</h1>
    <a href="">Commencez la visite</a>
    </div>
    <div id="bouton">
    <div id="g_id_onload" 
    data-client_id="526772582364-1r50q1bsceackgl23qphee8spgjmahtn.apps.googleusercontent.com" 
    data-context="signin" 
    data-ux_mode="popup" 
    data-login_uri="http://localhost" 
    data-auto_prompt="false">
    </div>
    
    <div class="g_id_signin" 
    data-type="standard" 
    data-shape="pill" 
    data-theme="filled_blue" 
    data-text="signin_with" 
    data-size="large" data-logo_alignment="left">
    </div>
    </div>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php


require "./ressources/template/_footer.php"

?>