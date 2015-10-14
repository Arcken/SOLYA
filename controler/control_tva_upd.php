<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require $path . '/model/Tva.php';
    require $path . '/model/TvaManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Si la modification ne se fait pas le manager léve un exception
        try {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oTva = new Tva();
                $oTva->tva_id = $_REQUEST['tvaId'];
                $oTva->tva_lbl = $_REQUEST['tvaLbl'];
                $oTva->tva_taux = $_REQUEST['tvaTaux'];

                $resUpdTva = TvaManager::updTva($oTva);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de la TVA: "'
                        . $oTva->tva_id
                        . '" intitulé "' . $oTva->tva_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            
            //Rappel du controleur de la liste, après update on appel view_ga_list
            //et redéfinition de $sAction
            
            $sAction = "tva_list";
            require_once $path . '/controler/control_tva_list.php';
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification TVA, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
        
    //Sinon on est dans l'affichage du détail
    } else {
        //On définit le titre
        $sPageTitle = "Détail de la tva";
        //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
        if (isset($_REQUEST['tvaId']) && $_REQUEST['tvaId'] != '') {
            $resTvaDetail = TvaManager::getTvaDetailForUpd($_REQUEST['tvaId']);
            $sButton = 'Modifier';
        }
    }
} else {
    echo 'Le silence est d\'or';
}
