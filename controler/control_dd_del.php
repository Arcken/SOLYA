<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/DroitDouaneManager.php';
        //On passe en paramètre de la requète la valeur gaIg de l'url
        $res = DroitDouaneManager::delDroitDouane($_REQUEST['ddId']);

        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression du droit de douane: "'
                . $_REQUEST['ddId']
                . '" à été effectué avec succès </p>';
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0){
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "Le droit de douane N° " . $_REQUEST['ddId']
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_dd_list.php';
} else {
    echo 'Le silence est d\'or';
}
