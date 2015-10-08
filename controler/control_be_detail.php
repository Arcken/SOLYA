<?php
//on récupére l'id du bon entré
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
    require_once $path . '/model/DroitDouane.php';
    require_once $path . '/model/DroitDouaneManager.php';

    //Si le formulaire est envoyé
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

        //On récupére les détails du bon entré
        $resBeDetail = BonEntreeManager::getBonEntreeDetailForUpd($beId);
        //On récupére toutes les be_ligne du bon
        $resAllBeLigneBE = BeLigneManager::getBesLignesDetailForUpd($beId);
        
        //On vérifie que $resAllBeLigneBE soit bien un tableau (si aucune donnée ce n'est pas un tableau
        if (is_array($resAllBeLigneBE)) {
            //Tableau pour les lignes
            $resLignes = [];
            //Tableau pour les lots
            $resAllLots = [];
            //Tableau pour les reférénces
            $resAllRefs = [];
            //Tableaux pour les droits de douanes
            $resAllDds = [];
            
            //Pour chaque be_ligne
            foreach ($resAllBeLigneBE as $beLigne) {
                
                //On récupére l'id de ligne
                $ligId = $beLigne->lig_id;
                //On récupére les infos de la ligne
                $ligne = LigneManager::getLigneDetailForUpd($ligId);
                //On ajoute la ligne retourné au tableau de ligne
                $resLignes[] = $ligne;
                
                //On récupére l'id du lot
                $lotId = $ligne->lot_id;
                //On récupére les infos du lot
                $lot = LotManager::getLotForUpd($lotId);
                //On ajoute le lot retourné au tableau de lot
                $resAllLots[] = $lot;
                
                //On récupére l'id de la référence
                $refid = $lot->ref_id;
                //On récupére les infos de la référence
                $ref = ReferenceManager::getReference($refid);
                //On ajoute la référence retournée au tableau de référence
                $resAllRefs[] = $ref;
                //On récupére l'id du droit de douane
                $ddId = $ref->dd_id;
                //On récupére les infos du droit de douane
                $dd = DroitDouaneManager::getDroitDouaneById($ddId);
                //On ajoute le droit de douane retournée au tableau de droit douane
                $resAllDds[] = $dd;
            }
        }
        $sButton = 'Modifier';
    }
} else {
    $sPageTitle = 'Erreur de chargement';
}                            