<?php
// Doit être importé au début de chaques documents
session_start();

// Valeur par défaut
if (!isset($_SESSION["active"]))
{
    $_SESSION["active"] = false;
}

// Déconnexion
if ($_POST && isset($_POST["log-out"]))
{
    $_SESSION["active"] = false;
    unset($_SESSION["email"]);

    // Eviter de rediriger l'utilisateur sur une page qui lui est interdite :p
    if (str_contains($_SERVER["REQUEST_URI"], "administration.php"))
    {
        header("Location: index.php");
    }
}

?>
