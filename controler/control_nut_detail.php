<?php

require_once $path . '/model/Nutrition.php';
require_once $path . '/model/NutritionManager.php';

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
    try {
        $oNutrition = new Nutrition();
        $oNutrition->nut_id = $_REQUEST['nutId'];
        $oNutrition->nut_lbl = $_REQUEST['nutLbl'];
        $resUpdNutrition = NutritionManager::updNutrition($oNutrition);

        if ($resUpdNutrition == 1) {
            $resMessage = "<font color='green'> La modification de la nutrition $oNutrition->nut_id
                  est un succés</font>";
            require_once $path . '/controler/control_nut_list.php';
        }
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> La modification de la nutrition $oNutrition->nut_id
                  est un echec</font>";
    }
} else {
    $sPageTitle = "Detail nutrition";
    if (isset($_REQUEST['nutId']) && $_REQUEST['nutId'] != '') {
        $resNutDetail = NutritionManager::getNutritionDetailUpd($_REQUEST['nutId']);
        $sButton = 'Modifier';
    }
}
                                