<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //on récupére l'id de l'inventaire
    $invId = $_REQUEST['invId'];

    //inclut les managers et leurs objets
    require_once $path . '/model/InventaireManager.php';
    require_once $path . '/model/LigneInventaireManager.php';
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/ReferenceManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        //les managers des objet lèvent une exception lorsque la requète échoue
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Instanciation de la connection
                $cnx = Connection::getConnection();

                //Démarrage de la transaction
                $cnx->beginTransaction();

                //Comme le code est commun avec le controleur inv_exec, le code
                //est écrit dans un autre fichier qui est appelé 
                //par les deux contrôleurs
                require_once $path . '/controler/control_inv_upd_exec_content.php';
                
                //La requète s'est effectué donc on commit la transaction
                $cnx->commit();

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de l\'inventaire N°: "'
                        . $invId
                        . '" intitulé "' . $oInventaire->inv_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
            } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            //Appel du controleur de la liste, après update on appel view_inv_list
            //et redéfinition de $sAction

            $sAction = "inv_list";
            require_once $path . '/controler/control_inv_list.php';
        } catch (MySQLException $e) {
            $cnx->rollback();
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
                    //On récupére le lot de la ligne
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
    echo 'le silence est d\'or';
}                            