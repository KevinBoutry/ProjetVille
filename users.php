<?php

$css = "users.css";
$title = "Liste des utilisateurs";
require "./ressources/template/_header.php";

if(!isset($_SESSION["superAdmin"]) || $_SESSION["superAdmin"] === 0)
{
    header("Location: ./map.php");
    exit;
}

require "./ressources/service/_pdo.php";

$pdo = connexionPDO();
$sql = $pdo->query("SELECT idUser, email, admin FROM user");
$users = $sql->fetchAll();

?>

<?php if($users): ?>
    <table>
        <thead>
            <th>id</th>
            <th>email</th>
            <th>admin</th>
            <th>action</th>
        </thead>
        <tbody>
            <?php foreach($users as $row): ?>
                <tr>
                    <td><?php echo $row["idUser"]?></td>
                    <td><?php echo $row["email"]?></td>
                    <td><?php echo $row["admin"]?></td>
                    <?php if($row["admin"] === 0 ): ?>
                        <td>
                            <a href="./addright.php?id=<?= $row["idUser"] ?>">Donner droit admin</a>
                        </td>
                    <?php endif; ?>
                    <?php if($_SESSION["superAdmin"] === 1 && $row["admin"] === 1):?>
                        <td>                   
                        <a href="./delright.php?id=<?= $row["idUser"] ?>">Supprimer droit admin</a>
                        </td> 
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php

require "./ressources/template/_footer.php";

?>