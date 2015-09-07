<?php
$fichier = 'config/param.ini.php';
if (file_exists($fichier) && is_file($fichier)) {
    $config = parse_ini_file($fichier, true);

    $host = $config['SQL']['host'];
    $user = $config['SQL']['user'];
    $passwd = $config['SQL']['passwd'];
    $base = $config['SQL']['base'];
    
    $sTitre=$config['APPLI']['titre'];
    
    } else {
    throw new MySQLException("Impossible de trouver le fichier de configuration 'config/param.ini.php'"
    , self::$cnx);
}