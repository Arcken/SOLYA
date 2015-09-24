<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$sPageTitle = "Détail de la référence";
$sButton = "Modifier";

require $path . '/model/ReferenceManager.php';



    
    $idRef = $_REQUEST['idRef'];
   
    $rsRef = ReferenceManager::getReferenceForUpd($idRef);
    
    require $path . '/model/ModeConservationManager.php';
    require $path . '/model/DureeConservationManager.php';
    require $path . '/model/FicheArticleManager.php';
    require $path . '/model/TvaManager.php';
    require $path . '/model/DroitDouaneManager.php';

    $toTvas = TvaManager::getAllTvas();
    $toDroitDouanes = DroitDouaneManager::getAllDroitDouanes();
    $toDurCons  = DureeConservationManager::getAllDureeConservations();
    $toModCons  = ModeConservationManager::getAllModeConservations();
    $toFiArts   = FicheArticleManager::getAllFichesArticles();


    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] === "Modifier") {

        if (isset($_REQUEST['refLbl']) && !empty($_REQUEST['refLbl'])) {
            require $path . '/model/Reference.php';
            
            

            try {

                $oRef = new Reference();

                $oRef->ref_id           = $_REQUEST['idRef'];
                $oRef->dc_id            = $_REQUEST['dureeConservation'];
                $oRef->cons_id          = $_REQUEST['modeConservation'];
                $oRef->fiart_id         = $_REQUEST['ficheArticle'];
                $oRef->dd_id            = $_REQUEST['droitDouane'];
                $oRef->tva_id           = $_REQUEST['tva'];
                $oRef->ref_lbl          = $_REQUEST['refLbl'];
                $oRef->ref_st_min       = $_REQUEST['refStMin'];
                $oRef->ref_poids_brut   = $_REQUEST['refPoidsBrut'];
                $oRef->ref_poids_net    = $_REQUEST['refPoidsNet'];
                $oRef->ref_emb_lbl      = $_REQUEST['refEmbLbl'];
                $oRef->ref_emb_couleur  = $_REQUEST['refEmbCouleur'];
                $oRef->ref_emb_vlm_ctn  = $_REQUEST['refEmbVlmCtn'];
                $oRef->ref_emb_dim_lng  = $_REQUEST['refEmbDimLng'];
                $oRef->ref_emb_dim_lrg  = $_REQUEST['refEmbDimLrg'];
                $oRef->ref_emb_dim_ht   = $_REQUEST['refEmbDimHt'];
                $oRef->ref_emb_dim_diam = $_REQUEST['refEmbDimDiam'];
                $oRef->ref_com          = $_REQUEST['refCom'];
                $oRef->ref_code         = strtoupper($_REQUEST['refCode']);
               // Tool::printAnyCase($oRef);

                $resAddRef = ReferenceManager::updReference($oRef);
                Tool::printAnyCase($resAddRef);
                echo '<br> id Ref:' . $oRef->ref_id;

                //$cnx->commit();
                //echo $resAddCtc;
            } catch (MySQLException $e) {
                
                $e->RetourneErreur();
                $cnx->rollback();
            }
        }
    }
   