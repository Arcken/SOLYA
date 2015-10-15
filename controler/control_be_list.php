<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        $sPageTitle = "Liste des bons d'entrés";
        require_once $path . '/model/BonEntree.php';
        require_once $path . '/model/BonEntreeManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('bon_entree');
        
        //Si un champs de orderby est défini on exécute la requète avec tri et ordreby
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderBy = $_REQUEST['orderby'];
            if (isset($_REQUEST['tri']) && $_REQUEST['tri'] != '') {
                $sort = $_REQUEST['tri'];
            }
            $resBeList = BonEntreeManager::getBonsEntreesLim($rowStart, $nbRow, $orderBy, $sort);
        }
        //Sinon sans tri
        else {
            $resBeList = BonEntreeManager::getBonsEntreesLim($rowStart, $nbRow);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}