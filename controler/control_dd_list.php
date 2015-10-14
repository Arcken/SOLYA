<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        $sPageTitle = "Liste des droits de douane";

        require_once $path . '/model/DroitDouaneManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('droit_douane');

        //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderby = $_REQUEST['orderby'];
            $resAllDd = DroitDouaneManager::getAllDroitsDouanesLim($limite, $iNbPage, $orderby);
        }

        //Sinon on appel la requête classique
        else {
            $resAllDd = DroitDouaneManager::getAllDroitsDouanesLim($limite, $iNbPage);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}