<?php

if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    /**
     * Sous controleur ajout pays 
     * 
     */
    $sPageTitle = "Ajouter un pays";
    require $path . '/model/Pays.php';
    require $path . '/model/PaysManager.php';
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        try {
            $oPays = new Pays();
            $oPays->pays_nom = ucwords($_REQUEST['paysNom']);
            $oPays->pays_abv = strtoupper($_REQUEST['paysAbv']);
            $oPays->pays_dvs_nom = ucfirst(strtolower($_REQUEST['paysDvsNom']));
            $oPays->pays_dvs_abv = strtoupper($_REQUEST['paysDvsAbv']);
            $oPays->pays_dvs_sym = $_REQUEST['paysDvsSym'];

            $result = PaysManager::addPays($oPays);
            $id = Connection::dernierId();
            if ($result == 1) {
                $resMessage = "<font color='green'> L'ajout du pays N° $id
                 intitulée: $oPays->pays_nom est un succés</font>";
            } else {
                $resMessage = "<font color='red'> L'ajout du pays est un échec, champs mal remplies</font>";
            }
        } catch (MySQLException $e) {
            $resMessage = "<font color='red'> L'ajout du pays est un échec</font>";
        }
    }
    $resAllPays = PaysManager::getAllPays();
}
