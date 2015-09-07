<?php

require_once 'model/Connection.php';
require_once 'model/model.php';
require_once('inc/ini.inc'); //recupere parametre du fichier param.ini

//Test si l'utilisateur est connecté si oui redirection à l'accueil.
 if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE)
     require 'view/view_home.php';
 else 
     require 'view/view_connection.php';
    
/*----------------------------Traitement des données----------------------------*/
switch ($sAction){
    
    
        
}
?>