<?php
// Script s'occupant de la connexion utilisateur et du control de la connexion.
$saisie = false;
if (isset($_REQUEST['login']) && !empty($_REQUEST['login']) &&
        isset($_REQUEST['pwd']) && !empty($_REQUEST['pwd'])) {
    $saisie = true;
    
    
    $oUser = connect($_REQUEST['login'],$_REQUEST['pwd']);
    
    if (!empty($oUser) && isset($oUser) && $oUser->UT_ACTIF == 1 && $saisie) {
        $_SESSION['name'] = $oUser->UT_PRENOM;
        $_SESSION['lastname'] = $oUser->UT_NOM;
        $_SESSION['BTHD'] = $oUser->UT_DTN;
        $_SESSION['auth'] = TRUE;
        $_SESSION['group'] = $oUser->GRP_NOM;
        $_SESSION['login'] = $_REQUEST['login'];
        }
    }
    else if ($saisie) echo "Erreur de login, compte inexistant.";
    ?>