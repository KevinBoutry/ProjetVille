<?php

$css = "admin.css";
$title = "Admin";
require "./ressources/template/_header.php";

$nomLieu = $adresse = "";
$lat = $lon = 0;
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

    if(empty($error))
    {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = $pdo->prepare("INSERT INTO lieu(nomLieu, lat, lon, adresse, image) VALUES (?,?,?,?,?)");
        $sql->execute([$nomLieu, $lat ,$lon ,$adresse, $target_name]);
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

    <input type="submit" value="Enregistrer" name="save">
</form>

<?php

require "./ressources/template/_footer.php"

?>