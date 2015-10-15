<?php

$sAction = $_REQUEST['action'];
//Comme la fenétre est une popup on passe la variable de contrôle d'affichage
// à 1
$nv = 1;

/* ----------------------------Traitement--------------------------------- */
switch ($sAction) {

    //Droit de douane
    case "nv_dd_add":

        require $path . '/model/DroitDouane.php';
        require $path . '/model/DroitDouaneManager.php';
        $sPageTitle = "Ajouter un droit de douane";

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //Les valeurs sont vérifiées à la saisie
            //On créé un objet contenant les valeurs que l'on passe en paramètre 
            //à la requête

            $oDd = new DroitDouane();
            $oDd->dd_lbl = $_REQUEST['ddLbl'];
            $oDd->dd_taux = $_REQUEST['ddTaux'];

            $result = DroitDouaneManager::addDroitDouane($oDd);

            //On récupére l'id de l'insert
            $id = Connection::dernierId();

            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout du droit de douane N° $id" .
                        "intitulée: $oDd->dd_lbl est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout du droit de douane est un échec.";
            }
        }

        break;

    //Durée de conservation
    case "nv_dc_add":

        require $path . '/model/DureeConservation.php';
        require $path . '/model/DureeConservationManager.php';
        $sPageTitle = "Ajouter une durée de conservation";

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //on créé un objet contenant les données que l'on passe en paramètre
            //de la requête
            $oDc = new DureeConservation();
            $oDc->dc_lbl = $_REQUEST['dcLbl'];
            $oDc->dc_nb = $_REQUEST['dcNb'];

            $result = DureeConservationManager::addDureeConservation($oDc);

            //On récupére l'id de l'insert
            $id = Connection::dernierId();

            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout de la durée de cnservation N° $id" .
                        "intitulée: $oDc->dc_lbl est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout de la durée de conservation est un échec.";
            }
        }

        break;

    //gammme
    case "nv_ga_add":

        require $path . '/model/Gamme.php';
        require $path . '/model/GammeManager.php';
        $sPageTitle = "Ajouter une gamme";

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //on créé un objet contenant les données que l'on passe en paramètre
            //de la requête
            $oGa = new Gamme();
            $oGa->GA_LBL = $_REQUEST['gaLbl'];
            $oGa->GA_ABV = $_REQUEST['gaAbv'];
            $result = GammeManager::addGamme($oGa);

            //On récupére l'id de l'insertion
            $id = Connection::dernierId();
            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout de la gamme N° $id" .
                        "intitulée: $oGa->GA_LBL est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout de la gamme est un échec.";
            }
        }

        break;

    //Mode de conservation
    case 'nv_mc_add':

        $sPageTitle = "Ajouter un mode de conservation";
        require $path . '/model/ModeConservation.php';
        require $path . '/model/ModeConservationManager.php';

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //on créé un objet contenant les données que l'on passe en paramètre
            //de la requête
            $oMc = new ModeConservation();
            $oMc->cons_lbl = $_REQUEST['consLbl'];
            $result = ModeConservationManager::addModeConservation($oMc);

            //On récupére l'id de l'insertion
            $id = Connection::dernierId();
            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout du mode de conservation N° $id" .
                        "intitulée: $oMc->cons_lbl est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout du mode de conservation est un échec.";
            }
        }

        break;

    //nutrition
    case 'nv_nut_add':

        $sPageTitle = "Ajouter une information";
        require $path . '/model/Nutrition.php';
        require $path . '/model/NutritionManager.php';

        //on créé un objet contenant les données que l'on passe en paramètre
        //de la requête
        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
            $oNut = new Nutrition();
            $oNut->nut_lbl = $_REQUEST['nutLbl'];
            $result = NutritionManager::addNutrition($oNut);

            //On récupére l'id de l'insertion
            $id = Connection::dernierId();
            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout de la nutrition N° $id" .
                        "intitulée: $oNut->nut_lbl est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout de la nutrition est un échec.";
            }
        }

        break;

    //pays
    case 'nv_pays_add':

        $sPageTitle = "Ajouter un pays";
        require $path . '/model/Pays.php';
        require $path . '/model/PaysManager.php';

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //on créé un objet contenant les données que l'on passe en paramètre
            //de la requête
            $oPays = new Pays();
            $oPays->pays_abv = $_REQUEST['paysAbv'];
            $oPays->pays_nom = $_REQUEST['paysNom'];
            $oPays->pays_dvs_abv = $_REQUEST['paysDvsAbv'];
            $oPays->pays_dvs_nom = $_REQUEST['paysDvsNom'];
            $oPays->pays_dvs_sym = $_REQUEST['paysDvsSym'];

            $result = PaysManager::addPays($oPays);

            //On récupére l'id de l'insertion
            $id = Connection::dernierId();
            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout du pays N° $id" .
                        "intitulée: $oPays->pays_nom est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout du pays est un échec, ";
            }
        }

        break;

    //TVA
    case "nv_tva_add":

        require $path . '/model/Tva.php';
        require $path . '/model/TvaManager.php';
        $sPageTitle = "Ajouter une tva";

        if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            //on créé un objet contenant les données que l'on passe en paramètre
            //de la requête
            $oTva = new Tva();
            $oTva->tva_lbl = $_REQUEST['tvaLbl'];
            $oTva->tva_taux = $_REQUEST['tvaTaux'];

            $result = TvaManager::addTva($oTva);

            //On récupére l'id de l'insert
            $id = Connection::dernierId();
            ;

            //Si l'insert c'est bien passé
            if ($result == 1) {
                $ligneMessage = "<font color='green'> L'ajout de la TVA N° $id" .
                        "intitulée: $oTva->tva_lbl est un succés</font>";
            } else {
                $ligneMessage = "<font color='red'> L'ajout de la TVA est un échec.";
            }
        }

        break;
}

/* ----------------------------Affichage--------------------------------- */
switch ($sAction) {

    //Droit de douane
    case "nv_dd_add":
        require $path . '/view/view_dd_add.php';
        break;

    //Durée de conservation
    case "nv_dc_add":
        require $path . '/view/view_dc_add.php';
        break;

    //gamme
    case "nv_ga_add":
        require $path . '/view/view_gamme_add.php';
        break;

    //Mode conservation
    case "nv_mc_add":
        require $path . '/view/view_mode_conservation_add.php';
        break;

    //nutrition
    case "nv_nut_add":
        require $path . '/view/view_nutrition_add.php';
        break;

    //pays
    case "nv_pays_add":
        require $path . '/view/view_pays_add.php';
        break;

    //tva
    case "nv_tva_add":
        require $path . '/view/view_tva_add.php';
        break;
}