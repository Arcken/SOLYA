<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sPageTitle = "Liste des bons d'entrés";
require_once $path . '/model/BonEntree.php';
require_once $path . '/model/BonEntreeManager.php';

$iTotal = Tool::getCountTable('bon_entree');
//Si un champs de tri est défini on exécute la requète avec tri
if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby = $_REQUEST['orderby'];
    $tri = $_REQUEST['tri'];
    $resBeList = BonEntreeManager::getAllBonsEntreesLim($limite, $iNbPage, $orderby, $tri);
    
} 
//Sinon sans tri
else {
    $resBeList = BonEntreeManager::getAllBonsEntreesLim($limite, $iNbPage);
}
