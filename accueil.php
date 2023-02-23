<?php

$css = "accueil.css";
$title = "Accueil";
require "./ressources/template/_header.php";

?>
<div class="acceuil">
    <h1>Bienvenue à Lille</h1>
    
</div>
<div>
    <!-- zone de connexion -->

    <form action="verification.php" method="POST">
        <h1>Connexion</h1>
        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
        <br>
        <br>

        <input type="submit" id='submit' value='LOGIN'>
        <br>
        <label><a href="">créer un compte</a></label>
        <?php
        if (isset($_POST['erreur'])) {
            $err = $_POST['erreur'];
            if ($err == 1 || $err == 2)
                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
        }
        
        ?>
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
        data-size="large" 
        data-logo_alignment="left">
        </div>
    </div>  
</div>
    </form>
    






<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php


require "./ressources/template/_footer.php"

?>