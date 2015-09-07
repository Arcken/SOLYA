
<?php

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

<link type="text/css" href="css/style_connexion.css" rel="stylesheet" >
<form class="connexion" action = "index.php" method ="get" >
    <input type="text" require="required" name="login"></input>
    <input type="password" require="required" name="pwd"></input>
    <input type="submit" name ="connexion" value="Connexion"></input>
</form>