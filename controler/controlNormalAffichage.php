<?php
/* ----------------------------Affichage---------------------------------
         * -------------------------------------------------------------------- */
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';

        switch ($sAction) {

            case "home":
            case "connexion":
                require $path . '/view/view_home.php';
                break;
//-------------------------------Bon sortie/reprise-----------------------------

            case "bon_add":
                require $path . '/view/view_bon.php';
                break;

            case "bon_detail":
                require $path . '/view/view_bon_ru.php';
                break;

            case "bon_list":
                require $path . '/view/view_bon_list.php';
                break;

//-------------------------------Bon entrée-------------------------------------

            case "be_add":
                require $path . '/view/view_bon_entree.php';
                break;

            case "be_detail":
                require $path . '/view/view_bon_entree_ru.php';
                break;

            case "be_list":
                require $path . '/view/view_bon_entree_list.php';
                break;

//------------------------------ Fiche article----------------------------------
            case "fiart_del":

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
                    $sAction = "fiart_detail_upd";
                    require $path . '/view/view_fiche_article_ru.php';
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
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_gamme_list.php';
                }
                require $path . '/view/view_gamme.php';
                break;

            case "ga_del":

            case "ga_list":
                require $path . '/view/view_gamme_list.php';
                break;

//----------------------------------- Inventaire -------------------------------
            case "inventaire_add":
                require $path . '/view/view_inventaire_c.php';
                break;


//-------------------------------Références-------------------------------------

            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference.php';
                break;

            case "ref_upd":
                $sPageTitle = "Modifier une référence";
                require $path . '/view/view_reference_upd.php';
                break;

            case "ref_detail":
                $sPageTitle = "Consulter une référence";
                require $path . '/view/view_reference_detail.php';
                break;

            case "ref_del":

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

            case "pays_detail":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_pays_list.php';
                } else {
                    require $path . '/view/view_pays_ru.php';
                }
                break;

            case "pays_del":

            case "pays_list":
                require $path . '/view/view_pays_list.php';
                break;

//-----------------------------------Nutrition----------------------------------            

            case "nut_add":
                require $path . '/view/view_nutrition.php';
                break;

            case "nut_detail":
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_nutrition_list.php';
                } else {
                    require $path . '/view/view_nutrition_ru.php';
                }
                break;

            case "nut_del":

            case "nut_list":
                require $path . '/view/view_nutrition_list.php';
                break;

//----------------------------------Utilisateur---------------------------------

            case "export":
                require $path . '/view/view_export.php';
                break;

            case "utilisateur_add":
                require $path . '/view/view_utilisateur.php';
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