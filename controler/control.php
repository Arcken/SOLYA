<?php

//inclut la classe outils contenant quelques fonctions
require_once $path . '/inc/Tool.inc';

//titre par défaut
$sPageTitle = "Connexion";
//valeur du bouton d'un formulaire par défaut
$sButton = "Envoyer";

//Initialisation des variables
//action pour le controleur
$sAction = '';

//variable pour contrôler l'affichage des popups
$nv = '';

//Message en cas d'inventaire ouvert
$invMes = "<h1>Un inventaire est en cours<h1>";

//Initialisation valeur limite pour les requêtes si non définie 
//sinon on récupére la valeur 
//cette variable sert pour récupérer la 'limit' pour faire des select d'un 
//nombre précis d'enregistrement
if (!isset($_REQUEST['limite']))
    $rowStart = 0;
else
    $rowStart = (int) $_REQUEST['limite'];


// si action = déconnection on détruit la session
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {
    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
}
//Sinon c'est que l'on veut faire une action
else {
    
    /* -------------------------------------------------------------------------
     * ************************************************************************* 
     * **********************Partie pour les fenetres classiques****************
     * *************************************************************************
     * ---------------------------------------------------------------------- */

    //Si action ne contient pas nv_ (pour les popups)
    if (isset($_REQUEST['action']) 
            && strpos($_REQUEST['action'], 'nv_') === FALSE) {
        
//$nv sert pour l'affichage du header et du footer, on le met à 0 pour
        //les fenétres classiques et 1 pour les popups
        $nv = 0;

        //on récupére l'action si elle est définie
        if (isset($_REQUEST['action'])) {
            $sAction = $_REQUEST['action'];
        }
        
        //traitement
        require $path . '/controler/controlNormalTraitement.php';

        //affichage
        require $path . '/controler/controlNormalAffichage.php';

        //fin des switchs on appel le footer des pages
        require $path . '/view/view_footer.php';
        
    } else {

    /**-------------------------------------------------------------------------
    * ************************************************************************** 
    * ***********************Partie pour les popups ****************************
    * **************************************************************************
    ------------------------------------------------------------------------- */
        
        //Si la fenetre est une popup
        if (isset($_REQUEST['action']) && 
                strpos($_REQUEST['action'], 'nv_') !== FALSE) {
            require 'controlPopup.php';
        }
    }
}
