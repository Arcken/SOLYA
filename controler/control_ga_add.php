<?php

/*
 * Sous controleur d'ajout gamme
 */


$sPageTitle = "Ajouter une gamme";
require $path . '/model/Gamme.php';
require $path . '/model/GammeManager.php';
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    $resMessage = "<font color='red'> L'ajout de la gamme est un échec</font>";
    try {
        $oGa = new Gamme();
        $oGa->GA_LBL = $_REQUEST['gaLbl'];
        $oGa->GA_ABV = $_REQUEST['gaAbv'];
        $result = GammeManager::addGamme($oGa);
        $id = Connection::dernierId();
        echo (strlen($oGa->GA_LBL) >= intval(Connection::getLimLbl()));
        
        if ($result == 1){ $resMessage = "<font color='green'> L'ajout de la gamme N° $id
                 intitulée: $oGa->GA_LBL est un succés</font>";
        }
        else $resMessage = "<font color='red'> L'ajout de la gamme est un échec, champs mal remplies</font>";
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> L'ajout de la gamme est un échec</font>";
    }
}
$resAllGa = GammeManager::getAllGammes();
