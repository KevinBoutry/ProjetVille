<?php

unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);

header("Location: /accueil.php");
exit;

?>