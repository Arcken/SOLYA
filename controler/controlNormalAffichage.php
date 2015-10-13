<?php
/* ----------------------------Affichage---------------------------------
    * -------------------------------------------------------------------- */
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';

        switch ($sAction) {

    //---------------------------- Accueil -------------------------------------
            case "home":
            case "connexion":
                require $path . '/view/view_home.php';
                break;
            
            
    //-------------------------------Bon entrée---------------------------------

            //Ajout du bon d'entrée
            case "be_add":
                require $path . '/view/view_bon_entree.php';
                break;

            //Détail d'un bon d'entrée
            case "be_detail":
                require $path . '/view/view_bon_entree_ru.php';
                break;
            
            //Liste des bons d'entrées
            case "be_list":
                require $path . '/view/view_bon_entree_list.php';
                break;
            
            
    //-------------------------------Bon sortie/reprise-------------------------

            //Ajout du bon de sortie/reprise
            case "bon_add":
                require $path . '/view/view_bon.php';
                break;

            //Détail du bon de sortie/reprise
            case "bon_detail":
                require $path . '/view/view_bon_ru.php';
                break;
            
            //Liste des bons de sortie/reprise
            case "bon_list":
                require $path . '/view/view_bon_list.php';
                break;


    //--------------------------------Contacts----------------------------------

            //Ajout d'un contact
            case "ctc_add":
                require $path . '/view/view_creer_contact.php';
                break;

            
    //------------------------------ Fiche article------------------------------
            
            //Supp de la fiche article
            case "fiart_del":
                
            //Liste des fiches articles
            case "fiart_list":
                require $path . '/view/view_fiche_article_list.php';
                break;

            //Ajout d'une fiche article
            case "fiart_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Envoyer') {
                    
                    require $path . '/view/view_fiche_article_list.php';
                    
                } else {
                    require $path . '/view/view_fiche_article.php';
                }
                
                break;

            //Detail d'une fiche article
            case "fiart_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_fiche_article_list.php';
                    
                } else {
                    require $path . '/view/view_fiche_article_ru.php';
                }
                
                break;
                

    //-------------------------------------- Gamme------------------------------

            //Détail d'une gammme
            case "ga_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_gamme_list.php';
                    
                } else {
                    require $path . '/view/view_gamme_ru.php';
                }
                
                break;

            //Ajout d'une gamme
            case "ga_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_gamme_list.php';
                }
                
                require $path . '/view/view_gamme.php';
                break;

            //Supp d'une gamme
            case "ga_del":

            //Liste des gammes
            case "ga_list":
                require $path . '/view/view_gamme_list.php';
                break;

    //----------------------------------- Inventaire ---------------------------
            
            //Ajout d'un enventaire
            case "inventaire_add":
                require $path . '/view/view_inventaire_c.php';
                break;


    //-------------------------------------Pays---------------------------------

            //Ajout d'un pays
            case "pays_add":
                require $path . '/view/view_pays.php';
                break;
            
            //Détail d'un pays
            case "pays_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_pays_list.php';
                    
                } else {
                    require $path . '/view/view_pays_ru.php';
                }
                break;

            //Supp d'un pays
            case "pays_del":

            //Liste des pays
            case "pays_list":
                require $path . '/view/view_pays_list.php';
                break;

            
//-----------------------------------Nutrition----------------------------------            

            //Ajout d'une nutrition
            case "nut_add":
                require $path . '/view/view_nutrition.php';
                break;

            //Détial d'une nutrition
            case "nut_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_nutrition_list.php';
                    
                } else {
                    require $path . '/view/view_nutrition_ru.php';
                }
                break;

            //Supp d'une nutrition
            case "nut_del":

            //Liste des nutritions
            case "nut_list":
                require $path . '/view/view_nutrition_list.php';
                break;
            

    //-------------------------------Références---------------------------------

            //Ajout d'une référence
            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference.php';
                break;
            
            //Modification d'une référence
            case "ref_upd":
                $sPageTitle = "Modifier une référence";
                require $path . '/view/view_reference_upd.php';
                break;
            
            //Détail d'une référence
            case "ref_detail":
                $sPageTitle = "Consulter une référence";
                require $path . '/view/view_reference_detail.php';
                break;

            //Supp d'une référence
            case "ref_del":

            //Liste des références
            case "ref_list":
                require $path . '/view/view_reference_list.php';
                break;


    //----------------------------------Export----------------------------------

            //Export
            case "export":
                require $path . '/view/view_export.php';
                break;
            
            
    //----------------------------------Utilisateur-----------------------------

            //Ajout d'un utilisateur
            case "utilisateur_add":
                require $path . '/view/view_utilisateur.php';
                break;

            //Liste des utilisateurs
            case "utilisateur_list":
                require $path . '/view/view_utilisateur_liste.php';
                break;

            //Détail d'un utilisateur
            case "utilisateur_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == "Modifier") {
                    
                    require $path . '/view/view_utilisateur_liste.php';
                    
                } else {
                    require $path . '/view/view_utilisateur_detail_ru.php';
                }
                break;
        }