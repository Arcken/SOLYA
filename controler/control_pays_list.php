<?php
$sPageTitle = "Liste des pays";
require_once $path . '/model/Pays.php';
require_once $path . '/model/PaysManager.php';

//Compte le nombre d'enregistrements de la table pour l'affichage par page
$iTotal = Tool::getCountTable('pays');

//On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby = $_REQUEST['orderby'];
    $resAllPays = PaysManager::getAllPaysLim($limite, $iNbPage, $orderby);
}
//Sinon on appel la requête classique
else {
    $resAllPays = PaysManager::getAllPaysLim($limite, $iNbPage);
}