<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/GammeManager.php';
        //On passe en paramètre de la requète la valeur gaIg de l'url
        $res = GammeManager::delGamme($_REQUEST['gaId']);

        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' la suppression de la gamme: "'
                . $_REQUEST['gaId']
                . '" à été effectué avec succès </p>';
    } catch (MySQLException $e) {

        //Messga en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "La gamme N° " . $_REQUEST['gaId']
                . " n'est pas supprimée</p>";
    }

    Tool::addMsg($msg);
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_ga_list.php';
} else {
    echo 'Le silence est d\'or';
}
