<?php

/**
 * Sous controleur ajout référence
 * 
 */
require $path . '/model/ModeConservationManager.php';
require $path . '/model/DureeConservationManager.php';
require $path . '/model/TvaManager.php';
require $path . '/model/DroitDouaneManager.php';
require $path . '/model/FicheArticleManager.php';


$sPageTitle = "Ajouter une référence";
$sButton="Envoyer";

Tool::printAnyCase($sAction);

$toFiArts = FicheArticleManager::getAllFichesArticles();
$toModCons = ModeConservationManager::getAllModeConservations();
$toDurCons = DureeConservationManager::getAllDureeConservations();
$toTvas =  TvaManager::getAllTvas();
$toDroitDouanes = DroitDouaneManager::getAllDroitDouanes();

/*Tool::printAnyCase($toFiArts);
Tool::printAnyCase($toModCons);
Tool::printAnyCase($toDurCons);
Tool::printAnyCase($toTvas);
Tool::printAnyCase($toDroitDouanes);*/


if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

            if (isset($_REQUEST['refLbl']) && !empty($_REQUEST['refLbl'])) {
                require $path . '/model/Reference.php';
                require $path . '/model/ReferenceManager.php';

                try {

                    $cnx = Connection::getConnection();

                    $cnx->beginTransaction();

                    $oRef = new Reference();
                    
                    //if (isset($_REQUEST['dureeConservation']))
                    $oRef->ref_id='g';
                    $oRef->dc_id            = $_REQUEST['dureeConservation'];
                    //if (isset())
                    $oRef->fiart_id         = $_REQUEST['ficheArticle'];
                    //if (isset())
                    $oRef->dd_id            = $_REQUEST['droitDouane'];
                    //if (isset())
                    $oRef->tva_id           = $_REQUEST['tva'];
                    //if (isset())
                    $oRef->ref_lbl          = $_REQUEST['refLbl'];
                    //if (isset())
                    $oRef->ref_st_min       = $_REQUEST['refStMin'];
                    //if (isset())
                    $oRef->ref_poids_brut    = $_REQUEST['refPoidsBrut'];
                    //if (isset())
                    $oRef->ref_poids_net     = $_REQUEST['refPoidsNet'];
                    //if (isset())
                    $oRef->ref_emb_lbl      = $_REQUEST['refEmbLbl'];
                    //if (isset($_REQUEST['refEmbCouleur']))
                    $oRef->ref_emb_couleur  = $_REQUEST['refEmbCouleur'];
                    //if (isset($_REQUEST['refEmbVlmCtn']))
                    $oRef->ref_emb_vlm_ctn  = $_REQUEST['refEmbVlmCtn'];
                    //if (isset($_REQUEST['refEmbDimLng']))
                    $oRef->ref_emb_dim_lng  = $_REQUEST['refEmbDimLng'];
                    //if (isset($_REQUEST['refEmbDimLrg']))
                    $oRef->ref_emb_dim_lrg  = $_REQUEST['refEmbDimLrg'];
                    //if (isset($_REQUEST['refEmbDimHt']))
                    $oRef->ref_emb_dim_ht   = $_REQUEST['refEmbDimHt'];
                    //if (isset($_REQUEST['refEmbDimDiam']))
                    $oRef->ref_emb_dim_diam = $_REQUEST['refEmbDimDiam'];
                    
                    Tool::printAnyCase($oRef);
      
                    $resAddRef = ReferenceManager::insReference($oRef);
                    $idRef = Connection::dernierId();
                    Tool::printAnyCase($resAddRef);
                    echo '<br> id personne:'.$idRef;
                    /*
                    if (isset($_REQUEST['ADR_VILLE'])) {

                        require $path . '/model/Adresse.php';
                        require $path . '/model/AdresseManager.php';

                        $oAddr = new Adresse();
                        $oAddr->PAYS_ID = $_REQUEST['PAYS_ID'];
                        $oAddr->ADR_NUM = $_REQUEST['ADR_NUM'];
                        $oAddr->ADR_VOIE = $_REQUEST['ADR_VOIE'];
                        $oAddr->ADR_RUE1 = $_REQUEST['ADR_RUE1'];
                        $oAddr->ADR_RUE2 = $_REQUEST['ADR_RUE2'];
                        $oAddr->ADR_RUE3 = $_REQUEST['ADR_RUE3'];
                        $oAddr->ADR_CP = $_REQUEST['ADR_CP'];
                        $oAddr->ADR_VILLE = $_REQUEST['ADR_VILLE'];
                        $oAddr->ADR_ETAT = $_REQUEST['ADR_ETAT'];

                        $resAddCtc = AdresseManager::addAddresse($oAddr);
                        $idAdr = Connection::dernierId();

                        //echo '<br>id adress:'.$idAdr.' resultat :'.$resAddCtc;

                        if (isset($idAdr) && isset($idPers)) {
                            require $path . '/model/DomicilierPrs.php';
                            require $path . '/model/DomicilierPrsManager.php';

                            $oDomPrs = new DomicilierPrs();
                            $oDomPrs->ADRPER_LBL = "truc";
                            $oDomPrs->ADR_ID = $idAdr;
                            $oDomPrs->PRS_ID = $idPers;

                            $resAddCtc = DomicilierPrsManager::addDomicilierPrs($oDomPrs);
                            // echo'<br> reultat Joindre personne : '.$resAddCtc;
                        }
                    }

                    if (isset($_REQUEST['MAIL_ADR'])) {
                        require $path . '/model/Mail.php';
                        require $path . '/model/MailManager.php';

                        $oMail = new Mail();
                        $oMail->MAIL_ADR = $_REQUEST['MAIL_ADR'];

                        $resAddCtc = MailManager::addMail($oMail);
                        $idMail = Connection::dernierId();
                        //echo '<br> id Mail :'.$idMail.' resultat :'.$resAddCtc;

                        if (isset($idMail) && isset($idPers)) {
                            require $path . '/model/ContacterPrs.php';
                            require $path . '/model/ContacterPrsManager.php';

                            $oCtcPrs = new ContacterPrs();
                            $oCtcPrs->MAILPER_LBL = "truc";
                            $oCtcPrs->MAIL_ID = $idMail;
                            $oCtcPrs->PRS_ID = $idPers;

                            $resAddCtc = ContacterPrsManager::addContacterPrs($oCtcPrs);
                            //echo'<br> reultat Joindre personne : '.$resAddCtc;
                        }
                    }

                    if (isset($_REQUEST['TEL_NUM']) && isset($_REQUEST['TEL_IND'])) {

                        require $path . '/model/Telephone.php';
                        require $path . '/model/TelephoneManager.php';

                        $oTel = new Telephone();
                        $oTel->TEL_IND = $_REQUEST['TEL_IND'];
                        $oTel->TEL_NUM = $_REQUEST['TEL_NUM'];

                        $resAddCtc = TelephoneManager::addTel($oTel);
                        $idTel = Connection::dernierId();
                        //echo '<br>id telephone :'.$idTel.' resultat :'.$resAddCtc ;

                        if (isset($idTel)) {

                            require $path . '/model/JoindrePrs.php';
                            require $path . '/model/JoindrePrsManager.php';

                            $oJoindrePrs = new JoindrePrs();
                            $oJoindrePrs->PRS_ID = $idPers;
                            $oJoindrePrs->TEL_ID = $idTel;
                            $oJoindrePrs->TELPER_LBL = "truc";

                            $resAddCtc = JoindrePrsManager::addJoindrePrs($oJoindrePrs);
                            // echo'<br> reultat Joindre personne : '.$resAddCtc;
                        }*/
                    
                    $cnx->commit();
                    //echo $resAddCtc;
                } catch (MySQLException $e) {
                    $e->RetourneErreur();
                    $cnx->rollback();
                }
    }
}