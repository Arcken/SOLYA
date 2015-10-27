<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        
        require_once $path . '/model/LotManager.php';
        require_once $path . '/model/ReferenceManager.php';
        $resStockMin = LotManager::getLotStockMin();
        $tRef = [];
        if (is_array($tRef)) {
            foreach ($resStockMin as $lot) {
                $tRef[] = ReferenceManager::getReference($lot->ref_id);
            }
        }
        print_r($tRef);
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}