<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Liste des TVA";

    require_once $path . '/model/TvaManager.php';

    //Compte le nombre d'enregistrements de la table pour l'affichage par page
    $iTotal = Tool::getCountTable('tva');

    //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        $orderby = $_REQUEST['orderby'];
        $resAllTva = TvaManager::getAllTvasLim($limite, $iNbPage, $orderby);
    }

    //Sinon on appel la requête classique
    else {
        $resAllTva = TvaManager::getAllTvasLim($limite, $iNbPage);
    }
} else {
    echo 'Le silence est d\'or';
}