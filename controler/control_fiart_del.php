<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/FicheArticleManager.php';

        //On exécute la requête avec les paramètres de l'url
        $res = FicheArticleManager::delFicheArticle($_REQUEST['fiartId']);
        
        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression de la fiche article: "'
                . $_REQUEST['fiartId']
                . '" à été effectué avec succès </p>';
        
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0) {
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "La fiche article N° " . $_REQUEST['fiartId']
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    
     //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_fiart_list.php';
} else {
    echo 'Le silence est d\'or';
}