<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$sPageTitle="Détail de la référence";

if (isset($_REQUEST['idRef']) && !empty($_REQUEST['idRef'])){
    
    require $path .'/model/ModeConservationManager.php';
    require $path .'/model/DureeConservationManager.php';
    require $path .'/model/ReferenceManager.php';
    require $path .'/model/FicheArticleManager.php';
    require $path .'/model/TvaManager.php';
    require $path .'/model/DroitDouaneManager.php';
    
    $toTvas         = TvaManager::getAllTvas();
    $toDroitDouanes = DroitDouaneManager::getAllDroitDouanes();
    $toDurCons      = DureeConservationManager::getAllDureeConservations();
    $toModCons      = ModeConservationManager::getAllModeConservations();
    $toFiArts       = FicheArticleManager::getAllFichesArticles();
    $idRef          = $_REQUEST['idRef'];
    $oRef           = ReferenceManager::getReference($idRef);
    
    //Tool::printAnyCase($oRef);
    //Tool::printAnyCase($idRef);
    
}