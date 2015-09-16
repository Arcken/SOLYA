<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "Solya") {
    $bdd = new PDO('mysql:host=localhost;dbname=solya;charset=utf8', 'solya', "Stage2015!");
    $sAction = $_REQUEST['action'];
    switch ($sAction) {

        case 'getAllGamme':
            $tab = array();
            $requete = "SELECT * FROM gamme";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;

        case 'getAllPays':
            $tab = array();
            $requete = "SELECT * FROM pays";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;
    }
}
?>