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
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/BeLigneManager.php';
    
    $iTotal = Tool::getCountTable('reference');

    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        if (isset($_REQUEST['tri']) && $_REQUEST['tri'] != '') {
                $sort = $_REQUEST['tri'];
            }
        $orderBy = $_REQUEST['orderby'];
        $toRef = ReferenceManager::getReferencesLim($rowStart, $iNbPage, $orderBy, $sort);
    } else {

        $toRef = ReferenceManager::getReferencesLim($rowStart, $iNbPage);
    }
    //Initialisation du tableau contenant toutes les informations
    
    if(is_array($toRef)){
        //on initialise les tableau
        $resAllRefs=[];
        $resAllFiArts=[];
        $resAllPves=[];
        $resAllTvas=[];
        $resAllDds=[];
        $resAllLots=[];
        $resAllBeLignes=[];
        $resAllStk=[];
        $resAllCaM=[];
        $resAllCoefsPart=[];
        $resAllCoefsPro=[];
        $resAllMargesPart=[];
        $resAllMargesPro=[];
    
    //Pour chaque référence contenu dans notre tableau de référence
    foreach($toRef as $oRef){
        
        //On récupère la référence 
        $resAllRefs[]     = $oRef;
        //On récupère la fiche article associé
        $resAllFiArts[]   = $oFiArt   = FicheArticleManager::getFicheArticleById($oRef->fiart_id);
        //On récupère les prix de vente associés
        $resAllPves[]     = $oPve     = PrixVenteManager::getCurPrixVente($oRef->ref_id);
        //On récupère la tva associé
        $resAllTvas[]     = $oTva     = TvaManager::getTvaById($oRef->tva_id);
        //On récupère le droit de douane associés
        $resAllDds[]      = $oDd      = DroitDouaneManager::getDroitDouaneById($oRef->dd_id);
        //On récupère les informations du lot le plus récent et en stock associé
        $oLot             = LotManager::getLotDlcMin($oRef->ref_id);
        
        //Si $oLot est définis on va chercher la ligne du bon d'entré associé
        if(isset($oLot) && $oLot !==0){
        //On récupère la ligne de bon d'entré associé au lot
            $resAllBeLignes[] = $oBeLigne = BeLigneManager::getBeLigneFromLot($oLot->lot_id);
        //Sinon    
        }else{
            //On créé un lot 'indéfinis' 
            //et on stock la valeur 'indéfinis' dans le tableau des Lignes de bon d'entrée
           $oLot= new Lot();
           $oLot->lot_dlc  ='indéfinis';
           
           $resAllBeLignes[] ='indéfinis';
        }
        $resAllLots[]    = $oLot;
        
        //On récupère le stock actuel de la référence
        $resAllStk[]     = $nStk = ReferenceManager::getRefCurSumStk($oRef->ref_id);
        
        //On récupère le cout d'achat moyen sur le stock actuel de la référence
        $oCaM     = ReferenceManager::getRefCurCaMoyen($oRef->ref_id);
        
        //On calcul les marges et coeffs professionnel et particulier
        //Si on a un résultats != 0 dans $oPve et dans $oCaM 
        if( isset($oPve) && ($oPve!==0) && ($oCaM->nb!='')){
            
            //Calcul des marges
            $margePro     = round(($oPve->pve_ent - $oCaM->nb)/$oPve->pve_ent,2);
            $resAllMargesPro[]  = $margePro.'%';
            $margePart = round(($oPve->pve_per - $oCaM->nb)/$oPve->pve_per,2);
            $resAllMargesPart[] = $margePart.'%';
            
            //Calcule des coefficients
            $resAllCoefsPro[]   = $coefPro      = round(($oPve->pve_ent / $oCaM->nb),2);
            $resAllCoefsPart[]  = $coefPart     = round(($oPve->pve_per / $oCaM->nb),2);
            
        }else{
            
            //Sinon on remplis avec indéfinis
            $oCaM = (object) ['nb'=>'indéfinis'];
            $resAllMargesPro[]  = 'indéfinis';
            $resAllMargesPart[] = 'indéfinis';
            $resAllCoefsPro[]   = 'indéfinis';
            $resAllCoefsPart[]  = 'indéfinis';
        
        }
        //Enfin on remplis le tableau des Cout d'achats moyens
        $resAllCaM[]     = $oCaM;
    }
    
    //Enfin on construit le tableau contenant toutes les données
    $resLigRefs=[    
                'ref'       =>$resAllRefs,
                'fiart'     =>$resAllFiArts,
                'dd'        =>$resAllDds,
                'tva'       =>$resAllTvas,
                'pve'       =>$resAllPves,
                'lot'       =>$resAllLots,
                'beLig'     =>$resAllBeLignes,
                'stock'     =>$resAllStk,
                'cuAchM'    =>$resAllCaM,
                'margePro'  =>$resAllMargesPro,
                'margePart' =>$resAllMargesPart,
                'coefPro'   =>$resAllCoefsPro,
                'coefPart'  =>$resAllCoefsPart
                     ];
    }
    
} catch (MySQLException $e) {
    
}
