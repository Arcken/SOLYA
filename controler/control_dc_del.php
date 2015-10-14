<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/DureeConservationManager.php';
        //On passe en paramètre de la requète la valeur gaIg de l'url
        $res = DureeConservationManager::delDureeConservation($_REQUEST['dcId']);

        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression de la durée de conservation: "'
                . $_REQUEST['dcId']
                . '" à été effectué avec succès </p>';
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0){
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "La durée de conservation N° " . $_REQUEST['dcId']
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_dc_list.php';
} else {
    echo 'Le silence est d\'or';
}
