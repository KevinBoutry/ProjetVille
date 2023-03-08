<?php

require "./ressources/service/_shouldBeLogged.php";
require "./ressources/service/_pdo.php";
shouldBeLogged(true, "./accueil.php");

if(!isset($_SESSION["superAdmin"]) || $_SESSION["superAdmin"] === 0)
{
    header("Location: ./accueil.php");
    exit;
}

if(empty($_GET["id"]))
{
    header("Location: ./users.php");
    exit;
}

$pdo = connexionPDO();
$sql = $pdo->prepare("DELETE FROM users WHERE idUser = ?");
$sql->execute([(int)$_GET["id"]]);
header("Location: ./users.php");

?>