<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sPageTitle = "Liste des fiches articles";
require_once $path . '/model/FicheArticle.php';
require_once $path . '/model/FicheArticleManager.php';

$iTotal = Tool::getCountTable('fiche_article');

if (isset($_REQUEST['orderby']) && $_REQUEST['orderby'] != '') {
    $orderby =  $_REQUEST['orderby'];
    $resFiartList = FicheArticleManager::getAllFichesArticlesLim($limite,$iNbPage,$orderby);
}
else $resFiartList = FicheArticleManager::getAllFichesArticlesLim($limite,$iNbPage);


