<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require $path . '/model/FicheArticle.php';
require $path . '/model/FicheArticleManager.php';
require $path . '/model/Pays.php';
require $path . '/model/PaysManager.php';
require $path . '/model/Gamme.php';
require $path . '/model/GammeManager.php';
require $path . '/model/Regrouper.php';
require $path . '/model/RegrouperManager.php';

if (isset($_REQUEST['fiartId'])) {
    $iFiartId = $_REQUEST['fiartId'];
    $resFiartDetail = FicheArticleManager::getFicheArticleDetail($iFiartId);
    $resAllPays = PaysManager::getAllPays();
    $resAllGamme = GammeManager::getAllGammes();
    $resRegrouperFiart = RegrouperManager::getRegrouperFiart($iFiartId);
}
$sButton = "Modifier";

