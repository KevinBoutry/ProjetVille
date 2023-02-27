<?php 
if(session_status() === PHP_SESSION_NONE)
    session_start();

/**
 * Vérifie si l'utilisateur est connecté ou non, et le redirge dans le cas contraire.
 * 
 * Si $logged est à true, vérifie si l'utilisateur est connecté
 * Si $logged est à false, vérifie si l'utilisateur est déconnecté
 *
 * @param boolean $logged
 * @param string $redirect
 * @return void
 */
function shouldBeLogged(bool $logged = true, string $redirect = "/"): void 
{
    if($logged)
    {
        if(isset($_SESSION["expire"]) && time()> $_SESSION["expire"])
        {
            unset($_SESSION);
            session_destroy();
            setcookie("PHPSESSID", "",time()-3600);
        }

        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true)
        {
            header("Location: ". $redirect);
            exit;
        }
    }
    else
    {
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
        {
            header("Location: ". $redirect);
            exit;
        }
    }
}
?>