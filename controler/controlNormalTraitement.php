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
                require $path . '/controler/control_be_detail.php';
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
            case "bon_detail":
                require $path . '/controler/control_bon_detail.php';
                break;


    //--------------------------------Contact-----------------------------------

            //Créer un contact    
            case "ctc_add":
                require $path . '/controler/control_ctc_add.php';
                $sPageTitle = "Ajouter un contact";
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
                require $path . '/controler/control_fiart_detail.php';
                break;


    //-------------------------------Gamme--------------------------------------
    //
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
                $sAction = "ga_list";
                break;

            
    //---------------------------- Inventaire ----------------------------------
    
            //ajout inventaire
            case "inventaire_add":
                require_once $path . '/controler/control_inv_add.php';
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
                require $path . '/controler/control_nut_detail.php';
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
                require $path . '/controler/control_pays_detail.php';
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
                require $path . '/controler/control_ut_detail.php';
                break;


//-------------------------------fin traitement---------------------------------            
        }