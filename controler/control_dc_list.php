<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        $sPageTitle = "Liste des durées de conservation";

        require_once $path . '/model/DureeConservation.php';
        require_once $path . '/model/DureeConservationManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('duree_conservation');

        //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderBy = $_REQUEST['orderby'];
            $resAllDc = DureeConservationManager::getDureesConservationsLim($rowStart, $iNbPage, $orderBy);
        }

        //Sinon on appel la requête classique
        else {
            $resAllDc = DureeConservationManager::getDureesConservationsLim($rowStart, $iNbPage);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}