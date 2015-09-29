<?php

require $path . '/model/Gamme.php';
require $path . '/model/GammeManager.php';

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
    $oGamme = new Gamme();
    $oGamme->ga_id = $_REQUEST['gaId'];
    $oGamme->ga_abv = $_REQUEST['gaAbv'];
    $oGamme->ga_lbl = $_REQUEST['gaLbl'];
    $resUpdGamme = GammeManager::updGamme($oGamme);

    if ($resUpdGamme == 1) {
        $resMessage = "<font color='green'> La modification de la gamme $oGamme->ga_id
                  est un succés</font>";
        require_once $path . '/controler/control_ga_list.php';
    } else {
        $resMessage = "<font color='red'> La modification de la gamme $oGamme->ga_id
                  est un echec</font>";
    }
   
} else {
    $sPageTitle = "Détail de la gamme";
    if (isset($_REQUEST['gaId']) && $_REQUEST['gaId'] != '') {
        $oGamme = new Gamme();
        $oGamme->ga_id = $_REQUEST['gaId'];
        $resGaDetail = GammeManager::getGammeDetailUpd($oGamme);        
        $sButton = 'Modifier';
        
    }
}
                                