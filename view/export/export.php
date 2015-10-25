<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {
    try {
        
        $fichier = '../../config/param.ini.php';
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
            
           $path = $_SERVER['DOCUMENT_ROOT'] . $sWebPath;
            require_once $path . '/model/Connection.php';
            require_once $path. '/model/ExportManager.php';
            
        } else {
            throw new Exception("Impossible de toruver le fichier param.ini");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    
} else {
    echo 'Le silence est d\'or';
}
