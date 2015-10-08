<?php

if (isset($_REQUEST['beId']) && $_REQUEST['beId'] != '') {
    $beId = $_REQUEST['beId'];



    require_once $path . '/model/BonEntree.php';
    require_once $path . '/model/BonEntreeManager.php';
    require_once $path . '/model/BeLigne.php';
    require_once $path . '/model/BeLigneManager.php';
    require_once $path . '/model/Ligne.php';
    require_once $path . '/model/LigneManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/Reference.php';
    require_once $path . '/model/ReferenceManager.php';

    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'mod') {
        try {
            //On créé un objet qe l'on hydrate avec les données de l'url

            if ($resUpdGamme == 1) {
                $resMessage = "<font color='green'> La modification de la gamme $oGamme->ga_id
                  est un succés</font>";
                require_once $path . '/controler/control_ga_list.php';
            }
        } catch (MySQLException $e) {
            $resMessage = "<font color='red'> La modification de la gamme $oGamme->ga_id
                  est un echec</font>";
        }
    } else {
        $sPageTitle = "Modifier le bon N°" . $beId;

        $resBeDetail = BonEntreeManager::getBonEntreeDetailForUpd($beId);
        $resAllBeLigneBE = BeLigneManager::getBesLignesDetailForUpd($beId);
        if (is_array($resAllBeLigneBE)) {
            $resLignes = [];
            $resAllLots = [];
            $resAllRefs = [];
            foreach ($resAllBeLigneBE as $beLigne) {
                $ligId = $beLigne->lig_id;
                $ligne = LigneManager::getLigneDetailForUpd($ligId);
                $resLignes[] = $ligne;
                $lotId = $ligne->lot_id;
                $lot = LotManager::getLotForUpd($lotId);
                $resAllLots[] = $lot;
                $refid = $lot->ref_id;
                $ref = ReferenceManager::getReference($refid);
                $resAllRefs[] = $ref;
            }
        }
        $sButton = 'Modifier';
    }
} else {
    $sPageTitle = 'Erreur de chargement';
}                            