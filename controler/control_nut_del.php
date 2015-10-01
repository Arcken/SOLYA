<?php

require_once $path . '/model/Nutrition.php';
require_once $path . '/model/NutritionManager.php';
try {
    $res = NutritionManager::delNutrition($_REQUEST['nutId']);
    if ($res == 1) {
        $resMessage = "<font color='orange'> La nutrition N° " . $_REQUEST['nutId']
                . " est supprimée</font>";
    }
} catch (MySQLException $e) {
    $resMessage = $resMessage = "<font color='red'> La nutrition N° " . $_REQUEST['nutId']
            . " n'est pas supprimée</font>";
}
require $path . '/controler/control_nut_list.php';
