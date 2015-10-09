<?php

//on récupére l'id du bon entré
if (isset($_REQUEST['beId']) && $_REQUEST['beId'] != '') {
    $beId = $_REQUEST['beId'];

    //inclut les managers et leurs objets
    require_once $path . '/model/BonEntree.php';
    require_once $path . '/model/BonEntreeManager.php';
    require_once $path . '/model/BeLigne.php';
    require_once $path . '/model/BeLigneManager.php';
    require_once $path . '/model/Ligne.php';
    require_once $path . '/model/LigneManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/Reference.php';
    require_once $path . '/model/ReferenceManager.php';
    require_once $path . '/model/DroitDouane.php';
    require_once $path . '/model/DroitDouaneManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        try {
            //Instanciation de la connection
            $cnx = Connection::getConnection();

            //Démarrage de la transaction
            $cnx->beginTransaction();

            //-----------------Gestion des lignes du formulaire-----------------
            //Création des tableaux contenant toutes les informations
            //Un tableau par type de champs
            
            //tableau pour la suppression de ligne
            if (isset($_REQUEST['ligSupp']))
                $tLigSupp = $_REQUEST['ligSupp'];

            //Tableaux pour la table be_ligne
            $tBeligPu = $_REQUEST['beligPu'];
            $tBeligCuAchat = $_REQUEST['beligCuAchat'];
            $tBeligFb = $_REQUEST['beligFb'];
            $tBeligFt = $_REQUEST['beligFt'];
            $tBeligDd = $_REQUEST['beligDd'];
            $tBeligTaxe = $_REQUEST['beligTaxe'];

            //Tableaux pour la table ligne
            $tLigId = $_REQUEST['ligId'];
            $tLigQte = $_REQUEST['ligQte'];
            $tLigComDep = $_REQUEST['ligComDep'];
            $tLigCom = $_REQUEST['ligCom'];

            //Tableaux pour la table lot
            $tLotIdProducteur = $_REQUEST['lotIdProducteur'];
            $tLotDlc = $_REQUEST['lotDlc'];

            //Tableau pour la référence
            $tRefId = $_REQUEST['refId'];

            //Tableau de ligne de formulaire
            $tLigneForm = [
                'belig_pu' => $tBeligPu,
                'belig_cu_achat' => $tBeligCuAchat,
                'belig_fb' => $tBeligFb,
                'belig_ft' => $tBeligFt,
                'belig_dd' => $tBeligDd,
                'belig_taxe' => $tBeligTaxe,
                'lig_id' => $tLigId,
                'lig_qte' => $tLigQte,
                'lig_com_dep' => $tLigComDep,
                'lig_com' => $tLigCom,
                'lot_id_producteur' => $tLotIdProducteur,
                'lot_dlc' => $tLotDlc,
                //les quantités sont identique pour un insert, 
                //pour une modification on ajustera
                'lot_qt_init' => $tLigQte,
                'lot_qt_stock' => $tLigQte,
                'ref_id' => $tRefId
            ];

            //Boucle pour traiter les lignes
            //On ignore la première ligne, c'est le squelette de construction 
            //pour l'ajout de ligne dans le bon
            //
            //La limite étant le nombre de ligne remplie 
            //on prend ref_id comme témoin
            for ($i = 1; $i < (count($tLigneForm['ref_id'])); $i++) {

                //On hydrate un objet bon d'entrée
                $oBe = new BonEntree();
                $oBe->be_id = $beId;
                $oBe->be_lbl = $_REQUEST['beLbl'];
                $oBe->be_date = $_REQUEST['beDate'];
                $oBe->be_fact_num = $_REQUEST['beFactNum'];
                $oBe->be_frais_douane = $_REQUEST['beFraisDouane'];
                $oBe->be_frais_bancaire = $_REQUEST['beFraisBancaire'];
                $oBe->be_frais_trans = $_REQUEST['beFraisTrans'];
                $oBe->be_com = $_REQUEST['beCom'];
                $oBe->be_info_trans = $_REQUEST['beInfoTrans'];
                $oBe->be_total = $_REQUEST['beTotal'];

                //On hydrate un objet Ligne
                $oLigne = new Ligne();
                $oLigne->lig_id = $tLigneForm['lig_id'][$i];
                $oLigne->lig_qte = $tLigneForm['lig_qte'][$i];
                $oLigne->lig_com_dep = $tLigneForm['lig_com_dep'][$i];
                $oLigne->lig_com = $tLigneForm['lig_com'][$i];

                //on hydrate un objet lot
                $oLot = new Lot();
                $oLot->ref_id = $tLigneForm['ref_id'][$i];
                $oLot->lot_id_producteur = $tLigneForm['lot_id_producteur'][$i];
                $oLot->lot_dlc = $tLigneForm['lot_dlc'][$i];
                $oLot->lot_qt_stock = $tLigneForm['lot_qt_stock'][$i];
                $oLot->lot_qt_init = $tLigneForm['lot_qt_init'][$i];

                //On hydrate l'objet BeLigne
                $oBeLigne = new BeLigne();
                $oBeLigne->lig_id = $oLigne->lig_id;
                $oBeLigne->be_id = $beId;
                $oBeLigne->belig_pu = $tLigneForm['belig_pu'][$i];
                $oBeLigne->belig_cu_achat = $tLigneForm['belig_cu_achat'][$i];
                $oBeLigne->belig_fb = $tLigneForm['belig_fb'][$i];
                $oBeLigne->belig_ft = $tLigneForm['belig_ft'][$i];
                $oBeLigne->belig_dd = $tLigneForm['belig_dd'][$i];
                $oBeLigne->belig_taxe = $tLigneForm['belig_taxe'][$i];

                //Si la case lig-id est != '' c'est un update
                if ($tLigneForm['lig_id'][$i] != '') {
                    
                    echo 'Update: '.$i.' ';
                    
                    //Modification du bon
                    $updBe = BonEntreeManager::updBonEntree($oBe);
                    //Si la case suppLigne existe, c'est que la ligne est cochée
                    //pour être supprimmée
                    if (isset($tLigSupp[$i])) {
                        echo ' Supp <br>';
                        //on commence par supprimmer be_ligne
                        $delBeLigne = BeLigneManager::delBeLigne($beId, $oBeLigne->lig_id);

                        //on récupére le lot_id de la ligne
                        $resLigne = LigneManager::getLigneDetail($oBeLigne->lig_id);
                        $oLot->lot_id = $resLigne->lot_id;

                        //On supprimme la ligne
                        $delLigne = LigneManager::delLigne($oLigne->lig_id);

                        //On supprimme le lot
                        $delLot = LotManager::delLot($oLot->lot_id);

                        //sinon on fait un update
                    } else {
                        echo 'MAJ<br>';
                        
                        //Update de la ligne dans la table ligne
                        $updLigne = LigneManager::updLigne($oLigne);
                        
                        //L'id du lot est récupéré dans la table ligne
                        //on créé un objet de la ligne qui va être maj
                        $oOldLigne = LigneManager::getLigneDetail($oLigne->lig_id);
                        
                        //on créé un objet du lot qui va être maj
                        $oOldLot = LotManager::getLot($oOldLigne->lot_id);
                        //On compare le stock_init de l'ancien lot et du nouveau
                        $diffQtLot = $oOldLot->lot_qt_init - $oLot->lot_qt_init;

                        //Si ils sont différents on réajuste
                        if ($diffQtLot != 0) {
                            $oLot->lot_qt_stock = $oLot->lot_qt_stock - $diffQtLot;
                        }

                        //Insert du lot dans la table lot
                        $updLot = LotManager::updLot($oLot);

                        //on insert l'objet BeLigne dans la table be_ligne
                        $updBeLigne = BeLigneManager::updBeLigne($oBeLigne);
                    }
                    //Sinon c'est que c'est un insert    
                } else {
                    echo 'Insert';
                    //Insert du lot dans la table lot
                    $resLot = LotManager::addLot($oLot);

                    //On récupére l'id du lot inséré
                    $idLot = Connection::dernierId();

                    //On le met dans l'objet ligne
                    $oLigne->lot_id = $idLot;

                    //Insert de la ligne dans la table ligne
                    $resLigne = LigneManager::addLigne($oLigne);

                    //On récupére l'id de la ligne inséré
                    $idLigne = Connection::dernierId();

                    //On le met dans l'objet beLigne
                    $oBeLigne->lig_id = $idLigne;

                    //on insert l'objet BeLigne dans la table be_ligne
                    $resBeLigne = BeLigneManager::addBeLigne($oBeLigne);
                }
            }
            $cnx->commit();
        } catch (MySQLException $e) {
            $cnx->rollback();
            throw $e;
        }
    } else {
        $sPageTitle = "Modifier le bon N°" . $beId;

        //On récupére les détails du bon entré
        $resBeDetail = BonEntreeManager::getBonEntreeDetailForUpd($beId);

        //On récupére toutes les be_ligne du bon
        $resAllBeLigneBE = BeLigneManager::getBesLignesDetailForUpd($beId);

        //On vérifie que $resAllBeLigneBE soit bien un tableau (si aucune donnée ce n'est pas un tableau
        if (is_array($resAllBeLigneBE)) {
            //Tableau pour les lignes
            $resLignes = [];
            //Tableau pour les lots
            $resAllLots = [];
            //Tableau pour les reférénces
            $resAllRefs = [];
            //Tableaux pour les droits de douanes
            $resAllDds = [];

            //Pour chaque be_ligne
            foreach ($resAllBeLigneBE as $beLigne) {

                //On récupére l'id de ligne
                $ligId = $beLigne->lig_id;
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
                //On récupére l'id du droit de douane
                $ddId = $ref->dd_id;
                //On récupére les infos du droit de douane
                $dd = DroitDouaneManager::getDroitDouaneById($ddId);
                //On ajoute le droit de douane retournée au tableau de droit douane
                $resAllDds[] = $dd;
            }
        }
        $sButton = 'Modifier';
    }
} else {
    $sPageTitle = 'Erreur de chargement';
}                            