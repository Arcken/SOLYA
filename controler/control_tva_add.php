<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Ajouter une tva";
    require_once $path . '/model/Tva.php';
    require_once $path . '/model/TvaManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Si l'insert ne se fait pas le manager léve un exception
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oTva = new Tva();
                $oTva->tva_lbl = $_REQUEST['tvaLbl'];
                $oTva->tva_taux = $_REQUEST['tvaTaux'];

                $result = TvaManager::addTva($oTva);

                //On récupére l'id de l'insert
                $id = Connection::dernierId();

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'enregistrement de la TVA: "'
                        . $id
                        . '" intitulé "' . $oTva->tva_lbl . '" a été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
            } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec insert TVA, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}
