<?php
require_once '/exception/MySQLException.php';
//Récupération des paramètres de l'application
$fichier = 'config/param.ini.php';
if (file_exists($fichier) && is_file($fichier)) {
    $config = parse_ini_file($fichier, true);

    $host = $config['SQL']['host'];
    $user = $config['SQL']['user'];
    $pwd  = $config['SQL']['pwd'];
    $base = $config['SQL']['base'];
    
    $sTitle=$config['APPLI']['titre'];
    $sWebPath=$config['APPLI']['webpath'];
    $iLimLbl=$config['APPLI']['limlbl'];
    $iNbPage=$config['APPLI']['nbpage'];
    } else {
    throw new MySQLException("Impossible de trouver le fichier de configuration 'config/param.ini.php'"
    , self::$cnx);
}
?>