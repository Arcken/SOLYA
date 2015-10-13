<?php

$sAction = $_REQUEST['action'];
//Comme la fenétre est une popup on passe la variable de contrôle d'affichage
// à 1
$nv = 1;

/* ----------------------------Traitement--------------------------------- */
switch ($sAction) {

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
            $oMc = new Mode_conservation();
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

    case "nv_bon_pdf":
        require $path . '/controler/control_bon_pdf.php';
        break;
}

/* ----------------------------Affichage--------------------------------- */
switch ($sAction) {

    //gamme
    case "nv_ga_add":
        require $path . '/view/view_gamme.php';
        break;

    //Mode conservation
    case "nv_mc_add":
        require $path . '/view/view_mode_conservation.php';
        break;

    //nutrition
    case "nv_nut_add":
        require $path . '/view/view_nutrition.php';
        break;

    //pays
    case "nv_pays_add":
        require $path . '/view/view_pays.php';
        break;
}