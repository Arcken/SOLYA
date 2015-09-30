<?php

require $path . '/model/Pays.php';
require $path . '/model/PaysManager.php';

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
    try {
        $oPays = new Pays();
        $oPays->pays_id = $_REQUEST['paysId'];
        $oPays->pays_nom = $_REQUEST['paysNom'];
        $oPays->pays_abv = $_REQUEST['paysAbv'];
        $oPays->pays_dvs_nom = $_REQUEST['paysDvsNom'];
        $oPays->pays_dvs_abv = $_REQUEST['paysDvsAbv'];
        $oPays->pays_dvs_sym = $_REQUEST['paysDvsSym'];
        $resUpdPays = PaysManager::updPays($oPays);

        if ($resUpdPays == 1) {
            $resMessage = "<font color='green'> La modification du pays $oPays->pays_id
                  est un succés</font>";
            require_once $path . '/controler/control_pays_list.php';
        }
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> La modification du pays $oPays->pays_id
                  est un echec</font>";
    }
} else {
    $sPageTitle = "Détail du pays";
    if (isset($_REQUEST['paysId']) && $_REQUEST['paysId'] != '') {        
        $resPaysDetail = PaysManager::getPaysDetailUpd($_REQUEST['paysId']);
        $sButton = 'Modifier';
    }
}
                                