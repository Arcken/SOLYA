<?php

require_once 'Connection.php';

/**
 * Classe manager de l'objet fiche article
 */
class FicheArticleManager {

    /**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Objet[]
     * * @description Retourne un tableau d'objet
     */
    public static function getAllFichesArticles() {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_ing, fiart_alg '
                    . 'FROM fiche_article';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {

            if ($e->getCode() == 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
        }
        return $result;
    }

    public static function getMaxIdFicheArticle() {

        try {

            $sql = 'SELECT MAX(fiart_id) FROM fiche_article';
            $result = Connection::request(0, $sql, null, $format = PDO::FETCH_ASSOC);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Renvoie le détail d'une fiche article
     * @return Objet[]
     * @description Retourne un tableau d'objet
     */
    public static function getFicheArticleDetail($iFiartId) {

        try {
            
                $tParam = array($iFiartId);
            
            $sql = 'SELECT f.fiart_id, f.fiart_lbl, f.fiart_ing, f.fiart_alg, '
                    . 'f.pays_id, p.pays_nom, r.ga_id '
                    . 'FROM fiche_article f '
                    . 'INNER JOIN pays AS p ON f.pays_id = p.pays_id '
                    . 'LEFT JOIN regrouper AS r ON f.fiart_id = r.fiart_id WHERE f.fiart_id = ?';
                    
            
            $result = Connection::request(1, $sql, $tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Effecute un insert dans la table ficher article à partir de l'objet
     * @param 'FicheArticle'
     * Objet de la classe Fiche article
     * @return int
     * @description renvoie 1 si insert effectuée sinon 0
     */
    public static function addFicheArticle($FicheArticle) {

        try {

            if (!empty($FicheArticle->fiart_lbl) && (strlen($FicheArticle->fiart_lbl)) > Connection::getLimLbl()) {

                $tParam = array(
                    $FicheArticle->fiart_lbl,
                    $FicheArticle->fiart_photos,
                    $FicheArticle->fiart_ing,
                    $FicheArticle->fiart_alg,
                    $FicheArticle->fiart_pays_id
                );

                $sql = "INSERT INTO fiche_article ("
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_ING,"
                        . "FIART_ALG,"
                        . "PAYS_ID)"
                        . "VALUES(?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);                
            } else {
                $result = '<p class="info">Enregistrement FIART impossible, erreur de données insérées</p><br/>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();

            $result = 'Enregistrement fiart erreur';
        }
        return $result;
    }

}
