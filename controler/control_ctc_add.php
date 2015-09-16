<?php

$iTypeCtc = $_REQUEST['typeCtc'];
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {


    switch ($iTypeCtc) {

        case 1:
            break;

        case 2 :

            if (isset($_REQUEST['PRS_NOM']) && !empty($_REQUEST['PRS_NOM'])) {
                require $path . '/model/Personne.php';
                require $path . '/model/PersonneManager.php';

                try {

                    $cnx = Connection::getConnection();
                    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $cnx->beginTransaction();

                    $oPers = new Personne();
                    $oPers->PRS_NOM = $_REQUEST['PRS_NOM'];
                    $oPers->PRS_PRENOM1 = $_REQUEST['PRS_PRENOM1'];
                    $oPers->PRS_PRENOM2 = $_REQUEST['PRS_PRENOM2'];
                    $oPers->PRS_PRENOM3 = $_REQUEST['PRS_PRENOM3'];
                    $oPers->PRS_DTN = $_REQUEST['PRS_DTN'];

                    $resAddCtc = PersonneManager::addPersonne($oPers);
                    $idPers = Connection::dernierId();


                    if (isset($_REQUEST['ADR_VILLE'])) {

                        require $path . '/model/Adresse.php';
                        require $path . '/model/AdresseManager.php';

                        $oAddr = new Adresse();
                        $oAddr->PAYS_ID = 1;
                        $oAddr->ADR_NUM = $_REQUEST['ADR_NUM'];
                        $oAddr->ADR_VOIE = $_REQUEST['ADR_VOIE'];
                        $oAddr->ADR_RUE1 = $_REQUEST['ADR_RUE1'];
                        $oAddr->ADR_RUE2 = $_REQUEST['ADR_RUE2'];
                        $oAddr->ADR_RUE3 = $_REQUEST['ADR_RUE3'];
                        $oAddr->ADR_CP = $_REQUEST['ADR_CP'];
                        $oAddr->ADR_VILLE = $_REQUEST['ADR_VILLE'];
                        $oAddr->ADR_ETAT = $_REQUEST['ADR_ETAT'];

                        $resAddCtc += '' . AdresseManager::addAddresse($oAddr);
                        $idAdr = Connection::dernierId();

                        if (isset($idAdr) && isset($idPers)) {
                            require $path . '/model/DomicilierPrs.php';
                            require $path . '/model/DomicilierPrsManager.php';

                            $oDomPrs = new DomicilierPrs();
                            $oDomPrs->ADRPER_LBL = "truc";
                            $oDomPrs->ADR_ID = $idAdr;
                            $oDomPrs->PRS_ID = $idPers;

                            $resAddCtc += ' ' . DomicilierPrsManager::addDomicilierPrs($oDomPrs);
                        }
                    }

                    if (isset($_REQUEST['MAIL_ADR'])) {
                        require $path . '/model/Mail.php';
                        require $path . '/model/MailManager.php';

                        $oMail = new Mail();
                        $oMail->MAIL_ADR = $_REQUEST['MAIL_ADR'];

                        $resAddCtc += ' ' . MailManager::addMail($oMail);
                        $idMail = Connection::dernierId();

                        if (isset($idMail) && isset($idPers)) {
                            require $path . '/model/ContacterPrs.php';
                            require $path . '/model/ContacterPrsManager.php';

                            $oCtcPrs = new ContacterPrs();
                            $oCtcPrs->MAILPER_LBL = "truc";
                            $oCtcPrs->MAIL_ID = $idMail;
                            $oCtcPrs->PRS_ID = $idPers;

                            $resAddCtc += ' ' . ContacterPrsManager::addContacterPrs($oCtcPrs);
                        }
                    }

                    if (isset($_REQUEST['TEL_NUM']) && isset($_REQUEST['TEL_IND'])) {

                        require $path . '/model/Telephone.php';
                        require $path . '/model/TelephoneManager.php';

                        $oTel = new Telephone();
                        $oTel->TEL_IND = $_REQUEST['TEL_IND'];
                        $oTel->TEL_NUM = $_REQUEST['TEL_NUM'];

                        $resAddCtc += ' ' . TelephoneManager::addTel($oTel);
                        $idTel = Connection::dernierId();

                        if (isset($idTel)) {

                            require $path . '/model/JoindrePrs.php';
                            require $path . '/model/JoindrePrsManager.php';

                            $oJoindrePrs = new JoindrePrs();
                            $oJoindrePrs->PRS_ID = $idPers;
                            $oJoindrePrs->TEL_ID = $idTel;
                            $oJoindrePrs->TELPER_LBL = "truc";

                            $resAddCtc += ' ' . JoindrePrsManager::addJoindrePrs($oJoindrePrs);
                        }
                    }

                    $cnx->commit();
                    echo $resAddCtc;
                } catch (MySQLException $e) {
                    $e->RetourneErreur();
                    $cnx->rollback();
                }
            }
            break;
    }
}


