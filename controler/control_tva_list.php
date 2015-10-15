<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    try {
        $sPageTitle = "Liste des TVA";

        require_once $path . '/model/TvaManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('tva');

        //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            if (isset($_REQUEST['tri']) && $_REQUEST['tri'] != '') {
                $sort = $_REQUEST['tri'];
            }
            $orderBy = $_REQUEST['orderby'];
            $resAllTva = TvaManager::getTvaLim($rowStart, $nbRow, $orderBy, $sort);
        }

        //Sinon on appel la requête classique
        else {
            $resAllTva = TvaManager::getTvaLim($rowStart, $nbRow);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}