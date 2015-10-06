<?php
/*
if($_REQUEST['cat'] == 'utilisateur'){
require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';

$res = UtilisateurManager::getAllUtilisateurs();

//
//
//
//il faut récupérer un tableau sans objet
//

// Création de la ligne d'en-tête
$entete = array("Nom", "Prénom", "Age");

// Création du contenu du tableau
$lignes = array();
$lignes[] = array("Jean", "Martin", "20");
$lignes[] = array("Pierre", "Dupond", "30");

$separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
//echo implode($separateur, $entete) . "\r\n";

// Affichage du contenu du tableau
foreach ($res as $ligne) {
    Tool::printAnyCase($ligne);
    echo implode($separateur, $ligne) . "\r\n";
}
 * 
 */

