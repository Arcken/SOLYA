<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    try {
        $sPageTitle = "Liste des utilisateurs";

        require_once $path . '/model/Utilisateur.php';
        require_once $path . '/model/UtilisateurManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('utilisateur');

        //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderBy = $_REQUEST['orderby'];
            $resAllUtilisateurs = UtilisateurManager::getUtilisateurLim($rowStart, $iNbPage, $orderBy);
        }

        //Sinon on appel la requête classique
        else {
            $resAllUtilisateurs = UtilisateurManager::getUtilisateurLim($rowStart, $iNbPage);
        }
        
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
    
} else {
    echo 'Le silence est d\'or';
}
