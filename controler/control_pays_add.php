<?php

/**
 * Sous controleur ajout pays 
 * 
 */
$sPageTitle = "Ajouter un pays";
require $path . '/model/Pays.php';
require $path . '/model/PaysManager.php';
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    $oPays = new Pays();
    $oPays->pays_nom = ucwords($_REQUEST['paysNom']);
    $oPays->pays_abv = strtoupper($_REQUEST['paysAbv']);
    $oPays->pays_dvs_nom = ucfirst(strtolower($_REQUEST['paysDvsNom']));
    $oPays->pays_dvs_abv = strtoupper($_REQUEST['paysDvsAbv']);
    $oPays->pays_dvs_sym = $_REQUEST['paysDvsSym'];
    
    $result = PaysManager::addPays($oPays);
    echo $result;
}
$resAllPays = PaysManager::getAllPays();
?>
