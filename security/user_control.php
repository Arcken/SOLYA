<?php

/*
 *  Script s'occupant de la vérification de l'utilisateur
 */

//On teste si les variables sont renseignées
if (isset($_REQUEST['login']) && !empty($_REQUEST['login']) &&
        isset($_REQUEST['pwd']) && !empty($_REQUEST['pwd'])) {
    require $path . '/model/Utilisateur.php';
    require $path . '/model/UtilisateurManager.php';
    $oUser = new Utilisateur;
    $oUser->ut_login = $_REQUEST['login'];
    $oUser->ut_pass = $_REQUEST['pwd'];
    
    //On exécute alors la requête et on stock le résultat dans un objet user (UserManager.php)
    //$oUser = connect($_REQUEST['login'], $_REQUEST['pwd']);
    
    $res = UtilisateurManager::getUtilisateur($oUser);
    
    //On contrôle le résultat et on stock les valeurs dans un tableau de session si le compte est actif
    if (!empty($res) && isset($res) && $res->UT_ACTIF == 1) {
        $_SESSION['name'] = $res->UT_PRENOM;
        $_SESSION['lastname'] = $res->UT_NOM;
        $_SESSION['BTHD'] = $res->UT_DTN;
        $_SESSION['auth'] = TRUE;
        $_SESSION['group'] = $res->GRP_NOM;
        $_SESSION['login'] = $_REQUEST['login'];
    }

    // c'est que le compte est inexistant ou désactivé
    else {
        echo "Erreur de login, compte inexistant ou désactivé.";
    }
}