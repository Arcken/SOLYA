<?php

/*
 * Sous controleur d'ajout nutrition
 */


$sPageTitle = "Ajouter un libellé de nutrition";
require $path . '/model/Nutrition.php';
require $path . '/model/NutritionManager.php';
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    $resMessage = "<font color='red'> L'ajout de la gamme est un échec</font>";
    try {
        $oNut = new Nutrition();
        
        $oNut->nut_lbl = $_REQUEST['nutLbl'];
        $result = NutritionManager::addNutrition($oNut);
        
        if ($result == 1){ $resMessage = "<font color='green'> L'ajout de la nutrition
                 intitulée: $oNut->nut_lbl est un succés</font>";
        }
        else $resMessage = "<font color='red'> L'ajout de la gamme est un échec, champs mal remplies</font>";
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> L'ajout de la gamme est un échec</font>";
    }
}
$resAllNut = NutritionManager::getAllNutritions();
