<?php

try {
    /**
     * Sous controleur Inventaire Pdf 
     */
    require_once $path . '/lib/generatorPDF.php';
    require_once $path . '/model/Inventaire.php';
    require_once $path . '/model/InventaireManager.php';
    require_once $path . '/model/ReferenceManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/LigneInventaire.php';
    require_once $path . '/model/LigneInventaireManager.php';

//-----------------------Initialisation---------------------------------//
    ob_start();
//------------------------Récupération des données----------------------//
    //On récupère l'id du bon passé en paramètre
    $invId = $_REQUEST['invId'];

    //On appel le manager pour récupéré le Bon 
    $oInv = InventaireManager::getInventaire($invId);
    //Et le manager pour les intitulés 
    //print_r($oInv);
    
    //On récupère les lignes associés
    //On récupére toutes les ligne du bon
    $resAllInvLig = LigneInventaireManager::getLignesInventaireFromInventaire($invId);
    //print_r($resAllInvLig);
    //On vérifie que le résultat récupéré soit bien un tableau (si aucune donnée ce n'est pas un tableau)
    if (is_array($resAllInvLig)) {

        //Tableau pour les lots
        $resAllLots = [];
        //Tableau pour les reférénces
        $resAllRefs = [];

        //Pour chaque ligne d'inventaire
        foreach ($resAllInvLig as $invLig) {
            
            //On récupère le lot associé
            $oLot = LotManager::getLot($invLig->lot_id);
            //Et la référence associé au lot
            $oRef = ReferenceManager::getReference($oLot->ref_id);
            //On ajoute le lot retourné au tableau de lot
            $resAllLots[] = $oLot;
            //On ajoute la référence retournée au tableau de référence
            $resAllRefs[] = $oRef;
        }


        //On réunis toutes les informations sous un même tableau pour les exploiter
        $tabLigPdf = array(
            'ref' => $resAllRefs,
            'lot' => $resAllLots,
            'invLig' => $resAllInvLig
        );
    }

//------------------------Création du Pdf----------------------//
//#1 Initialisation
    //Si la valeur de l'inventaire est égale à 1 l'inventaire est valide
    
    if ($oInv->inv_vld == 1){
        $sValide='Oui';
    }else{
        $sValide='Non';
    }
//Récupération des données en liste pour mise en page   
    list($year, $month, $day) = explode("-", $oInv->inv_date);
    
    $adresse = "SOLYA MEXICO \nLieu Quétel\n14430 GOUSTRANVILLE \nFRANCE"
             . "\n\nMail : contact@solyamexico.com\nTél : 06.27.18.29.94";

    $piedPage1 = 'SOLYA MEXICO - SARL Unipersonnelle au capital de 10 000 euros';
    $piedPage2 = "- Mail : contact@solyamexico.com - Tél : 06.27.18.29.94 ";
    $piedPage3 = "- N°SIRET : 8053006540001 - N°TVA INTRA : FR89805300654";


    $pdf = new generatorPDF($adresse,'', $piedPage1 . "\n" . $piedPage2 . "\n" . $piedPage3);

//Modification du saut de page à 40 px du bas de page
//10 px au dessus du footer
    $pdf->SetAutoPageBreak(true, 40);

//Ajout du logo
    $pdf->setLogo($path . '/img/site/logoSolya186x106.png');

//Elements personnalisé
    //Ajout des lignes pour la mise en page
    //Ajout de la partie motif
    $pdf->elementAdd('Inventaire validé : ' . $sValide, 'motif', 'header');
    $pdf->elementAdd('', 'traitEnteteProduit', 'content');
    $pdf->elementAdd('', 'traitEnteteProduitInf', 'content');
    $pdf->elementAdd('Commentaire : ' . $oInv->inv_lbl, 'commentaire', 'content');
    //Ajout trait bas du footer
    $pdf->elementAdd('', 'traitBas', 'footer');

//Colonnes du tableau
    $pdf->productHeaderAddRow('REFERENCE', 30, 'C');
    $pdf->productHeaderAddRow('PRODUIT ', 25, 'C');
    $pdf->productHeaderAddRow('N°LOT', 20, 'C');
    $pdf->productHeaderAddRow('QTE STOCK', 30, 'C');
    $pdf->productHeaderAddRow('QTE REEL', 25, 'C');
    $pdf->productHeaderAddRow('DLC/DLUO', 25, 'C');
    $pdf->productHeaderAddRow('COMMENTAIRE', 35, 'C');
    

    //#2 Ajout des infos

    $pdf->initPDF("INVENTAIRE N°" . $oInv->inv_id, "Créé le " . $day . "/" . $month . "/" . $year);

    if (isset($tabLigPdf)) {
    //Création d'une ligne par éléments à l'intérieur de mon tableau
        for ($i = 0; $i < count($tabLigPdf['ref']); $i++) {
            //On formate la date récupéré comme on la souhaite 
            list($year, $month, $day) = explode("-", (string) $tabLigPdf['lot'][$i]->lot_dlc);
            $lotDlc = $day . "/" . $month . "/" . $year;
            //Et on ajoute une ligne à notre PDF
            $pdf->productAdd(
                    array(
                        (string) $tabLigPdf['ref'][$i]->ref_code,
                        (string) $tabLigPdf['ref'][$i]->ref_lbl,
                        (string) $tabLigPdf['lot'][$i]->lot_id,
                        (string) $tabLigPdf['invLig'][$i]->liginv_qt_stock,
                        (string) $tabLigPdf['invLig'][$i]->liginv_qt_reel,
                        $lotDlc,
                        (string) $tabLigPdf['invLig'][$i]->liginv_lbl
                    )
            );
        }
    }
    require_once $path . '/templatePdf/template.php';

//------------------Construction du pdf ------------------//
//# Construction et affichage du pdf
    $pdf->buildPDF();

    $pdf->Output('INVENTAIRE' . $oInv->inv_id . 'pdf', 'I');

//On vide le buffer pour permettre l'affichage du pdf sans problèmes lors du prochain passage.
    ob_end_flush();
    
} catch (MySQLException $e) {
    
    //Si une erreur survient on la catch dans une exception
   if (isset ($resEr[0])){
      //Si elle provient de la base
            $msg = "<p class='erreur'> ". date('H:i:s') 
                    . " Impossible de générer le PDF. Code :"
                    . $resEr[0] . " Message : $resEr[1]"
                    . "</p>";
   }else{
       //Si c'est une erreur coté client
            $msg = "<p class='erreur'> ". date('H:i:s') 
                    . " Impossible de générer le PDF. Code :".$e->getCode()
                    . " Message : ". $e->getMessage()
                    . "</p>";
   }
   Tool::addMsg($msg);
   
}