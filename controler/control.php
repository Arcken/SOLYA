<?php

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
                $sPageTitle = "Ajout de Fiche Article";
                require $path . '/model/FicheArticle.php';
                require $path . '/model/FicheArticleManager.php';
                require $path . '/model/Gamme.php';
                require $path . '/model/GammeManager.php';
                require $path . '/model/Pays.php';
                require $path . '/model/PaysManager.php';
                require $path . '/model/Nutrition.php';
                require $path . '/model/NutritionManager.php';


                $resAllGa = GammeManager::getAllGammes();
                $resAllPays = PaysManager::getAllPays();
                $resAllNut = NutritionManager::getAllNutritions();
                $resMaxIdFiart = FicheArticleManager::getMaxIdFicheArticle();

                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

                    $cnx = Connection::getConnection();
                    //début de transaction
                    $cnx->beginTransaction();
                    try {
                        //on vérifie que le libellé de la fiche article soit renseigné
                        if (isset($_REQUEST['fiartLbl'])) {
                            $oFiArt = new FicheArticle();
                            echo 'FIART';
                            //On hydrate l'objet avec les paramètres de l'url
                            $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
                            $oFiArt->fiart_photos = $_REQUEST['fiartPhoto'];
                            $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
                            $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
                            $oFiArt->fiart_pays_id = $_REQUEST['pays'];

                            //on exécute la requête d'insert de la fiche article
                            FicheArticleManager::addFicheArticle($oFiArt);
                            $a = Connection::dernierId();
                            echo 'FIART ajouter !';
                            //On récupère l'id du dernier insert de la fiche article
                            $oFiArt->fiart_id = $a;

                            //On vérifie que la gamme soit renseignée
                            if (isset($_REQUEST['gamme']) && !empty($_REQUEST['gamme'])) {
                                require $path . '/model/RegrouperManager.php';
                                require $path . '/model/Regrouper.php';
                                echo 'GAMME';
                                foreach ($_REQUEST['gamme'] as $value) {
                                    echo $value;
                                    $oRegrouper = new Regrouper();

                                    $oRegrouper->fiart_id = $oFiArt->fiart_id;
                                    $oRegrouper->ga_id = $value;
                                    print_r($oRegrouper);
                                    $r = RegrouperManager::addRegrouper($oRegrouper);
                                    echo 'Gamme Ajouter !';
                                    print_r($r);
                                }
                            }

                            //On vérifie pour chaque champ de nutrition, la valeur soit !=0
                            //Comme les input du formulaires sont générés dynamiquement, leur nom est
                            //la concaténation de nut est de l'id
                            
                            require $path . '/model/InformerManager.php';
                            require $path . '/model/Informer.php';
                            foreach ($resAllNut as $object) {

                                if (isset($_REQUEST['nut' . $object->NUT_ID]) && $_REQUEST['nut' . $object->NUT_ID] != '') {
                                    
                                    echo 'nut' . $object->NUT_ID . '=' . $_REQUEST['nut' . $object->NUT_ID];
                                    $oInformer = new Informer();
                                    $oInformer->fiart_id = $oFiArt->fiart_id;
                                    $oInformer->nut_id = $object->NUT_ID;
                                    $oInformer->nutfiart_val = $_REQUEST['nut' . $object->NUT_ID];
                                    print_r($oInformer);
                                    //on exécute la requête
                                    $r = InformerManager::addInformer($oInformer);
                                    print_r($r);
                                }
                            }
                        }
                        $cnx->commit();
                        //Avec un objet PDO si l'insert n'est pas fait, il y a une remonté d'exception
                    } catch (MySQLException $e) {
                        $e->RetourneErreur();
                        $cnx->rollback();
                    }
                    //$result = FicheArticleManager::addFicheArticle($oFiArt);
                    //echo $result;
                }
                break;

            //Créer un contact    
            case "ctc_add":

                require'control_ctc_add.php';
                $sPageTitle = "Ajouter un contact";

                break;

            //gamme
            case "ga_add":
                $sPageTitle = "Ajouter une gamme";
                require $path . '/model/Gamme.php';
                require $path . '/model/GammeManager.php';
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    $oGa = new Gamme();
                    $oGa->GA_LBL = $_REQUEST['gaLbl'];
                    $oGa->GA_ABV = $_REQUEST['gaAbv'];
                    $result = GammeManager::addGamme($oGa);
                    echo $result;
                }
                $resAllGa = GammeManager::getAllGammes();
                break;

            case "pays_add":
                $sPageTitle = "Ajouter un pays";
                require $path . '/model/Pays.php';
                require $path . '/model/PaysManager.php';
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    $oGa = new Pays();

                    $result = PaysManager::addPays($oPays);
                    echo $result;
                }
                $resAllPays = PaysManager::getAllPays();
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
                    include $path . '/view/view_gamme.php';
                    break;

                case "nv_pays_add":
                    include $path . '/view/view_pays.php';
                    break;

                case "nv_nut_add":
                    include $path . '/view/view_nutrition.php';
                    break;
            }
        }
    }
}
?>