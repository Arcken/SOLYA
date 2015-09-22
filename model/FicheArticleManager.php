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
     * Retourne un tableau d'objet
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
/**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllFichesArticlesLim($limite,$nombre,$orderby = 'fiart_id') {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_ing, fiart_alg '
                    . 'FROM fiche_article ORDER BY '.$orderby.' LIMIT '.$limite.' , '.$nombre;
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
    
    /**
     * Renvoie le détail d'une fiche article
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getFicheArticleDetail($iFiartId) {

        try {
            
                $tParam = array($iFiartId);
            
            $sql = 'SELECT f.fiart_id, f.fiart_lbl, f.fiart_ing, f.fiart_alg, '
                    . 'f.pays_id, p.pays_nom '
                    . 'FROM fiche_article f '
                    . 'INNER JOIN pays AS p ON f.pays_id = p.pays_id '
                    . 'WHERE f.fiart_id = ?';
                    
            
            $result = Connection::request(0, $sql, $tParam);
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
    public static function getFicheArticleDetailUpd($iFiartId) {

        try {
            
                $tParam = array($iFiartId);
            
            $sql = 'SELECT f.fiart_id, f.fiart_lbl, f.fiart_ing, f.fiart_alg, '
                    . 'f.pays_id, p.pays_nom '
                    . 'FROM fiche_article f '
                    . 'INNER JOIN pays AS p ON f.pays_id = p.pays_id '
                    . 'WHERE f.fiart_id = ? FOR UPDATE';
                    
            
            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    public static function updFicheArticle($FicheArticle) {
    try{
        if (!empty($FicheArticle->fiart_lbl) && (strlen($FicheArticle->fiart_lbl)) > Connection::getLimLbl()) {

                $tParam = array(
                    $FicheArticle->fiart_lbl,
                    $FicheArticle->fiart_photos,
                    $FicheArticle->fiart_ing,
                    $FicheArticle->fiart_alg,
                    $FicheArticle->fiart_pays_id,
                    $FicheArticle->fiart_id
                );
                 $sql = "UPDATE fiche_article SET "                        
                        . "FIART_LBL = ?,"
                        . "FIART_PHOTOS = ?,"
                        . "FIART_ING = ?,"
                        . "FIART_ALG = ?,"
                        . "PAYS_ID = ?"
                         . "WHERE fiart_id = ?";

                $result = Connection::request(2, $sql, $tParam);                
            } else {
                $result = '<p class="info">Enregistrement FIART impossible, erreur de données insérées</p><br/>';
            }
        } catch (MySQLException $e) {

            //echo $e->RetourneErreur();

            $result = 'Enregistrement fiart erreur';
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

    public static function delFicheArticle($iFiartId){
        try {
            $tParam = array(
                    $iFiartId
                    );
            $sql = 'DELETE FROM fiche_article WHERE fiart_id=?';
            $result = Connection::request(2,$sql,$tParam);
        } catch (MySQLException $e) {
            
        }
        return $result;
    
    }
    
}
