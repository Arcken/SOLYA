<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require_once $path . '/model/Utilisateur.php';
    require_once $path . '/model/UtilisateurManager.php';
    require_once $path . '/model/Groupe.php';
    require_once $path . '/model/GroupeManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {

        //Si la modification ne se fait pas le manager léve un exception
        try {

            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête
                $oUtilisateur = new Utilisateur();

                $oUtilisateur->ut_login = $_REQUEST['utLogin'];
                $oUtilisateur->ut_nom = $_REQUEST['utNom'];
                $oUtilisateur->ut_prenom = $_REQUEST['utPrenom'];
                $oUtilisateur->ut_pass = $_REQUEST['utPass'];
                $oUtilisateur->ut_actif = $_REQUEST['utActif'];
                $oUtilisateur->grp_id = $_REQUEST['Groupe'];

                $resUpdUtilisateur = UtilisateurManager::updUtilisateur($oUtilisateur);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de l\'utilisateur: "'
                        . $oUtilisateur->ut_login
                        . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }

            //Rappel du controleur de la liste, après update on appel view_ut_list
            //et redéfinition de $sAction

            $sAction = "utilisateur_list";
            require_once $path . '/controler/control_ut_list.php';
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification utilisateur, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);

        //Sinon on est dans l'affichage du détail
    } else {

        try {
            
            $sPageTitle = "Détail de l'utilisateur";
            //On révupére les valeurs pour la combobox
            $resAllGroupes = GroupeManager::getAllGroupes();
            //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
            if (isset($_REQUEST['utLogin']) && $_REQUEST['utLogin'] != '') {
                $resUtilisateur = UtilisateurManager::getUtilisateurDetailForUpd($_REQUEST['utLogin']);
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


    