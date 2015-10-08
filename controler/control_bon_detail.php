<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    require_once $path . '/model/BonManager.php';
    require_once $path . '/model/DocLibelleManager.php';
    require_once $path . '/model/BonLigneManager.php';
    require_once $path . '/model/ReferenceManager.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/LigneManager.php';
    
    
    //On récupère l'id du bon passé en paramètre
    $bonId = $_REQUEST['bonId'];
    //On définit le titre de la page
    $sPageTitle = "Consulter/Modifier le bon N°" . $bonId;
    //On appel le manager pour récupéré le Bon 
    $oBon = BonManager::getBonForUpd($bonId);
    //Et le manager pour les intitulés 
    $resDocLbl = DocLibelleManager::getDocLibelles();

    //On récupére toutes les ligne du bon
    $resAllBonLignes = BonLigneManager::getBonLignesFromBon($bonId);

    //On vérifie que $resAllBeLigneBE soit bien un tableau (si aucune donnée ce n'est pas un tableau
    if (is_array($resAllBonLignes)) {
        
        //Tableau pour les lignes
        $resLignes = [];
        //Tableau pour les lots
        $resAllLots = [];
        //Tableau pour les reférénces
        $resAllRefs = [];
        
        //Pour chaque be_ligne
        foreach ($resAllBonLignes as $bonLigne) {

            //On récupére l'id de ligne
            $ligId = $bonLigne->lig_id;
            //On récupére les infos de la ligne
            $ligne = LigneManager::getLigneDetailForUpd($ligId);
            //On ajoute la ligne retourné au tableau de ligne
            $resLignes[] = $ligne;

            //On récupére l'id du lot
            $lotId = $ligne->lot_id;
            //On récupére les infos du lot
            $lot = LotManager::getLotForUpd($lotId);
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
     //On définit la valeur de sButton
    $sButton = 'Modifier';
    
    //Pour vérification permet de controler les valeurs des tableaux
    /*Tool::printAnyCase($oBon);
    Tool::printAnyCase($resAllBonLignes);
    Tool::printAnyCase($resLignes);
    Tool::printAnyCase($resAllLots);
    Tool::printAnyCase($resAllRefs);*/
    
} catch (MySQLException $e) {
    echo 'pouete pouete ' . $resEr." ". $e->RetourneErreur();
}