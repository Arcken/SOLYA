<?php

if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $sPageTitle = "Liste des fiches articles";
    require_once $path . '/model/FicheArticle.php';
    require_once $path . '/model/FicheArticleManager.php';

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
}

