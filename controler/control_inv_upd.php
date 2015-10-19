<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //on récupére l'id de l'inventaire
    $invId = $_REQUEST['invId'];

    //inclut les managers et leurs objets
    require_once $path . '/model/Inventaire.php';
    require_once $path . '/model/InventaireManager.php';
    require_once $path . '/model/LigneInventaire.php';
    require_once $path . '/model/LigneInventaireManager.php';
    require_once $path . '/model/Lot.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/ReferenceManager.php';
    
    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
           // if ($_SESSION['token'] != $_REQUEST['token']) {

                //Instanciation de la connection
                $cnx = Connection::getConnection();

                //Démarrage de la transaction
                $cnx->beginTransaction();

                //-----------------Gestion des lignes du formulaire-----------------
                //Création des tableaux contenant toutes les informations
                //Un tableau par type de champs
                
                //On récupére l'id de l'inventaire
                $invId = $_REQUEST['invId'];

                //Tableaux pour la table ligne_inventaire
                
                $tLiginvId = $_REQUEST['liginvId'];
                $tLiginvLbl = $_REQUEST['liginvLbl'];
                
                $tLiginvQtStock = $_REQUEST['liginvQtStock'];
                $tLiginvQtReel = $_REQUEST['liginvQtReel'];
                
                //Tableaux pour la table lot
                $tLotId = $_REQUEST['lotId'];

                //Tableau de ligne de formulaire
                $tLigneForm = [
                    'liginv_id' => $tLiginvId,
                    'liginv_lbl' => $tLiginvLbl,
                    'liginv_qt_reel' => $tLiginvQtReel,
                    'lot_id' => $tLotId
                ];

                //Boucle pour traiter les lignes
                //On ignore la première ligne, c'est le squelette de construction 
                //pour l'ajout de ligne d'inventaire                
                //La limite étant le nombre de ligne remplie 
                //on prend lot_id comme témoin
                
                //On hydrate un objet inventaire
                $oInventaire = new Inventaire();
                $oInventaire->inv_id = $invId;
                $oInventaire->inv_date = $_REQUEST['invDate'];
                $oInventaire->inv_lbl = $_REQUEST['invLbl'];
                
                //On met à jour le bon
                $resInventaire = InventaireManager::updInventaire($oInventaire);
                
                for ($i = 1; $i < (count($tLigneForm['lot_id'])); $i++) {
                    
                     //On hydrate un objet ligne inventaire
                    $oLiginv = new LigneInventaire();
                    $oLiginv->lot_id = $tLigneForm['lot_id'][$i];
                    $oLiginv->liginv_lbl = $tLigneForm['liginv_lbl'][$i];
                    $oLiginv->liginv_qt_reel = $tLigneForm['liginv_qt_reel'][$i];
                    $oLiginv->inv_id = $invId;
                    
                    //Si la case liginv_id est != '' c'est un update
                    if ($tLigneForm['liginv_id'][$i] != '') {
                        echo 'update';
                        //On récupére l'id de la ligne                        
                        $oLiginv->liginv_id = $tLigneForm['liginv_id'][$i];
                        print_r($oLiginv);
                        //On update la ligne
                        $resLiginv = LigneInventaireManager::updLigneInventaire($oLiginv);
                
                        //Sinon c'est que c'est un insert    
                    } else {
                        echo 'insert';
                        //on insert la ligne inventaire
                        $resLiginv = LigneInventaireManager::addLigneInventaire($oLiginv);
                    }
                }
                //La requète s'est effectué donc on commit la transaction
                $cnx->commit();
               
                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de l\'inventaire N°: "'
                        . $invId
                        . '" intitulé "' . $oLiginv->liginv_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
        /*    } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            } */
            //Rappel du controleur de la liste, après update on appel view_be_list
            //et redéfinition de $sAction

            $sAction = "inv_list";
            require_once $path . '/controler/control_inv_list.php';
        } catch (MySQLException $e) {
             $cnx->rollback();
            echo ($e->RetourneErreur());
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification inventaire, code: '
                    . $resEr . '</p>';
           
        }
        //On insert le message dans le tableau de message
        Tool::addMsg($msg);

        //Sinon on est dans l'affichage du détail
    } else {

        try {
             $sButton = 'Modifier';
             
            //On définit le titre
            $sPageTitle = "Modifier l'inventaire N°" . $invId;

            //On récupére les détails de l'inventaire
            $resInventaireDetail = InventaireManager::getInventaireDetailForUpd($invId);

            //On récupére toutes les lignes de l'inventaire
            $resAllLigneInventaire = LigneInventaireManager::getLigneInventairesFromInventaireForUpd($invId);
            //On vérifie que $resAllLigneInventaire soit bien un tableau 
            //(si aucune donnée, ce n'est pas un tableau)
            
            if (is_array($resAllLigneInventaire)) {
                
                //Tableau pour les lots
                $resAllLots = [];
                
                //Tableau pour les code de référence
                $resAllRefCode = [];

                //Pour chaque ligne
                foreach ($resAllLigneInventaire as $ligne) {

                    //On récupére l'id du lot
                    $liginvLotId = $ligne->lot_id;
                    //On récupére le lot de la ligne en
                    //faisant un select for update
                    $resLot = LotManager::getLotForUpd($liginvLotId);
                    
                    //On ajoute le lot au tableau de lot
                    $resAllLots[] = $resLot;
                    
                    //on récupére le refcode de la référence du lot 
                    //que l'on stock dans le tableau
                    $resAllRefCode[] = ReferenceManager::getRefCode($resLot->ref_id);
                }
            }
           
        } catch (MySQLException $e) {
            $msg = $resEr[1];
            Tool::addMsg($msg);
        }
    }
} else {
    $sPageTitle = 'Erreur de chargement';
}                            