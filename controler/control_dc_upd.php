<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require $path . '/model/DureeConservation.php';
    require $path . '/model/DureeConservationManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Si la modification ne se fait pas le manager léve un exception
        try {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oDc = new DureeConservation();
                $oDc->dc_id = $_REQUEST['dcId'];
                $oDc->dc_lbl = $_REQUEST['dcLbl'];
                $oDc->dc_nb = $_REQUEST['dcNb'];

                $resUpdGamme = DureeConservationManager::updDureeConservation($oDc);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de la durée de conservation: "'
                        . $oDc->dc_id
                        . '" intitulé "' . $oDc->dc_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            
            //Rappel du controleur de la liste, après update on appel view_ga_list
            //et redéfinition de $sAction
            
            $sAction = "dc_list";
            require_once $path . '/controler/control_dc_list.php';
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification Durée de conservation, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
        
    //Sinon on est dans l'affichage du détail
    } else {
        //On définit le titre
        $sPageTitle = "Détail de la durée de conservation";
        //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
        if (isset($_REQUEST['dcId']) && $_REQUEST['dcId'] != '') {
            $resDcDetail = DureeConservationManager::getDureeConservationDetailForUpd($_REQUEST['dcId']);
            $sButton = 'Modifier';
        }
    }
} else {
    echo 'Le silence est d\'or';
}
