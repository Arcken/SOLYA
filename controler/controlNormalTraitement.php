<?php

//-------------------------------------Traitement des données-----------------//
//----------------------------------------------------------------------------//

        switch ($sAction) {
            
    //----------------------------- Accueil ------------------------------------

            case "home":
            case "connexion":
                $sPageTitle = "Accueil";
                break;

            
    //---------------------------Bon entrée-------------------------------------

            //Ajout du bon d'entrée
            case "be_add":
                require $path . '/controler/control_be_add.php';
                break;
            
            //Liste des bons d'entrées
            case "be_list":
                require $path . '/controler/control_be_list.php';
                break;

            //Modification du bon d'entrée
            case "be_detail":
                require $path . '/controler/control_be_upd.php';
                break;

            
    //---------------------------Bon sortie/reprise-----------------------------

            //Ajout du bon
            case "bon_add":
                require $path . '/controler/control_bon_add.php';
                break;

            //Liste des bons
            case "bon_list":
                require $path . '/controler/control_bon_list.php';
                break;

            //Modification du bon
            case "bon_upd":
                require $path . '/controler/control_bon_upd.php';
                break;


    //-------------------------------- Droit de douane -------------------------

            //ajout de Droit de douane
            case "dd_add":
                require_once $path . '/controler/control_dd_add.php';
                break;

            //liste des Droits de douane
            case "dd_list":
                require_once $path . '/controler/control_dd_list.php';
                break;

            //détail  et upd d'un Droit de douane
            case "dd_detail":
                require_once $path . '/controler/control_dd_upd.php';
                break;

            //Suppression d'un Droit de douane
            case "dd_del":
                require $path . '/controler/control_dd_del.php';
                $sAction = "dd_list";
                break;

            
    //--------------------------------Contact-----------------------------------

            //Créer une personne    
            case "pers_add":
                require $path . '/controler/control_pers_add.php';
                $sPageTitle = "Ajouter une personne";
                break;
            
            //Créer une entreprise    
            case "pers_add":
                require $path . '/controler/control_ent_add.php';
                $sPageTitle = "Ajouter une entreprise";
                break;

            
    //-------------------------------Durée conservation-------------------------

            //ajout de Durée conservation
            case "dc_add":
                require_once $path . '/controler/control_dc_add.php';
                break;

            //liste des Durées conservations
            case "dc_list":
                require_once $path . '/controler/control_dc_list.php';
                break;

            //détail  et upd d'une Durée conservation
            case "dc_detail":
                require_once $path . '/controler/control_dc_upd.php';
                break;

            //Suppression d'une Durée conservation
            case "dc_del":
                require $path . '/controler/control_dc_del.php';
                $sAction = "dc_list";
                break;

            
    //-------------------------------- EXPORT ----------------------------------
            //export
            case "export":
                require $path . '/controler/control_export.php';
                break;
            
            
    //-------------------------------Fiche article------------------------------
    
            //Ajout de fiche article
            case "fiart_add":
                require $path . '/controler/control_fiart_add.php';
                break;

            //Suppression de fiche article
            case "fiart_del":
                require $path . '/controler/control_fiart_del.php';
                $sAction = "fiart_list";
                break;

            //Liste de fiche article
            case "fiart_list":
                require $path . '/controler/control_fiart_list.php';
                break;

            //Detail fiche article et maj fiche article            
            case "fiart_detail":
                require $path . '/controler/control_fiart_upd.php';
                break;


    //-------------------------------Gamme--------------------------------------
    
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
                require_once $path . '/controler/control_ga_upd.php';
                break;

            //Suppression d'une gamme
            case "ga_del":
                require $path . '/controler/control_ga_del.php';
                $sAction = "ga_list";
                break;

            
    //---------------------------- Inventaire ----------------------------------
    
            //ajout inventaire
            case "inventaire_add":
                require_once $path . '/controler/control_inv_add.php';
                break;

            //Liste des inventaires
            case "inventaire_list":
                require $path . '/controler/control_inv_list.php';
                break;
            
            
    //---------------------------- Mode de conservation ------------------------
    
            //Ajout de mode de conservation
            case "mc_add":
                require $path . '/controler/control_mc_add.php';
                break;
            
            //liste des modes de conservation
            case "mc_list":
                require_once $path . '/controler/control_mc_list.php';
                break;

            //détail d'un mode de conservation
            case "mc_detail":
                require_once $path . '/controler/control_mc_upd.php';
                break;

            //Suppression d'un mode de conservation
            case "mc_del":
                require $path . '/controler/control_mc_del.php';
                $sAction = "mc_list";
                break;
            
            
    //---------------------------------Nutrition--------------------------------
    
            //ajout de nutrition
            case "nut_add":
                require $path . '/controler/control_nut_add.php';
                break;

            //liste nutrition
            case "nut_list":
                require $path . '/controler/control_nut_list.php';
                break;

            //detail nutrition
            case "nut_detail":
                require $path . '/controler/control_nut_upd.php';
                break;

            //supp nutrition
            case "nut_del":
                require $path . '/controler/control_nut_del.php';
                $sAction = "nut_list";
                break;

            
    //---------------------------------Pays-------------------------------------
    
            //ajout de pays
            case "pays_add":
                require $path . '/controler/control_pays_add.php';
                break;

            //liste de pays
            case "pays_list":
                require $path . '/controler/control_pays_list.php';
                break;

            //détail pays
            case "pays_detail":
                require $path . '/controler/control_pays_upd.php';
                break;

            //supp pays
            case "pays_del":
                require $path . '/controler/control_pays_del.php';
                $sAction = "pays_list";
                break;

            
    //--------------------------------Référence---------------------------------
    
            //ajout de référence
            case "ref_add":
                require $path . '/controler/control_ref_add.php';
                break;

            //Liste des références
            case "ref_list":
                require $path . '/controler/control_ref_list.php';
                break;

            //Maj d'une référence
            case "ref_upd":
                require $path . '/controler/control_ref_upd.php';
                break;

            //Détail d'une référence
            case "ref_detail":
                require $path . '/controler/control_ref_detail.php';
                break;
            
            //Suppression d'une référence
            case "ref_del":
                require $path . '/controler/control_ref_del.php';
                $sAction = "ref_list";
                break;

            
    //------------------------------- TVA --------------------------------------
    
            //ajout de tva
            case "tva_add":
                require_once $path . '/controler/control_tva_add.php';
                break;

            //liste des tva
            case "tva_list":
                require_once $path . '/controler/control_tva_list.php';
                break;

            //détail d'une tva
            case "tva_detail":
                require_once $path . '/controler/control_tva_upd.php';
                break;

            //Suppression d'une tva
            case "tva_del":
                require $path . '/controler/control_tva_del.php';
                $sAction = "tva_list";
                break;

            
    //-------------------------------- Utilisateur------------------------------
    
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
                require $path . '/controler/control_ut_upd.php';
                break;


//-------------------------------fin traitement---------------------------------            
        }