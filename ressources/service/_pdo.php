<?php

function connexionPDO(): \PDO
{
    $config = require __DIR__."/../config/_pdoConfig.php";

    $dsn =
    "mysql:host=".$config["host"]
    .";dbname=".$config["database"]
    .";charser=".$config["charset"];

    try 
    {
        $pdo = new \PDO(
            $dsn,
            $config["user"],
            $config["password"],
            $config["options"]
        );
        return $pdo;
    } 
    catch (\PDOException $e)
    {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

?>