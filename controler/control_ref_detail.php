<?php

/**
 * Sous controleur détail d'une référence
 */
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        require $path . '/model/ReferenceManager.php';
        //On récupère l'identifiant de la référence
        $idRef = $_REQUEST['idRef'];
        //On récupère la référence associé
        $oRef = ReferenceManager::getReference($idRef);

        require $path . '/model/ModeConservationManager.php';
        require $path . '/model/DureeConservationManager.php';
        require $path . '/model/FicheArticleManager.php';
        require $path . '/model/TvaManager.php';
        require $path . '/model/DroitDouaneManager.php';
        require $path . '/model/PrixVente.php';
        require $path . '/model/PrixVenteManager.php';
        require $path . '/model/LotManager.php';
        //On récupère les données associés
        $oTva = TvaManager::getTvaById($oRef->tva_id);
        $oDroitDouane = DroitDouaneManager::getDroitDouaneById($oRef->dd_id);
        $oDurCons = DureeConservationManager::getDureeConservationById($oRef->dc_id);
        $oModCons = ModeConservationManager::getModeConservationById($oRef->cons_id);
        $oFiArt = FicheArticleManager::getFicheArticleById($oRef->fiart_id);
        $oPve = PrixVenteManager::getCurPrixVente($idRef);
        $toLots = LotManager::getLotsFromReference($idRef);

        if ($oPve === 0) {

            $oPve = new PrixVente();
            $oPve->pve_ent = 'indéfinis';
            $oPve->pve_per = 'indéfinis';
        }
    } catch (MySQLException $e) {
        $msg = "<p class='erreur'> " . date('H:i:s')
                . " Impossible de consulter la référence. Code :"
                . $resEr[0] . " Message : $resEr[1]"
                . "</p>";
    }
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo "Le silence est d'or";
}
   