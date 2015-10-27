<?php

/* ----------------------------Affichage---------------------------------
 * -------------------------------------------------------------------- */

//Pour chaque appel de page, on définit le titre puis on appel le header le menu
//le bloc latéral puis la page. Le ffoter est appelé dans control.php

switch ($sAction) {

    //----------------------------- Accueil ------------------------------------

    case "home":
    case "connexion":
    default:
        //titre par défaut
        $sPageTitle = "Accueil";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_home.php';
        break;


    //-------------------------------Bon entrée---------------------------------
    //Ajout du bon d'entrée
    case "be_add":
        $sPageTitle = "Ajouter un bon d'entrée";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_bon_entree_add.php';
        break;

    //Détail d'un bon d'entrée
    case "be_detail":
        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des bons d'entrée";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_bon_entree_list.php';
        } else {
            $sPageTitle = "Modifier un bon d'entrée";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_bon_entree_upd.php';
        }

        break;

    //Liste des bons d'entrées
    case "be_list":
        $sPageTitle = "Liste des bons d'entrée";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_bon_entree_list.php';
        break;


    //-------------------------------Bon sortie/reprise-------------------------
    //Ajout du bon de sortie/reprise
    case "bon_add":
        $sPageTitle = "Ajouter une bon de mouvement";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_bon_add.php';
        break;

    //Détail du bon de sortie/reprise
    case "bon_upd":
        $sPageTitle = "Modifier une bon de Sortie/Retour";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_bon_upd.php';
        break;

    //Liste des bons de sortie/reprise
    case "bon_list":
        $sPageTitle = "Liste des bons de Sortie/Retour";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_bon_list.php';
        break;


    //--------------------------------Contacts----------------------------------
    //Ajout d'une personne
    case "pers_add":
        $sPageTitle = "Ajouter une personne";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_personne_add.php';
        break;

    //Ajout d'une entreprise
    case "ent_add":
        $sPageTitle = "Ajouter une entreprise";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_entreprise_add.php';
        break;

    //Modifier une personne
    case "pers_upd":
        if ($sButtonUt == 'Modifier') {
         $sPageTitle = "Liste des contacts";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_contact_list.php';
        }else{
            $sPageTitle = "Modifier une personne";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_personne_upd.php';
        }
        break;
    //Modifier une entreprise
    case "ent_upd":
        if ($sButtonUt == 'Modifier') {
         $sPageTitle = "Liste des contacts";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_contact_list.php';
        }else{
            $sPageTitle = "Modifier une entreprise";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_entreprise_upd.php';
        }
        break;

    //Suppression d'une personne
    case "pers_del":
        $sPageTitle = "Sup";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_personne_del.php';
        break;

    //Suppression d'une entreprise
    case "ent_del":
        $sPageTitle = "Sup";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_entreprise_del.php';
        break;

    //Ajout d'une personne
    case "ctc_list":
        $sPageTitle = "Liste des contacts";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_contact_list.php';
        break;

    //-------------------------------- Droit de douane -------------------------
    //Détail d'un Droit de douane
    case "dd_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des droits de douane";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_droit_douane_list.php';
        } else {
            $sPageTitle = "Modifier un droit de douane";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_droit_douane_upd.php';
        }

        break;

    //Ajout d'un Droit de douane
    case "dd_add":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des droits de douanes";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_droit_douane_list.php';
        }
        $sPageTitle = "Ajouter une droit de douane";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_droit_douane_add.php';
        break;

    //Supp d'un Droit de douane
    case "dd_del":

    //Liste des Droits de douane
    case "dd_list": $sPageTitle = "Liste des droits de douane";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_droit_douane_list.php';
        break;


    //-------------------------------Durée conservation-------------------------
    //Détail d'une Durée conservation
    case "dc_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des durées de conservation";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_duree_conservation_list.php';
        } else {
            $sPageTitle = "Modifier un durées de conservation";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_duree_conservation_upd.php';
        }

        break;

    //Ajout d'une Durée conservation
    case "dc_add":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des durées de conservation";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_duree_conservation_list.php';
        }
        $sPageTitle = "Ajouter une durée de conservation";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_duree_conservation_add.php';
        break;

    //Supp d'une Durée conservation
    case "dc_del":

    //Liste des Durées conservations
    case "dc_list":
        $sPageTitle = "Liste des durées de conservation";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_duree_conservation_list.php';
        break;


    //----------------------------------Export----------------------------------
    //Export
    case "export":
        $sPageTitle = "Exporter des données";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_export.php';
        break;


    //------------------------------ Fiche article------------------------------
    //Supp de la fiche article
    case "fiart_del":

    //Liste des fiches articles
    case "fiart_list":
        $sPageTitle = "Liste des fiches articles";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_fiche_article_list.php';
        break;

    //Ajout d'une fiche article
    case "fiart_add":
        $sPageTitle = "Ajouter une fiche article";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_fiche_article_add.php';

        break;

    //Detail d'une fiche article
    case "fiart_upd":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des fiches articles";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_fiche_article_list.php';
        } else {
            $sPageTitle = "Modifier une fiche article";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_fiche_article_upd.php';
        }

        break;


    //-------------------------------------- Gamme------------------------------
    //Détail d'une gammme
    case "ga_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des gammes";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_gamme_list.php';
        } else {
            $sPageTitle = "Modifier une gamme";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_gamme_upd.php';
        }

        break;

    //Ajout d'une gamme
    case "ga_add":
        $sPageTitle = "Ajouter une gamme";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_gamme_add.php';
        break;

    //Supp d'une gamme
    case "ga_del":

    //Liste des gammes
    case "ga_list":
        $sPageTitle = "Liste des gammes";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_gamme_list.php';
        break;

    //----------------------------------- Inventaire ---------------------------
    //Ajout d'un inventaire
    case "inventaire_add":
        //Si on ajoute un inventaire 
        if ($sButtonUt == 'Envoyer') {
            $sPageTitle = "Liste des inventaires";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_inventaire_list.php';
        } else {
            $sPageTitle = "Créer un inventaire";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_inventaire_add.php';
        }
        break;

    //détail d'un inventaire
    case "inventaire_upd":

        if ($sButtonUt == 'Modifier' || $sButtonUt == 'Executer') {
            $sPageTitle = "Liste des inventaire";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_inventaire_list.php';
        } else {
            $sPageTitle = "Modifier une inventaire";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_inventaire_upd.php';
        }
        break;

    //Supp d'un inventaire
    case "inventaire_del":

    //Liste des inventaires
    case "inventaire_list":
        $sPageTitle = "Liste des inventaires";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_inventaire_list.php';
        break;


    //---------------------------- Mode de conservation ------------------------
    //Ajout de mode de conservation
    case "mc_add":
        $sPageTitle = "Ajouter un mode de conservation";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_mode_conservation_add.php';
        break;

    //détail d'un mode de conservation
    case "mc_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des modes de conservation";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_mode_conservation_list.php';
        } else {
            $sPageTitle = "Modifier un mode de conservation";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_mode_conservation_upd.php';
        }
        break;

    //Suppression d'un mode de conservation
    case "mc_del":

    //liste des modes de conservation
    case "mc_list":
        $sPageTitle = "Liste des modes de conservation";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        $sAction = "mc_list";
        require_once $path . '/view/view_mode_conservation_list.php';
        break;


//-----------------------------------Nutrition----------------------------------            
    //Ajout d'une nutrition
    case "nut_add":
         $sPageTitle = "Ajouter un libellé de nutrition";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
        require $path . '/view/view_nutrition_add.php';
        break;

    //Détial d'une nutrition
    case "nut_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des libellés de nutrition";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_nutrition_list.php';
        } else {
            $sPageTitle = "Ajouter un libellé de nutrition";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_nutrition_upd.php';
        }
        break;

    //Supp d'une nutrition
    case "nut_del":

    //Liste des nutritions
    case "nut_list":
        $sPageTitle = "Liste des libellés de nutrition";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_nutrition_list.php';
        break;


    //-------------------------------------Pays---------------------------------
    //Ajout d'un pays
    case "pays_add":
        $sPageTitle = "Ajouter un pays";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_pays_add.php';
        break;

    //Détail d'un pays
    case "pays_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des pays";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_pays_list.php';
        } else {
            $sPageTitle = "Modifier un pays";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_pays_upd.php';
        }
        break;

    //Supp d'un pays
    case "pays_del":

    //Liste des pays
    case "pays_list":
        $sPageTitle = "Liste des pays";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_pays_list.php';
        break;


    //-------------------------------Références---------------------------------
    //Ajout d'une référence
    case "ref_add":
        $sPageTitle = "Ajouter une référence";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_reference_add.php';
        break;

    //Modification d'une référence
    case "ref_upd":
        $sPageTitle = "Modifier une référence";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_reference_upd.php';
        break;

    //Détail d'une référence
    case "ref_detail":
        $sPageTitle = "Détail de la référence";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_reference_detail.php';
        break;

    //Supp d'une référence
    case "ref_del":

    //Liste des références
    case "ref_list":
        $sPageTitle = "Liste des références";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_reference_list.php';
        break;


    //-------------------------------------- TVA -------------------------------
    //Détail d'une tva
    case "tva_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des TVA";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_tva_list.php';
        } else {
            $sPageTitle = "Ajouter une TVA";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_tva_upd.php';
        }

        break;

    //Ajout d'une tva
    case "tva_add":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des TVA";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_tva_list.php';
        }
        $sPageTitle = "Ajouter une TVA";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_tva_add.php';
        break;

    //Supp d'une tva
    case "tva_del":

    //Liste des tva
    case "tva_list":
        $sPageTitle = "Liste des TVA";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_tva_list.php';
        break;


    //----------------------------------Utilisateur-----------------------------
    //Ajout d'un utilisateur
    case "utilisateur_add":
        $sPageTitle = "Ajouter un utilisateur";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_utilisateur_add.php';
        break;

    //Liste des utilisateurs
    case "utilisateur_list":
        $sPageTitle = "Liste des utilisateurs";
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        require_once $path . '/view/view_infos.php';
        require $path . '/view/view_utilisateur_list.php';
        break;

    //Détail d'un utilisateur
    case "utilisateur_detail":

        if ($sButtonUt == 'Modifier') {
            $sPageTitle = "Liste des utilisateurs";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_utilisateur_list.php';
        } else {
            $sPageTitle = "Modifier un utilisateur";
            require_once $path . '/view/view_header.php';
            require_once $path . '/view/view_menu.php';
            require_once $path . '/view/view_infos.php';
            require $path . '/view/view_utilisateur_upd.php';
        }
        break;
}