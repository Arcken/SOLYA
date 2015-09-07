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
        $_SESSION['name'] = $oUser->UT_PRENOM;
        $_SESSION['lastname'] = $oUser->UT_NOM;
        $_SESSION['BTHD'] = $oUser->UT_DTN;
    }
    if ($oUser->UT_ACTIF == 1) 
        $_SESSION['auth'] = TRUE;
        }
        
  
    
    ?>

<link type="text/css" href="css/style_connexion.css" rel="stylesheet" >
<form class="connexion" action = "index.php" method ="get" >
    <input type="text" require="required" name="login"></input>
    <input type="password" require="required" name="pwd"></input>
    <input type="submit" name ="connexion" value="Connexion"></input>
</form>