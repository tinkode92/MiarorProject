<?php
// afficher les messages d'erreurs du PHP.
ini_set('display_errors', '1');

const HOST = "localhost";

const DATABASE = "MIAROR";

const USERNAME = "root";

const PASSWORD = "root";

try
{

    $database = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USERNAME, PASSWORD, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
    /*
    Affiche les messages d'erreurs qui sont liées à la base donnée.
    Encodage au format utf-8
    */
}
catch(PDOException $error)
{
    echo "probleme connexion : " . $error->getMessage();
}

?>
