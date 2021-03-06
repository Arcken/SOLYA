<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require_once $path . '/model/Groupe.php';
    require_once $path . '/model/GroupeManager.php';
    require_once $path . '/model/Utilisateur.php';
    require_once $path . '/model/UtilisateurManager.php';

    $sPageTitle = "Ajouter un utilisateur";

    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

        //Si la modification ne se fait pas le manager léve un exception
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête
                $oUtilisateur = new Utilisateur();
                $oUtilisateur->ut_login = $_REQUEST['utLogin'];
                $oUtilisateur->ut_pass = $_REQUEST['utPass'];
                $oUtilisateur->ut_nom = $_REQUEST['utNom'];
                $oUtilisateur->ut_prenom = $_REQUEST['utPrenom'];
                $oUtilisateur->ut_actif = $_REQUEST['utActif'];
                $oUtilisateur->grp_id = $_REQUEST['Groupe'];

                $resUtilisateur = UtilisateurManager::addUtilisateur($oUtilisateur);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'enregistrement de l\'utilisateur: "'
                        . $oUtilisateur->ut_login
                        . '" à été effectué '
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
                    . ' Echec insert utilisateur, code: '
                    . $resEr[0] . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    } else {

        try {
            //On récupére les valeurs pour la combobox
            $resAllGroupes = GroupeManager::getAllGroupes();
        } catch (MySQLException $e) {
            $msg = $resEr[1];
            Tool::addMsg($msg);
        }
    }
} else {
    echo 'Le silence est d\'or';
}
