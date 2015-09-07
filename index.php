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
session_start();
require_once('inc/ini.inc'); //recupere parametre du fichier param.ini
// Initialisation des variables

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php $sTitre ?></title>
    </head>
    <body>
        <?php
     require 'view/view_menu.php';
     //require 'view/view_connexion.php'
        ?>
    </body>
</html>
>>>>>>> origin/master
