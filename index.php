<head>
    <meta charset="UTF-8"></meta>
    <link href="css/style.css" type="text/css" rel="stylesheet">

<?php
//Début de la session
session_start();

require_once 'inc/ini.inc'; //recupere parametre du fichier param.ini
//récupération du chemin du serveur web
$path = $_SERVER['DOCUMENT_ROOT'] . $sWebPath;
//Intégration de la classe gérant la connection PDO
require_once 'model/Connection.php';
//Intégration du contrôle de connection de l'utilisateur
require_once 'security/user_control.php';
//Intégration du contrôleur principale
require_once 'controler/control.php';

?>

</footer>