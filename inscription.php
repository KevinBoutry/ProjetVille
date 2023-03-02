<?php

$css = "inscription.css";
$title = "Inscription";
require "./ressources/template/_header.php";
require "./ressources/service/_csrf.php";
require "./ressources/service/_shouldBeLogged.php";

if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
{
    header("Location: ./map.php");
    exit;
}

$email = $password = "";
$error = [];
$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['inscription']))
{
    require "./ressources/service/_pdo.php";
    $pdo = connexionPDO();

    // Traitement email :
    if(empty($_POST["email"]))
        $error["email"] = "Veuillez saisir un email";
    else
    {
        $email = cleanData($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error["email"] = "Veuillez saisir un email valide";

        $sql = $pdo->prepare("SELECT * FROM user WHERE email = :em");
        $sql->execute(["em"=>$email]);
        $resultat = $sql->fetch();
        if($resultat)
            $error["email"] = "Cet email est déjà enregistré";
    }
    // Traitement password :
    if(empty($_POST["password"]))
        $error["password"] = "Veuillez saisir un mot de passe";
    else
    {
        $password = cleanData($_POST["password"]);
        if(!preg_match($regexPass, $password))
            $error["password"] = "Veuillez saisir un mot de passe valide";
        else
            $password = password_hash($password, PASSWORD_DEFAULT);
    }
    // Traitement confirmation password :
    if(empty($_POST["passwordBis"]))
        $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
    else
    {
        if($_POST["password"] != $_POST["passwordBis"])
            $error["passwordBis"] = "Veuillez saisir le même mot de passe";
    }
    // envoi des données:
    if(empty($error))
    {
        $sql = $pdo->prepare("INSERT INTO user(email, password) VALUES(?, ?)");
        $sql->execute([$email, $password]);
        session_start();
        $_SESSION["logged"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["expire"] = time() + (60*60);
        header("Location: ./map.php");
        exit;
    }
}

?>
<h2>Inscription</h2>
<form action="" method="post">
    <!-- Email -->
    <label for="email">Adresse Email :</label>
    <input type="email" name="email" id="email">
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <!-- Password -->
    <label for="password">Mot de Passe :</label>
    <input type="password" name="password" id="password">
    <span class="error"><?php echo $error["password"]??"" ?></span>
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis">
    <span class="error"><?php echo $error["passwordBis"]??"" ?></span>
    <br>
    <input type="submit" value="Inscription" name="inscription">
</form>

<?php


require "./ressources/template/_footer.php"

?>