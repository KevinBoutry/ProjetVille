<?php

require "./ressources/service/_shouldBeLogged.php";
require "./ressources/service/_pdo.php";
shouldBeLogged(true, "./accueil.php");

if(!isset($_SESSION["admin"]) || $_SESSION["admin"] === 0)
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
$sql = $pdo->prepare("UPDATE user SET admin = :adm WHERE idUser = :id");
$sql->execute([
    "adm" => 1,
    "id" => $_GET["id"]
]);
header("Location: ./users.php");

?>