<?php

/**
 * Sous controleur de la suppression d'une référence
 */
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    try {

        require_once $path . '/model/ReferenceManager.php';
        require_once $path . '/model/PrixVenteManager.php';

        //On récupère les infos de la référence
        $idRef = $_REQUEST['idRef'];
        $refCode = $_REQUEST['refCode'];
        $refLbl = $_REQUEST['refLbl'];

        //On récupère la connexion
        $cnx = Connection::getConnection();
        //On démarre la transaction
        $cnx->beginTransaction();

        //On supprime les prix de ventes associés à la référence
        $resPvDel = PrixVenteManager::delPrixVentesOfRef($idRef);

        //On supprime la référence 
        $resDelRef = ReferenceManager::delReference($idRef);

        $cnx->commit();
        //Si la suppression à bien impacté un enregistrement
        //alors on ajoiute le message de réussite

        $msg = "<p class='info'>" . date('H:i:s')
                . " La référence:\n" . $refCode
                . $refLbl . " à bien était Supprimé</p>";

        require_once $path . '/controler/control_ref_list.php';
        $sAction = "ref_list";
        
    } catch (MySQLException $e) {
        $cnx->rollback();
         $msg = "<p class='erreur'> " . date('H:i:s')
                . " Echec suppresion de la référence. Code :"
                . $resEr[0] . " Message : $resEr[1]"
                . "</p>";
    }
    if (isset($msg)) {
        Tool::addMsg($msg);
    }
} else {
    echo "Le silence est d'or";
}