<?php

$sPageTitle = "Liste des gammes";

try {
    require_once $path . '/model/ModeConservation.php';
    require_once $path . '/model/ModeConservationManager.php';

    //Compte le nombre d'enregistrements de la table pour l'affichage par page
    $iTotal = Tool::getCountTable('mode_conservation');

//On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        $orderby = $_REQUEST['orderby'];
        $resAllMc = ModeConservationManager::getAllGammesLim($limite, $iNbPage, $orderby);
    }
    
//Sinon on appel la requête classique
    else {
        $resAllMc = ModeConservationManager::getAllGammesLim($limite, $iNbPage);
    }
} catch (MySQLException $e) {
    //Message d'echec
    $msg = "<p class='erreur'>" . date('H:i:s') . " Liste mode de conservation."
            . " Une erreur est survenue : $resEr </p>";
    //On insert le message dans le tableau de message
    Tool::addMsg($msg);
}