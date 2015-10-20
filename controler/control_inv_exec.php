<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Executer') {
        //les managers des objet lèvent une exception lorsque la requète échoue
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Instanciation de la connection
                $cnx = Connection::getConnection();

                //Démarrage de la transaction
                $cnx->beginTransaction();
                
                //MAJ de l'inventaire
                //Comme le code est commun avec le controleur inv_exec, le code
                //est écrit dans un autre fichier qui sera appelé 
                //par les deux contrôleurs
                require_once $path . '/controler/control_inv_upd_exec_content.php';
                
                //La requète s'est effectué donc on commit la transaction
                $cnx->commit();

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' L\'exécution de l\'inventaire N°: "'
                        . $invId
                        . '" intitulé "' . $oLiginv->liginv_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
            } else {
                //Message en cas de formulaire déja envoyé
                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }
            //Rappel du controleur de la liste, après update on appel view_inv_list
            //et redéfinition de $sAction

            $sAction = "inv_list";
            require_once $path . '/controler/control_inv_list.php';
        } catch (MySQLException $e) {
            echo $e->RetourneErreur();
            $cnx->rollback();
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec exécution inventaire, code: '
                    . $resEr . '</p>';
        }
        //On insert le message dans le tableau de message
        Tool::addMsg($msg);
    }
} else {
    echo 'le silence est d\'or';
}    