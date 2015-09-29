<?php

require_once $path . '/model/FicheArticle.php';
require_once $path . '/model/FicheArticleManager.php';
if (isset($_REQUEST['fiartId'])) {
    $res = FicheArticleManager::delFicheArticle($_REQUEST['fiartId']);
    if ($res == 1) {
        $resMessage = "<font color='orange'> La fiche article N° " . $_REQUEST['fiartId'] . " est supprimée</font>";
    } else {
        $resMessage = "<font color='red'> Echec de la suppression</font>";
    }
    require $path . '/controler/control_fiart_list.php';
}