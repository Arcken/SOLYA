<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Liste des modes de conservation";

    //Si la modification ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/ModeConservationManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('mode_conservation');

//On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderBy = $_REQUEST['orderby'];
            $resAllMc = ModeConservationManager::getAllGammesLim($rowStart, $iNbPage, $orderBy);
        }

//Sinon on appel la requête classique
        else {
            $resAllMc = ModeConservationManager::getAllGammesLim($rowStart, $iNbPage);
        }
    } catch (MySQLException $e) {
        //Message pour l'erreur
        $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                . $resEr . '</p>';
    }
} else {
    echo 'Le silence est d\'or';
}