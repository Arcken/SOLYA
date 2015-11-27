<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {
    
    //Comme on ne passe pas par index.php, on appel export.php en chemin relatif
    require_once __DIR__ . '/export.php';
    //On a récupéré les variables du site et appelé les manager nécessaires
   
    //global $host, $user, $pwd, $base, $path;
    $file = 'backup_' . date("Y-m-d_H-i-s") . '.gz';
    system("mysqldump --user=$user --password=$pwd $base gzip > $path/backup/$file");
   if (date("N" == 7)){
       $sauvpath = $path."/backup/semaine";
       $file = 'backup_' . date("Y_W_H-i-s") . '.gz';
       system("mysqldump --user=$user --password=$pwd $base gzip > $sauvpath/$file");
   }
   if (date("j") == 1){
       $sauvpath = $path."/backup/mois";
       $file = 'backup_' . date("Y_m_H-i-s") . '.gz';
       system("mysqldump --user=$user --password=$pwd $base gzip > $sauvpath/$file");
   }
    
    
} else {
    echo 'Le silence est d\'or';
} 