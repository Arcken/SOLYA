<?php

require_once $path . '/model/Lot.php';
require_once $path . '/model/LotManager.php';
require_once $path . '/model/ReferenceManager.php';

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Ajouter inventaire";
    //On récupère tous les lots en stock
    $resStock = LotManager::getLotStock();
} else {
    echo 'Le silence est d\'or';
}