<?php

try {
    require $path . '/model/DocLibelleManager.php';
    require $path . '/model/Lot.php';
    require $path . '/model/LotManager.php';
    require $path . '/model/Bon.php';
    require $path . '/model/BonManager.php';
    require $path . '/model/Ligne.php';
    require $path . '/model/LigneManager.php';
    require $path . '/model/BonLigne.php';
    require $path . '/model/BonLigneManager.php';

    //Déffinition du titre de la page
    $sPageTitle = 'Créer un Bon';
    //Chargement des Libéllé de documents
    $resDocLbl = DocLibelleManager::getDocLibelles();

    //Controle si le formulaire a était envoyé 
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Vérification du jeton pour savoir si le formulaire à était envoyé
        if ($_SESSION['token'] != $_REQUEST['token']) {
            //On récupère la valeur de typeBon pour définir l'action à executer
            $type = $_REQUEST['typeBon'];

            switch ($type) {

                //Cas des bons de sortie
                case "1":
                case "2":
                case "3":
                case "4":
                case "5":
                case "6":
                case "7":

                    //Instanciation de la connection
                    $cnx = Connection::getConnection();

                    //Création du bon de sortie
                    $oBon = new Bon();
                    $oBon->bon_date = $_REQUEST['bonDate'];
                    $oBon->bon_fact_num = $_REQUEST['numFact'];
                    $oBon->doclbl_id = $_REQUEST['typeBon'];


                    //Démarrage de la transaction
                    $cnx->beginTransaction();

                    //Insert du bon de sortie
                    $resBon = BonManager::addBon($oBon);

                    //Récupération de l'id du bon inséré
                    $idBon = Connection::dernierId();

                    //Création des tableaux contenant toutes les informations 
                    $tabLotId = $_REQUEST['lotId'];
                    $tabLigQte = $_REQUEST['ligQte'];
                    $tabLigDepot = $_REQUEST['ligDepot'];
                    $tabLigCom = $_REQUEST['ligCom'];

                    //Création du tableau général contenant les tableaux de données
                    $tabLigAdd = array(
                        'lot_id' => $tabLotId,
                        'lig_qte' => $tabLigQte,
                        'lig_com' => $tabLigCom,
                        'lig_com_dep' => $tabLigDepot);


                    //On boucle sur le tableau en commençant à 1
                    //pour éviter la ligne caché servant de modèle aux autres lignes
                    //Toute cette étape sera répété pour autant de ligne contenue dans nos tableau
                    //Ici on se base sur lot_id pour définir la taille 
                    //mais n'importe quelle tableau contenue par $tabLigAdd ferait l'affaire
                    for ($i = 1; $i < (count($tabLigAdd['lot_id'])); $i++) {

                        $oLig = new Ligne();
                        $oLig->lot_id = $tabLigAdd['lot_id'][$i];
                        $oLig->lig_qte = $tabLigAdd['lig_qte'][$i];
                        $oLig->lig_com = $tabLigAdd['lig_com'][$i];
                        $oLig->lig_com_dep = $tabLigAdd['lig_com_dep'][$i];


                        //On ajoute la ligne
                        $resLig = LigneManager::addLigne($oLig);
                        //On récupère l'id de la ligne
                        $idLig = Connection::dernierId();
                        //On selectionne le lot à mettre à jour
                        $oLot = LotManager::getLotForUpd($oLig->lot_id);

                        //On met à jour la qté stock lot
                        $lotCurQteStk = $oLot->lot_qt_stock;
                        $oLot->lot_qt_stock = $lotCurQteStk - $oLig->lig_qte;

                        if ($oLot->lot_qt_stock < 0) {
                            $resEr = '666';
                            throw new MySQLException('Quantité retiré supérieur à quantité stock', $cnx);
                        }

                        //On appel le manager pour appliquer la modification
                        $resLot = LotManager::updQteLot($oLot);

                        //Enfin on créé notre BonLigne
                        $oBonLig = new BonLigne();
                        $oBonLig->lig_id = $idLig;
                        $oBonLig->bon_id = $idBon;
                        //Et on l'ajoute
                        BonLigneManager::addBonLigne($oBonLig);
                    }

                    //On commit la transaction
                    $cnx->commit();

                    //Ajout du message de réussite
                    $msg = '<p class=\'info\'>' . date('H:i:s') . ' L\'enregistrement du bon numéro : '
                            . $idBon . ' de type sortie à été effectué avec succès</p>';
                    

                    break;
                //Cas des bons de retour
                case "8":
                case "9":
                case "10":
                case "11":
                case "12":

                    //Instanciation de la connection
                    $cnx = Connection::getConnection();

                    //Création du bon de retour
                    $oBon = new Bon();

                    $oBon->bon_date = $_REQUEST['bonDate'];
                    $oBon->bon_fact_num = $_REQUEST['numFact'];
                    $oBon->doclbl_id = $_REQUEST['typeBon'];
                    $oBon->bon_sortie_assoc = $_REQUEST['bonSortie'];

                    //Démarrage de la transaction
                    $cnx->beginTransaction();

                    //Insert du bon de retour
                    $resBon = BonManager::addBon($oBon);

                    //Récupération de l'id du bon inséré
                    $idBon = Connection::dernierId();

                    //Création du "tableau de tableau" contenant toutes les informations 
                    $tabLotId = $_REQUEST['lotId'];
                    $tabLigQte = $_REQUEST['ligQte'];
                    $tabLigDepot = $_REQUEST['ligDepot'];
                    $tabLigCom = $_REQUEST['ligCom'];

                    $tabLigAdd = array(
                        'lot_id' => $tabLotId,
                        'lig_qte' => $tabLigQte,
                        'lig_com' => $tabLigCom,
                        'lig_com_dep' => $tabLigDepot);


                    //Toujours la même chose.
                    //On boucle sur le tableau en commençant à 1
                    //pour éviter la ligne caché servant de modèle aux autres lignes
                    //Toute cette étape sera répété pour autant de ligne contenue dans nos tableau
                    //Ici on se base sur lot_id pour définir la taille 
                    //mais n'importe quelle tableau contenue par $tabLigAdd ferait l'affaire
                    for ($i = 1; $i < (count($tabLigAdd['lot_id'])); $i++) {

                        $oLig = new Ligne();
                        $oLig->lot_id = $tabLigAdd['lot_id'][$i];
                        $oLig->lig_qte = $tabLigAdd['lig_qte'][$i];
                        $oLig->lig_com = $tabLigAdd['lig_com'][$i];
                        $oLig->lig_com_dep = $tabLigAdd['lig_com_dep'][$i];


                        //On ajoute la ligne
                        $resLig = LigneManager::addLigne($oLig);
                        //On récupère l'id de la ligne
                        $idLig = Connection::dernierId();
                        //On selectionne le lot à mettre à jour
                        $oLot = LotManager::getLotForUpd($oLig->lot_id);

                        //On controle que la valeur saisie dans l'input n'ai pas supérieur
                        //à la qt initial - la qté stk si c'est le cas on lance une exception
                        if ($oLot->lot_qt_init - $oLot->lot_qt_stock < $oLig->lig_qte) {
                            $resEr = '777';
                            throw new MySQLException('Quantité retourner supérieur au maximum attendue.'
                            . 'Quantité du stock initial : ' . $oLot->lot_qt_init .
                            ' A la Ligne : ' . $i, $cnx);
                        }

                        //On met à jour la qté stock lot
                        $lotCurQteStk = $oLot->lot_qt_stock;
                        $oLot->lot_qt_stock = $lotCurQteStk + $oLig->lig_qte;


                        //On appel le manager pour appliquer la modification
                        $resLot = LotManager::updQteLot($oLot);

                        //Enfin on créé notre BonLigne
                        $oBonLig = new BonLigne();
                        $oBonLig->lig_id = $idLig;
                        $oBonLig->bon_id = $idBon;
                        //Et on l'ajoute
                        BonLigneManager::addBonLigne($oBonLig);
                    }

                    //On commit la transaction
                    $cnx->commit();

                    //Ajout du méssage de réussite
                    $msg = '<p class=\'info\'>' . date('H:i:s') .
                            ' L\'enregistrement du bon numéro : '
                            . $idBon
                            . ' de type retour à été effectué avec succès </p>';
                    //Tool::addMsg($msg);


                    break;

                default:
                    $msg = '<p class=\'info\'>' . date('H:i:s') .
                            'Selectionner un type de bon avant d\'envoyer le formulaire';
                    
                    break;
            }
            //L'ajout s'est effectué donc on copie le token dans la session
            $_SESSION['token']=$_REQUEST['token'];
        }else{
            
            $msg = "<p class= 'erreur'> " . date('H:i:s')."
                Vous avez déja envoyé ce formulaire </p>";
            
        }
        Tool::addMsg($msg);
    }
} catch (MySQLException $e) {
    switch ($resEr) {
        case '666':
        case '777':
           
          $msg = "<p class= 'erreur'> " . date('H:i:s') . " "
                . $e->getMessage() . "</p>";
            break;

        default:
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Oups une erreur est survenue veuillez contacter'
                    . ' votre administrateur avec le code erreur suivant : '
                    . $resEr .'</p>';
            break;
    }
   $cnx->rollback();
    
    Tool::addMsg($msg);
}