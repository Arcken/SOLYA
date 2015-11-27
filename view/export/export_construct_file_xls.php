<?php


//On paramètre le fichier
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");

//Il faudra préciser au préalable le nom du fichier avec
//      header("Content-disposition: filename=Solya-" . $today . ".csv");

/**
 * function de convertion d'utf8 en utf16 pour excel
 */
$func = function($str){
    return mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
};


// Création de la ligne d'en-tête
$entete = [];
//On parcours la première case pour récupéré les titres
foreach ($res[0] as $key => $value) {
    $entete[] = $func($key);
}

// Création du contenu du tableau en récupérant chaque ligne du tableau associatif
$lignes = [];
foreach ($res as $ligne) {
    $lignes[] = array_map($func,$ligne);
}

//Pramète pour la séparation des données dans le fichier csv
$separateur = "\t";

// Ecriture de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete) . "\r\n";

// Ecriture du contenu du tableau ligne par ligne
foreach ($lignes as $ligne) {
    echo implode($separateur, $ligne) . "\r\n";
}

//Le fichier est terminé