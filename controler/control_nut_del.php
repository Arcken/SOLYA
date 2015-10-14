<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/NutritionManager.php';

        //On passe en paramètre de la requète la valeur nutId de l'url
        $res = NutritionManager::delNutrition($_REQUEST['nutId']);

        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression de la nutrition: "'
                . $_REQUEST['nutId']
                . '" à été effectué avec succès </p>';
        
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0) {
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . " La gamme N° " . $_REQUEST['nutId']
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }

    //On appel le contrôleur de la liste, car on affiche la liste 
    //après une suppression
    require $path . '/controler/control_nut_list.php';
    
} else {
    echo 'Le silence est d\'or';
}