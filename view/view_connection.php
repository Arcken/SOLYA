<<<<<<< HEAD
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
=======
<?php
if (isset($_GET['login']) && !empty($_GET['login']) &&
        isset($_GET['pwd']) && !empty($_GET['pwd'])) {
    
    echo "<br/>";
    echo $_GET['login'];
    echo $sPwd = $_GET['pwd'];
    
    $_SESSION['login'] = $_GET['login'];
    $sql="SELECT * FROM utilisateur u "
            . "JOIN groupe g on u.GRP_ID = g.GRP_ID "
            . "WHERE UT_LOGIN=? AND UT_PASS=?";
    
    $param=[$_GET['login'], $_GET['pwd']];
    $oUser = Connexion::requeteFetch($sql, $param,$format = PDO::FETCH_OBJ)[0];
    print_r($oUser);
    
    if (!empty($oUser)) {
        
        $_SESSION['name'] = $oUser['UT_PRENOM'];
        $_SESSION['lastname'] = $oUser['UT_NOM'];
        $_SESSION['BTHD'] = $oUser['UT_DTN'];
        
        }
        
    if ($oUser['UT_ACTIF'] == 1) 
        $_SESSION['auth'] = TRUE;
    
    }
        
  
    
    ?>

<link type="text/css" href="css/style_connexion.css" rel="stylesheet" >
<form class="connexion" action = "index.php" method ="get" >
    <input type="text" require="required" name="login"></input>
    <input type="password" require="required" name="pwd"></input>
    <input type="submit" name ="connexion" value="Connexion"></input>
>>>>>>> origin/master
</form>