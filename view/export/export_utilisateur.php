<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {


    $path = $_SERVER['DOCUMENT_ROOT'] . "SOLYA";
    require_once $path . '/view/export/export.php';
    require_once $path . '/model/Utilisateur.php';
    require_once $path . '/model/UtilisateurManager.php';

    $res = UtilisateurManager::getAllUtilisateursTableau();
    
    $today = date("Ymd");
    
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-disposition: filename=ut-". $today .".csv");

// Création de la ligne d'en-tête
    $entete = array("Nom", "Prénom", "Login", "Actif", "Groupe");

// Création du contenu du tableau
    $lignes = array();
    foreach ($res as $ut) {
        $lignes[] = array($ut['ut_nom'], $ut['ut_prenom'], $ut['ut_login'], $ut['ut_actif'], $ut['grp_nom']);
    }


    $separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete) . "\r\n";

// Affichage du contenu du tableau
    foreach ($lignes as $ligne) {
        echo implode($separateur, $ligne) . "\r\n";
    }
} else {
    echo 'Le silence est d\'or';
}