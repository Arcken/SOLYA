<?php

$sPageTitle = "Connexion";
$sAction = '';
//$sPhp_Action='';
//$sButton='';

if (!isset($_SESSION['auth'])) {
    require $path.'/view/view_connection.php';
} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {

    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path.'/view/view_connection.php';
} else {
    if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'newView') == false) {
        require_once $path.'/view/view_header.php';
        require_once $path.'/view/view_menu.php';

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

                require $path.'/model/FicheArticle.php';
                require $path.'/model/FicheArticleManager.php';

                $sButton = "Envoyer";

                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

                    $oFiArt = new FicheArticle();
                    //$oFiArt->fiart_id      = $_REQUEST[''];
                    $oFiArt->fiart_pays_id = $_REQUEST['pays'];
                    $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
                    //$oFiArt->fiart_photos  = $_REQUEST[''];
                    $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
                    $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
                    echo $oFiArt->fiart_lbl;
                    $result = FicheArticleManager::addFicheArticle($oFiArt);
                    echo $result;
                }

                break;

            case "ctc_add":
                $sButton = "Envoyer";
                break;

            //gamme
            case "ga_add_add":
                require $path.'/model/Gamme.php';
                require $path.'/model/GammeManager.php';

                $oGa = new Gamme();
                $oGa->GA_LBL = $_REQUEST['gaLbl'];
                $result = GammeManager::addGamme($oGa);
                echo $result;
                break;
        }

        /* ----------------------------Affichage--------------------------------- */
        switch ($sAction) {

            case "home":
            case "connexion":
                require $path.'/view/view_home.php';
                break;

            //Catalogue
            case "fiart_add":
                $sPageTitle = "Ajouter une fiche article";
                require $path.'/view/view_fiche_article.php';
                break;


            case "ga_add":
            case "ga_add_add":
                $sAction = '';
                $sPageTitle = "Ajouter une gamme";
                require $path.'/view/view_gamme.php';
                break;



            case "ctc_add":
                require $path.'/view/view_creer_contact.php';
                break;
        }
        require_once $path.'/view/view_footer.php';
    } else {
        if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'newView') != false) {
            $sAction = $_REQUEST['action'];

            switch ($sAction) {
                case newViewGamme:
                    include $path.'/view_gamme.php';
            }
        }
    }
}
?>