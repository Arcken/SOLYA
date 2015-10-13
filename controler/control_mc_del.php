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
                . ' la suppression du mode de conservation: "'
                . $id
                . '" à été effectué avec succès </p>';
        
    } catch (MySQLException $e) {

        //Messga en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "Le mode de conservation N° " . $_REQUEST['consId']
                . " n'est pas supprimée</p>";
    }

    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_mc_list.php';
    
    } else {
    echo 'Le silence est d\'or';
}
