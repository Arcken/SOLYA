<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si une requéte échoue, une exception est levé par la manager
    try {

        require_once $path . '/model/InventaireManager.php';
        
        $tInventaire = InventaireManager::getInventaireOpen();
        
        //Contrôle si un inventaire est en cours
        if (!isset($tInventaire) || !is_array($tInventaire)) {

            require_once $path . '/model/BonEntree.php';
            require_once $path . '/model/BonEntreeManager.php';
            require_once $path . '/model/BeLigne.php';
            require_once $path . '/model/BeLigneManager.php';
            require_once $path . '/model/Ligne.php';
            require_once $path . '/model/LigneManager.php';
            require_once $path . '/model/Lot.php';
            require_once $path . '/model/LotManager.php';

            //Controle si le formulaire a était envoyé 
            if ($sButtonUt == "Envoyer") {

                //Vérification du jeton pour savoir si le formulaire à déja était envoyé
                if ($_SESSION['token'] != $_REQUEST['token']) {
                    
                    //Récupération de la connection
                    $cnx = Connection::getConnection();

                    //Démarrage de la transaction
                    $cnx->beginTransaction();

                    //Création du bon d'entrée
                    $oBe = new BonEntree();
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

                    //Insert du bon
                    BonEntreeManager::addBonEntree($oBe);

                    //On récupére l'id du bon d'entrée inséré
                    $idBe = Connection::dernierId();

                    //-----------------Gestion des lignes du formulaire-------------------------
                    //Création des tableaux contenant toutes les informations
                    //Un tableau par type de champs
                    //Tableaux pour la table be_ligne
                    $tBeligPu = $_REQUEST['beligPu'];
                    $tBeligCuAchat = $_REQUEST['beligCuAchat'];
                    $tBeligFb = $_REQUEST['beligFb'];
                    $tBeligFt = $_REQUEST['beligFt'];
                    $tBeligDd = $_REQUEST['beligDd'];
                    $tBeligTaxe = $_REQUEST['beligTaxe'];

                    //Tableaux pour la table ligne
                    $tLigQte = $_REQUEST['ligQte'];
                    $tLigComDep = $_REQUEST['ligComDep'];
                    $tLigCom = $_REQUEST['ligCom'];

                    //Tableaux pour la table lot
                    $tLotIdProducteur = $_REQUEST['lotIdProducteur'];
                    $tLotDlc = $_REQUEST['lotDlc'];

                    //Tableau pour la référence
                    $tRefId = $_REQUEST['refId'];

                    //On rassemble les tableaux dans un seul
                    $tLigneForm = [
                        'belig_pu' => $tBeligPu,
                        'belig_cu_achat' => $tBeligCuAchat,
                        'belig_fb' => $tBeligFb,
                        'belig_ft' => $tBeligFt,
                        'belig_dd' => $tBeligDd,
                        'belig_taxe' => $tBeligTaxe,
                        'lig_qte' => $tLigQte,
                        'lig_com_dep' => $tLigComDep,
                        'lig_com' => $tLigCom,
                        'lot_id_producteur' => $tLotIdProducteur,
                        'lot_dlc' => $tLotDlc,
                        'lot_qt_init' => $tLigQte,
                        'lot_qt_stock' => $tLigQte,
                        'ref_id' => $tRefId
                    ];


                    //Boucle pour insérer les lignes
                    //On ignore la première ligne, c'est le squelette de construction 
                    //pour l'ajout de ligne dans le bon
                    //La limite étant le nombre de ligne remplie on prend ref_id comme témoin
                    for ($i = 1; $i < (count($tLigneForm['ref_id'])); $i++) {

                        //on hydrate un objet lot
                        $oLot = new Lot();
                        $oLot->ref_id = $tLigneForm['ref_id'][$i];
                        $oLot->lot_id_producteur = $tLigneForm['lot_id_producteur'][$i];
                        $oLot->lot_dlc = $tLigneForm['lot_dlc'][$i];
                        $oLot->lot_qt_stock = $tLigneForm['lot_qt_stock'][$i];
                        $oLot->lot_qt_init = $tLigneForm['lot_qt_init'][$i];

                        //Insert du lot dans la table lot
                        LotManager::addLot($oLot);

                        //On récupére l'id du lot inséré
                        $idLot = Connection::dernierId();

                        //On hydrate un objet Ligne
                        $oLigne = new Ligne();
                        $oLigne->lot_id = $idLot;
                        $oLigne->lig_qte = $tLigneForm['lig_qte'][$i];
                        $oLigne->lig_com_dep = $tLigneForm['lig_com_dep'][$i];
                        $oLigne->lig_com = $tLigneForm['lig_com'][$i];

                        //Insert de la ligne dans la table ligne
                        LigneManager::addLigne($oLigne);

                        //On récupére l'id de la ligne inséré
                        $idLigne = Connection::dernierId();

                        //On hydrate un objet beligne
                        $oBeLigne = new BeLigne();

                        //On hydrate l'objet BeLigne
                        $oBeLigne->lig_id = $idLigne;
                        $oBeLigne->be_id = $idBe;
                        $oBeLigne->belig_pu = $tLigneForm['belig_pu'][$i];
                        $oBeLigne->belig_cu_achat = $tLigneForm['belig_cu_achat'][$i];
                        $oBeLigne->belig_fb = $tLigneForm['belig_fb'][$i];
                        $oBeLigne->belig_ft = $tLigneForm['belig_ft'][$i];
                        $oBeLigne->belig_dd = $tLigneForm['belig_dd'][$i];
                        $oBeLigne->belig_taxe = $tLigneForm['belig_taxe'][$i];

                        //on insert l'objet BeLigne dans la table be_ligne
                        BeLigneManager::addBeLigne($oBeLigne);
                    }

                    //Message pour le succés
                    $msg = '<p class=\'info\'>' . date('H:i:s')
                            . ' L\'enregistrement du bon d\entrée: "'
                            . $idBe
                            . '" intitulé "' . $oBe->be_lbl . '" à été effectué '
                            . 'avec succès </p>';

                    //La requète s'est effectué donc on copie le token dans la session
                    $_SESSION['token'] = $_REQUEST['token'];

                    //on valide le formulaire
                    $cnx->commit();
                } else {
                    //Message en cas de formulaire déja envoyé
                    $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
                }
            }
        }
    } catch (MySQLException $e) {

        //on annule la transaction
        $cnx->rollback();

        //Message pour l'erreur

        switch ($resEr[0]) {

            case 'ERR0R':
                $msg = "<p class='erreur'> " . date('H:i:s')
                        . ' Echec ajout bon entrée, code: '
                        . $resEr[0] . ' Message: ' . $resEr[1] . '</p>';
                break;

            default:
                $msg = '<p class=\'erreur\'> ' . date('H:i:s')
                        . 'code: ' . $resEr[0]
                        . ' message: ' . $resEr[1] . '</p>';
                break;
        }
    }

    //On insert le message dans le tableau de message
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}