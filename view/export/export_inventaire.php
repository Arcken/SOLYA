<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {
   
    //Comme on ne passe pas par index.php, on appel export.php en chemin relatif
    require_once __DIR__ . '/export.php';
    //On a récupéré les variables du site et appelé les manager nécessaires
    
    
    //On éxécute la requête
    $res = ExportManager::getAllInventaires();
    
    //On récupére la date pour la mettre dans le nom du fichier
    $today = date("Ymd");
    //On paramète le nom du fichier
    header("Content-disposition: filename=Solya-Inventaire-" . $today . ".csv");
    //On construit le fichier
    require $path . '/view/export/export_construct_file.php';
    
} else {
    echo 'Le silence est d\'or';
}