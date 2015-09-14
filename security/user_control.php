<?php

/*
 *  Script s'occupant de la vérification de l'utilisateur
 */

//On teste si les variables sont renseignées
if (isset($_REQUEST['login']) && !empty($_REQUEST['login']) &&
        isset($_REQUEST['pwd']) && !empty($_REQUEST['pwd'])) {

    //On exécute alors la requête et on stock le résultat dans un objet user (UserManager.php)
    $oUser = connect($_REQUEST['login'], $_REQUEST['pwd']);

    //On contrôle le résultat et on stock les valeurs dans un tableau de session si le compte est actif
    if (!empty($oUser) && isset($oUser) && $oUser->UT_ACTIF == 1) {
        $_SESSION['name'] = $oUser->UT_PRENOM;
        $_SESSION['lastname'] = $oUser->UT_NOM;
        $_SESSION['BTHD'] = $oUser->UT_DTN;
        $_SESSION['auth'] = TRUE;
        $_SESSION['group'] = $oUser->GRP_NOM;
        $_SESSION['login'] = $_REQUEST['login'];
    }

    // c'est que le compte est inexistant ou désactivé
    else {
        echo "Erreur de login, compte inexistant ou désactivé.";
    }
}