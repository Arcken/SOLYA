<?php

require_once 'model/Connection.php';
require_once 'inc/ini.inc'; //recupere parametre du fichier param.ini
require_once 'inc/model.inc';
require      'security/user_control.php'; //connexion et control de connexion utilisateur

$sPageTitle="Connexion";
$sAction='root';

if (isset($_REQUEST['Action'])) {
    $sAction = $_REQUEST['Action'];
}

//Test si l'utilisateur est connecté si oui redirection à l'accueil.
 if (!isset($_SESSION['auth']) ){
      $sAction='root';
 }
 
    
    
/*----------------------------Traitement des données----------------------------*/
switch ($sAction){
    
    case "Deconnexion":
        if(isset($_SESSION)){
            
            session_destroy();
            session_commit();
            $_SESSION=array();
            require 'index.php';
            }
            break;
    

    case "Accueil":
    case "Connexion":
        
        $sPageTitle="Accueil";
        require 'view/view_home.php';
        
        break;
    
    case "root" :
        require_once 'view/view_connection.php';
        
    }
    echo $sAction;
?>