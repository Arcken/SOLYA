<?php
try{
    require $path . '/model/Pays.php';
    require $path . '/model/PaysManager.php';
    
    //On récupère tout les pays
    $resAllPays = PaysManager::getAllPays();
    
}catch(MySQLException $e){
    echo $e->RetourneErreur();
}


