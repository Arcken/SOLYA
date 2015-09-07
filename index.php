<<<<<<< HEAD
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <?php
        require 'view/view_header.php';
        ?>
        <div id="wrap">
        <?php require 'controler/control.php'; 
        ?>
        </div>
        ?>
 
=======
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start(); //lance la session
require_once 'controler/control.php'; //appel page du contrôleur
require_once('inc/ini.inc'); //recupere parametre du fichier param.ini
// Initialisation des variables

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $sTitre ?></title>
    </head>
    <body>
        <?php
        echo $user;
        echo $base;
        echo $pwd;
        echo $host;
                
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE)
            require 'view/view_menu.php';
        else 
            require 'view/view_connection.php';
     //require 'view/view_connexion.php'
        ?>
    </body>
</html>
>>>>>>> origin/master
