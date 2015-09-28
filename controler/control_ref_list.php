<?php

$sPageTitle="Liste des références";

require $path.'/model/Reference.php';
require $path.'/model/ReferenceManager.php';
require $path.'/model/Tva.php';
require $path.'/model/TvaManager.php';
require $path.'/model/DroitDouane.php';
require $path.'/model/DroitDouaneManager.php';
require $path.'/model/FicheArticle.php';
require $path.'/model/FicheArticleManager.php';
require $path.'/model/ModeConservation.php';
require $path.'/model/ModeConservationManager.php';
require $path.'/model/DureeConservation.php';
require $path.'/model/DureeConservationManager.php';
require $path.'/model/PrixVente.php';
require $path.'/model/PrixVenteManager.php';
                         
$iTotal = Tool::getCountTable('reference');

if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby =  $_REQUEST['orderby'];
    $toRef = ReferenceManager::getAllReferences($iNbPage,$limite,$orderby);
    
}
else {
    $toRef = ReferenceManager::getAllReferences($iNbPage,$limite);
}

