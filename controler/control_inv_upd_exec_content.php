<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    
    //inclut les manager et les objets
    require_once $path . '/model/Inventaire.php';
    require_once $path . '/model/InventaireManager.php';
    require_once $path . '/model/LigneInventaire.php';
    require_once $path . '/model/LigneInventaireManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';

//-----------------Gestion des lignes du formulaire-----------------
//Création des tableaux contenant toutes les informations
//Un tableau par type de champs
//On récupére l'id de l'inventaire
$invId = $_REQUEST['invId'];

//Tableaux pour la table ligne_inventaire

$tLiginvId = $_REQUEST['liginvId'];
$tLiginvLbl = $_REQUEST['liginvLbl'];

$tLiginvQtStock = $_REQUEST['liginvQtStock'];
$tLiginvQtReel = $_REQUEST['liginvQtReel'];

//Tableaux pour la table lot
$tLotId = $_REQUEST['lotId'];

//Tableau de ligne de formulaire
$tLigneForm = [
    'liginv_id' => $tLiginvId,
    'liginv_lbl' => $tLiginvLbl,
    'liginv_qt_reel' => $tLiginvQtReel,
    'liginv_qt_stock' =>$tLiginvQtStock,
    'lot_id' => $tLotId
];

//Boucle pour traiter les lignes
//On ignore la première ligne, c'est le squelette de construction 
//pour l'ajout de ligne d'inventaire                
//La limite étant le nombre de ligne remplie 
//on prend lot_id comme témoin


//On hydrate un objet inventaire
$oInventaire = new Inventaire();
$oInventaire->inv_id = $invId;
$oInventaire->inv_date = $_REQUEST['invDate'];
$oInventaire->inv_lbl = $_REQUEST['invLbl'];

for ($i = 1; $i < (count($tLigneForm['lot_id'])); $i++) {

    //On hydrate un objet ligne inventaire
    $oLiginv = new LigneInventaire();
    $oLiginv->lot_id = $tLigneForm['lot_id'][$i];
    $oLiginv->liginv_lbl = $tLigneForm['liginv_lbl'][$i];
    $oLiginv->liginv_qt_reel = $tLigneForm['liginv_qt_reel'][$i];
    $oLiginv->liginv_qt_stock = $tLigneForm['liginv_qt_stock'][$i];
    $oLiginv->inv_id = $invId;

    //Si la case liginv_id est != '' c'est un update
    if ($tLigneForm['liginv_id'][$i] != '') {
        //On récupére l'id de la ligne                        
        $oLiginv->liginv_id = $tLigneForm['liginv_id'][$i];
        //On update la ligne
        $resLiginv = LigneInventaireManager::updLigneInventaire($oLiginv);

        //Sinon c'est que c'est un insert    
    } else {
        //on insert la ligne inventaire
        $resLiginv = LigneInventaireManager::addLigneInventaire($oLiginv);
    }

    //code en cas d'exécution du formulaire, modifie les lots pour faire correpondre
    //leur quantité stock avec leur quantité réelle
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Executer') {

        //On hydrate un objet lot
        $oLot = new Lot();
        $oLot = LotManager::getLot($oLiginv->lot_id);
        $oLot->lot_qt_stock = $oLiginv->liginv_qt_reel;
        //On update le lot
        $resLot = LotManager::updLot($oLot);
    }
}

//une fois tous les lots modifiés on change le booleen de l'inventaire pour interdire
//sa modification à partir de maintenant si le bouton executer est cliqué
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Executer') {
    $oInventaire->inv_vld = 1;
}

//On met à jour le bon
$resInventaire = InventaireManager::updInventaire($oInventaire);


} else {
    echo 'le silence est d\'or';
}  