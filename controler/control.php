<?php

//inclut la classe outils contenant quelques fonctions
require_once $path . '/inc/Tool.inc';


//Initialisation des variables-------------------------------------
//action pour le controleur
if (isset($_REQUEST['action'])) {
    $sAction = $_REQUEST['action'];
} else {
    $sAction = 'home';    
}

//valeur du bouton d'un formulaire par défaut
$sButton = "Envoyer";

//variable pour contrôler l'affichage des popups
$nv = '';

//Message en cas d'inventaire ouvert
$invMes = "<h1>Un inventaire est en cours<h1>";

//Initialisation valeur limite pour les requêtes 
//cette variable sert pour récupérer la 'limit' pour faire des select d'un 
//nombre précis d'enregistrement
if (!isset($_REQUEST['limite']))
    $rowStart = 0;
else
    $rowStart = (int) $_REQUEST['limite'];


//-----------------------fin init variable--------------------------------------


//----------------------------Test si l'utilisateur veut se déconnecter---------
if ($sAction == 'deconnexion') {
    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
}
//Sinon c'est que l'on veut faire une action
else {
    
    /* **********************Partie pour les fenetres classiques***************/

    //Si action ne contient pas nv_ (pour les popups)
    if (strpos($sAction, 'nv_') === FALSE) {
        
        //$nv sert pour l'affichage du header et du footer, on le met à 0 pour
        //les fenétres classiques et 1 pour les popups
        $nv = 0;
        
        //traitement
        require $path . '/controler/controlNormalTraitement.php';

        //affichage
        require $path . '/controler/controlNormalAffichage.php';

        //On appel le footer des pages
        require $path . '/view/view_footer.php';
        
    } else {

    /************************Partie pour les popups ***************************/
        
        //Si la fenetre est une popup
        if (strpos($sAction, 'nv_') !== FALSE) {
            require 'controlPopup.php';
        }
    }
}
