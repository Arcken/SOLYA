<?php
try{
    
    require_once $path . '/model/CiviliteManager.php';
    require_once $path . '/model/Pays.php';
    require_once $path . '/model/PaysManager.php';
    
    //On récupère toutes les civilités
    $resAllCivs = CiviliteManager::getAllCivilites();
    //On récupère tout les pays
    $resAllPays = PaysManager::getAllPays();
    
    //Si le bouton envoyer est définis
   if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Vérification du jeton pour savoir si le formulaire à déja était envoyé
        if ($_SESSION['token'] != $_REQUEST['token']) {
            //On appel les managers nécéssaire à l'insert d'une personne
            require_once $path . '/model/Compte.php';
            require_once $path . '/model/CompteManager.php';
            require_once $path . '/model/Personne.php';
            require_once $path . '/model/PersonneManager.php';
            
            //On récupère la connexion pour démarrer la transaction
            $cnx=  Connection::getConnection();
            $cnx->beginTransaction();
            
            //On créé le tableau d'argument pour notre objet compte
            $argsCpt=['cpt_date'=>date('d/m/y'),
                   'cpt_nom'=>$_REQUEST['cptNom'],
                   'cpt_com'=>$_REQUEST['cptCom']
                  ];
            
            //On hydrate notre objet compte
            $oCompte =new Compte($argsCpt);
            
            //On appel le manager pour effectuer l'insert
            $resInsCompte =  CompteManager::addCompte($oCompte);
            
            //Et on récupère son identifiant
            $idCpt =  Connection::dernierId();
            echo 'resultat compte '.$resInsCompte;
            
            //On créé le tableau d'arguments pour notre objet Personne
            $argsPers=['cpt_id'=>$idCpt,
                       'civ_id'=>$_REQUEST['civilite'],
                       'prs_prenom1'=>$_REQUEST['prsPrenom1'],
                       'prs_prenom2'=>$_REQUEST['prsPrenom2'],
                       'prs_dtn'=>$_REQUEST['prsDtn']
                      ];
            
            //On hydrate notre objet personne
           $oPersonne = new Personne($argsPers);
           
           //On appel le manager pour effectuer l'insert
           $resInsPers =  PersonneManager::addPersonne($oPersonne);
           
           //Et on récupère son identifiant
           $idPers =  Connection::dernierId();
           echo 'resultat personne '.$resInsPers;
           //On tegroupe toutes les informations
           $resAllAdr =['adr_lbl'   =>$_REQUEST['adrLbl'],
                        'pays_id'   =>$_REQUEST['paysId'],
                        'adr_num'   =>$_REQUEST['adrNum'],
                        'adr_voie'  =>$_REQUEST['adrVoie'],
                        'adr_rue1'  =>$_REQUEST['adrRue1'],
                        'adr_rue2'  =>$_REQUEST['adrRue2'],
                        'adr_rue3'  =>$_REQUEST['adrRue3'],
                        'adr_cp'    =>$_REQUEST['adrCp'],
                        'adr_ville' =>$_REQUEST['adrVille'],
                        'adr_etat'  =>$_REQUEST['adrEtat']
                       ];
           
            //On utilise le pays comme référence pour compter le nombre de cases
                for($i=1;$i<count($resAllAdr['pays_id'])-1;$i++){
                    
                    //On créé un nouvelle objet pour chaque ligne du tableau 
                    //en sautant la ligne fantôme 0
                    $oAddr = new Adresse();
                    //On l'hydrate
                    $oAddr->pays_id    =$resAllAdr['pays_id'][$i];
                    $oAddr->adr_num    =$resAllAdr['adr_num'][$i];
                    $oAddr->adr_voie   =$resAllAdr['adr_voie'][$i];
                    $oAddr->adr_rue1   =$resAllAdr['adr_rue1'][$i];
                    $oAddr->adr_rue2   =$resAllAdr['adr_rue2'][$i];
                    $oAddr->adr_rue3   =$resAllAdr['adr_rue3'][$i];
                    $oAddr->adr_cp     =$resAllAdr['adr_cp'][$i];
                    $oAddr->adr_ville  =$resAllAdr['adr_ville'][$i];
                    $oAddr->adr_etat   =$resAllAdr['adr_etat'][$i];
                    //On insert notre adresse
                    $resInsAddr = AdresseManager::addAddresse($oAddr);
                    echo 'résultat insert adresse'.$resInsAddr;
                    //On récupert l'identifiant de notre adresse
                    $idAddr=Connection::dernierId();
                    
                    //On se créé un objet domicilier correspondant à la table associative
                    $oDomicilier= new Domicilier();
                    //On l'hydrate
                    $oDomicilier->cpt_id=$idCpt;
                    $oDomicilier->adr_id=$idAddr;
                    $oDomicilier->adr_lbl=$resAllAdr['adr_lbl'][$i];
                    
                    //On insert dans la table associative
                    $resInsDomicilier=  DomicilierManager::addDomicilier($oDomicilier);
                }
                
                
                //Ensuite on s'occupe des emails
                //On regroupe les informations
                $resAllMail =['mail_lbl'   =>$_REQUEST['mailLbl'],
                              'mail_adr'   =>$_REQUEST['mailAdr']
                             ];
                 //On utilise l'addresse mail comme référence pour compter le nombre de cases
                for($i=1;$i<count($resAllMail['mail_adr'])-1;$i++){
                    
                    $oMail= new Mail();
                    $oMail->mail_adr=$resAllMail['mail_adr'][$i];
                    
                    $resInsMail= MailManager::addMail($oMail);
                }
                }
    }

}catch(MySQLException $e){
    $cnx->rollBack();
    echo $e->RetourneErreur();
}
