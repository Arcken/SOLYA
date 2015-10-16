<?php
try{
/**
 * Sous controleur Bon_Pdf 
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

//-----------------------Initialisation---------------------------------//
ob_start();
//------------------------Récupération des données----------------------//

    //On récupère l'id du bon passé en paramètre
    $bonId = $_REQUEST['bonId'];
    
    //On appel le manager pour récupéré le Bon 
    $oBon = BonManager::getBon($bonId);
    //Et le manager pour les intitulés 
    $resDocLbl = DocLibelleManager::getAllDocsLibelles();
    
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
                     'ref' => $resAllRefs,
                     'lot' => $resAllLots,
                     'lig' => $resLignes 
                        );
     
//Récupération des données en liste pour mise en page   
list($year, $month, $day) = explode("-", $oBon->bon_date);
list($sCat, $sSubCat) = explode(" ",$sTypeBon);

//------------------------Création du Pdf----------------------//
    //#1 Initialisation


$adresse ="SOLYA MEXICO \nLieu Quétel\n14430 GOUSTRANVILLE \nFRANCE";

$piedPage1 ='SOLYA MEXICO - SARL Unipersonnelle au capital de 10 000 euros';
$piedPage2 = "- Mail : contact@solyamexico.com - Tél : 06.27.18.29.94 ";
$piedPage3 = "- N°SIRET : 8053006540001 - N°TVA INTRA : FR89805300654";


$pdf = new generatorPDF($adresse,'LE CLIENT EST ICI ET IL EST VACHEMENT LONG '
                                . 'SON NOM EN PLUS IL PREND DE LA PLACE '
                                . 'MAIS C\'EST QUAND MEME COOL '
                                . 'CA SE DEFORME PAS', $piedPage1."\n".$piedPage2."\n".$piedPage3);

//Modification du saut de page à 40 px du bas de page
//10 px au dessus du footer
$pdf->SetAutoPageBreak(true, 40); 

//Ajout du logo
$pdf->setLogo($path.'/img/site/logoSolya186x106.png');

//Elements personnalisé
    //Ajout de la partie motif
$pdf->elementAdd('Motif : '.$sSubCat, 'motif', 'header');
    //Ajout des lignes pour la mise en page
$pdf->elementAdd('', 'traitEnteteProduit', 'content');
$pdf->elementAdd('', 'traitEnteteProduitInf', 'content');

$pdf->elementAdd('Commentaire : '.$oBon->bon_com,'commentaire', 'content');
    //Si bon de sortie associé (cas du bon de retour)
if($oBon->bon_sortie_assoc != ''){
    $pdf->elementAdd('Bon de sortie associé : '.$oBon->bon_sortie_assoc,'bonSortieAssoc', 'content');
}
    //Ajout trait bas du footer
$pdf->elementAdd('', 'traitBas', 'footer');

//Colonnes du tableau
$pdf->productHeaderAddRow('REFERENCE ', 30, 'C');
$pdf->productHeaderAddRow('PRODUIT ', 30, 'C');
$pdf->productHeaderAddRow('N°LOT ', 20, 'C');
$pdf->productHeaderAddRow('QTE ', 20, 'C');
$pdf->productHeaderAddRow('DLC/DLUO ', 25, 'C');
$pdf->productHeaderAddRow('DEPOT ',25,'C');
$pdf->productHeaderAddRow('COMMENTAIRE ',40,'C');

    //#2 Ajout des infos

$pdf->initPDF("BON N°".$oBon->bon_id." ".$sCat, "Caen le ".$day."/".$month."/".$year);


//Création d'une ligne par éléments à l'intérieur de mon tableau
for($i=0;$i<count($tabLig['ref']);$i++){
   //On formate la date récupéré comme on la souhaite 
   list($year, $month, $day) = explode("-",(string)$tabLig['lot'][$i]->lot_dlc);
   $lotDlc=$day."/".$month."/".$year;
   
    $pdf->productAdd(
                      
                     array(
                          (string)$tabLig['ref'][$i]->ref_code,
                          (string)$tabLig['ref'][$i]->ref_lbl,
                          (string)$tabLig['lot'][$i]->lot_id,
                          (string)$tabLig['lig'][$i]->lig_qte,
                          $lotDlc,
                          (string)$tabLig['lig'][$i]->lig_com_dep,
                          (string)$tabLig['lig'][$i]->lig_com
                          )
           );
    
}    

require_once $path . '/templatePdf/template.php';

//------------------Construction du pdf ------------------//
//# Construction et affichage du pdf
$pdf->buildPDF();

$pdf->Output('Bon'.$sTypeBon.$oBon->bon_id.'pdf', 'I');

//On vide le buffer pour permettre l'affichage du pdf sans problèmes lors du prochain passage.
ob_end_flush();

}catch (Exception $e){
    echo'<br>';
    Tool::printAnyCase($e->getCode());
    echo'<br>';
    Tool::printAnyCase($e->getMessage());
    echo'<br>';
    Tool::printAnyCase($e->getTraceAsString());
    echo'<br>';
}