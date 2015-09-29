<?php

if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    require_once $path . '/model/Gamme.php';
    require_once $path . '/model/GammeManager.php';
    try {
        $res = GammeManager::delGamme($_REQUEST['gaId']);
        if ($res == 1) {
            $resMessage = "<font color='green'> La gamme N° " . $_REQUEST['gaId']
                    . " est supprimée</font>";
        } else {
            $resMessage = "<font color='red'> La gamme N° " . $_REQUEST['gaId']
                    . " ne peut pas être supprimée</font>";
        }
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> La gamme N° " . $_REQUEST['gaId']
                . " n'est pas supprimée</font>";
    }
    require $path . '/controler/control_ga_list.php';
    $sAction = 'ga_list';
}
