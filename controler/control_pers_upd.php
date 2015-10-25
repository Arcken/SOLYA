<?php

/**
 * Sous controleur mise a jour d'une personne
 */
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
try {
        require_once $path . '/model/Compte.php';
        require_once $path . '/model/CompteManager.php';
        require_once $path . '/model/Personne.php';
        require_once $path . '/model/PersonneManager.php';
        require_once $path . '/model/Mail.php';
        require_once $path . '/model/MailManager.php';
        require_once $path . '/model/Telephone.php';
        require_once $path . '/model/TelephoneManager.php';
        require_once $path . '/model/Adresse.php';
        require_once $path . '/model/AdresseManager.php';
        require_once $path . '/model/Joindre.php';
        require_once $path . '/model/JoindreManager.php';
        require_once $path . '/model/Domicilier.php';
        require_once $path . '/model/DomicilierManager.php';
        require_once $path . '/model/Contacter.php';
        require_once $path . '/model/ContacterManager.php';
        require_once $path . '/model/CiviliteManager.php';
        require_once $path . '/model/PaysManager.php';
      

    //On met la valeur de sButton a modifier
    $sButton='Modifier';   
    //On récupère l'id du compte passé en paramètre
    $cptId = $_REQUEST['cptId'];

    //On appel le manager pour récupéré le Compte 
    $oCompte  = CompteManager::getCompteDetailForUpd($cptId);
    
    //On appel le manager personne
    $oPersonne=  PersonneManager::getPersonneForUpd($cptId);
     //On récupère toutes les civilités
    $resAllCivs = CiviliteManager::getAllCivilites();
    //On récupère tout les pays
    $resAllPays = PaysManager::getAllPays();
        
    //On récupère tous les mails du compte
    $resAllMail =  MailManager::getMailsFromCptForUpd($cptId);
    
    //On récupère tous les numéros de téléphones du compte 
   // print_r($resAllMail);
    $resAllTel = TelephoneManager::getTelephonesFromCptForUpd($cptId);
    //print_r($resAllTel);
    //On récupére toutes adresses du compte
    $resAllAdr = AdresseManager::getAdressesFromCptForUpd($cptId);
   
    

    //Si le formulaire est envoyé
    if ($sButtonUt == 'Modifier') {
        //Vérification du jeton pour savoir si le formulaire à était envoyé
        if ($_SESSION['token'] != $_REQUEST['token']) {
            echo 'dedans';
    
            //Instanciation de la connection
            $cnx = Connection::getConnection();

            //Démarrage de la transaction
            $cnx->beginTransaction();
            //Création du compte
            $oCompte = new Compte();
            
            $oCompte->cpt_id=$cptId;
            $oCompte->cpt_nom= $_REQUEST['cptNom'];
            $oCompte->cpt_com= $_REQUEST['cptCom'];
            $oCompte->cpt_code=$_REQUEST['cptCode'];
            

            //Modification du compte
            $updCpt = CompteManager::updCompte($oCompte);
            //echo "Mise à jour du bon check : $updCpt ";

            $oPersonne= new Personne();
            $oPersonne->civ_id=$_REQUEST['civilite'];
            $oPersonne->cpt_id=$cptId;
            $oPersonne->prs_dtn=$_REQUEST['prsDtn'];
            $oPersonne->prs_prenom1=$_REQUEST['prsPrenom1'];
            $oPersonne->prs_prenom2=$_REQUEST['prsPrenom2'];
            
            $updPrs=  PersonneManager::updPersonne($oPersonne);
            
            //-----------------Gestion des lignes du formulaire-------------------------
            //Création des tableaux contenant toutes les informations
            //Un tableau par type de champs
            
            $resLigMail = [  'mail_id'  => $_REQUEST['mailId'],
                             'mail_lbl' => $_REQUEST['mailLbl'],
                             'mail_adr' => $_REQUEST['mailAdr']];
           
            $resLigTel  = [  'tel_id'  => $_REQUEST['telId'],
                             'tel_lbl' => $_REQUEST['telLbl'],
                             'tel_ind' => $_REQUEST['telInd'],
                             'tel_num' => $_REQUEST['telNum']];
            
            $resLigAdr  = [ 'adr_id'    => $_REQUEST['adrId'],
                            'adr_lbl'   => $_REQUEST['adrLbl'],
                            'adr_num'   => $_REQUEST['adrNum'],
                            'adr_voie'  => $_REQUEST['adrVoie'],
                            'adr_rue1'  => $_REQUEST['adrRue1'],
                            'adr_rue2'  => $_REQUEST['adrRue2'],
                            'adr_rue3'  => $_REQUEST['adrRue3'],
                            'adr_cp'    => $_REQUEST['adrCp'],
                            'adr_ville' => $_REQUEST['adrVille'],
                            'adr_etat'  => $_REQUEST['adrEtat'],
                            'pays_id'  => $_REQUEST['paysId']];
            
            //Tableau pour la suppression de ligne
            //Ce tableau est un tableau à deux dimensions
            //la premiere est une clé associative contenant 'adr', 'tel', ou 'mail', le second 
            //contient l'id de l'élément à supprimer
           if (isset($_REQUEST['ligSupp'])) {
                $tLigSupp = $_REQUEST['ligSupp'];
               
           }
           
           
           //On traite les lignes de mails
           //On prend mail_id comme témoin
            for($i=1; $i < count($resLigMail['mail_id']);$i++){
                
                //Si l'id de la ligne est > 0
                if($resLigMail['mail_id'][$i]> 0){
                    
                    //C'est un update ou une suppression
                    //On vérifie si la valeur est dans le tableau
                    
                    if(isset($tLigSupp['mail']) &&
                            in_array($resLigMail['mail_id'][$i], $tLigSupp['mail'])== TRUE){
                                            
                        //On supprime la ligne
                            $resContDel= ContacterManager::delContacterFromCptAndMail($cptId,$resLigMail['mail_id'][$i]);
                          
                        
                    }else{
                        //Sinon on met à jour
                        //Donc on hydrate un objet Contacter
                        $oContacter =new Contacter();
                        $oContacter->cpt_id  =$cptId;
                        $oContacter->mail_id =$resLigMail['mail_id'][$i];
                        $oContacter->mail_lbl=$resLigMail['mail_lbl'][$i];
                        //On appel le manager pour faire la mise à jour
                        $resContUpd =ContacterManager::updContacter($oContacter);
                        
                      
                        //Ensuite on met à jour le mail
                        //Création de l'objet
                        $oMail = new Mail();
                        $oMail->mail_adr = $resLigMail['mail_adr'][$i];
                        $oMail->mail_id  = $resLigMail['mail_id'][$i];
                        //Mise à jour de celui-ci
                        $resMailUpd =  MailManager::updMail($oMail);
                      
                    }
                
                //Sinon c'est un insert
                }else if($resLigMail['mail_id'][$i]==''){
                    //Création du mail
                    $oMail = new Mail();
                    $oMail->mail_adr = $resLigMail['mail_adr'][$i];
                    //Et insertion
                    $resAddMail= MailManager::addMail($oMail);
                    $idMail    =  Connection::dernierId();
                    
                    //Création de l'objet contacter
                    $oContacter= new Contacter();
                    $oContacter->cpt_id=$cptId;
                    $oContacter->mail_id=$idMail;
                    $oContacter->mail_lbl=$resLigMail['mail_lbl'][$i];
                    //Et insertion
                    $resAddContacter=  ContacterManager::addContacter($oContacter);
                   
                }
            }
             
             //On traite les lignes de téléphones
            print_r($resLigTel);
             for($i=1; $i < count($resLigTel['tel_id']); $i++){
                //Si l'id de la ligne est > 0
                if($resLigTel['tel_id'][$i] > 0){
                    //C'est un update ou une suppression
                    //On vérifie si la valeur est dans le tableau
                    if( isset($tLigSupp['tel']) &&
                            in_array($resLigTel['tel_id'][$i], $tLigSupp['tel']) == TRUE){
                        
                        //On supprime la ligne
                        $resJoindreDel= JoindreManager::delJoindreFromCptAndTel($cptId,$resLigTel['tel_id'][$i]);
                        echo "Supression Joindre check $resJoindreDel";
                        
                    }else{
                        //Sinon on met à jour
                        //Donc on hydrate un objet Joindre
                        $oJoindre =new Joindre();
                        $oJoindre->cpt_id  =$cptId;
                        $oJoindre->tel_id =$resLigTel['tel_id'][$i];
                        $oJoindre->tel_lbl=$resLigTel['tel_lbl'][$i];
                        //On appel le manager pour faire la mise à jour
                        $resJoindreUpd =JoindreManager::updJoindre($oJoindre);
                        
                        echo "Modif joindre check $resJoindreUpd";
                        //Ensuite on met à jour le tel
                        //Création de l'objet
                        $oTelephone = new Telephone();
                        $oTelephone->tel_id  = $resLigTel['tel_id'][$i];
                        $oTelephone->tel_num = $resLigTel['tel_num'][$i];
                        $oTelephone->tel_ind = $resLigTel['tel_ind'][$i];
                        
                        //Mise à jour de celui-ci
                        $resTelephoneUpd =  TelephoneManager::updTelephone($oTelephone);
                        echo "Modif telephone check $resTelephoneUpd";
                    }
                
                //Sinon c'est un insert
                }else if($resLigTel['tel_id'][$i]==''){
                    //Création du telephone
                    $oTelephone = new Telephone();
                    $oTelephone->tel_num = $resLigTel['tel_num'][$i];
                    $oTelephone->tel_ind = $resLigTel['tel_ind'][$i];
                    //Et insertion
                    $resAddTelephone = TelephoneManager::addTel($oTelephone);
                    $idTelephone     = Connection::dernierId();
                    
                    //Création de l'objet contacter
                    $oJoindre= new Joindre();
                    $oJoindre->cpt_id =$cptId;
                    $oJoindre->tel_id =$idTelephone;
                    $oJoindre->tel_lbl=$resLigTel['tel_lbl'][$i];
                    //Et insertion
                    $resAddJoindre=  JoindreManager::addJoindre($oJoindre);
                    echo "Ajout joindre check : $resAddJoindre";
                }
            }
            
              //On traite les lignes d' Adresse
            for($i=1;$i < count($resLigAdr['adr_id']);$i++){
                //Si l'id de la ligne est > 0
                print_r($resLigAdr);
                if($resLigAdr['adr_id'][$i]> 0){
                    //C'est un update ou une suppression
                    //On vérifie si la valeur est dans le tableau
                    if(isset($tLigSupp['adr'])&& in_array($resLigAdr['adr_id'][$i], $tLigSupp['adr'])==TRUE){
                        
                        //On supprime la ligne
                        $resDomicilierDel= DomicilierManager::delDomicilierFromCptAndAdr($cptId,$resLigAdr['adr_id'][$i]);
                        echo "Supression Domicilier check $resDomicilierDel";
                        
                    }else{
                        //Sinon on met à jour
                        //Donc on hydrate un objet Domicilier
                        $oDomicilier =new Domicilier();
                        $oDomicilier->cpt_id =$cptId;
                        $oDomicilier->adr_id =$resLigAdr['adr_id'][$i];
                        $oDomicilier->adr_lbl=$resLigAdr['adr_lbl'][$i];
                        //On appel le manager pour faire la mise à jour
                        $resDomicilierUpd =DomicilierManager::updDomicilier($oDomicilier);
                        
                        echo "Modif Domicilier check $resDomicilierUpd";
                        //Ensuite on met à jour l'adresse
                        //Création de l'objet
                        $oAdresse = new Adresse();
                        $oAdresse->adr_id  = $resLigAdr['adr_id'][$i];
                        $oAdresse->adr_num = $resLigAdr['adr_num'][$i];
                        $oAdresse->adr_voie = $resLigAdr['adr_voie'][$i];
                        $oAdresse->adr_rue1 = $resLigAdr['adr_rue1'][$i];
                        $oAdresse->adr_rue2 = $resLigAdr['adr_rue2'][$i];
                        $oAdresse->adr_rue3 = $resLigAdr['adr_rue3'][$i];
                        $oAdresse->adr_cp = $resLigAdr['adr_cp'][$i];
                        $oAdresse->adr_ville = $resLigAdr['adr_ville'][$i];
                        $oAdresse->adr_etat = $resLigAdr['adr_etat'][$i];
                        $oAdresse->pays_id = $resLigAdr['pays_id'][$i];
                        
                        //Mise à jour de celui-ci
                        $resAdresseUpd = AdresseManager::updAdresse($oAdresse);
                        echo "Modif adresse check $resAdresseUpd";
                    }
                
                //Sinon c'est un insert
                }else if($resLigAdr['adr_id'][$i]==''){
                    //Création de l'adresse
                    $oAdresse = new Adresse();
                    $oAdresse->adr_num = $resLigAdr['adr_num'][$i];
                    $oAdresse->adr_voie = $resLigAdr['adr_voie'][$i];
                    $oAdresse->adr_rue1 = $resLigAdr['adr_rue1'][$i];
                    $oAdresse->adr_rue2 = $resLigAdr['adr_rue2'][$i];
                    $oAdresse->adr_rue3 = $resLigAdr['adr_rue3'][$i];
                    $oAdresse->adr_cp = $resLigAdr['adr_cp'][$i];
                    $oAdresse->adr_ville = $resLigAdr['adr_ville'][$i];
                    $oAdresse->adr_etat = $resLigAdr['adr_etat'][$i];
                    $oAdresse->pays_id = $resLigAdr['pays_id'][$i];
                    //Et insertion
                    $resAddAdresse = AdresseManager::addAdresse($oAdresse);
                    $idAdresse     =  Connection::dernierId();
                    
                    //Création de l'objet contacter
                    $oDomicilier= new Domicilier();
                    $oDomicilier->cpt_id =$cptId;
                    $oDomicilier->adr_id =$idAdresse;
                    $oDomicilier->adr_lbl=$resLigAdr['adr_lbl'][$i];
                    //Et insertion
                    $resAddDomicilier=  DomicilierManager::addDomicilier($oDomicilier);
                    echo "Ajout joindre check : $resAddDomicilier";
                }
            }
       //On commit la transaction    
      $cnx->commit();      
      //On affiche le message de succès
      $msg="<p class=info>". date('H:i:s') 
              ."La modification du Compte N°$cptId à été effectué avec succés</p>";    
      
      $_SESSION['token']= $_REQUEST['token'];
        } else{
            
            $msg = "<p class= 'erreur'> " . date('H:i:s')."
                Vous avez déja envoyé ce formulaire </p>";
            
            
        }
    }
} catch (MySQLException $e) {
    echo $e->RetourneErreur();
         //On rollback la transaction
        $cnx->rollback();
        //On défini le message d'erreur
        switch ($resEr[0]) {
            default:
                $msg = '<p class=\'erreur\'> ' . date('H:i:s') . " Code : $resEr[0]"
                        . " Message : $resEr[1] </p>";
                break;
        }
        
    }
    //On ajoute le message
    if (isset($msg)){
        Tool::addMsg($msg);
    }

    }else{
    echo "Le silence est d'or";
}