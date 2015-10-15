<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


try {
    
$sPageTitle = "Détail de la référence";


require $path . '/model/ReferenceManager.php';
$idRef = $_REQUEST['idRef'];



    $rsRef = ReferenceManager::getReference($idRef);

    require $path . '/model/ModeConservationManager.php';
    require $path . '/model/DureeConservationManager.php';
    require $path . '/model/FicheArticleManager.php';
    require $path . '/model/TvaManager.php';
    require $path . '/model/DroitDouaneManager.php';
    require $path . '/model/PrixVente.php';
    require $path . '/model/PrixVenteManager.php';
    require $path . '/model/LotManager.php';
    
    $toTvas         = TvaManager::getAllTvas();
    $toDroitDouanes = DroitDouaneManager::getAllDroitsDouanes();
    $toDurCons      = DureeConservationManager::getAllDureesConservations();
    $toModCons      = ModeConservationManager::getAllModesConservations();
    $toFiArts       = FicheArticleManager::getAllFichesArticles();
    $oPve           = PrixVenteManager::getCurPrixVente($idRef);
    $toLots         = LotManager::getLotsFromReference($idRef);
    
    if ($oPve === 0) {
        
        $oPve = new PrixVente();
        $oPve->pve_ent = 'indéfinis';
        $oPve->pve_per = 'indéfinis';
    }
    
} catch (MySQLException $e) {

    $cnx->rollback();
}
   