<head>
    <meta charset="UTF-8"></meta>
    <link href="css/style.css" type="text/css" rel="stylesheet">
     <?php
    //Début de la session
    session_start();
    //connexion et control de connexion utilisateur
    require_once 'inc/ini.inc'; //recupere parametre du fichier param.ini
    require_once 'model/Connection.php';
    require_once 'inc/model.inc';
    require 'security/user_control.php';
    require_once'controler/control.php';
    //Test si l'utilisateur est connecté si non retour à connexion.
    ?>
</head>

   
    <title> <?php echo $sTitle; ?> </title>

