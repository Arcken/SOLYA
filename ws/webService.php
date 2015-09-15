<?php
$bdd = new PDO('mysql:host=localhost;dbname=solya;charset=utf8', 'solya', "Stage2015!");


$tab = array();
$requete = "SELECT * FROM gamme";
$resultat = $bdd->query($requete);
while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
$tab[] = $donnees;
}
echo json_encode($tab);
?>