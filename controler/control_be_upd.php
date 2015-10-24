<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si une requéte échoue, une exception est levé par la manager
    try {
        //Contrôle si un inventaire est en cours
        $tInventaire = InventaireManager::getInventaireOpen();
        if (!isset($tInventaire) || !is_array($tInventaire)) {

//on récupére l'id du bon entré
            $beId = $_REQUEST['beId'];

            //inclut les managers et leurs objets
            require_once $path . '/model/BonEntree.php';
            require_once $path . '/model/BonEntreeManager.php';
            require_once $path . '/model/BeLigne.php';
            require_once $path . '/model/BeLigneManager.php';
            require_once $path . '/model/BonLigneManager.php';
            require_once $path . '/model/Ligne.php';
            require_once $path . '/model/LigneManager.php';
            require_once $path . '/model/Lot.php';
            require_once $path . '/model/LotManager.php';
            require_once $path . '/model/Reference.php';
            require_once $path . '/model/ReferenceManager.php';
            require_once $path . '/model/DroitDouane.php';
            require_once $path . '/model/DroitDouaneManager.php';

            //Si le formulaire est envoyé
            if ($sButtonUt == 'Modifier') {

                //Vérification du jeton pour savoir si le formulaire à déja était envoyé
                if ($_SESSION['token'] != $_REQUEST['token']) {

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
                    $tLotId = $_REQUEST['lotId'];

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
                        //les quantités sont identique pour un insert
                        'lot_qt_init' => $tLigQte,
                        'lot_qt_stock' => $tLigQte,
                        'ref_id' => $tRefId,
                        'lot_id' => $tLotId
                    ];

                    //On hydrate un objet bon d'entrée
                    $oBe = new BonEntree();
                    $oBe->be_id = $beId;
                    //Si un compte est choisi
                    if (isset($_REQUEST['cptId']) && $_REQUEST['cptId'] != '') {
                        $oBe->cpt_id = $_REQUEST['cptId'];
                    }
                    $oBe->be_lbl = $_REQUEST['beLbl'];
                    $oBe->be_date = $_REQUEST['beDate'];
                    $oBe->be_fact_num = $_REQUEST['beFactNum'];
                    $oBe->be_frais_douane = $_REQUEST['beFraisDouane'];
                    $oBe->be_frais_bancaire = $_REQUEST['beFraisBancaire'];
                    $oBe->be_frais_trans = $_REQUEST['beFraisTrans'];
                    $oBe->be_com = $_REQUEST['beCom'];
                    $oBe->be_info_trans = $_REQUEST['beInfoTrans'];
                    $oBe->be_total = $_REQUEST['beTotal'];
                    $oBe->be_mode_pai = $_REQUEST['beModePai'];
                    $oBe->be_com_pai = $_REQUEST['beComPai'];

                    //Modification du bon c'est la première modification à vendre
                    BonEntreeManager::updBonEntree($oBe);

                    //Boucle pour traiter les lignes
                    //On ignore la première ligne, c'est le squelette de construction 
                    //pour l'ajout de ligne dans le bon
                    //La limite étant le nombre de ligne remplie 
                    //on prend ref_id comme témoin
                    for ($i = 1; $i < (count($tLigneForm['ref_id'])); $i++) {

                        //on hydrate un objet lot
                        $oLot = new Lot();
                        $oLot->lot_id = $tLigneForm['lot_id'][$i];
                        $oLot->ref_id = $tLigneForm['ref_id'][$i];
                        $oLot->lot_id_producteur = $tLigneForm['lot_id_producteur'][$i];
                        $oLot->lot_dlc = $tLigneForm['lot_dlc'][$i];


                        //On hydrate un objet Ligne
                        $oLigne = new Ligne();
                        $oLigne->lig_id = $tLigneForm['lig_id'][$i];
                        $oLigne->lig_qte = $tLigneForm['lig_qte'][$i];
                        $oLigne->lig_com_dep = $tLigneForm['lig_com_dep'][$i];
                        $oLigne->lig_com = $tLigneForm['lig_com'][$i];

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


                            //Si la case suppLigne existe, c'est que la ligne est cochée
                            //pour être supprimmée, si le lot est utilisé 
                            //dans un autre enregsitrement de ligne
                            //une exception sera levé et fera un rollback
                            if (isset($tLigSupp[$i])) {
                                //on commence par supprimmer be_ligne
                                BeLigneManager::delBeLigne($beId, $oBeLigne->lig_id);

                                //On supprimme la ligne
                                LigneManager::delLigne($oLigne->lig_id);

                                //On supprimme le lot
                                LotManager::delLot($oLot->lot_id);

                                //sinon on fait un update
                            } else {

                                //Update de la ligne dans la table ligne
                                LigneManager::updLigne($oLigne);

                                //on update l'objet BeLigne dans la table be_ligne
                                BeLigneManager::updBeLigne($oBeLigne);

                                //l'update du lot dans la table lot se fait par 
                                //un triger dans la base pour les champs quantités
                                //On fait une update que pour les champs 
                                //autres que quantité

                                LotManager::updInfosLot($oLot);
                            }
                            //Sinon c'est que c'est un insert    
                        } else {

                            //Insert du lot dans la table lot avec toutes les infos
                            //récupérés                        
                            $oLot->lot_qt_stock = $tLigneForm['lot_qt_stock'][$i];
                            $oLot->lot_qt_init = $tLigneForm['lot_qt_init'][$i];
                            LotManager::addLot($oLot);

                            //On récupére l'id du lot inséré
                            $idLot = Connection::dernierId();

                            //On le met dans l'objet ligne
                            $oLigne->lot_id = $idLot;

                            //Insert de la ligne dans la table ligne
                            LigneManager::addLigne($oLigne);

                            //On récupére l'id de la ligne inséré
                            $idLigne = Connection::dernierId();

                            //On le met dans l'objet beLigne
                            $oBeLigne->lig_id = $idLigne;

                            //on insert l'objet BeLigne dans la table be_ligne
                            BeLigneManager::addBeLigne($oBeLigne);
                        }
                    }
                    //La requète s'est effectué donc on commit la transaction
                    $cnx->commit();
                    //Message pour le succés
                    $msg = '<p class=\'info\'>' . date('H:i:s')
                            . ' La modification du bon d\'entrée: "'
                            . $oBe->be_id
                            . '" intitulé "' . $oBe->be_lbl . '" à été effectué '
                            . 'avec succès </p>';

                    //La requète s'est effectué donc on copie le token dans la session
                    $_SESSION['token'] = $_REQUEST['token'];
                } else {
                    //Message en cas de formulaire déja envoyé
                    $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
                }
                //Rappel du controleur de la liste, après update on appel view_be_list
                //et redéfinition de $sAction

                $sAction = "be_list";
                require_once $path . '/controler/control_be_list.php';


                //On insert le message dans le tableau de message
                Tool::addMsg($msg);

                //Sinon on est dans l'affichage du détail
            } else {

                try {
                    $sButton = 'Modifier';

                    //On définit le titre
                    $sPageTitle = "Modifier le bon N°" . $beId;

                    //On récupére les détails du bon entré
                    $resBeDetail = BonEntreeManager::getBonEntreeDetailForUpd($beId);

                    //On récupére toutes les be_ligne du bon
                    $resAllBeLigneBE = BeLigneManager::getBesLignesDetailForUpd($beId);

                    //On vérifie que $resAllBeLigneBE soit bien un tableau (si aucune donnée,
                    // ce n'est pas un tableau
                    if (is_array($resAllBeLigneBE)) {

                        //Tableau pour les lignes
                        $resLignes = [];

                        //Tableau pour les lots
                        $resAllLots = [];

                        //tableau pour les lots
                        $resAllLotsBons = [];

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

                            //On recherche ses occurences associé à la table bon
                            $lotBon = BonLigneManager::getBonLignesFromLot($lotId);

                            //Si le tableau est définie, au moins une occurence est trouvé
                            if (is_array($lotBon)) {
                                //Dans ce cas on stock l'id du lot dans le tableau, 
                                //dans le formulaire si on trouve l'id du lot dans le tableau
                                //on désactive la checkbox de suppression
                                $resAllLotsBons[] = $lotId;
                            }

                            //On récupére les infos du lot
                            $lot = LotManager::getLotForUpd($lotId);
                            //On ajoute le lot retourné au tableau de lot
                            $resAllLots[] = $lot;

                            //On récupére l'id de la référence
                            $refId = $lot->ref_id;
                            //On récupére les infos de la référence
                            $ref = ReferenceManager::getReference($refId);
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
                } catch (MySQLException $e) {

                    $msg = $resEr[1];
                    Tool::addMsg($msg);
                }
            }
        }
    } catch (MySQLException $e) {

        //Message pour l'erreur

        $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                . ' Echec modification bon d\'entré, code: '
                . $resEr[0] . ' Message: ' . $resEr[1] . '</p>';


        $cnx->rollback();
    }
} else {
    echo 'Le silence est d\'or';
}                            