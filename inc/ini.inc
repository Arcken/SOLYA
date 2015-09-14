<?php

//Récupération des paramètres de l'application
$fichier = 'config/param.ini.php';
if (file_exists($fichier) && is_file($fichier)) {
    $config = parse_ini_file($fichier, true);

    $host = $config['SQL']['host'];
    $user = $config['SQL']['user'];
    $pwd  = $config['SQL']['pwd'];
    $base = $config['SQL']['base'];
    
    $sTitle=$config['APPLI']['titre'];
    $sPath=$config['APPLI']['path'];
    $iLimLbl=$config['APPLI']['limlbl'];
    } else {
    throw new MySQLException("Impossible de trouver le fichier de configuration 'config/param.ini.php'"
    , self::$cnx);
}
?>