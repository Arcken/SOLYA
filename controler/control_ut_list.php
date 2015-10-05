<?php
$sPageTitle = "Liste des utilisateurs";

require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';

//Compte le nombre d'enregistrements de la table pour l'affichage par page
$iTotal = Tool::getCountTable('utilisateur');

//On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby = $_REQUEST['orderby'];
    $resAllUtilisateurs = UtilisateurManager::getAllUtilisateursLim($limite, $iNbPage, $orderby);
}

//Sinon on appel la requête classique
else {
    $resAllUtilisateurs = UtilisateurManager::getAllUtilisateursLim($limite, $iNbPage);
}
