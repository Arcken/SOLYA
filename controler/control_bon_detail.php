<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {

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
    /* Tool::printAnyCase($oBon);
      Tool::printAnyCase($resAllBonLignes);
      Tool::printAnyCase($resLignes);
      Tool::printAnyCase($resAllLots);
      Tool::printAnyCase($resAllRefs); */

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Instanciation de la connection
        $cnx = Connection::getConnection();

        //Démarrage de la transaction
        $cnx->beginTransaction();

        //Création du bon 
        $oBon = new Bon();
        //$oBe->cpt_id = $_REQUEST['cptId'];
        $oBon->bon_id = $bonId;
        $oBon->doclbl_id = $_REQUEST['typeBon'];
        $oBon->bon_date = $_REQUEST['bonDate'];
        $oBon->bon_fact_num = $_REQUEST['numFact'];
        $oBon->bon_com = $_REQUEST['bonCom'];

        // Tool::printAnyCase($oBon);
        //Modification du bon
        $updBon = BonManager::updBon($oBon);
        Tool::printAnyCase($updBon);
        echo 'bon';
        
        //-----------------Gestion des lignes du formulaire-------------------------
        //Création des tableaux contenant toutes les informations
        //Un tableau par type de champs
        //tableau pour la suppression de ligne
        if (isset($_REQUEST['ligSupp'])) {
            $tLigSupp = $_REQUEST['ligSupp'];
        }

        //On récupère les anciennes quantités des lignes
        $tOldQte = $_REQUEST['ligQteOld'];

        //Tableaux pour la table ligne

        $tLigId = $_REQUEST['ligId'];
        $tLotId = $_REQUEST['lotId'];
        $tLigQte = $_REQUEST['ligQte'];
        $tLigComDep = $_REQUEST['ligComDep'];
        $tLigCom = $_REQUEST['ligCom'];


        //Tableau pour la référence
        $tRefId = $_REQUEST['refId'];

        //Tableau de ligne de formulaire
        $tLigneForm = [
            'lig_id' => $tLigId,
            'lot_id' => $tLotId,
            'old_qte' => $tOldQte,
            'lig_qte' => $tLigQte,
            'lig_com_dep' => $tLigComDep,
            'lig_com' => $tLigCom,
            'ref_id' => $tRefId
        ];

        Tool::printAnyCase($tLigneForm);
        //Boucle pour traiter les lignes
        //On ignore la première ligne, c'est le squelette de construction 
        //pour l'ajout de ligne dans le bon
        //La limite étant le nombre de ligne remplie on prend ref_id comme témoin
        echo '<br>en dehors de la boucle <br>';
        for ($i = 1; $i <= (count($tLigneForm['ref_id'])) - 1; $i++) {
            echo '<br>dans la boucle <br>';
            //Si la case lig-id est != '' c'est un update
            if ($tLigneForm['lig_id'][$i] != 0) {
                //Si
                if (isset($tLigSupp[$i])) {
                    echo '<br>';
                    echo 'suppre';
                    echo '<br>';
                } else {
                    echo $i . "<br>";
                    //On hydrate un objet Ligne
                    $args = array(
                        'lig_id'=>$tLigneForm['lig_id'][$i],
                        'lot_id' => $tLigneForm['lot_id'][$i],
                        'lig_qte' => $tLigneForm['lig_qte'][$i],
                        'lig_com_dep' => $tLigneForm['lig_com_dep'][$i],
                        'lig_com' => $tLigneForm['lig_com'][$i]
                    );

                    $oLigne = new Ligne($args);
                    /* $oLigne->lot_id = $tLigneForm['lot_id'][$i];
                      $oLigne->lig_qte = $tLigneForm['lig_qte'][$i];
                      $oLigne->lig_com_dep = $tLigneForm['lig_com_dep'][$i];
                      $oLigne->lig_com = $tLigneForm['lig_com'][$i]; */

                    //Update de la ligne dans la table ligne
                    $updLigne = LigneManager::updLigne($oLigne);
                    echo "<br>Update ligne check : $updLigne <br>";

                    //on récupére l'ancien lot
                    $oOldLot = LotManager::getLot($oLigne->lot_id);

                    //On compare l'ancienne quantité avec la nouvelle le calcul étant
                    //différent selon le type de bon
                    $typeBon = $_REQUEST['typeBon'];

                    echo 'OldqtéLot =' . $oOldLot->lot_qt_stock . '</br>';
                    switch ($typeBon) {

                        case '1':
                        case '2':
                        case '3':
                        case '4':
                        case '5':
                        case '6':
                        case '7':

                            $diffQteMvt = ((float) $tLigneForm['old_qte'][$i]) - ((float) $oLigne->lig_qte);
                            break;

                        case '8':
                        case '9':
                        case '10':
                        case '11':
                        case '12':

                            $diffQteMvt = ((float) $oLigne->lig_qte) - ((float) $tLigneForm['old_qte'][$i]);
                            break;
                    }

                    echo 'diffQtMvt = ' . $diffQteMvt . '</br>';
                    //On réajuste la qté en stock 
                    //Règles des opérateurs (- et -) = (+), (+ et -) = (-) ,( + et +) = (+)

                    $newQtLot = $oOldLot->lot_qt_stock + ($diffQteMvt);
                    echo 'NewqtéLot =' . $newQtLot . '</br>';
                    if($oOldLot->lot_qt_init<$newQtLot){
                        $resEr='666';
                        throw new MySQLException ("Impossible de mettre"
                                . " à jour le lot la quantité de retour est"
                                . " supérieur à la quantité initial du lot",$cnx);
                        
                    }
                    $argsLot = array('lot_qt_stock' => $newQtLot,
                        'lot_id' => $oOldLot->lot_id);

                    $oLot = new Lot($argsLot);
                    $res = LotManager::updQteLot($oLot);
                    echo "<br>Update qté lot check : $res <br>";
                    //Tool::printAnyCase($res);
                }
                //Sinon c'est que c'est un insert    
            } else {

                switch ($typeBon) {
                    
                    //Cas bon de sortie
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                    case '7':

                        $oLig = new Ligne();
                        $oLig->lot_id = $tLigneForm['lot_id'][$i];
                        $oLig->lig_qte = $tLigneForm['lig_qte'][$i];
                        $oLig->lig_com = $tLigneForm['lig_com'][$i];
                        $oLig->lig_com_dep = $tLigneForm['lig_com_dep'][$i];


                        //On ajoute la ligne
                        $resLig = LigneManager::addLigne($oLig);
                        echo "<br> Ajout ligne check : $resLig ligne = $i<br>";
                        //On récupère l'id de la ligne
                        $idLig = Connection::dernierId();
                        //On selectionne le lot à mettre à jour
                        $oLot = LotManager::getLotForUpd($oLig->lot_id);

                        //On met à jour la qté stock lot
                        $lotCurQteStk = $oLot->lot_qt_stock;
                        $oLot->lot_qt_stock = $lotCurQteStk - $oLig->lig_qte;
                        
                        if ($oLot->lot_qt_stock < 0) {
                            $resEr = '666';
                            throw new MySQLException('Quantité retiré supérieur à quantité stock', $cnx);
                        }

                        //On appel le manager pour appliquer la modification
                        $resLot = LotManager::updQteLot($oLot);
                        echo "<br>Update qté lot check : $resLot <br>";
                        
                        //Enfin on créé notre BonLigne
                        $oBonLig = new BonLigne();
                        $oBonLig->lig_id = $idLig;
                        $oBonLig->bon_id = $bonId;
                        //Et on l'ajoute
                        $resBl=BonLigneManager::addBonLigne($oBonLig);
                        echo "<br>Ajout Bon lign check : $resBl <br>";
                        break;
                        
                    //Cas bon de retour
                    case '8':
                    case '9':
                    case '10':
                    case '11':
                    case '12':

                        $oLig = new Ligne();
                        $oLig->lot_id = $tLigneForm['lot_id'][$i];
                        $oLig->lig_qte = $tLigneForm['lig_qte'][$i];
                        $oLig->lig_com = $tLigneForm['lig_com'][$i];
                        $oLig->lig_com_dep = $tLigneForm['lig_com_dep'][$i];


                        //On ajoute la ligne
                        $resLig = LigneManager::addLigne($oLig);
                        echo "<br>Ajout ligne check : $resLig ligne =$i  <br>";
                        //On récupère l'id de la ligne
                        $idLig = Connection::dernierId();
                        //On selectionne le lot à mettre à jour
                        $oLot = LotManager::getLotForUpd($oLig->lot_id);

                        //On controle que la valeur saisie dans l'input n'ai pas supérieur
                        //à la qt initial - la qté stk si c'est le cas on lance une exception
                        if ($oLot->lot_qt_init - $oLot->lot_qt_stock < $oLig->lig_qte) {
                            $resEr = '777';
                            throw new MySQLException('Quantité retourner supérieur au maximum attendue.'
                            . 'Quantité du stock initial : ' . $oLot->lot_qt_init .
                            ' A la Ligne : ' . $i, $cnx);
                        }

                        //On met à jour la qté stock lot
                        $lotCurQteStk = $oLot->lot_qt_stock;
                        $oLot->lot_qt_stock = $lotCurQteStk + $oLig->lig_qte;


                        //On appel le manager pour appliquer la modification
                        $resLot = LotManager::updQteLot($oLot);
                        echo "<br>Update qté lot check : $resLot <br>";
                        //Enfin on créé notre BonLigne
                        $oBonLig = new BonLigne();
                        $oBonLig->lig_id = $idLig;
                        $oBonLig->bon_id = $idBon;
                        //Et on l'ajoute
                        $resBl=BonLigneManager::addBonLigne($oBonLig);
                        echo "<br>Ajout bon ligne check : $resBl <br>";
                        break;
                }
            }
        }

        $cnx->commit();
        echo "<br>pouete pouete : c'est un succés ! <br>";
    }
} catch (MySQLException $e) {
    $cnx->rollback();
    echo 'pouete pouete ' . $resEr . " " . $e->RetourneErreur();
}