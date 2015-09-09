<?php

$sPageTitle = "Connexion";
$sAction = '';
if (!isset($_SESSION['auth'])) {

    require 'view/view_connection.php';
} else if($_REQUEST['Action']=='Deconnexion') {
     session_destroy();
                session_commit();
                $_SESSION = array();
                require 'view/view_connection.php';
}
else{

    require_once'view/view_header.php';
    require_once'view/view_menu.php';

    if (isset($_REQUEST['Action'])) {
        $sAction = $_REQUEST['Action'];
    }

//Test si l'utilisateur est connecté si oui redirection à l'accueil.
    if (!isset($_SESSION['auth'])) {
        $sAction = 'root';
    }
    if ($sAction == '') {
        $sAction = 'home';
    }



    /* ----------------------------Traitement des données---------------------------- */
    switch ($sAction) {

        case "Deconnexion":
            if (isset($_SESSION)) {

               
            }
            break;


        case "home":
        case "Connexion":
            $sPageTitle = "Accueil";
            require 'view/view_home.php';

            break;

        case "root" :
            require_once 'view/view_connection.php';
    }
    require_once 'view/view_footer.php';
}
?>