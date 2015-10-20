<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "Solya") {
    $bdd = new PDO('mysql:host=localhost;dbname=solya;charset=utf8', 'solya', "Stage2015!");
    $sAction = $_REQUEST['action'];
    switch ($sAction) {

        case 'getAllGamme':
            $tab = array();
            $requete = "SELECT ga_id, ga_lbl FROM gamme "
                    . "ORDER BY ga_lbl";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;


        case 'getAllMc':
            $tab = array();
            $requete = "SELECT cons_id, cons_lbl FROM mode_conservation "
                    . "ORDER BY cons_lbl";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;



        case 'getAllNut':
            $tab = array();
            $requete = "SELECT nut_id, nut_lbl  FROM nutrition "
                    . "ORDER BY nut_lbl";
            $resultat = $bdd->query($requete);
            while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $donnees;
            }
            echo json_encode($tab);
            break;


        case 'getAllPays':
            $tab = array();
            $requete = 'SELECT pays_id, pays_nom, pays_abv, pays_dvs_nom, '
                        . 'pays_dvs_abv, pays_dvs_sym '
                        . 'FROM pays ORDER BY pays_nom';;
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


            $champs = $_REQUEST['champs'];
            $table = $_REQUEST['table'];
            $valeur = $_REQUEST['valeur'];

            $requete = "SELECT count(*) AS total FROM " . $table .
                    " WHERE " . $champs . " ='" . $valeur . "'";
            $resultat = $bdd->query($requete);

            $donnees = $resultat->fetch(PDO::FETCH_ASSOC);
            echo json_encode($donnees);

            break;

        case 'getRef':

            //On contrôle le champs sur lequel s'effectue la recherche
            if (isset($_REQUEST['champs'])) {
                //On le récupère
                $champs = $_REQUEST['champs'];
                //Selon la valeur du champs on récupère la bonne valeur dans $param
                switch ($champs) {

                    case 'ref_id':
                        $param = $_REQUEST['value'];
                        $criteria = 'ref_id';
                        break;

                    case 'ref_code':
                        $param = $_REQUEST['value'];
                        $criteria = 'ref_code';
                        break;
                }


                //On écrit la requète en conséquence
                $tab = array();
                $requete = "SELECT  r.ref_id, r.ref_lbl, r.ref_code, "
                        . " r.ref_poids_brut, d.dd_taux"
                        . " FROM reference r "
                        . " JOIN droit_douane d ON r.dd_id = d.dd_id "
                        . " WHERE r." . $criteria . " = '" . $param . "'";
                //On l'éxécute
                $resultat = $bdd->query($requete);
                //Récupération des données
                while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    $tab[] = $data;
                }
                //Envoie des données en JSON
                echo json_encode($tab);
            }
            break;



        case 'getLots':

            $tab = array();
            $refId = $_REQUEST['refId'];
            $typeBon = $_REQUEST['typeBon'];

            switch ($typeBon) {
                
                 case "1":
                 case "2":
                 case "3":
                 case "4": 
                 case "5": 
                 case "6": 
                 case "7":    

                    $requete = " SELECT  l.lot_id, l.lot_dlc, l.lot_qt_stock, l.lot_qt_init"
                            . " FROM lot l "
                            . " INNER JOIN reference r ON l.ref_id = r.ref_id "
                            . " WHERE r.ref_id = '" . $refId . "' AND lot_qt_stock > '0' "
                            . " ORDER BY lot_dlc ASC";

                    //On l'éxécute
                    $resultat = $bdd->query($requete);
                    //Récupération des données
                    while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        $tab[] = $data;
                    }
                    echo json_encode($tab);

                    break;
                    
                     case "8":
                     case "9": 
                     case "10":     
                     case "11": 
                     case "12": 

                    $requete =" SELECT  l.lot_id, l.lot_dlc,l.lot_qt_stock,l.lot_qt_init"
                            . " FROM lot l "
                            . " INNER JOIN reference r ON l.ref_id = r.ref_id "
                            . " WHERE r.ref_id = '" . $refId . "'"
                            . " ORDER BY lot_dlc ASC";

                    //On l'éxécute
                    $resultat = $bdd->query($requete);
                    //Récupération des données
                    while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        $tab[] = $data;
                    }
                    echo json_encode($tab);

                    break;
            }
        break;

        
        
        case 'getLot':

            $tab = array();
            $lotId = $_REQUEST['lotId'];


            $requete = "SELECT lot_qt_stock, lot_qt_init, l.ref_id, "
                    . "lot_id_producteur, lot_dlc, r.ref_code"
                    . " FROM lot l"
                    . " JOIN reference r ON l.ref_id = r.ref_id"
                    . " WHERE lot_id=" . $lotId;

            //On l'éxécute
            $resultat = $bdd->query($requete);
            //Récupération des données
            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }
            echo json_encode($tab);


            break;
            case 'getSearch':

            $tab = array();

            $requete =$_REQUEST['request'];

            //On l'éxécute
            $resultat = $bdd->query($requete);
            //Récupération des données
            
            while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $tab[] = $data;
            }
            echo json_encode($tab);


            break;
    }
    
}
?>