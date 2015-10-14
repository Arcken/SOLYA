<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/ModeConservationManager.php';
        //On passe en paramètre de la requète la valeur consId de l'url
        $res = ModeConservationManager::delModeConservation($_REQUEST['consId']);

        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression du mode de conservation: "'
                . $_REQUEST['consId']
                . '" à été effectué avec succès </p>';
        
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0){
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "Le mode de conservation N° " . $_REQUEST['consId']
                . " n'est pas supprimée</p>";
         //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_mc_list.php';
    
    } else {
    echo 'Le silence est d\'or';
}
