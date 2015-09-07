<?php
if (isset($_POST['login']) && !empty($_POST['login']) &&
        isset($_POST['pwd']) && !empty($_POST['pwd'])) {

    $_SESSION['login'] = $_POST['pseudo'];
    $oUser = getUser($login, $pwd,$host,$base,$user,$pwd);
    if (!empty($oUser)) {
        $_SESSION[name] = $oUser->UT_PRENOM;
        $_SESSION[lastname] = $oUser->UT_NOM;
        $_SESSION[BTHD] = $oUser->UT_DTN;
    }
    if ($oUser->UT_ACTIF == 1) 
        $_SESSION['auth'] = TRUE;
        }
    
    function getUser($cnx, $login, $pwd,$host,$base,$user,$pwd) {
    $str_requete = "SELECT * FROM utilisateur WHERE UT_LOGIN= ? AND UT_PASS= ?";
    $cnx = bib1_connecte_db($host,$base,$user,$pwd);
    $stm = $cnx->prepare($str_requete)or die("Erreur dans la requête !
(" . $str_requete . ") Liste indisponible");

    $stm->bindParam(1, $login);
    $stm->bindParam(2, $pwd);
    $stm->execute();
    $oAut = $stm->fetch(PDO::FETCH_OBJ);

    $stm->closeCursor();
    return $oUser;}
    
    function bib1_connecte_db($host,$base,$user,$pwd) {
  try {
      
        $db = new PDO("mysql:host=$host;dbname=$base;charset=utf8;", $user, $pwd);
        return $db;
    } catch (Exception $e) {
        print 'Erreur : ' . $e->getMessage() . '<br />';
        print 'N° : ' . $e->getCode();
        die("Connexion au serveur impossible. <br /><a href=
\"javascript:history.go(-1) \">BACK</a>");
    }
}

    ?>

<link type="text/css" href="css/style_connexion.css" rel="stylesheet" >
<form class="cnx" action = "index.php" method ="get" >
    <input type="text" require="required" name="login"></input>
    <input type="password" require="required" name="pwd"></input>
    <input type="submit" name ="connexion" value="Connexion"></input>
</form>