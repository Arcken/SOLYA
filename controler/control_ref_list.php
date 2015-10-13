<?php

/**
 * Sous controleur list référence
 * 
 */
try {

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


    $iTotal = Tool::getCountTable('reference');

    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {

        $orderby = $_REQUEST['orderby'];
        $toRef = ReferenceManager::getAllReferences($limite, $iNbPage, $orderby);
    } else {

        $toRef = ReferenceManager::getAllReferences($limite, $iNbPage);
    }
    //Initialisation du tableau contenant toutes les informations
    
    if(is_array($toRef)){
        //on initialise les tableau
        $resRef=[];
        $resFiArt=[];
        $resPve=[];
        $resTva=[];
        $resDd=[];
    }
    //Pour chaque référence contenu dans notre tableau de référence
    foreach($toRef as $oRef){
        $resRef[]   = $oRef;
        //On récupère la fiche article associé
        $resFiArt[] = $oFiArt =  FicheArticleManager::getFicheArticleById($oRef->fiart_id);
        //On récupère les prix de vente associés
        $resPve[]   = $oPve   = PrixVenteManager::getCurPrixVente($oRef->ref_id);
        //On récupère la tva associé
        $resTva[]   = $oTva   =  TvaManager::getTvaById($oRef->tva_id);
        //On récupère le droit de douane associés
        $resDd[]    = $oDd    =  DroitDouaneManager::getDroitDouaneById($oRef->dd_id);
     
    }
    //Enfin on construit le tableau contenant toutes les données
    $resLigRefs=[    
                'ref'  =>$resRef,
                'fiart'=>$resFiArt,
                'dd'   =>$resDd,
                'tva'  =>$resTva,
                'pve'  =>$resPve
                     ];
    
} catch (MySQLException $e) {
    
}
