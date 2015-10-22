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
                require $path . '/view/view_bon_entree_add.php';
                break;

            //Détail d'un bon d'entrée
            case "be_detail":
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_bon_entree_list.php';
                    
                } else {
                    require $path . '/view/view_bon_entree_upd.php';
                }
                
                break;
            
            //Liste des bons d'entrées
            case "be_list":
                require $path . '/view/view_bon_entree_list.php';
                break;
            
            
    //-------------------------------Bon sortie/reprise-------------------------

            //Ajout du bon de sortie/reprise
            case "bon_add":
                require $path . '/view/view_bon_add.php';
                break;

            //Détail du bon de sortie/reprise
            case "bon_upd":
                require $path . '/view/view_bon_upd.php';
                break;
            
            //Liste des bons de sortie/reprise
            case "bon_list":
                require $path . '/view/view_bon_list.php';
                break;


    //--------------------------------Contacts----------------------------------

            //Ajout d'une personne
            case "pers_add":
                require $path . '/view/view_personne_add.php';
                break;
            
            //Ajout d'une entreprise
            case "ent_add":
                require $path . '/view/view_entreprise_add.php';
                break;
            
            //Ajout d'une personne
            case "pers_upd":
                require $path . '/view/view_personne_upd.php';
                break;
            
            //Ajout d'une entreprise
            case "ent_upd":
                require $path . '/view/view_entreprise_upd.php';
                break;
            
              //Suppression d'une personne
            case "pers_del":
                require $path . '/view/view_personne_del.php';
                break;
            
            //Suppression d'une entreprise
            case "ent_del":
                require $path . '/view/view_entreprise_del.php';
                break;
            
            //Ajout d'une personne
            case "ctc_list":
                require $path . '/view/view_contact_list.php';
                break;
            
    //-------------------------------- Droit de douane -------------------------

            //Détail d'un Droit de douane
            case "dd_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_droit_douane_list.php';
                    
                } else {
                    require $path . '/view/view_droit_douane_upd.php';
                }
                
                break;

            //Ajout d'un Droit de douane
            case "dd_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_droit_douane_list.php';
                }
                
                require $path . '/view/view_droit_douane_add.php';
                break;

            //Supp d'un Droit de douane
            case "dd_del":

            //Liste des Droits de douane
            case "dd_list":
                require $path . '/view/view_droit_douane_list.php';
                break;

            
    //-------------------------------Durée conservation-------------------------

            //Détail d'une Durée conservation
            case "dc_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_duree_conservation_list.php';
                    
                } else {
                    require $path . '/view/view_duree_conservation_upd.php';
                }
                
                break;

            //Ajout d'une Durée conservation
            case "dc_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_duree_conservation_list.php';
                }
                
                require $path . '/view/view_duree_conservation_add.php';
                break;

            //Supp d'une Durée conservation
            case "dc_del":

            //Liste des Durées conservations
            case "dc_list":
                require $path . '/view/view_duree_conservation_list.php';
                break;

            
    //----------------------------------Export----------------------------------

            //Export
            case "export":
                require $path . '/view/view_export.php';
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
                
                    require $path . '/view/view_fiche_article_add.php';
                
                break;

            //Detail d'une fiche article
            case "fiart_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_fiche_article_list.php';
                    
                } else {
                    require $path . '/view/view_fiche_article_upd.php';
                }
                
                break;
                

    //-------------------------------------- Gamme------------------------------

            //Détail d'une gammme
            case "ga_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_gamme_list.php';
                    
                } else {
                    require $path . '/view/view_gamme_upd.php';
                }
                
                break;

            //Ajout d'une gamme
            case "ga_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_gamme_list.php';
                }
                
                require $path . '/view/view_gamme_add.php';
                break;

            //Supp d'une gamme
            case "ga_del":

            //Liste des gammes
            case "ga_list":
                require $path . '/view/view_gamme_list.php';
                break;

    //----------------------------------- Inventaire ---------------------------
            
            //Ajout d'un inventaire
            case "inventaire_add":
                //Si on ajoute un inventaire 
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Envoyer') {
                require $path . '/view/view_inventaire_list.php';
                }else {
                require $path . '/view/view_inventaire_add.php';
                }
                break;

            //détail d'un inventaire
            case "inventaire_upd":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier' 
                        || isset($_REQUEST['btnForm'])
                        && $_REQUEST['btnForm'] == 'Executer' ) {
                    
                    require $path . '/view/view_inventaire_list.php';
                    
                } else {
                    require $path . '/view/view_inventaire_upd.php';
                }
                break;
            
            //Supp d'un inventaire
            case "inventaire_del":
            
            //Liste des inventaires
            case "inventaire_list":
                require $path . '/view/view_inventaire_list.php';
                break;
            
            
    //---------------------------- Mode de conservation ------------------------
    
            //Ajout de mode de conservation
            case "mc_add":
                require $path . '/view/view_mode_conservation_add.php';
                break;
                        
            //détail d'un mode de conservation
            case "mc_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_mode_conservation_list.php';
                    
                } else {
                    require $path . '/view/view_mode_conservation_upd.php';
                }
                break;

            //Suppression d'un mode de conservation
            case "mc_del":
            
            //liste des modes de conservation
            case "mc_list":
                $sAction = "mc_list";
                require_once $path . '/view/view_mode_conservation_list.php';
                break;

    
//-----------------------------------Nutrition----------------------------------            

            //Ajout d'une nutrition
            case "nut_add":
                require $path . '/view/view_nutrition_add.php';
                break;

            //Détial d'une nutrition
            case "nut_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_nutrition_list.php';
                    
                } else {
                    require $path . '/view/view_nutrition_upd.php';
                }
                break;

            //Supp d'une nutrition
            case "nut_del":

            //Liste des nutritions
            case "nut_list":
                require $path . '/view/view_nutrition_list.php';
                break;
            

    //-------------------------------------Pays---------------------------------

            //Ajout d'un pays
            case "pays_add":
                require $path . '/view/view_pays_add.php';
                break;
            
            //Détail d'un pays
            case "pays_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_pays_list.php';
                    
                } else {
                    require $path . '/view/view_pays_upd.php';
                }
                break;

            //Supp d'un pays
            case "pays_del":

            //Liste des pays
            case "pays_list":
                require $path . '/view/view_pays_list.php';
                break;

            
    //-------------------------------Références---------------------------------

            //Ajout d'une référence
            case "ref_add":
                $sPageTitle = "Ajouter une référence";
                require $path . '/view/view_reference_add.php';
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


    //-------------------------------------- TVA -------------------------------

            //Détail d'une tva
            case "tva_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_tva_list.php';
                    
                } else {
                    require $path . '/view/view_tva_upd.php';
                }
                
                break;

            //Ajout d'une tva
            case "tva_add":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    
                    require $path . '/view/view_tva_list.php';
                }
                
                require $path . '/view/view_tva_add.php';
                break;

            //Supp d'une tva
            case "tva_del":

            //Liste des tva
            case "tva_list":
                require $path . '/view/view_tva_list.php';
                break;

              
    //----------------------------------Utilisateur-----------------------------

            //Ajout d'un utilisateur
            case "utilisateur_add":
                require $path . '/view/view_utilisateur_add.php';
                break;

            //Liste des utilisateurs
            case "utilisateur_list":
                require $path . '/view/view_utilisateur_list.php';
                break;

            //Détail d'un utilisateur
            case "utilisateur_detail":
                
                if (isset($_REQUEST['btnForm']) 
                        && $_REQUEST['btnForm'] == 'Modifier') {
                    require $path . '/view/view_utilisateur_list.php';
                    
                } else {
                    require $path . '/view/view_utilisateur_upd.php';
                }
                break;
        }