<?php

require $path . '/inc/Tool.inc';

//titre par défaut
$sPageTitle = "Connexion";
//valeur du bouton d'un formulaire par défaut
$sButton = "Envoyer";

//on initialise les variables
$sAction = ''; //action pour le controleur
$nv = ''; //variable pour contrôler l'affichage des popups
//Initialisation valeur limite pour les requêtes si non définie 
//sinon on récupére la valeur 
//cette variable sert pour récupérer la 'limit' pour récupérer 
//le nombre d'enregistrements nécessaires
if (!isset($_REQUEST['limite']))
    $limite = 0;
else
    $limite = (int) $_REQUEST['limite'];

//Vérification de connection
//Si on n'est pas identifié on appel la page de connection
if (!isset($_SESSION['auth'])) {
    require $path . '/view/view_connection.php';
}
//sinon si action = déconnection on détruit la session
else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {
    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
}
//sinon c'est que l'on est connecté
else {
    /* -------------------------------------------------------------------------
     * ************************************************************************* 
     * **********************Partie pour les fenetres classiques****************
     * *************************************************************************
      ------------------------------------------------------------------------- */

    //si action ne contient pas nv_ (pour les popups)
    if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') === FALSE) {
        $nv = 0;
        //on récupére l'action si elle est définie
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
            case "fiart_del":
                require $path . '/controler/control_fiart_del.php';
                break;

            //Liste de fiche article
            case "fiart_list":
                require $path . '/controler/control_fiart_list.php';
                break;

            //Detail fiche article et maj fiche article            
            case "fiart_detail":
                require $path . '/controler/control_fiart_detail.php';
                break;

//--------------------------------Contact---------------------------------------
            //Créer un contact    
            case "ctc_add":
                require $path . '/controler/control_ctc_add.php';
                $sPageTitle = "Ajouter un contact";

                break;

//-------------------------------gamme------------------------------------------
            //ajout de gamme
            case "ga_add":
                require_once $path . '/controler/control_ga_add.php';
                break;

            //liste des gammes
            case "ga_list":
                require_once $path . '/controler/control_ga_list.php';
                break;

            //détail d'une gamme
            case "ga_detail":
                require_once $path . '/controler/control_ga_detail.php';
                break;

            //Suppression d'une gamme
            case "ga_del":
                require $path . '/controler/control_ga_del.php';
                break;

//---------------------------------Pays-----------------------------------------
            //ajout de pays
            case "pays_add":
                require $path . '/controler/control_pays_add.php';
                break;

//---------------------------------Nutrition------------------------------------
            //ajout de nutrition
            case "nut_add":
                require $path . '/controler/control_nut_add.php';
                break;

//--------------------------------Référence-------------------------------------
            //ajout de référence
            case "ref_add":
                require $path . '/controler/control_ref_add.php';
                break;

            //Liste des références
            case "ref_list":
                require $path . '/controler/control_ref_list.php';
                break;

            //Détail d'une référence
            case "ref_detail":
                require $path . '/controler/control_ref_detail.php';
                break;

            //Suppression d'une référence
            case "ref_del":
                require $path . '/controler/control_ref_del.php';
                break;

//---------------------------Ajout Utilisateur----------------------------------
            //Ajout d'un utilisateur
            case "utilisateur_add":
                require $path . '/controler/control_ut_add.php';
                break;

            //Liste des utilisateurs
            case "utilisateur_list":
                require $path . '/controler/control_ut_list.php';
                break;

            //Détail de l'utilisateur
            case "utilisateur_detail":
                require $path . '/controler/control_ut_detail.php';
                break;
        }

        /* ----------------------------Affichage---------------------------------
         * -------------------------------------------------------------------- */
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        switch ($sAction) {

            case "home":
            case "connexion":
                require $path . '/view/view_home.php';
                break;

            //Catalogue
//------------------------------ Fiche article----------------------------------
            case "fiart_supp":
                $sAction = "fiart_list";
            case "fiart_list":
                require $path . '/view/view_fiche_article_list.php';
                break;

            case "fiart_add":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Envoyer') {
                    require $path . '/view/view_fiche_article_list.php';
                } else {
                    require $path . '/view/view_fiche_article.php';
                }
                break;

            case "fiart_detail":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_fiche_article_list.php';
                } else {                   
                    require $path . '/view/view_fiche_article_rw.php';
                }
                break;

//-------------------------------------- Gamme----------------------------------

            case "ga_detail":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_gamme_list.php';
                } else {
                    require $path . '/view/view_gamme_ru.php';
                }
                break;

            case "ga_add":
                //case "ga_add_add":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_gamme_list.php';
                }
                require $path . '/view/view_gamme.php';
                break;

            case "ga_supp":
                $sAction = "ga_list";
            case "ga_list":
                require $path . '/view/view_gamme_list.php';
                break;

//-------------------------------Références-------------------------------------

            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference.php';
                break;

            case "ref_detail":
                $sPageTitle = "Consulter Modifier une référence";
                require $path . '/view/view_reference_rw.php';
                break;

            case "ref_del":
                $sAction = "ref_list";
            case "ref_list":
                require $path . '/view/view_reference_list.php';
                break;


//--------------------------------Contacts--------------------------------------

            case "ctc_add":
                require $path . '/view/view_creer_contact.php';
                break;

//-------------------------------------Pays-------------------------------------

            case "pays_add":
                require $path . '/view/view_pays.php';
                break;

            case "nut_add":
                require $path . '/view/view_nutrition.php';
                break;

//----------------------------------Utilisateur---------------------------------

            case "utilisateur_add":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    require $path . '/view/view_utilisateur_liste.php';
                } else {
                    require $path . '/view/view_utilisateur.php';
                }
                break;

            case "utilisateur_list":
                require $path . '/view/view_utilisateur_liste.php';
                break;

            case "utilisateur_detail":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Modifier") {
                    require $path . '/view/view_utilisateur_liste.php';
                } else {
                    require $path . '/view/view_utilisateur_detail_ru.php';
                }
                break;
        }
        //fin des switchs on appel le footer des pages
        require_once $path . '/view/view_footer.php';
    } else {

        /** -------------------------------------------------------------------------
         * ************************************************************************* 
         * **********************Partie pour les popups ****************************
         * *************************************************************************
          ------------------------------------------------------------------------- */
        //Si la fenetre est une popup
        if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') !== FALSE) {
            $sAction = $_REQUEST['action'];
            $nv = 1;

            /* ----------------------------Traitement--------------------------------- */
            switch ($sAction) {
                //gammme
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

                //pays
                case 'nv_pays_add':
                    $sPageTitle = "Ajouter un pays";
                    require $path . '/model/Pays.php';
                    require $path . '/model/PaysManager.php';
                    if (isset($_REQUEST['btnForm']) 
                            && $_REQUEST['btnForm'] == "Envoyer") {
                        try {
                            $oPays = new Pays();
                            $oPays->pays_abv = $_REQUEST['paysAbv'];
                            $oPays->pays_nom = $_REQUEST['paysNom'];
                            $oPays->pays_dvs_abv = $_REQUEST['paysDvsAbv'];
                            $oPays->pays_dvs_nom = $_REQUEST['paysDvsNom'];
                            $oPays->pays_dvs_sym = $_REQUEST['paysDvsSym'];

                            $result = PaysManager::addPays($oPays);
                            $id = Connection::dernierId();
                            if ($result == 1) {
                                $resMessage = "<font color='green'> "
                                        . "L'ajout du pays N° $id intitulée: "
                                        . "$oPays->pays_nom est un succés</font>";
                            } else {
                                $resMessage = "<font color='red'> L'ajout du pays"
                                        . " est un échec, champs mal remplies</font>";
                            }
                        } catch (MySQLException $e) {
                            $resMessage = "<font color='red'> L'ajout du pays "
                                    . "est un échec</font>";
                        }
                    }
                    $resAllPays = PaysManager::getAllPays();
                    break;

                //nutrition
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

                //gamme
                case "nv_ga_add":
                    require $path . '/view/view_gamme.php';
                    break;

                //pays
                case "nv_pays_add":
                    require $path . '/view/view_pays.php';
                    break;

                //nutrition
                case "nv_nut_add":
                    require $path . '/view/view_nutrition.php';
                    break;
            }
        }
    }
}
?>