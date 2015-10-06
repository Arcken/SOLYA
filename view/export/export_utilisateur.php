<?php
$path = $_SERVER['DOCUMENT_ROOT']."SOLYA";

$fichier = $path .'/config/param.ini.php';
if (file_exists($fichier) && is_file($fichier)) {
    $config = parse_ini_file($fichier, true);

    $host = $config['SQL']['host'];
    $user = $config['SQL']['user'];
    $pwd  = $config['SQL']['pwd'];
    $base = $config['SQL']['base'];
    
    $sTitle = $config['APPLI']['titre'];
    $sWebPath = $config['APPLI']['webpath'];
    
    $iLimLbl = $config['APPLI']['limlbl'];
    $iNbPage = $config['APPLI']['nbpage'];
    
    $imgPath = $config['APPLI']['imgpath'];
    $imgMiniPath = $config['APPLI']['imgminipath'];
    $imgExtension = $config['APPLI']['imgextension'];
    $imgMaxSize = $config['APPLI']['imgmaxsize'];
}


require_once $path . '/model/Connection.php';

require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';

$res = UtilisateurManager::getAllUtilisateursTableau();


header("Content-Type: text/csv; charset=UTF-8");
header("Content-disposition: filename=mon-tableau.csv");

// Création de la ligne d'en-tête
$entete = array("Nom", "Prénom", "Login", "Actif", "Groupe");

// Création du contenu du tableau
$lignes = array();
foreach ($res as $ut){
$lignes[] = array($ut['ut_nom'],$ut['ut_prenom'],$ut['ut_login'],$ut['ut_actif'],$ut['grp_nom']);
}


$separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete) . "\r\n";

// Affichage du contenu du tableau
foreach ($lignes as $ligne) {
    echo implode($separateur, $ligne) . "\r\n";
}