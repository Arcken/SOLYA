<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si une requéte échoue, une exception est levé par la manager
    try {
        
        require $path . '/model/Gamme.php';
        require $path . '/model/GammeManager.php';
        require $path . '/model/Pays.php';
        require $path . '/model/PaysManager.php';
        require $path . '/model/Nutrition.php';
        require $path . '/model/NutritionManager.php';

        $resAllGa = GammeManager::getAllGammes();
        $resAllPays = PaysManager::getAllPays();
        $resAllNut = NutritionManager::getAllNutritions();
        
        //Si le formulaire est envoyé
        if ($sButtonUt == "Envoyer") {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //début de transaction si une erreur survient une exception est levée
                //suivie d'un rollback
                $cnx = Connection::getConnection();
                $cnx->beginTransaction();

                require $path . '/model/FicheArticle.php';
                require $path . '/model/FicheArticleManager.php';

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête
                $oFiArt = new FicheArticle();

                //On hydrate l'objet avec les paramètres de l'url
                $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];

                $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
                $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
                $oFiArt->pays_id = $_REQUEST['pays'];
                $oFiArt->fiart_com = $_REQUEST['fiartCom'];
                $oFiArt->fiart_com_tech = $_REQUEST['fiartComTech'];
                $oFiArt->fiart_com_util = $_REQUEST['fiartComUtil'];
                $oFiArt->fiart_desc_fr = $_REQUEST['fiartDescFr'];
                $oFiArt->fiart_desc_eng = $_REQUEST['fiartDescEng'];
                $oFiArt->fiart_desc_esp = $_REQUEST['fiartDescEsp'];

                //traitement photos
                $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension);
                if (count($resPhoto) > 0 && $resPhoto[0] != '') {
                    $oFiArt->fiart_photos = implode(',', $resPhoto);
                    $oFiArt->fiart_photos_pref = $resPhoto[0];
                }

                //on exécute la requête d'insert de la fiche article
                FicheArticleManager::addFicheArticle($oFiArt);

                //On récupère l'id du dernier insert de la fiche article
                $oFiArt->fiart_id = Connection::dernierId();

                require $path . '/model/RegrouperManager.php';
                require $path . '/model/Regrouper.php';

                //Pour chaque valeur de gamme récupérée 
                //on l'insert dans la table
                foreach ($_REQUEST['gamme'] as $value) {

                    $oRegrouper = new Regrouper();

                    $oRegrouper->fiart_id = $oFiArt->fiart_id;
                    $oRegrouper->ga_id = $value;

                    RegrouperManager::addRegrouper($oRegrouper);
                }

                require $path . '/model/InformerManager.php';
                require $path . '/model/Informer.php';

                //On vérifie pour chaque champ de nutrition, la valeur soit !=0
                //Comme les input du formulaires sont générés dynamiquement, 
                //leur nom est:
                //la concaténation de 'nut' et de leur id pour les id, 
                //et de 'nutAjr' et de leur id pour les valeurs

                foreach ($resAllNut as $object) {
                    //on vérifie que pour une nutrition sa valeur 
                    //ou son AJR soir renseigné et on fait un insert selon le cas
                    if ((isset($_REQUEST['nut' . $object->nut_id]) 
                            && $_REQUEST['nut' . $object->nut_id] != '') 
                            || (isset($_REQUEST['nutAjr' . $object->nut_id]) 
                                    && $_REQUEST['nutAjr' . $object->nut_id] != '')) {

                        $oInformer = new Informer();
                        $oInformer->fiart_id = $oFiArt->fiart_id;
                        $oInformer->nut_id = $object->nut_id;

                        if (isset($_REQUEST['nutAjr' . $object->nut_id])) {
                            $oInformer->nutfiart_ajr = $_REQUEST['nutAjr' . $object->nut_id];
                        }

                        if (isset($_REQUEST['nut' . $object->nut_id])) {
                            $oInformer->nutfiart_val = $_REQUEST['nut' . $object->nut_id];
                        }

                        //on exécute la requête si une deux deux valeurs est non nul
                        if ($oInformer->nutfiart_ajr != '' 
                                || $oInformer->nutfiart_val != '') {
                            InformerManager::addInformer($oInformer);
                        }
                    }
                }

                //La requète s'est effectué donc on commit la transaction
                $cnx->commit();

                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'enregistrement de la fiche article N° "'
                        . $oFiArt->fiart_id
                        . '" intitulé "' . $oFiArt->fiart_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
            } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
        }
    } catch (MySQLException $e) {
        //Message pour l'erreur
        $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                . ' Echec insert fiche article, code: '
                . $resEr[0] . ' Message: ' . $resEr[1] . '</p>';
    }

    //On insert le message dans le tableau de message
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}