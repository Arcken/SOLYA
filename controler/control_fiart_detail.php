<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once $path . '/model/FicheArticle.php';
require_once $path . '/model/FicheArticleManager.php';
require_once $path . '/model/Pays.php';
require_once $path . '/model/PaysManager.php';
require_once $path . '/model/Gamme.php';
require_once $path . '/model/GammeManager.php';
require_once $path . '/model/Regrouper.php';
require_once $path . '/model/RegrouperManager.php';
require_once $path . '/model/Nutrition.php';
require_once $path . '/model/NutritionManager.php';
require_once $path . '/model/Informer.php';
require_once $path . '/model/InformerManager.php';

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
        $resMessage = "<font color='green'> La modification de la fiche article N° $oFiArt->fiart_id
                 intitulée: $oFiArt->fiart_lbl est un succés</font>";
        require_once $path . '/controler/control_fiart_list.php';
    } catch (MySQLException $e) {
        $e->RetourneErreur();
        $cnx->rollback();
        $resMessage = "<font color='red'> La modification de la fiche article N° $oFiArt->fiart_id
                 intitulée: $oFiArt->fiart_lbl a échoué</font>";
    }
}
$sButton = "Modifier";
