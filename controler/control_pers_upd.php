<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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


    //On récupère l'id du compte passé en paramètre
    $cptId = $_REQUEST['cptId'];
    //On définit le titre de la page
    $sPageTitle = "Consulter/Modifier le compte N°" . $cptId;
    //On appel le manager pour récupéré le Compte 
    $oCompte  = CompteManager::getCompteDetailForUpd($cptId);
    //On appel le manager personne
    $oPersonne=  PersonneManager::getPersonne($cptId);
     //On récupère toutes les civilités
    $resAllCivs = CiviliteManager::getAllCivilites();
    //On récupère tout les pays
    $resAllPays = PaysManager::getAllPays();
        
    //On récupère tous les mails du compte
    $resAllMail =  MailManager::getMailsFromCptForUpd($cptId);
    
    //On récupère tous les numéros de téléphones du compte 
    print_r($resAllMail);
    $resAllTel = TelephoneManager::getTelephonesFromCptForUpd($cptId);
    print_r($resAllTel);
    //On récupére toutes adresses du compte
    $resAllAdr = AdresseManager::getAdressesFromCptForUpd($cptId);
    //On définis la valeur du boutton 
    $sButton = 'Modifier';
    

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        //Vérification du jeton pour savoir si le formulaire à était envoyé
        if ($_SESSION['token'] != $_REQUEST['token']) {
    
            //Instanciation de la connection
            $cnx = Connection::getConnection();

            //Démarrage de la transaction
            $cnx->beginTransaction();
            //Création du compte
            $oCompte = new Compte();
            
            $oCompte->cpt_id=$cptId;
            $oCompte->cpt_nom= $_REQUEST['cptNom'];
            $oCompte->cpt_date=$_REQUEST['cptDate'];
            $oCompte->cpt_com= $_REQUEST['cptCom'];
            $oCompte->cpt_code=$_REQUEST['cptCode'];
            

            //Modification du compte
            $updCpt = CompteManager::updCompte($oCompte);
            echo "Mise à jour du bon check : $updCpt ";

            //-----------------Gestion des lignes du formulaire-------------------------
            //Création des tableaux contenant toutes les informations
            //Un tableau par type de champs
            //tableau pour la suppression de ligne

            if (isset($_REQUEST['ligSupp'])) {
                $tLigSupp = $_REQUEST['ligSupp'];
            }

            
        } else{
            
            $msg = "<p class= 'erreur'> " . date('H:i:s')."
                Vous avez déja envoyé ce formulaire </p>";
            
            
        }
        Tool::addMsg($msg); 
    }
} catch (MySQLException $e) {
    echo $e->RetourneErreur();
    switch ($resEr){
        
    case '666':
    case '777':
    case '444':
        $msg = "<p class= 'erreur'> " . date('H:i:s') . " "
                . $e->getMessage() . "</p>";
        break;
    
    default :
        $msg='<p class="erreur"> '. date('H:i:s') . 'Oups !une erreur innatendue est survenue ' .
               $resEr . " " . $e->getMessage().'</p>';
    break;

    }
    
    $cnx->rollback();
    Tool::addMsg($msg);
}