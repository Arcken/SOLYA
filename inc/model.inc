<?php
function connect($login,$pwd){
$cnx =  Connexion::getConnexion();
 $sql="SELECT * FROM utilisateur u "
            . "JOIN groupe g on u.GRP_ID = g.GRP_ID "
            . "WHERE UT_LOGIN=? AND UT_PASS=?";
    $param=[$login, $pwd];
    $cnx=  Connexion::getConnexion();
    $stm = $cnx->prepare($sql) or die("Erreur dans las requête!<br/>".$sql."<br/>Requête annulé");
    $stm->execute($param);
    print_r($stm);
    
    $res = $stm->fetch(PDO::FETCH_OBJ);
    
    return $res;
}