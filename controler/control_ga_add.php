<?php

/*
 * Sous controleur d'ajout gamme
 */


$sPageTitle = "Ajouter une gamme";
require $path . '/model/Gamme.php';
require $path . '/model/GammeManager.php';
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    $oGa = new Gamme();
    $oGa->GA_LBL = $_REQUEST['gaLbl'];
    $oGa->GA_ABV = $_REQUEST['gaAbv'];
    $result = GammeManager::addGamme($oGa);
    echo $result;
}
$resAllGa = GammeManager::getAllGammes();

?>