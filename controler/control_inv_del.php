<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si la suppression ne se fait pas le manager léve un exception
    try {
        require_once $path . '/model/InventaireManager.php';
        require_once $path . '/model/LigneInventaireManager.php';
        
        //Récupération de la connection
        $cnx = Connection::getConnection();

        //Démarrage de la transaction
        $cnx->beginTransaction();
        
        //On récupére l'id de l'inventaire
        $invId = $_REQUEST['invId'];
        
        //on efface toutes les lignes de l'inventaire
        $resDelLiginv = LigneInventaireManager::delLigneInventaireFromInventaire($invId);
        
        //On efface l'inventaire
        $resDelInv = InventaireManager::delInventaire($invId);
        
        //Message pour le succés
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . ' La suppression de l\'inventaire: "'
                . $invId
                . '" à été effectué avec succès </p>';
        // si la suppression a été effectué on met le message dans le tableau
        if ($res > 0){
            Tool::addMsg($msg);
        }
        
    } catch (MySQLException $e) {

        //Message en cas d'échec
        $msg = '<p class=\'info\'>' . date('H:i:s')
                . "L'inventaire N° " . $invId
                . " n'est pas supprimée</p>";
        //On met le message dans le tableau
        Tool::addMsg($msg);
    }
    
    //On appel le contrôleur de la liste, car on affiche la liste après une suppression
    require $path . '/controler/control_ga_list.php';
} else {
    echo 'Le silence est d\'or';
}
