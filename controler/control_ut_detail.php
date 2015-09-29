<?php

require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';
require_once $path . '/model/Groupe.php';
require_once $path . '/model/GroupeManager.php';

if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
    $oUtilisateur = new Utilisateur();
    $oUtilisateur->ut_login = $_REQUEST['utLogin'];
    $oUtilisateur->ut_nom = $_REQUEST['utNom'];
    $oUtilisateur->ut_prenom = $_REQUEST['utPrenom'];
    $oUtilisateur->ut_pass = $_REQUEST['utPass'];
    $oUtilisateur->ut_actif = $_REQUEST['utActif'];
    $oUtilisateur->grp_id = $_REQUEST['Groupe'];
    $resUpdUtilisateur = UtilisateurManager::updUtilisateur($oUtilisateur);
    print_r($resUpdUtilisateur);
    if ($resUpdUtilisateur == 1) {
        $resMessage = "<font color='green'> La modification de l'utilisateur $oUtilisateur->ut_login
                  est un succés</font>";
        $sPageTitle = "Liste des utilisateurs";
    } else {
        $resMessage = "<font color='red'> La modification de l'utilisateur $oUtilisateur->ut_login
                  est un echec</font>";
    }
    $resAllUtilisateurs = UtilisateurManager::getAllUtilisateurs();
} else {
    $sPageTitle = "Détail de l'utilisateur";
    if (isset($_REQUEST['utLogin']) && $_REQUEST['utLogin'] != '') {
        $oUtilisateur = new Utilisateur();
        $oUtilisateur->ut_login = $_REQUEST['utLogin'];
        $sButton = 'Modifier';
    }
}
$resUtilisateur = UtilisateurManager::getUtilisateurDetailUpd($oUtilisateur);
$resAllGroupes = GroupeManager::getAllGroupes();
