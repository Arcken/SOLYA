<?php



//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Ajouter inventaire";
    
    require_once $path . '/model/LotManager.php';
    require_once $path . '/model/ReferenceManager.php';
    require_once $path . '/model/Inventaire.php';
    require_once $path . '/model/InventaireManager.php';
    require_once $path . '/model/LigneInventaire.php';
    require_once $path . '/model/LigneInventaireManager.php';

    //On récupère tous les lots en stock
    $resStock = LotManager::getLotStock();

    //pour chaque lot on récupére le ref_code de la référence que l'on stock
    //dans un tableau, l'indexation est la même que le tableau $resStock
    foreach ($resStock as $lot) {
        $resStockRefCode[] = ReferenceManager::getRefCode($lot->ref_id)->ref_code;
    }

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Si l'insert ne se fait pas le manager léve un exception
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Récupération de la connection
                $cnx = Connection::getConnection();

                //Démarrage de la transaction
                $cnx->beginTransaction();

                //Création de l'inventaire
                $oInventaire = new Inventaire();

                //Hydratation de l'objet avec les valeurs de l'url
                $oInventaire->inv_date = $_REQUEST['invDate'];
                $oInventaire->inv_lbl = $_REQUEST['invLbl'];

                //On insert l'inventaire
                $resInventaire = InventaireManager::addInventaire($oInventaire);

                //On récupére l'id de l'insert
                $invId = Connection::dernierId();

                //-----------------Gestion des lignes du formulaire-------------------------
                //Création des tableaux contenant toutes les informations
                //Un tableau par type de champs
                //Tableaux pour la table ligne_inventaire
                //On récupére uniquement le lot_id et le libellé de la ligne
                $tLiginvLotId = $_REQUEST['lotId'];
                $tLiginvLbl = $_REQUEST['liginvLbl'];                

                //On rassemble les tableaux dans un seul
                $tLigneForm = [
                    'lot_id' => $tLiginvLotId,
                    'liginv_lbl' => $tLiginvLbl
                        ];

                //Boucle pour insérer les lignes
                //On ignore la première ligne, c'est le squelette de construction 
                //pour l'ajout de ligne dans l'inventaire
                //La limite étant le nombre de ligne remplie on prend lot_id comme témoin
                for ($i = 1; $i < (count($tLigneForm['lot_id'])); $i++) {
                
                    //On hydrate un objet ligne inventaire
                    $oLiginv = new LigneInventaire();
                    $oLiginv->lot_id = $tLigneForm['lot_id'][$i];
                    $oLiginv->liginv_lbl = $tLigneForm['liginv_lbl'][$i];
                    $oLiginv->inv_id = $invId;
                    print_r($oLiginv);
                    //On insert la ligne
                    $resLiginv = LigneInventaireManager::addLigneInventaire($oLiginv);
                }
                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'enregistrement de l\'inventaire: "'
                        . $invId
                        . '" intitulé "' . $oInventaire->inv_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
                //on valide le formulaire
                $cnx->commit();
                
            } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
        } catch (MySQLException $e) {
            echo ($e->RetourneErreur());
            //on annule la transaction
            $cnx->rollback();
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec insert Inventaire, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}