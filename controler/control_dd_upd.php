<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require $path . '/model/DroitDouane.php';
    require $path . '/model/DroitDouaneManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Si la modification ne se fait pas le manager léve un exception
        try {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête

                $oDd = new DroitDouane();
                $oDd->dd_id = $_REQUEST['ddId'];
                $oDd->dd_lbl = $_REQUEST['ddLbl'];
                $oDd->dd_taux = $_REQUEST['ddTaux'];

                $resUpdDd = DroitDouaneManager::updDroitDouane($oDd);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification du droit de douane: "'
                        . $oDd->dd_id
                        . '" intitulé "' . $oDd->dd_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
                
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            
            //Rappel du controleur de la liste, après update on appel view_dd_list
            //et redéfinition de $sAction
            
            $sAction = "dd_list";
            require_once $path . '/controler/control_dd_list.php';
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification droit de douane, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
        
    //Sinon on est dans l'affichage du détail
    } else {
        try{
        //On définit le titre
        $sPageTitle = "Détail du droit de douane";
        //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
        if (isset($_REQUEST['ddId']) && $_REQUEST['ddId'] != '') {
            $resDdDetail = DroitDouaneManager::getDroitDouaneDetailForUpd($_REQUEST['ddId']);
            $sButton = 'Modifier';
        }
        } catch (MySQLException $e) {
            $msg = $resEr[1];
            Tool::addMsg($msg);
        }
    }
} else {
    echo 'Le silence est d\'or';
}
