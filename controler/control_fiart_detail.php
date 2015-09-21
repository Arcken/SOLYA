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
require $path . '/model/Nutrition.php';
require $path . '/model/NutritionManager.php';
require $path . '/model/Informer.php';
require $path . '/model/InformerManager.php';

if (isset($_REQUEST['fiartId'])) {
    $iFiartId = $_REQUEST['fiartId'];
    $resFiartDetail = FicheArticleManager::getFicheArticleDetailUpd($iFiartId);
    $resAllPays = PaysManager::getAllPays();
    $resAllGamme = GammeManager::getAllGammes();
    $resRegrouperFiart = RegrouperManager::getRegrouperFiart($iFiartId);
    $resAllNut = NutritionManager::getAllNutritions();
    $resNutFiart = InformerManager::getFiartInformer($iFiartId);
}

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

    $cnx = Connection::getConnection();
    //début de transaction
    $cnx->beginTransaction();
    
    try {
        $oFiArt = new FicheArticle();
        $oFiArt->fiart_id = $_REQUEST['fiartId'];
        $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
        $oFiArt->fiart_photos = $_REQUEST['fiartId'];
        $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
        $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
        $oFiArt->fiart_pays_id = $_REQUEST['pays'];

        FicheArticleManager::updFicheArticle($oFiArt);
        
        RegrouperManager::delRegrouperFiart($oFiArt->fiart_id);
        InformerManager::delInformerFiart($oFiArt->fiart_id);

        foreach ($_REQUEST['gamme'] as $value) {
            $oRegrouper = new Regrouper();

            $oRegrouper->fiart_id = $oFiArt->fiart_id;
            $oRegrouper->ga_id = $value;
            RegrouperManager::addRegrouper($oRegrouper);
        }

        foreach ($resAllNut as $object) {

            if (isset($_REQUEST['nut' . $object->nut_id]) && $_REQUEST['nut' . $object->nut_id] != '') {
                $oInformer = new Informer();
                $oInformer->fiart_id = $oFiArt->fiart_id;
                $oInformer->nut_id = $object->nut_id;
                $oInformer->nutfiart_val = $_REQUEST['nut' . $object->nut_id];
                InformerManager::addInformer($oInformer);
            }
        }
         $cnx->commit();
         
    } catch (MySQLException $e) {
         $e->RetourneErreur();
        $cnx->rollback();
    }
}
$sButton = "Modifier";
