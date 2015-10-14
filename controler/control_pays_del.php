<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    
    require_once $path . '/model/Pays.php';
    require_once $path . '/model/PaysManager.php';
    
    //Si la suppression ne se fait pas le manager léve un exception
    try {
        //On passe en paramètre de la requète la valeur paysId de l'url
        $res = PaysManager::delPays($_REQUEST['paysId']);
        
        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression du pays: "'
                . $_REQUEST['paysId']
                . '" à été effectué avec succès </p>';
        
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0) {
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {
        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "Le pays N° " . $_REQUEST['paysId']
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_pays_list.php';
    
} else {
    echo 'Le silence est d\'or';
}
