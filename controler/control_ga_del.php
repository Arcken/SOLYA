<?php

require_once $path . '/model/Gamme.php';
require_once $path . '/model/GammeManager.php';
$res = GammeManager::delGamme($_REQUEST['gaId']);
if ($res == 1) {
    $resMessage = "<font color='orange'> La gamme N° " . $_REQUEST['gaId']
            . " est supprimée</font>";
}
require $path . '/controler/control_ga_list.php';
