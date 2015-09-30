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


        case 'getAllNut':
            $tab = array();
            $requete = "SELECT * FROM nutrition";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;


        case 'getFiartPays':
            $fiartId = $_REQUEST['fiartId'];
            $tab = array();
            $requete = "SELECT * FROM pays p "
                    . "INNER JOIN fiche_article f ON "
                    . "f.pays_id=p.pays_id "
                    . "WHERE f.fiart_id =" . $fiartId;

            $resultat = $bdd->query($requete);

            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }
            echo json_encode($tab);

            break;


        case 'getFiartGamme':

            $fiartId = $_REQUEST['fiartId'];
            $tab = array();
            $requete = "SELECT * FROM gamme g "
                    . "INNER JOIN regrouper r ON "
                    . "g.ga_id = r.ga_id "
                    . "WHERE r.fiart_id =" . $fiartId;

            $resultat = $bdd->query($requete);

            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }

            echo json_encode($tab);
            break;

        case 'getRefCode':

            $refCode = $_REQUEST['refCode'];
            $tab = array();
            $requete = "SELECT ref_code FROM reference "
                    . "WHERE ref_code LIKE '" . $refCode . "%' ORDER BY ref_code DESC LIMIT 0,5";

            $resultat = $bdd->query($requete);

            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }
            echo json_encode($tab);
            break;


        case 'getNombre':
            $tab = array();
            
            $champs = $_REQUEST['champs'];
            $table = $_REQUEST['table'];
            $valeur = $_REQUEST['valeur'];
             
            $requete = "SELECT count(*) AS total FROM " . $table .
                    " WHERE " . $champs . " ='" . $valeur."'";
            $resultat = $bdd->query($requete);

            $donnees = $resultat->fetch(PDO::FETCH_ASSOC);
            echo json_encode($donnees);
            
            break;
        
        case 'getRef':

            $refId = $_REQUEST['refId'];
            $tab = array();
            $requete = "SELECT * FROM reference "
                    . "WHERE ref_id ='".$refId."'";

            $resultat = $bdd->query($requete);

            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }
            echo json_encode($tab);
            break;
        
    }
}
?>