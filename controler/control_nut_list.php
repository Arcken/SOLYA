<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {
        $sPageTitle = "Liste des nutritions";

        require_once $path . '/model/Nutrition.php';
        require_once $path . '/model/NutritionManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('nutrition');

        //On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderBy = $_REQUEST['orderby'];
            if (isset($_REQUEST['tri']) && $_REQUEST['tri'] != '') {
                $sort = $_REQUEST['tri'];
            }
            $resAllNut = NutritionManager::getNutritionsLim($rowStart, $nbRow, $orderBy, $sort);
        }
        //Sinon on appel la requête classique
        else {
            $resAllNut = NutritionManager::getNutritionsLim($rowStart, $nbRow);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}