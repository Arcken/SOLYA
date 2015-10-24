<?php

/**
 * Sous controleur Modification bon
 */
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        require_once $path . '/model/InventaireManager.php';
        //Contrôle si un inventaire est en cours
        $tInventaire = InventaireManager::getInventaireOpen();
        if (!isset($tInventaire) || !is_array($tInventaire)) {

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
            $resDocLbl = DocLibelleManager::getAllDocsLibelles();

            //On récupére toutes les ligne du bon
            $resAllBonLignes = BonLigneManager::getBonLignesFromBon($bonId);

            //On vérifie que le résultat récupéré soit bien un tableau (si aucune donnée ce n'est pas un tableau)
            if (is_array($resAllBonLignes)) {

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

            //Si le formulaire est envoyé
            if ($sButtonUt == 'Modifier') {
                //Vérification du jeton pour savoir si le formulaire à était envoyé
                if ($_SESSION['token'] != $_REQUEST['token']) {

                    //Instanciation de la connection
                    $cnx = Connection::getConnection();

                    //Démarrage de la transaction
                    $cnx->beginTransaction();

                    //Création du bon 
                    $oBon = new Bon();
                    //$oBon->cpt_id = $_REQUEST['cptId'];
                    $oBon->bon_id = $bonId;
                    $oBon->doclbl_id = $_REQUEST['typeBon'];
                    $oBon->bon_date = $_REQUEST['bonDate'];

                    if (isset($_REQUEST['bonSortie'])) {
                        $oBon->bon_sortie_assoc = $_REQUEST['bonSortie'];
                    }
                    $oBon->bon_fact_num = $_REQUEST['numFact'];
                    $oBon->bon_com = $_REQUEST['bonCom'];


                    //Modification du bon
                    $updBon = BonManager::updBon($oBon);
                    
                    //-----------------Gestion des lignes du formulaire-------------------------
                    //Création des tableaux contenant toutes les informations
                    //Un tableau par type de champs
                    //tableau pour la suppression de ligne

                    if (isset($_REQUEST['ligSupp'])) {
                        $tLigSupp = $_REQUEST['ligSupp'];
                    }


                    //Tableaux pour la table ligne
                    if (isset($_REQUEST['ligId'])) {

                        $tLigId = $_REQUEST['ligId'];
                        $tLotId = $_REQUEST['lotId'];
                        $tLigQte = $_REQUEST['ligQte'];
                        $tLigComDep = $_REQUEST['ligComDep'];
                        $tLigCom = $_REQUEST['ligCom'];

                        //On récupère les anciennes quantités des lignes si il en éxiste
                        if (isset($_REQUEST['ligQteOld'])) {
                            $tOldQte = $_REQUEST['ligQteOld'];
                        }
                        //Tableau pour la référence
                        $tRefId = $_REQUEST['refId'];

                        //Tableau de ligne de formulaire
                        $tLigneForm = [
                            'lig_id' => $tLigId,
                            'lot_id' => $tLotId,
                            'lig_qte' => $tLigQte,
                            'lig_com_dep' => $tLigComDep,
                            'lig_com' => $tLigCom,
                            'ref_id' => $tRefId
                        ];
                        if (isset($tOldQte)) {
                            $tLigneForm['old_qte'] = $tOldQte;
                        }

                       
                    }
                    //On créé la variable typeBon qui va nous permettre
                    //de choisir quelles actions effectuer
                    $typeBon = $_REQUEST['typeBon'];

                    //Boucle pour traiter les lignes
                    //On ignore la première ligne, c'est le squelette de construction 
                    //pour l'ajout de ligne dans le bon.
                    //La limite étant le nombre de ligne remplie on prend ref_id comme témoin
                    

                    for ($i = 1; $i <= (count($tLigneForm['ref_id'])) - 1; $i++) {
                        //echo '<br> dans la boucle <br>';
                        //Si la case lig-id est > 0 c'est un update ou une suppression
                        if ($tLigneForm['lig_id'][$i] > 0) {

                            //Si le tableau de checkbox pour la suppression est définit
                            if (isset($tLigSupp[$i])) {

                                //On créé les arguments à passer au constructeur de l'objet Bonligne
                                $argsDelBl = array(
                                    'lig_id' => $tLigneForm['lig_id'][$i],
                                    'bon_id' => $oBon->bon_id
                                );

                                //On hydrate l'objet BonLigne que l'on va supprimer
                                $oBonLigneToDel = new BonLigne($argsDelBl);

                                //On supprime dans la table associative bon_ligne
                                $resDelBonLig = BonLigneManager::delBonLigne($oBonLigneToDel);

                                //On récupère les données de la ligne à supprimer
                                $oLigneToDel = LigneManager::getLigneDetail($tLigneForm['lig_id'][$i]);
                                $oLot = LotManager::getLotForUpd($oLigneToDel->lot_id);
                                //Selon le type de bon le traitement diffère donc switch
                                switch ($typeBon) {

                                    case '1':
                                    case '2':
                                    case '3':
                                    case '4':
                                    case '5':
                                    case '6':
                                    case '7':

                                        //echo "<br>Ancienne valeur stk du lot = $oLot->lot_qt_stock <br>";
                                        //Sur la suppression d'une ligne de bon de sortie
                                        //on modifie la valeur stock du lot pour la réincrémenter
                                        //Cependant il est nécessaire de controler
                                        //que la nouvelle valeur ne dépasse pas la quantité initiale du lot
                                        //Controle fait dans la base

                                        $nvVal = (float) $oLot->lot_qt_stock + (float) $oLigneToDel->lig_qte;
                                        $oLot->lot_qt_stock = $nvVal;

                                        

                                        break;

                                    case '8':
                                    case '9':
                                    case '10':
                                    case '11':
                                    case '12':

                                        
                                        //Sur la suppression d'une ligne de bon de retour
                                        //on modifie la valeur stock du lot pour la décrémenter
                                        //Cependant il est nécessaire de controler
                                        //que la nouvelle valeur ne soit pas inférieur à 0
                                        //Controle également fait dans la base avec un trigger
                                        $nvVal = (float) $oLot->lot_qt_stock - (float) $oLigneToDel->lig_qte;
                                        $oLot->lot_qt_stock = $nvVal;

                                        break;
                                }

                                $resLotQteUpd = LotManager::updQteLot($oLot);
                                

                                $resLigneDel = LigneManager::delLigne($oLigneToDel->lig_id);
                             
                            } else {

                                
                                //On hydrate un objet Ligne
                                $args = array(
                                    'lig_id' => $tLigneForm['lig_id'][$i],
                                    'lot_id' => $tLigneForm['lot_id'][$i],
                                    'lig_qte' => $tLigneForm['lig_qte'][$i],
                                    'lig_com_dep' => $tLigneForm['lig_com_dep'][$i],
                                    'lig_com' => $tLigneForm['lig_com'][$i]
                                );

                                $oLigne = new Ligne($args);

                                //Update de la ligne dans la table ligne
                                $updLigne = LigneManager::updLigne($oLigne);
                                
                                //on récupére le lot
                                $oOldLot = LotManager::getLot($oLigne->lot_id);

                                
                                switch ($typeBon) {

                                    case '1':
                                    case '2':
                                    case '3':
                                    case '4':
                                    case '5':
                                    case '6':
                                    case '7':
                                        //Pour la sortie on récupère l'ancienne qté du lot à laquelle on retire la quantité de la ligne
                                        $diffQteMvt = ((float) $tLigneForm['old_qte'][$i]) - ((float) $oLigne->lig_qte);
                                        break;

                                    case '8':
                                    case '9':
                                    case '10':
                                    case '11':
                                    case '12':
                                        //Pour le retour on récupère l'ancienne qté du lot et l'on soustrait à la quantité de la ligne
                                        $diffQteMvt = ((float) $oLigne->lig_qte) - ((float) $tLigneForm['old_qte'][$i]);
                                        break;
                                }

                               
                                //On réajuste la qté en stock 
                                //Règles des opérateurs (- et -) = (+), (+ et -) = (-) ,( + et +) = (+)
                                $newQtLot = $oOldLot->lot_qt_stock + ($diffQteMvt);
                               


                                $argsLot = array(
                                    'lot_qt_stock' => $newQtLot,
                                    'lot_id' => $oOldLot->lot_id);

                                $oLot = new Lot($argsLot);
                                //Pas besoin de controler les valeurs le trigger le fait pour nous
                                $res = LotManager::updQteLot($oLot);
                                
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
                                    //On hydrate l'objet ligne
                                    $oLig = new Ligne();
                                    $oLig->lot_id = $tLigneForm['lot_id'][$i];
                                    $oLig->lig_qte = $tLigneForm['lig_qte'][$i];
                                    $oLig->lig_com = $tLigneForm['lig_com'][$i];
                                    $oLig->lig_com_dep = $tLigneForm['lig_com_dep'][$i];


                                    //On ajoute la ligne
                                    $resLig = LigneManager::addLigne($oLig);
                                  
                                    //On récupère l'id de la ligne
                                    $idLig = Connection::dernierId();

                                    //On selectionne le lot à mettre à jour
                                    $oLot = LotManager::getLotForUpd($oLig->lot_id);

                                    //On met à jour la qté stock lot
                                    $lotCurQteStk = $oLot->lot_qt_stock;
                                    $oLot->lot_qt_stock = $lotCurQteStk - $oLig->lig_qte;
                                    //Pas besoin de controler les valeurs le trigger le fait pour nous

                                    //On appel le manager pour appliquer la modification
                                    $resLot = LotManager::updQteLot($oLot);
                                    //echo "<br>Update qté lot check : $resLot <br>";
                                    //Enfin on créé notre BonLigne
                                    $oBonLig = new BonLigne();
                                    $oBonLig->lig_id = $idLig;
                                    $oBonLig->bon_id = $oBon->bon_id;

                                    //Et on l'ajoute
                                    $resBl = BonLigneManager::addBonLigne($oBonLig);
                                    //echo "<br>Ajout Bon lign check : $resBl <br>";
                                    break;

                                //Cas bon de retour
                                case '8':
                                case '9':
                                case '10':
                                case '11':
                                case '12':

                                    //On hydrate l'objet ligne
                                    $oLig = new Ligne();
                                    $oLig->lot_id = $tLigneForm['lot_id'][$i];
                                    $oLig->lig_qte = $tLigneForm['lig_qte'][$i];
                                    $oLig->lig_com = $tLigneForm['lig_com'][$i];
                                    $oLig->lig_com_dep = $tLigneForm['lig_com_dep'][$i];

                                    //On ajoute la ligne
                                    $resLig = LigneManager::addLigne($oLig);
                                    //echo "<br>Ajout ligne check : $resLig ligne =$i  <br>";
                                    //On récupère l'id de la ligne
                                    $idLig = Connection::dernierId();

                                    //On selectionne le lot à mettre à jour
                                    $oLot = LotManager::getLotForUpd($oLig->lot_id);

                                    //On controle que la valeur saisie dans l'input n'ai pas supérieur
                                    //à la qt initial - la qté stk si c'est le cas on lance une exception
                                    
                                    //On met à jour la qté stock lot
                                    $lotCurQteStk = $oLot->lot_qt_stock;
                                    $oLot->lot_qt_stock = $lotCurQteStk + $oLig->lig_qte;

                                    //Le trigger de la base s'occupe
                                    //du controle sur les quantités donc pas besoin
                                    //de faire de contôle de quantités
                                    //On appel le manager pour appliquer la modification
                                    $resLot = LotManager::updQteLot($oLot);
                                   
                                    //Enfin on créé notre BonLigne
                                    $oBonLig = new BonLigne();
                                    $oBonLig->lig_id = $idLig;
                                    $oBonLig->bon_id = $oBon->bon_id;

                                    //Et on l'ajoute
                                    $resBl = BonLigneManager::addBonLigne($oBonLig);
                                    //echo "<br>Ajout bon ligne check : $resBl <br>";
                                    break;
                            }
                        }
                    }

                    $cnx->commit();

                    $msg = "<p class= info>" . date('H:i:s') .
                            " Les modifications sur le bon N° $oBon->bon_id" .
                            " ont bien étaient prises en compte";

                    $_SESSION['token'] = $_REQUEST['token'];
                } else {

                    $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
                }
                Tool::addMsg($msg);
            }
        }
    } catch (MySQLException $e) {
        switch ($resEr[0]) {

            case 'ERR0R':
                $msg = "<p class='erreur'> " . date('H:i:s')
                        . "Echec de la modification du bon. Code : $resEr[0] "
                        . "Message : $resEr[1]";
                break;


            default :
                $msg = '<p class="erreur"> ' . date('H:i:s') . 'Oups !une erreur innatendue est survenue ' .
                        $resEr[0] . " " . $e->getMessage() . '</p>';
                break;
        }
        $cnx->rollback();
        Tool::addMsg($msg);
    }
} else {
    echo "Les silence est d'or";
}