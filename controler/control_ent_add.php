<?php

if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {

        require_once $path . '/model/FormeJuridiqueManager.php';
        require_once $path . '/model/CategorieManager.php';

        
        //On récupère toutes les formes juridiques
        $resAllFmju = FormeJuridiqueManager::getAllFormesJuridiques();
        //On récupère toutes les catégories
        $resAllCatEnt = CategorieManager::getAllCategories();

        //Si le bouton envoyer est définis
        if ($sButtonUt == "Envoyer") {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //On appel les managers nécéssaire à l'insert d'une personne
                require_once $path . '/model/Compte.php';
                require_once $path . '/model/CompteManager.php';
                require_once $path . '/model/Entreprise.php';
                require_once $path . '/model/EntrepriseManager.php';
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

                //On récupère la connexion pour démarrer la transaction
                $cnx = Connection::getConnection();
                $cnx->beginTransaction();


                //On créé le tableau d'argument pour notre objet compte
                //Le compte type 1 correspond à une entreprise
                $argsCpt = ['cpt_date' => date('Y-m-d'),
                    'cpt_nom' => $_REQUEST['cptNom'],
                    'cpt_com' => $_REQUEST['cptCom'],
                    'cpt_code' => $_REQUEST['cptCode'],
                    'cpt_type' => 1
                ];

                //On hydrate notre objet compte
                $oCompte = new Compte($argsCpt);
                print_r($oCompte);
                //On appel le manager pour effectuer l'insert
                $resInsCompte = CompteManager::addCompte($oCompte);

                //Et on récupère son identifiant
                $idCpt = Connection::dernierId();
                echo 'resultat compte ' . $resInsCompte;

                //On créé le tableau d'arguments pour notre objet Entreprise
                $argsEnt = ['cpt_id' => $idCpt,
                    'fmju_id' => $_REQUEST['fmju'],
                    'catent_id' => $_REQUEST['catEnt'],
                    'ent_horaire' => $_REQUEST['entHoraire'],
                    'ent_siren' => $_REQUEST['entSiren'],
                    'ent_num_tva' => $_REQUEST['entTva'],
                    'ent_site' => $_REQUEST['entSite'],
                    'ent_ecommerce' => $_REQUEST['entEcom']
                ];

                //On hydrate notre objet personne
                $oEntreprise = new Entreprise($argsEnt);
                print_r($oEntreprise);
                //On appel le manager pour effectuer l'insert
                $resInsPers = EntrepriseManager::addEntreprise($oEntreprise);

                //Et on récupère son identifiant
                $idPers = Connection::dernierId();
                //echo 'resultat personne '.$resInsPers;
                //On regroupe toutes les informations
                $resAllAdr = ['adr_lbl' => $_REQUEST['adrLbl'],
                    'pays_id' => $_REQUEST['paysId'],
                    'adr_num' => $_REQUEST['adrNum'],
                    'adr_voie' => $_REQUEST['adrVoie'],
                    'adr_rue1' => $_REQUEST['adrRue1'],
                    'adr_rue2' => $_REQUEST['adrRue2'],
                    'adr_rue3' => $_REQUEST['adrRue3'],
                    'adr_cp' => $_REQUEST['adrCp'],
                    'adr_ville' => $_REQUEST['adrVille'],
                    'adr_etat' => $_REQUEST['adrEtat']
                ];
                print_r($resAllAdr);

                //On utilise le pays comme référence pour compter le nombre de cases
                for ($i = 1; $i < count($resAllAdr['pays_id']); $i++) {

                    //On créé un nouvelle objet pour chaque ligne du tableau 
                    //en sautant la ligne fantôme 0

                    $oAdr = new Adresse();
                    //On l'hydrate
                    $oAdr->pays_id = $resAllAdr['pays_id'][$i];
                    $oAdr->adr_num = $resAllAdr['adr_num'][$i];
                    $oAdr->adr_voie = $resAllAdr['adr_voie'][$i];
                    $oAdr->adr_rue1 = $resAllAdr['adr_rue1'][$i];
                    $oAdr->adr_rue2 = $resAllAdr['adr_rue2'][$i];
                    $oAdr->adr_rue3 = $resAllAdr['adr_rue3'][$i];
                    $oAdr->adr_cp = $resAllAdr['adr_cp'][$i];
                    $oAdr->adr_ville = $resAllAdr['adr_ville'][$i];
                    $oAdr->adr_etat = $resAllAdr['adr_etat'][$i];
                    print_r($oAdr);
                    //On insert notre adresse
                    $resInsAdr = AdresseManager::addAdresse($oAdr);
                    //echo 'résultat insert adresse '.$resInsAdr;
                    //On récupère l'identifiant de notre adresse
                    $idAdr = Connection::dernierId();

                    //On se créé un objet domicilier correspondant à la table associative
                    $oDomicilier = new Domicilier();
                    //On l'hydrate
                    $oDomicilier->cpt_id = $idCpt;
                    $oDomicilier->adr_id = $idAdr;
                    $oDomicilier->adr_lbl = $resAllAdr['adr_lbl'][$i];

                    //On insert dans la table associative
                    $resInsDomicilier = DomicilierManager::addDomicilier($oDomicilier);
                }


                //Ensuite on s'occupe des emails
                //On regroupe les informations
                $resAllMail = ['mail_lbl' => $_REQUEST['mailLbl'],
                    'mail_adr' => $_REQUEST['mailAdr']
                ];
                //On utilise l'adresse mail comme référence pour compter le nombre de cases

                for ($i = 1; $i < count($resAllMail['mail_adr']); $i++) {

                    //On créé un nouvelle objet pour chaque ligne du tableau 
                    //en sautant la ligne fantôme 0
                    $oMail = new Mail();
                    //On l'hydrate
                    $oMail->mail_adr = $resAllMail['mail_adr'][$i];

                    //On insert notre adresse mail
                    $resInsMail = MailManager::addMail($oMail);
                    //echo 'résultat insert mail '.$resInsMail;
                    //On récupère son identifiant
                    $idMail = Connection::dernierId();

                    //On créé un nouvel objet contacter correspondant à notre table associative
                    $oContacter = new Contacter();
                    //On l'hydrate
                    $oContacter->mail_lbl = $resAllMail['mail_lbl'][$i];
                    $oContacter->cpt_id = $idCpt;
                    $oContacter->mail_id = $idMail;
                    //print_r($oContacter);
                    //On insert notre enregistrement dans contacter
                    $resInsContacter = ContacterManager::addContacter($oContacter);
                    //echo 'résultat insert contacter '.$resInsContacter;
                }

                //Ensuite on s'occupe des téléphones
                //On regroupe les informations
                $resAllTel = [ 'tel_lbl' => $_REQUEST['telLbl'],
                    'tel_num' => $_REQUEST['telNum'],
                    'tel_ind' => $_REQUEST['telInd']
                ];
                //On utilise le numéro de téléphone comme référence pour compter le nombre de cases

                for ($i = 1; $i < count($resAllTel['tel_num']); $i++) {

                    //On créé un nouvelle objet pour chaque ligne du tableau 
                    //en sautant la ligne fantôme 0
                    $oTelephone = new Telephone();

                    //On l'hydrate
                    $oTelephone->tel_ind = $resAllTel['tel_ind'][$i];
                    $oTelephone->tel_num = $resAllTel['tel_num'][$i];

                    //On insert notre adresse mail
                    $resInsTel = TelephoneManager::addTel($oTelephone);
                    //echo 'résultat insert Tel '.$resInsMail;
                    //On récupère son identifiant
                    $idTel = Connection::dernierId();

                    //On créé un nouvel objet Joindre correspondant à notre table associative
                    $oJoindre = new Joindre();
                    //On l'hydrate
                    $oJoindre->tel_lbl = $resAllTel['tel_lbl'][$i];
                    $oJoindre->cpt_id = $idCpt;
                    $oJoindre->tel_id = $idTel;

                    //On insert notre enregistrement dans contacter
                    $resInsJoindre = JoindreManager::addJoindre($oJoindre);
                    //echo 'résultat insert contacter '. $resInsJoindre;
                }

                //On commit la transaction
                $cnx->commit();
                //On affiche le message de succés 
                //Et enfin on vient stocker le jeton dans la session
                $_SESSION['token'] = $_REQUEST['token'];

                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' Le compte de l\'entreprise '
                        . $oCompte->cpt_nom
                        . ' à bien été enregistré sous le numéro '
                        . $idCpt . '</p>';
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s')
                        . " Vous avez déja envoyé ce formulaire </p>";
            }
        }
    } catch (MySQLException $e) {
        //On rollback la transaction
        $cnx->rollBack();
         //On défini le message d'erreur
        switch ($resEr[0]) {
            default:
                $msg = '<p class=\'erreur\'> ' . date('H:i:s')
                    . " Code : $resEr[0]"
                    . " Message : $resEr[1] </p>";
                break;
        } 
    }
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo "Le silence est d'or";
}



