<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/ressources/css/<?= $css ?>"> 
    <link rel="stylesheet" href="/ressources/css/template.css">
    <link rel="stylesheet" href="/ressources/css/<?= $cardCss?>">
    <?php 
        echo $morecss??"";
        echo $morejs??"";
    ?>
    <script src="/ressources/js/<?= $js ?>" defer></script>
    <script src="/ressources/js/script.js" defer></script>
    <script src="./ressources/js/<?= $cardJs?>" defer></script>
</head>
<body>
    <header>
        <h1><?php echo $title ?></h1>
    </header>
