<?php

require_once 'model/Connection.php';
require_once 'inc/ini.inc'; //recupere parametre du fichier param.ini
require_once 'inc/model.inc';
require      'security/user_control.php'; //connexion et control de connexion utilisateur

$sPageTitle="Connexion";

//Test si l'utilisateur est connecté si oui redirection à l'accueil.
 if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
     $sPageTitle="Accueil";
     require 'view/view_home.php';
    
 }
 else{   
     require 'view/view_connection.php';
 }
     
    
/*----------------------------Traitement des données----------------------------*/
switch ($sAction){
    
    
        
}
?>