<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    try {
        $sPageTitle = "Liste des fiches articles";
        require_once $path . '/model/FicheArticle.php';
        require_once $path . '/model/FicheArticleManager.php';

        //Compte le nombre d'enregistrements de la table pour l'affichage par page
        $iTotal = Tool::getCountTable('fiche_article');
        
        //Si un champs de tri est défini on exécute la requète avec tri
        if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
            $orderby = $_REQUEST['orderby'];
            $resFiartList = FicheArticleManager::getAllFichesArticlesLim($limite, $iNbPage, $orderby);
        }
        //Sinon sans tri
        else {
            $resFiartList = FicheArticleManager::getAllFichesArticlesLim($limite, $iNbPage);
        }
    } catch (MySQLException $e) {
        $msg = $resEr[1];
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}
