<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    $sPageTitle = "Ajouter une gamme";
    require_once $path . '/model/Gamme.php';
    require_once $path . '/model/GammeManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
        //Si l'insert ne se fait pas le manager léve un exception
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oGa = new Gamme();
                $oGa->ga_lbl = $_REQUEST['gaLbl'];
                $oGa->ga_abv = strtoupper($_REQUEST['gaAbv']);

                $result = GammeManager::addGamme($oGa);

                //On récupére l'id de l'insert
                $id = Connection::dernierId();

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'enregistrement de la gamme: "'
                        . $id
                        . '" intitulé "' . $oGa->ga_lbl . '" à été effectué '
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
                    . ' Echec insert Gamme, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    }
} else {
    echo 'Le silence est d\'or';
}
