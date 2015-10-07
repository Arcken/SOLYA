<?php

//Déffinition du titre de la page
$sPageTitle = "Créer un Bon d'entrée";

require_once $path . '/model/BonEntree.php';
require_once $path . '/model/BonEntreeManager.php';
require_once $path . '/model/BeLigne.php';
require_once $path . '/model/BeLigneManager.php';
require_once $path . '/model/Ligne.php';
require_once $path . '/model/LigneManager.php';
require_once $path . '/model/Lot.php';
require_once $path . '/model/LotManager.php';

//Controle si le formulaire a était envoyé 
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    //On récupère la valeur de typeBon pour définir l'action à executer
    //Instanciation de la connection
    $cnx = Connection::getConnection();

    //Démarrage de la transaction
    $cnx->beginTransaction();
    
    //Création du bon d'entrée
    $oBe = new BonEntree();
    //$oBe->cpt_id = $_REQUEST['cptId'];
    $oBe->be_lbl = $_REQUEST['beLbl'];
    $oBe->be_date = $_REQUEST['beDate'];
    $oBe->be_fact_num = $_REQUEST['beFactNum'];
    $oBe->be_frais_douane =$_REQUEST['beFraisSouane'];
    $oBe->be_frais_bancaire = $_REQUEST['beFraisBancaire'];
    $oBe->be_frais_trans = $_REQUEST['beFraisTrans'];
    $oBe->be_com = $_REQUEST['beCom'];
    $oBe->be_infos_trans = $_REQUEST['beInfosTrans'];
            
    //Insert du bon
    $resBe = BonEntreeManager::addBonEntree($oBe);
    
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
    $tBeligLbl = $_REQUEST['beligLbl'];
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
    
}