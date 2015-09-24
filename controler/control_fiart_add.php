<?php

/**
 * Sous controleur ajout fiche article
 */
$sPageTitle = "Ajout de Fiche Article";
require $path . '/model/FicheArticle.php';
require $path . '/model/FicheArticleManager.php';
require $path . '/model/Gamme.php';
require $path . '/model/GammeManager.php';
require $path . '/model/Pays.php';
require $path . '/model/PaysManager.php';
require $path . '/model/Nutrition.php';
require $path . '/model/NutritionManager.php';


$resAllGa = GammeManager::getAllGammes();
$resAllPays = PaysManager::getAllPays();
$resAllNut = NutritionManager::getAllNutritions();

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

    //début de transaction
    $cnx = Connection::getConnection();
    $cnx->beginTransaction();
    try {

        $cnx = Connection::getConnection();
        //on vérifie que le libellé de la fiche article soit renseigné
        if (isset($_REQUEST['fiartLbl'])) {
            $oFiArt = new FicheArticle();

            //On hydrate l'objet avec les paramètres de l'url
            $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
            //traitement photos

            $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension);
            if (count($resPhoto) > 0 && $resPhoto[0] != '') {
                $oFiArt->fiart_photos = implode(',', $resPhoto);
                $oFiArt->fiart_photos_pref = $resPhoto[0];
                ;
            }
            $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
            $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
            $oFiArt->fiart_pays_id = $_REQUEST['pays'];
            $oFiArt->fiart_com = $_REQUEST['fiartCom'];
            $oFiArt->fiart_com_tech = $_REQUEST['fiartComTech'];
            $oFiArt->fiart_com_util = $_REQUEST['fiartComUtil'];
            $oFiArt->fiart_desc_fr = $_REQUEST['fiartDescFr'];
            $oFiArt->fiart_desc_eng = $_REQUEST['fiartDescEng'];
            $oFiArt->fiart_desc_esp = $_REQUEST['fiartDescEsp'];

            //on exécute la requête d'insert de la fiche article
            $resFiartAdd = FicheArticleManager::addFicheArticle($oFiArt);
            if ($resFiartAdd = 0)
                throw new Exception;
            //On récupère l'id du dernier insert de la fiche article
            $oFiArt->fiart_id = Connection::dernierId();
            ;

            //On vérifie que la gamme soit renseignée
            if (isset($_REQUEST['gamme']) && !empty($_REQUEST['gamme'])) {
                require $path . '/model/RegrouperManager.php';
                require $path . '/model/Regrouper.php';

                foreach ($_REQUEST['gamme'] as $value) {

                    $oRegrouper = new Regrouper();

                    $oRegrouper->fiart_id = $oFiArt->fiart_id;
                    $oRegrouper->ga_id = $value;

                    $r = RegrouperManager::addRegrouper($oRegrouper);
                    echo 'gamme ajoute ' . $r;
                }
            }

            //On vérifie pour chaque champ de nutrition, la valeur soit !=0
            //Comme les input du formulaires sont générés dynamiquement, leur nom est
            //la concaténation de nut est de l'id

            require $path . '/model/InformerManager.php';
            require $path . '/model/Informer.php';
            foreach ($resAllNut as $object) {

                if ((isset($_REQUEST['nut' . $object->nut_id]) && $_REQUEST['nut' . $object->nut_id] != '') 
                        || (isset($_REQUEST['nutAjr' . $object->nut_id]) && $_REQUEST['nutAjr' . $object->nut_id] != '')) {
                    $oInformer = new Informer();
                    $oInformer->fiart_id = $oFiArt->fiart_id;
                    $oInformer->nut_id = $object->nut_id;
                    if (isset( $_REQUEST['nutAjr' . $object->nut_id])) 
                            $oInformer->nutfiart_ajr = $_REQUEST['nutAjr' . $object->nut_id];
                    if (isset( $_REQUEST['nut' . $object->nut_id]))
                            $oInformer->nutfiart_val = $_REQUEST['nut' . $object->nut_id];

                    //on exécute la requête
                    $r = InformerManager::addInformer($oInformer);
                }
            }
        }
        $res = $cnx->commit();
        $resMessage = "<font color='green'> L'enregistrement de la fiche article N° $oFiArt->fiart_id
                 intitulée: $oFiArt->fiart_lbl est un succés</font>";
        //Avec un objet PDO si l'insert n'est pas fait, il y a une remonté d'exception
    } catch (MySQLException $e) {
        $resMessage = "<font color='green'> L'enregistrement de la fiche article est un echec</font>";
    }
}
