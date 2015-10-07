<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$sPageTitle = "Détail de la référence";
$sButton = "Modifier";

require $path . '/model/ReferenceManager.php';




$idRef = $_REQUEST['idRef'];

$rsRef = ReferenceManager::getReferenceForUpd($idRef);

require $path . '/model/ModeConservationManager.php';
require $path . '/model/DureeConservationManager.php';
require $path . '/model/FicheArticleManager.php';
require $path . '/model/TvaManager.php';
require $path . '/model/DroitDouaneManager.php';
require $path . '/model/PrixVente.php';
require $path . '/model/PrixVenteManager.php';

$toTvas = TvaManager::getAllTvas();
$toDroitDouanes = DroitDouaneManager::getAllDroitDouanes();
$toDurCons = DureeConservationManager::getAllDureeConservations();
$toModCons = ModeConservationManager::getAllModeConservations();
$toFiArts = FicheArticleManager::getAllFichesArticles();

try {
    $oPve = PrixVenteManager::getCurPrixVente($idRef);
    if ($oPve === 0) {
        $oPve = new PrixVente();
        $oPve->pve_ent = 'indéfinis';
        $oPve->pve_per = 'indéfinis';
    }

    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] === "Modifier") {
            
            require $path . '/model/Reference.php';


            $cnx = Connection::getConnection();
            $cnx->beginTransaction();

            $oRef = new Reference();

            $oRef->ref_id = $_REQUEST['idRef'];
            $oRef->dc_id = $_REQUEST['dureeConservation'];
            $oRef->cons_id = $_REQUEST['modeConservation'];
            $oRef->fiart_id = $_REQUEST['ficheArticle'];
            $oRef->dd_id = $_REQUEST['droitDouane'];
            $oRef->tva_id = $_REQUEST['tva'];
            $oRef->ref_lbl = $_REQUEST['refLbl'];
            $oRef->ref_st_min = $_REQUEST['refStMin'];
            $oRef->ref_poids_brut = $_REQUEST['refPoidsBrut'];
            $oRef->ref_poids_net = $_REQUEST['refPoidsNet'];
            $oRef->ref_emb_lbl = $_REQUEST['refEmbLbl'];
            $oRef->ref_emb_couleur = $_REQUEST['refEmbCouleur'];
            $oRef->ref_emb_vlm_ctn = $_REQUEST['refEmbVlmCtn'];
            $oRef->ref_emb_dim_lng = $_REQUEST['refEmbDimLng'];
            $oRef->ref_emb_dim_lrg = $_REQUEST['refEmbDimLrg'];
            $oRef->ref_emb_dim_ht = $_REQUEST['refEmbDimHt'];
            $oRef->ref_emb_dim_diam = $_REQUEST['refEmbDimDiam'];
            $oRef->ref_com = $_REQUEST['refCom'];
            $oRef->ref_code = strtoupper($_REQUEST['refCode']);

            if (isset($_REQUEST['refMrq'])) {
                $oRef->ref_mrq = $_REQUEST['refMrq'];
            }
//Récupère l'ancienne liste de photos
            $oRef->ref_photos = $_REQUEST['refPhotos'];

//Traitement des uploads de photos

            if (!empty($_FILES) && $_FILES['img_upload']['name'][0] != '') {
                $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension);

//On intégre la lste des nouvelles photos avec l'ancienne
                if ($rsRef->ref_photos != '') {
                    echo "photos deja existante";
                    $oRef->ref_photos = $rsRef->ref_photos . ',' 
                                        . implode(',', $resPhoto);
                } else {
                    echo "aucune photos existante";
                    $oRef->ref_photos = implode(',', $resPhoto);
                }
            }
            if (isset($_REQUEST['refPhotosPref'])) {
                $oRef->ref_photos_pref = $_REQUEST['refPhotosPref'];
            }

            if ($oPve->pve_per != $_REQUEST['pvePer'] ||
                    $oPve->pve_ent != $_REQUEST['pveEnt']) {

                $oNewPve = new PrixVente();
                $oNewPve->ref_id  = $oRef->ref_id;
                $oNewPve->pve_per = $_REQUEST['pvePer'];
                $oNewPve->pve_ent = $_REQUEST['pveEnt'];


                $resAddPve = PrixVenteManager::addPrixVente($oNewPve);
            }


            $resAddRef = ReferenceManager::updReference($oRef);
            $cnx->commit();
            
            $msg = "<p class=info>La référence " . $oRef->ref_lbl . " a été modifié "
                        . "avec succès</p>";
            Tool::addMsg($msg);
       
         $sAction='ref_list';
         require $path.'/controler/control_ref_list.php';
    }
    
} catch (MySQLException $e) {
     switch ($resEr){
            case '23000':
                $msg="<p class='erreur'>Impossible de Modifier la référence :\n'".$oRef->ref_code
                    ."'\n'".$oRef->ref_lbl."'.\nMerci de remplir le code référence avec un Code Unique</p>";
                Tool::addMsg($msg);
                break;
            
            default:
                $msg = "<p class='erreur'>Oups!Une erreur inattendue s'est produite lors de la modification de " 
                . "'$oRef->ref_lbl'"
                . ".Détail de l'érreur : \n"  
                . $resEr."</p>"
                . "Merci de rééssayer ultérieurement";
                Tool::addMsg($msg);
                break;
        }
    
    $cnx->rollback();
}
   