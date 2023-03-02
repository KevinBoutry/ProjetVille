<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/ressources/css/<?= $css ?>"> 
    <link rel="stylesheet" href="/ressources/css/template.css">

    <?php 
        echo $morecss??"";
        echo $morejs??"";
    ?>
    <script src="/ressources/js/<?= $js ?>" defer></script>
    <script src="/ressources/js/script.js" defer></script>

</head>
<body>
    <header>
        <img src="../../ressources/img/logo.png" alt="logo" id="logo">
        <h1><?php echo $title; ?></h1>
        <?php 
            session_start();
            // var_dump($_SESSION)
        ?>
        <?php if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true): ?>        
        <div id="user">
            <span> Utilisateur : <?php echo $_SESSION["email"]?> </span>
            <a href="/deconnexion.php">Déconnexion</a>
            <?php endif ?> 
            <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] === 1): ?>
            <a href="/admin.php">ADMIN</a>
            <a href="/users.php">USERS</a>
            <?php endif ?>
        </div>

    </header>
