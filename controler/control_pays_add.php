<?php

/**
 * Sous controleur ajout pays 
 * 
 */
$sPageTitle = "Ajouter un pays";
require $path . '/model/Pays.php';
require $path . '/model/PaysManager.php';
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    $oGa = new Pays();

    $result = PaysManager::addPays($oPays);
    echo $result;
}
$resAllPays = PaysManager::getAllPays();
?>
