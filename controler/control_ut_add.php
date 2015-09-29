<?php

require_once $path . '/model/Groupe.php';
require_once $path . '/model/GroupeManager.php';
require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';
$resAllGroupes = GroupeManager::getAllGroupes();
$sPageTitle = "Ajouter un utilisateur";
if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
    try {
        $oUtilisateur = new Utilisateur();
        $oUtilisateur->ut_login = $_REQUEST['utLogin'];
        $oUtilisateur->ut_pass = $_REQUEST['utPass'];
        $oUtilisateur->ut_nom = $_REQUEST['utNom'];
        $oUtilisateur->ut_prenom = $_REQUEST['utPrenom'];
        $oUtilisateur->ut_actif = $_REQUEST['utActif'];
        $oUtilisateur->grp_id = $_REQUEST['Groupe'];

        $resUtilisateur = UtilisateurManager::addUtilisateur($oUtilisateur);

        if ($resUtilisateur == 1) {
            $resMessage = "<font color='green'> L'ajout de l'utilisateur $oUtilisateur->ut_login
                  est un succés</font>";
        } else {
            $resMessage = "<font color='red'> L'ajout de l'utilisateur $oUtilisateur->ut_login
                  est un échec, champs mal remplies</font>";
        }
    } catch (MySQLException $e) {
        $resMessage = "<font color='red'> L'ajout de l'utilisateur $oUtilisateur->ut_login
                  est un échec</font>";
    }
}
$resAllUtilisateurs = UtilisateurManager::getAllUtilisateurs();
