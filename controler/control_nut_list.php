<?php
$sPageTitle = "Liste des nutritions";
require_once $path . '/model/Nutrition.php';
require_once $path . '/model/NutritionManager.php';

//Compte le nombre d'enregistrements de la table pour l'affichage par page
$iTotal = Tool::getCountTable('nutrition');

//On regarde si orderby est  définie pour appeler la méthode de trie dans ce cas
if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby = $_REQUEST['orderby'];
    $resAllGa = NutritionManager::getAllNutritionsLim($limite, $iNbPage, $orderby);
}
//Sinon on appel la requête classique
else {
    $resAllGa = NutritionManager::getAllNutritionsLim($limite, $iNbPage);
}