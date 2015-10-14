<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Liste des gammes";

    require_once $path . '/model/Gamme.php';
    require_once $path . '/model/GammeManager.php';

    //Compte le nombre d'enregistrements de la table pour l'affichage par page
    $iTotal = Tool::getCountTable('gamme');

    //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
    if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
        $orderby = $_REQUEST['orderby'];
        $resAllGa = GammeManager::getAllGammesLim($limite, $iNbPage, $orderby);
    }

    //Sinon on appel la requête classique
    else {
        $resAllGa = GammeManager::getAllGammesLim($limite, $iNbPage);
    }
} else {
    echo 'Le silence est d\'or';
}