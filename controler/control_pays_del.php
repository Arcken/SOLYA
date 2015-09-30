<?php

require_once $path . '/model/Pays.php';
require_once $path . '/model/PaysManager.php';
try {
    $res = PaysManager::delPays($_REQUEST['paysId']);
    if ($res == 1) {
        $resMessage = "<font color='orange'> Le pays N° " . $_REQUEST['paysId']
                . " est supprimée</font>";
    }
} catch (MySQLException $e) {
    $resMessage = $resMessage = "<font color='red'> Le pays N° " . $_REQUEST['paysId']
            . " n'est pas supprimée</font>";
}
require $path . '/controler/control_pays_list.php';
