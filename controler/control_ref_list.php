<?php
/**
 * Sous controleur list référence
 * 
 */

$sPageTitle = "Liste des références";

require_once $path . '/model/Reference.php';
require_once $path . '/model/ReferenceManager.php';
require_once $path . '/model/Tva.php';
require_once $path . '/model/TvaManager.php';
require_once $path . '/model/DroitDouane.php';
require_once $path . '/model/DroitDouaneManager.php';
require_once $path . '/model/FicheArticle.php';
require_once $path . '/model/FicheArticleManager.php';
require_once $path . '/model/ModeConservation.php';
require_once $path . '/model/ModeConservationManager.php';
require_once $path . '/model/DureeConservation.php';
require_once $path . '/model/DureeConservationManager.php';
require_once $path . '/model/PrixVente.php';
require_once $path . '/model/PrixVenteManager.php';


try {
    
$iTotal = Tool::getCountTable('reference');

    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        
        $orderby = $_REQUEST['orderby'];
        $toRef = ReferenceManager::getAllReferences($limite,$iNbPage, $orderby);
        
    } else {
        
        $toRef = ReferenceManager::getAllReferences($limite,$iNbPage);
    }
    
} catch (MySQLException $e){
    
    switch ($resEr){
        default:
            $msg ="<p class='erreur'> ".date('H:i:s')." Oups! Une erreur est survenue : $resEr </p>";
            Tool::addMsg($msg);
        break;
    }
}
