<?php

$sPageTitle = "Connexion";
$sAction = '';

if (!isset($_SESSION['auth'])) {
    require 'view/view_connection.php';
} 
else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {
    
    session_destroy();
    session_commit();
    $_SESSION = array();
    require 'view/view_connection.php';
    
} 
else {
    
    require_once'view/view_header.php';
    require_once'view/view_menu.php';
    
    if (isset($_REQUEST['action'])) {
        $sAction = $_REQUEST['action'];
    }

    /* ----------------------------Traitement des données-------------------- */

    switch ($sAction) {

        case "home":
        case "connexion":
            $sPageTitle = "Accueil";
            break;
       
     //Catalogue
        case "fiart_add":
            require 'model/FicheArticle.php';
            require 'model/FicheArticleManager.php';
            
            if(isset($_REQUEST['fiart_add'])){
               $oFiArt= new FicheArticle(); 
            }
            
            break;
    }

    /* ----------------------------Affichage--------------------------------- */
    switch ($sAction) {

        case "home":
        case "connexion":
            require 'view/view_home.php';
            break;
        
        //Catalogue
        case "fiart":
            require 'view/view_fiche_article.php';
            break;
        
    }
    require_once 'view/view_footer.php';
}
?>