<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    require_once $path . '/model/ModeConservation.php';
    require_once $path . '/model/ModeConservationManager.php';
    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Si la modification ne se fait pas le manager léve un exception
        try {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {



                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oMc = new ModeConservation();
                $oMc->cons_id = $_REQUEST['consId'];
                $oMc->cons_lbl = $_REQUEST['consLbl'];
                $result = ModeConservationManager::updModeConservation($oMc);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification du mode de conservation: "'
                        . $oMc->cons_id . '" intitulé "' . $oMc->cons_lbl 
                        . '" à été effectué'
                        . ' avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            
            //Rappel du controleur de la liste, après update on appel view_mc_list
            //et redéfinition de $sAction
            
            $sAction = "mc_list";
            require_once $path . '/controler/control_mc_list.php';
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification Mode conservation, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
        
    //Sinon on est dans l'affichage du détail
    } else {
        //On définit le titre
        $sPageTitle = "Détail du mode de conservation";
        //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
        if (isset($_REQUEST['consId']) && $_REQUEST['consId'] != '') {
            $resMcDetail = ModeConservationManager::getModeConservationDetailForUpd($_REQUEST['consId']);
            $sButton = 'Modifier';
        }
    }
} else {
    echo 'Le silence est d\'or';
}
