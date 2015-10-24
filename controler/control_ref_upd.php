<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$sPageTitle = "Détail de la référence";
$sButton = "Modifier";

require $path . '/model/ReferenceManager.php';



//On récupère idRef qui correspond à l'id de la référence
$idRef = $_REQUEST['idRef'];

//On récupère la référence pour la mettre a jour
$rsRef = ReferenceManager::getReferenceForUpd($idRef);

require $path . '/model/ModeConservationManager.php';
require $path . '/model/DureeConservationManager.php';
require $path . '/model/FicheArticleManager.php';
require $path . '/model/TvaManager.php';
require $path . '/model/DroitDouaneManager.php';
require $path . '/model/PrixVente.php';
require $path . '/model/PrixVenteManager.php';

//On va chercher toutes les tvas
$toTvas = TvaManager::getAllTvas();
//On va chercher toutes les droit de douanes
$toDroitDouanes = DroitDouaneManager::getAllDroitsDouanes();
//On va chercher toutes les durée de conservation
$toDurCons = DureeConservationManager::getAllDureesConservations();
//On va chercher toutes les modes de conservations
$toModCons = ModeConservationManager::getAllModesConservations();
//On va chercher toutes les fiches articles
$toFiArts = FicheArticleManager::getAllFichesArticles();
//Pour charger les comboboxs
try {
    //On va chercher le prix de vente actuel
    $oPve = PrixVenteManager::getCurPrixVente($idRef);
    //Si aucun éxiste on construit un objet avec pour valeurs indéfinis
    if ($oPve === 0) {
        $oPve = new PrixVente();
        $oPve->pve_ent = 'indéfinis';
        $oPve->pve_per = 'indéfinis';
    }
//Si le bouton du formulaire est définis et que sa valeur est = à modifier
    if (isset($sButtonUt) && $sButtonUt === "Modifier") {
        //Si le formulaire n'a pas déja été envoyé
         if ($_SESSION['token'] != $_REQUEST['token']) {    
            require $path . '/model/Reference.php';

            //On récupère la connexion 
            $cnx = Connection::getConnection();
            //On commence une nouvelle transaction
            $cnx->beginTransaction();
            
            //On crée une nouvelle référence
            $oRef = new Reference();
            //On hydrate la référence
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
            $oRef->ref_code_douane=$_REQUEST['refCodeDouane'];
            //On controle si la marque est bien définis
            if (isset($_REQUEST['refMrq'])) {
                $oRef->ref_mrq = $_REQUEST['refMrq'];
            }
            
            //Récupère l'ancienne liste de photos
            $oRef->ref_photos = $_REQUEST['refPhotos'];

            //Traitement des uploads de photos

            if (!empty($_FILES) && $_FILES['img_upload']['name'][0] != '') {
                $resPhoto = Tool::uplImg($imgPath, $imgMiniPath, $imgExtension);

                //On intégre la liste des nouvelles photos avec l'ancienne
                if ($rsRef->ref_photos != '') {
                    echo "photos deja existante";
                    $oRef->ref_photos = $rsRef->ref_photos . ',' 
                                        . implode(',', $resPhoto);
                } else {
                    echo "aucune photos existante";
                    $oRef->ref_photos = implode(',', $resPhoto);
                }
            }
            //Si une photos preféré est choisis on remplace la valeur dans l'objet
            if (isset($_REQUEST['refPhotosPref'])) {
                $oRef->ref_photos_pref = $_REQUEST['refPhotosPref'];
            }
            //Si le prix de vente pour particulier ou celui des entreprise est différent
            //de celui ancienement entré
            $resAddPve=0;
            
            if ($oPve->pve_per != $_REQUEST['pvePer'] ||
                    $oPve->pve_ent != $_REQUEST['pveEnt']) {
                
                //On en créé un nouveau
                $oNewPve = new PrixVente();
                $oNewPve->ref_id  = $oRef->ref_id;
                $oNewPve->pve_per = $_REQUEST['pvePer'];
                $oNewPve->pve_ent = $_REQUEST['pveEnt'];

                //Et on fait un insert
                $resAddPve = PrixVenteManager::addPrixVente($oNewPve);
                
            }

            //On effectue la mise à jour de la référence
            $resAddRef = ReferenceManager::updReference($oRef);
            //On commit la transaction
            $cnx->commit();
            
            if($resAddRef > 0 || $resAddPve > 0){
                //si le résultat ramené est supérieur à 0 une modification à bien était apporté 
                //donc on ajoute un message
            $msg = "<p class=info>".date('H:i:s')." La référence " . $oRef->ref_lbl . " a été modifié "
                        . "avec succès</p>";
            
            }
            //On met le token du formulaire dans celui de la session
            //vue que la modification est un succés
         $_SESSION['token']=$_REQUEST['token'];
         //Et on rappel la liste de référence
         $sAction='ref_list';
         require $path.'/controler/control_ref_list.php';
         
    }else{
        // le token session étant égale au token du formulaire
        //On renvoie un message disant que le formulaire à déja était ajouté
        $msg = "<p class= 'erreur'> " . date('H:i:s')."
                Vous avez déja envoyé ce formulaire </p>";
    }
    Tool::addMsg($msg);
  } 
} catch (MySQLException $e) {
    $cnx->rollback();
    $msg = "<p class='erreur'> ". date('H:i:s') 
                    . " Echec Modification de la référence. Code :"
                    . $resEr[0] . " Message : $resEr[1]"
                    . "</p>";
    Tool::addMsg($msg);
}
   