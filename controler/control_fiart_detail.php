<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$sPageTitle = "Détail de la fiche N°".$_REQUEST['fiartId'];

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
require_once $path . '/inc/Tool.inc';

if (isset($_REQUEST['fiartId'])) {
    $iFiartId = $_REQUEST['fiartId'];
    $resFiartDetail = FicheArticleManager::getFicheArticleDetailUpd($iFiartId);
    $resAllPays = PaysManager::getAllPays();
    $resAllGamme = GammeManager::getAllGammes();
    $resRegrouperFiart = RegrouperManager::getRegrouperFiart($iFiartId);
    $resAllNut = NutritionManager::getAllNutritions();
    $resNutFiart = InformerManager::getFiartInformer($iFiartId);

    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        $cnx = Connection::getConnection();
        //début de transaction
        $cnx->beginTransaction();

        try {
            $oFiArt = new FicheArticle();
            //Récupère l'ancienne liste de photos
            $oFiArt->fiart_photos = $_REQUEST['fiartPhotos'];

            //Traitement des uploads de photos

            if (!empty($_FILES) && $_FILES['img_upload']['name'][0] != '') {
                $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension);

                //On intégre la lste des nouvelles photos avec l'ancienne
                if ($resFiartDetail->fiart_photos != '') {
                    echo "photos deja existante";
                    $oFiArt->fiart_photos = $resFiartDetail->fiart_photos . ',' . implode(',', $resPhoto);
                } else {
                    echo "aucune photos existante";
                    $oFiArt->fiart_photos = implode(',', $resPhoto);
                }
            }
            if (isset($_REQUEST['fiartPhotosPref'])){
                $oFiArt->fiart_photos_pref = $_REQUEST['fiartPhotosPref'];
            }
            $oFiArt->fiart_id = $_REQUEST['fiartId'];
            $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
            $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
            $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
            $oFiArt->fiart_pays_id = $_REQUEST['pays'];
            $oFiArt->fiart_com = $_REQUEST['fiartCom'];
            $oFiArt->fiart_com_tech = $_REQUEST['fiartComTech'];
            $oFiArt->fiart_com_util = $_REQUEST['fiartComUtil'];
            $oFiArt->fiart_desc_fr = $_REQUEST['fiartDescFr'];
            $oFiArt->fiart_desc_eng = $_REQUEST['fiartDescEng'];
            $oFiArt->fiart_desc_esp = $_REQUEST['fiartDescEsp'];

            //Maj de la fiche article
            FicheArticleManager::updFicheArticle($oFiArt);

            //Effacement des enregistrements concernant cette fiche dans la table Regrouper
            RegrouperManager::delRegrouperFiart($oFiArt->fiart_id);
            //Effacement des enregistrements concernant cette fiche dans la table Informer
            InformerManager::delInformerFiart($oFiArt->fiart_id);

            //Insertion des nouvelles valeurs pour les Gammes
            foreach ($_REQUEST['gamme'] as $value) {
                $oRegrouper = new Regrouper();

                $oRegrouper->fiart_id = $oFiArt->fiart_id;
                $oRegrouper->ga_id = $value;
                RegrouperManager::addRegrouper($oRegrouper);
            }

            //Insertion des nouvelles valeurs pour les Nutritions
            foreach ($resAllNut as $object) {

                if ((isset($_REQUEST['nut' . $object->nut_id]) && $_REQUEST['nut' . $object->nut_id] != '') || (isset($_REQUEST['nutAjr' . $object->nut_id]) && $_REQUEST['nutAjr' . $object->nut_id] != '')) {
                    $oInformer = new Informer();
                    $oInformer->fiart_id = $oFiArt->fiart_id;
                    $oInformer->nut_id = $object->nut_id;
                    $oInformer->nutfiart_ajr = $_REQUEST['nutAjr' . $object->nut_id];
                    $oInformer->nutfiart_val = $_REQUEST['nut' . $object->nut_id];
                    InformerManager::addInformer($oInformer);
                }
            }
            $cnx->commit();
            $resMessage = "<font color='green'> La modification de la fiche article N° $oFiArt->fiart_id
                 intitulée: $oFiArt->fiart_lbl est un succés</font>";
            
        } catch (MySQLException $e) {

            $cnx->rollback();
            $resMessage = "<font color='red'> La modification de la fiche article N° $oFiArt->fiart_id
                 intitulée: $oFiArt->fiart_lbl a échoué</font>";
        }
    }
}
$sButton = "Modifier";
