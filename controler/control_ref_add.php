<?php

/**
 * Sous controleur ajout référence
 * 
 */
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        require $path . '/model/ModeConservationManager.php';
        require $path . '/model/DureeConservationManager.php';
        require $path . '/model/TvaManager.php';
        require $path . '/model/DroitDouaneManager.php';
        require $path . '/model/FicheArticleManager.php';

        $toFiArts = FicheArticleManager::getAllFichesArticles();
        $toModCons = ModeConservationManager::getAllModesConservations();
        $toDurCons = DureeConservationManager::getAllDureesConservations();
        $toTvas = TvaManager::getAllTvas();
        $toDroitDouanes = DroitDouaneManager::getAllDroitsDouanes();

        if (isset($sButtonUt) && $sButtonUt == "Envoyer") {
            if ($_SESSION['token'] != $_REQUEST['token']) {

                require $path . '/model/Reference.php';
                require $path . '/model/ReferenceManager.php';



                $cnx = Connection::getConnection();

                $cnx->beginTransaction();

                $oRef = new Reference();


                $oRef->dc_id = $_REQUEST['dureeConservation'];
                $oRef->cons_id = $_REQUEST['modeConservation'];
                $oRef->fiart_id = $_REQUEST['ficheArticle'];
                $oRef->dd_id = $_REQUEST['droitDouane'];
                $oRef->tva_id = $_REQUEST['tva'];
                $oRef->ref_lbl = $_REQUEST['refLbl'];
                $oRef->ref_st_min = $_REQUEST['refStMin'];
                $oRef->ref_poids_brut = $_REQUEST['refPoidsBrut'];
                $oRef->ref_poids_net = $_REQUEST['refPoidsNet'];
                $oRef->ref_emb_lbl = $_REQUEST['refEmbLbl'];
                $oRef->ref_emb_couleur = $_REQUEST['refEmbCouleur'];
                $oRef->ref_emb_vlm_ctn = $_REQUEST['refEmbVlmCtn'];
                $oRef->ref_emb_dim_lng = $_REQUEST['refEmbDimLng'];
                $oRef->ref_emb_dim_lrg = $_REQUEST['refEmbDimLrg'];
                $oRef->ref_emb_dim_ht = $_REQUEST['refEmbDimHt'];
                $oRef->ref_emb_dim_diam = $_REQUEST['refEmbDimDiam'];
                $oRef->ref_com = $_REQUEST['refCom'];
                $oRef->ref_code = strtoupper($_REQUEST['refCode']);
                $oRef->ref_mrq = $_REQUEST['refMrq'];
                $oRef->ref_code_douane = $_REQUEST['refCodeDouane'];

                $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension, $imgMaxSize);
                if (count($resPhoto) > 0 && $resPhoto[0] != '') {
                    $oRef->ref_photos = implode(',', $resPhoto);
                    $oRef->ref_photos_pref = $resPhoto[0];
                }

                //Tool::printAnyCase($oRef);

                $resAddRef = ReferenceManager::addReference($oRef);
                $idRef = Connection::dernierId();

                if (isset($_REQUEST['pvePer']) && !empty($_REQUEST['pvePer']) ||
                        isset($_REQUEST['pveEnt']) && !empty($_REQUEST['pveEnt'])) {

                    require $path . '/model/PrixVente.php';
                    require $path . '/model/PrixVenteManager.php';

                    $oPve = new PrixVente();
                    $oPve->ref_id = $idRef;
                    $oPve->pve_ent = $_REQUEST['pveEnt'];
                    $oPve->pve_per = $_REQUEST['pvePer'];

                    $resPv = PrixVenteManager::addPrixVente($oPve);
                }



                $cnx->commit();
                $msg = "<p class='info'>" . date('H:i:s') . " La référence " . $oRef->ref_lbl . " a été enregistré"
                        . " avec succès</p>";


                $_SESSION['token'] = $_REQUEST['token'];
                $sAction = 'ref_list';
                require $path . '/controler/control_ref_list.php';
            } else {
                $msg = "<p class= 'erreur'> " . date('H:i:s') .
                        " Vous avez déja envoyé ce formulaire </p>";
            }
        }
    } catch (MySQLException $e) {
        $cnx->rollback();
        $msg = "<p class='erreur'> " . date('H:i:s')
                . " Echec de l'ajout de la référence. Code :"
                . $resEr[0] . " Message : $resEr[1]"
                . "</p>";
    }
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo "Le silence est d'or";
}