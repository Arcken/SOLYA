<?php

/**
 * Sous controleur liste des bons de sortie et des bons de retour
 */

    require_once $path . '/model/Bon.php';
    require_once $path . '/model/BonManager.php';
    require_once $path . '/model/DocLibelleManager.php';
    $sPageTitle="Liste des bons de SORTIE/RETOUR";
try {
    
    //On récupère le nombre d'enregistrement total pour la pagination
    $iTotal = Tool::getCountTable('bon');
   //Si orderby est définis alors tri l'est forcément. 
   //Si c'est le cas on les utilise en paramètres dans notre manager
    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        $tri=$_REQUEST['tri'];
        $orderby = $_REQUEST['orderby'];
        $resAllBon = BonManager::getAllBon($limite, $iNbPage, $orderby,$tri);
    } else {
        $resAllBon = BonManager::getAllBon($limite, $iNbPage);
    }
    //On récupère tout les libéllés des Bons pour les associés dans la colonne
    $toDocLbl=  DocLibelleManager::getDocLibelles();
} catch (MySQLException $e) {

    switch ($resEr) {
        default:
            $msg = "<p class='erreur'>".date('H:i:s')." Oups! Une erreur est survenue : $resEr </p>";
            Tool::addMsg($msg);
            break;
    }
}