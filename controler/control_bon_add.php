<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require $path . '/model/DocLibelleManager.php';
require $path . '/model/Lot.php';
require $path . '/model/LotManager.php';
require $path . '/model/Bon.php';
require $path . '/model/BonManager.php';
require $path . '/model/Ligne.php';
require $path . '/model/LigneManager.php';
require $path . '/model/BonLigne.php';
require $path . '/model/BonLigneManager.php';


try {
    $resDocLbl = DocLibelleManager::getDocLibelles();

    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        $type = $_REQUEST['typeBon'];
        
        switch ($type) {
            
            //Correspond au bon de sortie
            case "1":
                    //Instanciation de la connection
                    $cnx = Connection::getConnection();
                    //Création du bon
                    $oBon = new Bon();

                    $oBon->bon_date = $_REQUEST['bonDate'];
                    $oBon->bon_fact_num = $_REQUEST['numFact'];
                    $oBon->doclbl_id = $_REQUEST['typeBon'];
                    
                    
                    //Prise en main de la connection
                    $cnx->beginTransaction();
                    
                    //insert du bon
                    $resBon = BonManager::addBon($oBon);
                   
                    //Récupération de l'id du bon inséré
                    $idBon = Connection::dernierId();
                   
                    //Création du "tableau de tableau" contenant toutes les informations 
                    $tabLotId        = $_REQUEST['lotId'];
                    $tabLigQte       = $_REQUEST['ligQte'];
                    $tabBonLigDepot  = $_REQUEST['bonligDepot'];
                    $tabBonLigCom    = $_REQUEST['bonligCom'];

                    $tabLigAdd = array(
                        'lot_id'=>$tabLotId,
                        'lig_qte'=>$tabLigQte,
                        'lig_com'=>$tabBonLigCom,
                        'lig_com_dep'=>$tabBonLigDepot);
                    
                    
                   //On boucle sur le tableau en commençant à 1
                   //pour éviter la ligne caché servant de modèle aux autres lignes
                   //Toute cette étape sera répété pour autant de ligne contenue dans nos tableau
                   //Ici on se base sur lot_id pour définir la taille 
                   //mais n'importe quelle tableau contenue par $tabLigAdd ferait l'affaire
                   for($i=1;$i<(count($tabLigAdd['lot_id']));$i++){
                       
                        $oLig = new Ligne();
                        $oLig->lot_id      =$tabLigAdd['lot_id'][$i];
                        $oLig->lig_qte     =$tabLigAdd['lig_qte'][$i];
                        $oLig->lig_com     =$tabLigAdd['lig_com'][$i];
                        $oLig->lig_com_dep =$tabLigAdd['lig_com_dep'][$i];
                        
                       
                        //On ajoute la ligne
                        $resLig=LigneManager::addLigne($oLig);
                        //On récupère l'id de la ligne
                        $idLig = Connection::dernierId();
                        //On selectionne le lot à mettre à jour
                        $oLot=LotManager::getLotForUpdate($oLig->lot_id);
                        
                        //On met à jour la qté stock lot
                        $lotQteStkInit         = $oLot->lot_qt_stock;
                        $oLot->lot_qt_stock    = $lotQteStkInit  - $oLig->lig_qte;
                        
                        if ($oLot->lot_qt_stock <0){
                            $resEr ='666';
                            throw new MySQLException('Quantité retiré supérieur à quantité stock',$cnx) ;
                        }
                        
                        //On appel le manager pour appliquer la modification
                        $resLot = LotManager::updQteLot($oLot);
                        
                        //Enfin on créé notre BonLigne
                        $oBonLig = new BonLigne();
                        $oBonLig->lig_id=$idLig;
                        $oBonLig->bon_id=$idBon;
                        //Et on l'ajoute
                        BonLigneManager::addBonLigne($oBonLig);
                    }
                    
                    //On commit la transaction
                    $cnx->commit();
                    //Ajout du méssage de réussite
                    $msg='<p class=\'info\'>'.date('H:i:s').'L\'enregistrement du bon de sortie numéro :'
                            .$idBon.' à été effectué avec succès</p>';
                    Tool::addMsg($msg);
                    
                break;

            case "2":
                Tool::printAnyCase($type);
                break;
        }
    }
} catch (MySQLException $e) {
    switch ($resEr) {
        case '666':
            $msg="<p class= 'erreur'> ".date('H:i:s')." Oups! La Quantité retiré est supérieur à la quantité en stock.</p>";
        break;
        default:
            $msg = '<p class=\'erreur\'> '.date('H:i:s').' Oups une erreur est survenue '.$resEr.'</p>';
        break;
    }
    Tool::addMsg($msg);
}