<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {


    $path = $_SERVER['DOCUMENT_ROOT'] . "SOLYA";
    require_once $path . '/view/export/export.php';
    require_once $path . '/model/FicheArticle.php';
    require_once $path . '/model/FicheArticleManager.php';

    $res = FicheArticleManager::getAllFichesArticlesTableau();
    
    $today = date("Ymd");
    
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-disposition: filename=fiart-". $today .".csv");

// Création de la ligne d'en-tête
    $entete = array("ID","Libellé","Photos","Photo pref","Ingrédients",
        "Allergénes","Pays","Commentaire", "Com technique","Com utilisation",
        "Description fr","Description eng","Description esp","Gamme");

// Création du contenu du tableau
    $lignes = array();
    foreach ($res as $fiart) {
        $lignes[] = array($fiart['fiart_id'], $fiart['fiart_lbl'], 
            $fiart['fiart_photos'], $fiart['fiart_photos_pref'], 
            $fiart['fiart_ing'],$fiart['fiart_alg'],$fiart['pays_nom'],
            $fiart['fiart_com'],$fiart['fiart_com_tech'],
            $fiart['fiart_com_util'], $fiart['fiart_desc_fr'],
            $fiart['fiart_desc_eng'],$fiart['fiart_desc_esp'],$fiart['ga_lbl']);
    }


    $separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete) . "\r\n";

// Affichage du contenu du tableau
    foreach ($lignes as $ligne) {
        echo implode($separateur, $ligne) . "\r\n";
    }
} else {
    echo 'Le silence est d\'or';
}