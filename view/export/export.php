<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {
    try {
        $fichier = $path . '/config/param.ini.php';
        if (file_exists($fichier) && is_file($fichier)) {
            $config = parse_ini_file($fichier, true);

            $host = $config['SQL']['host'];
            $user = $config['SQL']['user'];
            $pwd = $config['SQL']['pwd'];
            $base = $config['SQL']['base'];

            $sTitle = $config['APPLI']['titre'];
            $sWebPath = $config['APPLI']['webpath'];

            $iLimLbl = $config['APPLI']['limlbl'];
            $nbRow = $config['APPLI']['nbpage'];

            $imgPath = $config['APPLI']['imgpath'];
            $imgMiniPath = $config['APPLI']['imgminipath'];
            $imgExtension = $config['APPLI']['imgextension'];
            $imgMaxSize = $config['APPLI']['imgmaxsize'];
        } else {
            throw new Exception("Impossible de toruver le fichier param.ini");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    require_once $path . '/model/Connection.php';
} else {
    echo 'Le silence est d\'or';
}
