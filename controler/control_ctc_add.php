<?php

try {
    
    require $path . '/model/Civilite.php';
    require $path . '/model/CiviliteManager.php';
    require $path . '/model/Pays.php';
    require $path . '/model/PaysManager.php';
    
    //On récupère toutes les civilités
    $toCiv = CiviliteManager::getAllCivilites();
    //On récupère tout les pays
    $toPays = PaysManager::getAllPays();
    //Si typeCtc est définis on prend sa valeur 
    if (isset($_REQUEST['typeCtc'])) {
        $iTypeCtc = $_REQUEST['typeCtc'];
    //Sinon on initialise typeCtc à 0
    } else {
        $iTypeCtc = 0;
    }
    //Si le formumaire à était envoyé 
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Selon le type de contact le traitement est différent donc switch
        switch ($iTypeCtc) {
            //Cas ou le contact est une entreprise
            case 1:
                
                require $path . '/model/Entreprise.php';
                require $path . '/model/EntrepriseManager.php';
                
                
                //On récupère la connexion
                $cnx = Connection::getConnection();
                //On démarre la transactio
                $cnx->beginTransaction();
                //On créé un objet personne
                $oPers = new Entreprise();
                //On l'hydrate avec les données du formulaire
                $oPers->civ_id = $_REQUEST['CIV_CODE'];
                $oPers->prs_nom = $_REQUEST['PRS_NOM'];
                $oPers->prs_prenom1 = $_REQUEST['PRS_PRENOM1'];
                $oPers->prs_prenom2 = $_REQUEST['PRS_PRENOM2'];
                $oPers->prs_prenom3 = $_REQUEST['PRS_PRENOM3'];
                $oPers->prs_dtn = $_REQUEST['PRS_DTN'];
                //Et on appel le manager pour éxécuter la requète
                $resAddCtc = EntrepriseManager::addEntreprise($oPers);
                //On récupère l'id de la personne inséré
                $idPers = Connection::dernierId();

                
                //Si la ville est définis
                if (isset($_REQUEST['ADR_VILLE'])) {

                    require $path . '/model/Adresse.php';
                    require $path . '/model/AdresseManager.php';
                    //On créé un nouvel objet adresse
                    $oAddr = new Adresse();
                    //On hydrate l'objet adresse avec les données du formulaire  
                    $oAddr->PAYS_ID = $_REQUEST['PAYS_ID'];
                    $oAddr->ADR_NUM = $_REQUEST['ADR_NUM'];
                    $oAddr->ADR_VOIE = $_REQUEST['ADR_VOIE'];
                    $oAddr->ADR_RUE1 = $_REQUEST['ADR_RUE1'];
                    $oAddr->ADR_RUE2 = $_REQUEST['ADR_RUE2'];
                    $oAddr->ADR_RUE3 = $_REQUEST['ADR_RUE3'];
                    $oAddr->ADR_CP = $_REQUEST['ADR_CP'];
                    $oAddr->ADR_VILLE = $_REQUEST['ADR_VILLE'];
                    $oAddr->ADR_ETAT = $_REQUEST['ADR_ETAT'];
                    
                    //On insert la nouvelle adresse dans la table
                    $resAddCtc = AdresseManager::addAddresse($oAddr);
                    //On récupère l'id de l'adresse inséré
                    $idAdr = Connection::dernierId();

                    
                    //Si les id sont définis
                    if (isset($idAdr) && isset($idPers)) {
                        require $path . '/model/DomicilierPrs.php';
                        require $path . '/model/DomicilierPrsManager.php';
                        //On créé un objet DomicilierPersonne
                        $oDomPrs = new DomicilierPrs();
                        //On hydrate l'objet avec les données du formulaire
                        $oDomPrs->ADRPER_LBL = "truc";
                        $oDomPrs->ADR_ID = $idAdr;
                        $oDomPrs->PRS_ID = $idPers;
                        //Et on l'ajoute
                        $resAddCtc = DomicilierPrsManager::addDomicilierPrs($oDomPrs);

                    }
                }
                //Si l'adresse mail est définis
                if (isset($_REQUEST['MAIL_ADR'])) {
                    require $path . '/model/Mail.php';
                    require $path . '/model/MailManager.php';
                    //On créé un objet mail
                    $oMail = new Mail();
                    //On l'hydrate
                    $oMail->MAIL_ADR = $_REQUEST['MAIL_ADR'];
                    //On l'ajoute
                    $resAddCtc = MailManager::addMail($oMail);
                    //Et on récupère l'id du mail inséré
                    $idMail = Connection::dernierId();
                    
                    
                    //Si l'id du Mail et de la personne sont définis
                    if (isset($idMail) && isset($idPers)) {
                        require $path . '/model/ContacterPrs.php';
                        require $path . '/model/ContacterPrsManager.php';
                        //On créé un nouvelle objet ContacterPersonne
                        $oCtcPrs = new ContacterPrs();
                        //On l'hydrate avec les ids récupéré
                        $oCtcPrs->MAILPER_LBL = "truc";
                        $oCtcPrs->MAIL_ID = $idMail;
                        $oCtcPrs->PRS_ID = $idPers;
                        //Et on l'ajoute à la table
                        $resAddCtc = ContacterPrsManager::addContacterPrs($oCtcPrs);
                        
                    }
                }
                //Si tel num et l'indicatif sont définis
                if (isset($_REQUEST['TEL_NUM']) && isset($_REQUEST['TEL_IND'])) {

                    require $path . '/model/Telephone.php';
                    require $path . '/model/TelephoneManager.php';
                    //On créé un nouvel objet téléphone    
                    $oTel = new Telephone();
                    //On l'hydrate
                    $oTel->TEL_IND = $_REQUEST['TEL_IND'];
                    $oTel->TEL_NUM = $_REQUEST['TEL_NUM'];
                    //On ajoute à la table un nouvel enregistrement
                    $resAddCtc = TelephoneManager::addTel($oTel);
                    //On récupère son id
                    $idTel = Connection::dernierId();
                    
                    
                    //Si idTel est définis
                    if (isset($idTel)) {

                        require $path . '/model/JoindrePrs.php';
                        require $path . '/model/JoindrePrsManager.php';
                        //On créé un objet joindrePersonne 
                        $oJoindrePrs = new JoindrePrs();
                        //On l'hydrate avec les identifiants 
                        $oJoindrePrs->PRS_ID = $idPers;
                        $oJoindrePrs->TEL_ID = $idTel;
                        $oJoindrePrs->TELPER_LBL = "truc";
                        //On ajoute à la table un nouvel enregistrement
                        $resAddCtc = JoindrePrsManager::addJoindrePrs($oJoindrePrs);
                 
                    }
                }
                //On commit la transaction
                $cnx->commit();
                
                
                break;
            //Cas ou le contact est une personne
            case 2 :

                require $path . '/model/Personne.php';
                require $path . '/model/PersonneManager.php';


                //On récupère la connexion
                $cnx = Connection::getConnection();
                //On démarre la transactio
                $cnx->beginTransaction();
                //On créé un objet personne
                $oPers = new Personne();
                //On l'hydrate avec les données du formulaire
                $oPers->CIV_ID = $_REQUEST['CIV_CODE'];
                $oPers->PRS_NOM = $_REQUEST['PRS_NOM'];
                $oPers->PRS_PRENOM1 = $_REQUEST['PRS_PRENOM1'];
                $oPers->PRS_PRENOM2 = $_REQUEST['PRS_PRENOM2'];
                $oPers->PRS_PRENOM3 = $_REQUEST['PRS_PRENOM3'];
                $oPers->PRS_DTN = $_REQUEST['PRS_DTN'];
                //Et on appel le manager pour éxécuter la requète
                $resAddCtc = PersonneManager::addPersonne($oPers);
                //On récupère l'id de la personne inséré
                $idPers = Connection::dernierId();

                
                //Si la ville est définis
                if (isset($_REQUEST['ADR_VILLE'])) {

                    require $path . '/model/Adresse.php';
                    require $path . '/model/AdresseManager.php';
                    //On créé un nouvel objet adresse
                    $oAddr = new Adresse();
                    //On hydrate l'objet adresse avec les données du formulaire  
                    $oAddr->PAYS_ID = $_REQUEST['PAYS_ID'];
                    $oAddr->ADR_NUM = $_REQUEST['ADR_NUM'];
                    $oAddr->ADR_VOIE = $_REQUEST['ADR_VOIE'];
                    $oAddr->ADR_RUE1 = $_REQUEST['ADR_RUE1'];
                    $oAddr->ADR_RUE2 = $_REQUEST['ADR_RUE2'];
                    $oAddr->ADR_RUE3 = $_REQUEST['ADR_RUE3'];
                    $oAddr->ADR_CP = $_REQUEST['ADR_CP'];
                    $oAddr->ADR_VILLE = $_REQUEST['ADR_VILLE'];
                    $oAddr->ADR_ETAT = $_REQUEST['ADR_ETAT'];
                    
                    //On insert la nouvelle adresse dans la table
                    $resAddCtc = AdresseManager::addAddresse($oAddr);
                    //On récupère l'id de l'adresse inséré
                    $idAdr = Connection::dernierId();

                    
                    //Si les id sont définis
                    if (isset($idAdr) && isset($idPers)) {
                        require $path . '/model/DomicilierPrs.php';
                        require $path . '/model/DomicilierPrsManager.php';
                        //On créé un objet DomicilierPersonne
                        $oDomPrs = new DomicilierPrs();
                        //On hydrate l'objet avec les données du formulaire
                        $oDomPrs->ADRPER_LBL = "truc";
                        $oDomPrs->ADR_ID = $idAdr;
                        $oDomPrs->PRS_ID = $idPers;
                        //Et on l'ajoute
                        $resAddCtc = DomicilierPrsManager::addDomicilierPrs($oDomPrs);

                    }
                }
                //Si l'adresse mail est définis
                if (isset($_REQUEST['MAIL_ADR'])) {
                    require $path . '/model/Mail.php';
                    require $path . '/model/MailManager.php';
                    //On créé un objet mail
                    $oMail = new Mail();
                    //On l'hydrate
                    $oMail->MAIL_ADR = $_REQUEST['MAIL_ADR'];
                    //On l'ajoute
                    $resAddCtc = MailManager::addMail($oMail);
                    //Et on récupère l'id du mail inséré
                    $idMail = Connection::dernierId();
                    
                    
                    //Si l'id du Mail et de la personne sont définis
                    if (isset($idMail) && isset($idPers)) {
                        require $path . '/model/ContacterPrs.php';
                        require $path . '/model/ContacterPrsManager.php';
                        //On créé un nouvelle objet ContacterPersonne
                        $oCtcPrs = new ContacterPrs();
                        //On l'hydrate avec les ids récupéré
                        $oCtcPrs->MAILPER_LBL = "truc";
                        $oCtcPrs->MAIL_ID = $idMail;
                        $oCtcPrs->PRS_ID = $idPers;
                        //Et on l'ajoute à la table
                        $resAddCtc = ContacterPrsManager::addContacterPrs($oCtcPrs);
                        
                    }
                }
                //Si tel num et l'indicatif sont définis
                if (isset($_REQUEST['TEL_NUM']) && isset($_REQUEST['TEL_IND'])) {

                    require $path . '/model/Telephone.php';
                    require $path . '/model/TelephoneManager.php';
                    //On créé un nouvel objet téléphone    
                    $oTel = new Telephone();
                    //On l'hydrate
                    $oTel->TEL_IND = $_REQUEST['TEL_IND'];
                    $oTel->TEL_NUM = $_REQUEST['TEL_NUM'];
                    //On ajoute à la table un nouvel enregistrement
                    $resAddCtc = TelephoneManager::addTel($oTel);
                    //On récupère son id
                    $idTel = Connection::dernierId();
                    
                    
                    //Si idTel est définis
                    if (isset($idTel)) {

                        require $path . '/model/JoindrePrs.php';
                        require $path . '/model/JoindrePrsManager.php';
                        //On créé un objet joindrePersonne 
                        $oJoindrePrs = new JoindrePrs();
                        //On l'hydrate avec les identifiants 
                        $oJoindrePrs->PRS_ID = $idPers;
                        $oJoindrePrs->TEL_ID = $idTel;
                        $oJoindrePrs->TELPER_LBL = "truc";
                        //On ajoute à la table un nouvel enregistrement
                        $resAddCtc = JoindrePrsManager::addJoindrePrs($oJoindrePrs);
                 
                    }
                }
                //On commit la transaction
                $cnx->commit();
                break;
        }
    }
} catch (MySQLException $e) {
    $e->RetourneErreur();
    $cnx->rollback();
}


