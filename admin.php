<?php

$css = "admin.css";
$title = "Admin";
require "./ressources/template/_header.php";

if(!isset($_SESSION["admin"]) || $_SESSION["admin"] === 0)
{
    header("Location: ./map.php");
    exit;
}

$nomLieu = $adresse = $question = $choix1 = $choix2 = $choix3 = $choix4 = "";
$lat = $lon = $reponse = 0;
$error = [];
$target_dir = "./ressources/img/";
$target_file = $target_name = $mime_type = $oldName = "";
$typePermis = ["image/png", "image/jpeg", "image/gif"];

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save']))
{
    require "./ressources/service/_pdo.php";
    $pdo = connexionPDO();

    // Vérification Nom du Lieu
    if(empty($_POST["nomLieu"]))
        $error["nomLieu"] = "Ce champs ne peut pas être vide";
    else
        $nomLieu = $_POST["nomLieu"];
    
    // Vérification Latitude
    if(empty($_POST["lat"]))
        $error["lat"] = "Ce champs ne peut pas être vide";
    else
        $lat = $_POST["lat"];
    
    // Vérification Longitude
    if(empty($_POST["lon"]))
        $error["lon"] = "Ce champs ne peut pas être vide";
    else
        $lon = $_POST["lon"];
    
    // Vérification adresse
    if(empty($_POST["adresse"]))
        $error["adresse"] = "Ce champs ne peut pas être vide";
    else
        $adresse = $_POST["adresse"];
    
    // Vérification image
    if(empty($_FILES["image"]) || !is_uploaded_file($_FILES["image"]["tmp_name"]))
        $error = "Aucune image sélectionnée";
    else
    {
        $oldName = basename($_FILES["image"]["name"]);
        $target_name = uniqid(time()."-", true)."-".$oldName;
        $target_file = $target_dir . $target_name;
        $mime_type = mime_content_type($_FILES["image"]["tmp_name"]);

        if(file_exists($target_file))
            $error = "Ce fichier existe déjà";
        if($_FILES["image"]["size"] > 5000000)
            $error = "Ce fichier est trop gros.";
        if(!in_array($mime_type, $typePermis))
            $error = "Ce type de fichier n'est pas accepté. Merci d'utiliser du .jpeg, .png ou .gif";
    }

    // Vérification Question
    if(empty($_POST["question"]))
        $error["question"] = "Ce champs ne peut pas être vide";
    else
        $question = $_POST["question"];
    
    // Vérification Choix 1
    if(empty($_POST["choix1"]))
        $error["choix1"] = "Vous devez au moins avoir 2 choix de réponse";
    else
        $choix1 = $_POST["choix1"];

    // Vérification Choix 2
    if(empty($_POST["choix2"]))
        $error["choix2"] = "Vous devez au moins avoir 2 choix de réponse";
    else
        $choix2 = $_POST["choix2"];
    
    // Choix 3 et 4 non obligatoires
    $choix3 = $_POST["choix3"];
    $choix4 = $_POST["choix4"];

    // Vérification Réponse
    // if(empty($_POST["reponse"]))
    //     $error["reponse"] = "Ce champs ne peut pas être vide";
    // else
        $reponse = $_POST["reponse"];

    // Enregistrement du lieu
    if(empty($error))
    {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = $pdo->prepare("INSERT INTO lieu(nomLieu, lat, lon, adresse, image) VALUES (?,?,?,?,?)");
        $sql->execute([$nomLieu, $lat ,$lon ,$adresse, $target_name]);
        $id = $pdo->lastInsertId();
        $sql = $pdo->prepare("INSERT INTO quizz(question, choix1, choix2, choix3, choix4, reponse, idLieu) VALUES (?,?,?,?,?,?,?)");
        $sql->execute([$question, $choix1, $choix2, $choix3, $choix4, $reponse, $id]);
    }
}
?>

<h2>Ajout d'un nouveau point d'interet</h2>

<form action="" method="post" enctype="multipart/form-data">

    <!-- Nom du lieu -->
    <label for="nomLieu">Nom du lieu :</label>
    <input type="text" name="nomLieu" id="nomLieu"><br>
    <span class="error"><?php echo $error["nomLieu"]??"" ?></span>
    <!-- Latitude -->
    <label for="lat">Latitude :</label>
    <input type="text" name="lat" id="lat"><br>
    <span class="error"><?php echo $error["lat"]??"" ?></span>
    <!-- Longitude -->
    <label for="lon">Longitude :</label>
    <input type="text" name="lon" id="lon"><br>
    <span class="error"><?php echo $error["lon"]??"" ?></span>
    <!-- Image -->
    <label for="image">Ajouter une image</label>
    <input type="file" name="image" id="image"><br>
    <span class="error"><?php echo $error["image"]??"" ?></span>
    <!-- Adresse -->
    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" id="adresse"><br>
    <span class="error"><?php echo $error["adresse"]??"" ?></span>
    <!-- Question -->
    <label for="question">Question :</label>
    <textarea type="text" name="question" id="question" cols="60" rows="1"></textarea><br>
    <span class="error"><?php echo $error["question"]??"" ?></span>
    <!-- Choix 1 -->
    <label for="choix1">Choix 1 :</label>
    <textarea type="text" name="choix1" id="choix1" cols="60" rows="1"></textarea><br>
    <span class="error"><?php echo $error["choix1"]??"" ?></span>
    <!-- Choix 2 -->
    <label for="choix2">Choix 2 :</label>
    <textarea type="text" name="choix2" id="choix2" cols="60" rows="1"></textarea><br>
    <span class="error"><?php echo $error["choix2"]??"" ?></span>
    <!-- Choix 3 -->
    <label for="choix3">Choix 3 :</label>
    <textarea type="text" name="choix3" id="choix3" cols="60" rows="1"></textarea><br>
    <!-- Choix 4 -->
    <label for="choix1">Choix 4 :</label>
    <textarea type="text" name="choix4" id="choix4" cols="60" rows="1"></textarea><br>
    <!-- Réponse -->
    <label for="reponse">Réponse :</label>
    <input type="number" name="reponse" id="reponse"><br>
    <span class="error"><?php echo $error["reponse"]??"" ?></span>

    <input type="submit" value="Enregistrer" name="save" id="save">
</form>

<?php

require "./ressources/template/_footer.php"

?>