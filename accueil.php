<?php

$css = "accueil.css";
$title = "Accueil";
require "./ressources/template/_header.php";
require "./ressources/service/_shouldBeLogged.php";
require "./ressources/service/_pdo.php";

shouldBeLogged(false, "/map.php");

if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
{
    header("Location: /map.php");
    exit;
}
$email = $password = "";
$error = [];

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
{
    if(empty($_POST["email"]))
        $error["email"] = "Veuillez entrer un email";
    else
        $email = trim($_POST["email"]);
    
    if(empty($_POST["password"]))
        $error["password"] = "Veuillez entrer un mot de passe";
    else
        $password = trim($_POST["password"]);
    if(empty($error))
    {
        $pdo = connexionPDO();
        $sql = $pdo->prepare("SELECT * FROM user WHERE email = :em");
        $sql->execute(["em"=>$email]);
        $user = $sql->fetch();        

        if($user){
            if(password_verify($password, $user["password"]))
            {
                $_SESSION["logged"] = true; 
                $_SESSION["email"] = $user["email"];
                $_SESSION["admin"] = $user["admin"];
                $_SESSION["superAdmin"] = $user["superAdmin"];
                $_SESSION["idUser"] = $user["idUser"];
                $_SESSION["expire"] = time()+ (60*60);
                header("location: /map.php");
                exit;
            }
            else
            {
                $error["login"] = "Email ou Mot de passe incorrect.";
            }
        }
        else
        {
            $error["login"] = "Email ou Mot de passe incorrect.";
        }
    }        
}

?>
<div class="accueil">
    <h1>Bienvenue à Lille</h1>    
</div>

<div>
    <!-- zone de connexion -->

    <form action="" method="POST">
        <h1>Connexion</h1>
        <label><b>Adresse mail</b></label>
        <input type="text" placeholder="Entrer votre email" name="email" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
        <br>

        <input type="submit" id='submit' value='login' name="login">
        <br>
        <label><a href="./inscription.php">créer un compte</a></label>
        <br>
        <a href="./map.php">Continuer sans se connecter</a>
        <?php
        if (isset($_POST['erreur'])) {
            $err = $_POST['erreur'];
            if ($err == 1 || $err == 2)
                echo "<p style='color:red'>email ou mot de passe incorrect</p>";
        }
        ?>
    </form>
    <div id="bouton">
        <div id="g_id_onload" data-client_id="526772582364-1r50q1bsceackgl23qphee8spgjmahtn.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="http://localhost" data-auto_prompt="false">
        </div>

        <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="filled_blue" data-text="signin_with" data-size="large" data-logo_alignment="left">
        </div>
    </div>
</div>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php

require "./ressources/template/_footer.php"

?>