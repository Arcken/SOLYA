<?php

/*
 *  Script s'occupant de la vérification de l'utilisateur
 */
try{
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
    if (!empty($res) && isset($res) && $res->ut_actif == 1) {
        $_SESSION['name']     = $res->ut_prenom;
        $_SESSION['lastname'] = $res->ut_nom;        
        $_SESSION['auth']     = TRUE;
        $_SESSION['group']    = $res->grp_nom;
        $_SESSION['login']    = $_REQUEST['login'];
        $_SESSION['msg']      = array("","","","","");
        $_SESSION['token']    = '0';
        //on rappel controler.php car la connection est effectuée
        require $path . '/controler/control.php';
    }

    // sinon c'est que le compte est inexistant ou désactivé
    else {
        echo "Erreur de login, compte inexistant ou désactivé.";
    }
}
}catch (Exception $e){
    echo 'test';
    echo $e->getCode();
}