<?php

require $path . '/inc/Tool.inc';

$sPageTitle = "Connexion";
$sAction = '';
$sButton = "Envoyer";
$nv = ''; //variable de contrôle pour les popups
//Initialisation valeur limite pour les requêtes si non définie
if (!isset($_REQUEST['limite']))
    $limite = 0;
else
    $limite = (int) $_REQUEST['limite'];

//Vérification de connection
if (!isset($_SESSION['auth'])) {
    require $path . '/view/view_connection.php';
} else if (isset($_REQUEST['action']) 
        && $_REQUEST['action'] == 'deconnexion') {

    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
} 
else {
    if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') === FALSE) {
        $nv = 0;
        if (isset($_REQUEST['action'])) {
            $sAction = $_REQUEST['action'];
        }

        // ----------------------------Traitement des données-----------------//
        //--------------------------------------------------------------------//

        switch ($sAction) {

            case "home":
            case "connexion":
                $sPageTitle = "Accueil";
                break;
//-------------------------------Fiche article-------------------------------
            //Ajout de fiche article
            case "fiart_add":
                require $path . '/controler/control_fiart_add.php';
                break;

            //Suppression de fiche article
            case "fiart_supp":
                require_once $path . '/model/FicheArticle.php';
                require_once $path . '/model/FicheArticleManager.php';
                $res = FicheArticleManager::delFicheArticle($_REQUEST['fiartId']);
                if ($res == 1) {
                    $resMessage = "<font color='orange'> La fiche article N° " . $_REQUEST['fiartId'] . " est supprimée</font>";
                }
                require $path . '/controler/control_fiart_list.php';
                break;

            //Liste de fiche article
            case "fiart_list":
                require $path . '/controler/control_fiart_list.php';
                break;

            //Detail fiche article et maj fiche article
            case "fiart_detail_upd":
            case "fiart_detail":
                require $path . '/controler/control_fiart_detail.php';
                break;
            
            //Créer un contact    
            case "ctc_add":
                require $path . '/controler/control_ctc_add.php';
                $sPageTitle = "Ajouter un contact";

                break;

            //gamme
            case "ga_add":
                require $path . '/controler/control_ga_add.php';
                break;

            case "pays_add":
                require $path . '/controler/control_pays_add.php';
                break;

            case "ref_add":
                require $path . '/controler/control_ref_add.php';
                break;

            case "nut_add":
                require $path . '/controler/control_nut_add.php';
                break;

            //liste référence
            case "ref_list":
                require $path . '/controler/control_ref_list.php';
                break;
            //Détail référence

            case "ref_detail":
                require $path . '/controler/control_ref_detail.php';
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
                $sAction = "fiart_detail_upd";
                $sPageTitle = "Détail fiche article";
                require $path . '/view/view_fiche_article_rw.php';
                break;

            case "ga_add":
            case "ga_add_add":

                $sPageTitle = "Ajouter une gamme";
                require $path . '/view/view_gamme.php';
                break;

            //Références
            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference.php';
                break;

            case "ref_detail":
                $sPageTitle = "Consulter Modifier une référence";
                require $path . '/view/view_reference_rw.php';
                break;

            //Contacts
            case "ctc_add":
                require $path . '/view/view_creer_contact.php';
                break;

            //Liste fiche article
            case "fiart_supp":
                $sAction = "fiart_list";
            case "fiart_detail_upd":
            case "fiart_list":
                $sPageTitle = "Liste fiche article";
                require $path . '/view/view_list_fiche_article.php';
                break;

            //liste référence
            case "ref_list":
                require $path . '/view/view_list_reference.php';
                break;
            
            //Pays add
            case "pays_add":
                require $path . '/view/view_pays.php';
                break;
            
            case "nut_add":
                require $path . '/view/view_nutrition.php';
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