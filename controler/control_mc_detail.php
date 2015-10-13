<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        
         //Si la modification ne se fait pas le manager léve un exception
        try {
            
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {
                
            require $path . '/model/ModeConservation.php';
            require $path . '/model/ModeConservationManager.php';
        
            //Les valeurs sont vérifiées à la saisie
            //On créé un objet contenant les valeurs que l'on passe en paramètre 
            //à la requête
            
            $oMc = new ModeConservation();
            $oMc->cons_lbl = $_REQUEST['consLbl'];
            $result = ModeConservationManager::addModeConservation($oMc);

            //Message pour le succés
            $msg = '<p class=\'info\'>' . date('H:i:s')
                    . ' La modification du mode de conservation:'
                    . ' intitulé "' . $oMc->cons_lbl . '" à été effectué'
                    . ' avec succès </p>';
            
            //La requète s'est effectué donc on copie le token dans la session
            $_SESSION['token'] = $_REQUEST['token'];
                
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification Mode conservation, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    } else {
        $sPageTitle = "Détail du mode de conservation";
        if (isset($_REQUEST['consId']) && $_REQUEST['consId'] != '') {
            $resMcDetail = ModeConservationManager::getModeConservationDetailUpd($_REQUEST['consId']);
            $sButton = 'Modifier';
        }
    }
} else {
    echo 'Le silence est d\'or';
}
