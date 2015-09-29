<?php

require_once $path . '/model/Gamme.php';
require_once $path . '/model/GammeManager.php';
try {
    $res = GammeManager::delGamme($_REQUEST['gaId']);
    if ($res == 1) {
        $resMessage = "<font color='orange'> La gamme N° " . $_REQUEST['gaId']
                . " est supprimée</font>";
    }
} catch (MySQLException $e) {
    $resMessage = $resMessage = "<font color='red'> La gamme N° " . $_REQUEST['gaId']
            . " n'est pas supprimée</font>";
}
require $path . '/controler/control_ga_list.php';
