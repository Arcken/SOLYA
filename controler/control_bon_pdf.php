<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once $path . '/lib/generatorPDF.php';
    require_once $path . '/model/Bon.php';
    require_once $path . '/model/BonManager.php';
    require_once $path . '/model/DocLibelleManager.php';
    require_once $path . '/model/BonLigne.php';
    require_once $path . '/model/BonLigneManager.php';
    require_once $path . '/model/ReferenceManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/Ligne.php';
    require_once $path . '/model/LigneManager.php';

//------------------------Récupération des données----------------------//

    //On récupère l'id du bon passé en paramètre
    $bonId = $_REQUEST['bonId'];
    //On définit le titre de la page
    $sPageTitle = "Consulter/Modifier le bon N°" . $bonId;
    //On appel le manager pour récupéré le Bon 
    $oBon = BonManager::getBon($bonId);
    //Et le manager pour les intitulés 
    $resDocLbl = DocLibelleManager::getDocLibelles();
    
    foreach($resDocLbl as $lbl){
        if ($lbl->doclbl_id == $oBon->doclbl_id){
            $sTypeBon=$lbl->doclbl_lbl;
        }
    }
    //On récupére toutes les ligne du bon
    $resAllBonLignes = BonLigneManager::getBonLignesFromBon($bonId);

    //On vérifie que le résultat récupéré soit bien un tableau (si aucune donnée ce n'est pas un tableau)
    if ( is_array($resAllBonLignes)) {

        //Tableau pour les lignes
        $resLignes = [];
        //Tableau pour les lots
        $resAllLots = [];
        //Tableau pour les reférénces
        $resAllRefs = [];

        //Pour chaque bon_ligne
        foreach ($resAllBonLignes as $bonLigne) {

            //On récupére l'id de ligne
            $ligId = $bonLigne->lig_id;
            //On récupére les infos de la ligne
            $ligne = LigneManager::getLigneDetail($ligId);
            //On ajoute la ligne retourné au tableau de ligne
            $resLignes[] = $ligne;

            //On récupére l'id du lot
            $lotId = $ligne->lot_id;
            //On récupére les infos du lot
            $lot = LotManager::getLot($lotId);
            //On ajoute le lot retourné au tableau de lot
            $resAllLots[] = $lot;

            //On récupére l'id de la référence
            $refid = $lot->ref_id;
            //On récupére les infos de la référence
            $ref = ReferenceManager::getReference($refid);
            //On ajoute la référence retournée au tableau de référence
            $resAllRefs[] = $ref;
        }
    }
    
    //On réunis toutes les informations sous un même tableau pour les exploiter
     $tabLig = array(   
                     'ref' => $resLignes ,
                     'lot' => $resAllLots,
                     'lig' => $resAllRefs
                        );
    
    
//------------------------Création du Pdf----------------------//
    //#1 Initialisation
$adresse ='SOL\'YA Mexico 22 quai vandoeuvre\n14000\nCaen';

$piedPage1 ='SOL\'YA Mexico 22 quai vandoeuvre 14000 Caen - contact@solya-mexico.fr 06 00 00 00 00';
$piedPage2 = "Les produits livrés demeurent la propriété exclusive de notre entreprise"
            ."jusqu'au paiement complet de la présente facture.";
$piedPage3 = "RCS : 000-000-000- CAEN "
            ."/ TVA Intracomunautaire : FR 00 0000 0000 0000 0000 / SIRET 000 000 000 000 000";


$pdf = new generatorPDF($adresse, '', $piedPage1."\n".$piedPage2."\n".$piedPage3);

$pdf->setLogo($path.'/img/site/logo.png');

$pdf->productHeaderAddRow('REF ID', 50, 'L');
$pdf->productHeaderAddRow('CODE REFERENCE', 40, 'C');
$pdf->productHeaderAddRow('LIBELLE REFERENCE', 50, 'C');
$pdf->productHeaderAddRow('N°LOT', 50, 'C');
$pdf->productHeaderAddRow('QTE ', 15, 'C');
$pdf->productHeaderAddRow('DEPOT',50,'C');
$pdf->productHeaderAddRow('COMMENTAIRE',50,'C');

    //#2 Ajout des infos

$pdf->initPDF("Bon de ".$sTypeBon , "Caen le ".date('d/m/y'), "Page ");

//Création d'une ligne par éléments à l'intérieur de mon tableau
foreach($tabLig as $ligPdf){
    $pdf->productAdd($ligPdf);
    
}    

//------------Application de la mise en page---------------------//
//#3 Mise en pages

// coordonnée de l'entreprise
$pdf->template['header']['fontSize'] = 11;
$pdf->template['header']['lineHeight'] = 5;
$pdf->template['header']['margin'] = array(24, 0, 0, 10);
// numéro de page
$pdf->template['infoPage']['margin'] = array(5, 5, 0, 0);
$pdf->template['infoPage']['align'] = 'R';
// numéro de facture
$pdf->template['infoFacture']['margin'] = array(60, 5, 0, 10);
$pdf->template['infoFacture']['fontFace'] = 'B';
// date
$pdf->template['infoDate']['fontSize'] = 10;
$pdf->template['infoDate']['margin'] = array(20, 0, 0, 120);
$pdf->template['infoDate']['color'] = array('r'=>150, 'g'=>150, 'b'=>150);
// client
$pdf->template['client']['fontSize'] = 15;
$pdf->template['client']['margin'] = array(30, 0, 0, 120);
// pied de page
$pdf->template['footer']['fontSize'] = 11;
$pdf->template['footer']['lineHeight'] = 5;
$pdf->template['footer']['color'] = array('r'=>100, 'g'=>100, 'b'=>100);
$pdf->template['footer']['align'] = 'L';
$pdf->template['footer']['margin'] = array(255, 40, 0, 40);
// entete de produit
$pdf->template['productHead']['fontFace'] = 'B';
$pdf->template['productHead']['color'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['productHead']['margin'] = array(20, 0, 0, 0);
$pdf->template['productHead']['padding'] = array(4, 4, 0, 14);
// liste des produit
$pdf->template['product']['fontSize'] = 10;
$pdf->template['product']['lineHeight'] = 4;
$pdf->template['product']['backgroundColor2'] = array('r'=>255, 'g'=>255, 'b'=>255);
$pdf->template['product']['color'] = array('r'=>50, 'g'=>50, 'b'=>50);
$pdf->template['product']['color2'] = array('r'=>50, 'g'=>50, 'b'=>50);
$pdf->template['product']['margin'] = array(1, 0, 0, 10);
$pdf->template['product']['padding'] = array(1, 4, 1, 4);
// entete des totaux
$pdf->template['totalHead']['lineHeight'] = 1;
$pdf->template['totalHead']['backgroundColor'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['totalHead']['margin'] = array(10, 0, 0, 0);
// liste des totaux
$pdf->template['total']['lineHeight'] = 5;
$pdf->template['total']['margin'] = array(0, 0, 0, 120);
$pdf->template['total']['padding'] = array(2, 0, 0, 0);
// element personnalisé 1
$pdf->template['traitEnteteProduit']['lineHeight'] = 1;
$pdf->template['traitEnteteProduit']['backgroundColor'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['traitEnteteProduit']['margin'] = array(80, 0, 0, 0);
// element personnalisé 2
$pdf->template['traitBas']['lineHeight'] = 1;
$pdf->template['traitBas']['backgroundColor'] = array('r'=>255, 'g'=>210, 'b'=>255);
$pdf->template['traitBas']['margin'] = array(290, 40, 0, 40);


//------------------Construction du pdf ------------------//
//# Construction et affichage du pdf

$pdf->buildPDF();
$pdf->Output('Facture.pdf', 'I');