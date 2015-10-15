<?php

/**
 * Sous controleur liste des bons de sortie et des bons de retour
 */
try {
    require_once $path . '/model/Bon.php';
    require_once $path . '/model/BonManager.php';
    require_once $path . '/model/DocLibelleManager.php';
    $sPageTitle="Liste des bons de SORTIE/RETOUR";

    
    //On récupère le nombre d'enregistrement total pour la pagination
    $iTotal = Tool::getCountTable('bon');
    
   //Si orderby est définis alors tri l'est forcément. 
   //Si c'est le cas on les utilise en paramètres dans notre manager
    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        $sort=$_REQUEST['tri'];
        $orderBy = $_REQUEST['orderby'];
        $resAllBon = BonManager::getBonsLim($rowStart, $nbRow, $orderBy,$sort);
    } else {
        $resAllBon = BonManager::getBonsLim($rowStart, $nbRow);
    }
    //On récupère tout les libéllés des Bons pour les associés dans la colonne
    $toDocLbl=  DocLibelleManager::getAllDocsLibelles();
    
} catch (MySQLException $e) {

}