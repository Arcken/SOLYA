<?php
require $path.'/inc/Tool.inc';

$sPageTitle = "Connexion";
$sAction = '';
$sButton = "Envoyer";
$nv = ''; //variable de contrôle pour les popups
//$sPhp_Action='';
//$sButton='';

if (!isset($_SESSION['auth'])) {

    require $path . '/view/view_connection.php';
} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {

    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
} else {
    if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') === FALSE) {
        $nv = 0;
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
                require 'control_fiart_add.php';
                break;

            //Créer un contact    
            case "ctc_add":

                require 'control_ctc_add.php';
                $sPageTitle = "Ajouter un contact";

                break;

            //gamme
            case "ga_add":
                require 'control_ga_add.php';
                break;

            case "pays_add":
                require 'control_pays_add.php';
                break;
                
            case "ref_add":
                require 'control_ref_add.php';
                break;
            
            //Liste fiche article
            case "fiart_list":
                require $path . '/model/FicheArticle.php';
                require $path . '/model/FicheArticleManager.php';
                $resFiartList = FicheArticleManager::getAllFichesArticles();
                break;
            
            //Detail fiche article
            case "fiart_detail":
                require $path . '/model/FicheArticle.php';
                require $path . '/model/FicheArticleManager.php';
                if (isset($_REQUEST['fiartId'])){
                    $iFiartId = $_REQUEST['fiartId'];
                $resFiartDetail = FicheArticleManager::getFicheArticleDetail($iFiartId);
                print_r($resFiartDetail);
                }
                $sButton = "Modifier";
                break;
            
            //liste référence
            case "ref_list":
                require $path . '/control/control_ref_list.php';                
                break;
            
        }

        /* ----------------------------Affichage--------------------------------- */
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        switch ($sAction) {

            case "home":
            case "connexion":
                require $path . '/view/view_home.php';
                break;

            //Catalogue
            case "fiart_add":
                $sPageTitle = "Ajouter une fiche article";
                require $path . '/view/view_fiche_article.php';
                break;
            
            case "fiart_detail":
                $sPageTitle = "Détail fiche article";
                require $path . '/view/view_fiche_article.php';
                break;
            
            case "ga_add":
            case "ga_add_add":

                $sPageTitle = "Ajouter une gamme";
                require $path . '/view/view_gamme.php';
                break;

            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference.php';
                break;

            //Contacts
            case "ctc_add":
                require $path . '/view/view_creer_contact.php';
                break;
            
            //Liste fiche article
            case "fiart_list":
                require $path.'/view/view_list_fiche_article.php';
                break;
            
            //liste référence
            case "ref_list":
                require $path.'/view/view_list_reference.php';
                break;
        }
        require_once $path . '/view/view_footer.php';
    } else {
        /* ----------------------------Popup--------------------------------- */

        if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') !== FALSE) {
            $sAction = $_REQUEST['action'];
            $nv = 1;
            /* ----------------------------Traitement--------------------------------- */
            switch ($sAction) {

                case "nv_ga_add":
                    require $path . '/model/Gamme.php';
                    require $path . '/model/GammeManager.php';
                    $sPageTitle = "Ajouter une gamme";
                    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                        $oGa = new Gamme();
                        $oGa->GA_LBL = $_REQUEST['gaLbl'];
                        $oGa->GA_ABV = $_REQUEST['gaAbv'];
                        $result = GammeManager::addGamme($oGa);
                    }
                    $resAllGa = GammeManager::getAllGammes();
                    break;

                case 'nv_pays_add':
                    $sPageTitle = "Ajouter un pays";
                    require $path . '/model/Pays.php';
                    require $path . '/model/PaysManager.php';
                    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                        $oPays = new Pays();
                        $oPays->PAYS_ABV = $_REQUEST['paysAbv'];
                        $oPays->PAYS_NOM = $_REQUEST['paysNom'];
                        $oPays->PAYS_DVS_ABV = $_REQUEST['paysDvsAbv'];
                        $oPays->PAYS_DVS_NOM = $_REQUEST['paysDvsNom'];
                        $oPays->PAYS_DVS_SYM = $_REQUEST['paysDvsSym'];
                        $result = PaysManager::addPays($oPays);
                        echo $result;
                    }
                    $resAllPays = PaysManager::getAllPays();
                    break;

                case 'nv_nut_add':
                    
                    $sPageTitle = "Ajouter une information";
                    require $path . '/model/Nutrition.php';
                    require $path . '/model/NutritionManager.php';
                    
                    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                        $oNut = new Nutrition();
                        $oNut->nut_lbl = $_REQUEST['nutLbl'];
                        $result = NutritionManager::addNutrition($oNut);
                        echo $result;
                    }
                    
                    $resAllNut = NutritionManager::getAllNutritions();
                    break;
            }

            /* ----------------------------Affichage--------------------------------- */
            switch ($sAction) {

                case "nv_ga_add":
                    require $path . '/view/view_gamme.php';
                    
                    break;

                case "nv_pays_add":
                    require $path . '/view/view_pays.php';
                    break;

                case "nv_nut_add":
                    require $path . '/view/view_nutrition.php';
                    break;
            }
        }
    }
}
?>