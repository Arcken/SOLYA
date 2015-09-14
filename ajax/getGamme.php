<?php
$tab = array();
$requete = "SELECT * FROM GAMME";
$resultat = $bdd->query($requete);
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);

echo json_encode($tab);
?>