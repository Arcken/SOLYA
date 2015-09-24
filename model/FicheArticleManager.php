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

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, , fiart_photos_pref, '
                    . 'fiart_ing, fiart_alg, pays_id, fiart_com, fiart_com_tech, '
                    . 'fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
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

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos_pref, fiart_ing, fiart_alg, fiart_com, fiart_desc_fr, pays_id '
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
            
            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_ing, fiart_alg, pays_id '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
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
     * Select for update détail d'une fiche article
     * @return Objet
     * @description Retourne un d'objet
     */
    public static function getFicheArticleDetailUpd($iFiartId) {

        try {
            
                $tParam = array($iFiartId);
            
            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_photos_pref, fiart_ing, fiart_alg, f.pays_id, '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
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
                    $FicheArticle->fiart_photos_pref,
                    $FicheArticle->fiart_ing,
                    $FicheArticle->fiart_alg,
                    $FicheArticle->fiart_pays_id,
                    $FicheArticle->fiart_com,
                    $FicheArticle->fiart_com_tech,
                    $FicheArticle->fiart_com_util,
                    $FicheArticle->fiart_desc_fr,
                    $FicheArticle->fiart_desc_eng,
                    $FicheArticle->fiart_desc_esp,
                    $FicheArticle->fiart_id
                );
                
                                
                 $sql = "UPDATE fiche_article SET "                        
                        . "FIART_LBL = ?,"
                        . "FIART_PHOTOS = ?,"
                        . "FIART_PHOTOS_PREF = ?,"
                        . "FIART_ING = ?,"
                        . "FIART_ALG = ?,"
                        . "PAYS_ID = ?,"
                        . "FIART_COM = ?,"
                        . "FIART_COM_TECH = ?,"
                        . "FIART_COM_UTIL = ?,"
                        . "FIART_DESC_FR = ?,"
                        . "FIART_DESC_ENG = ?,"
                        . "FIART_DESC_ESP = ? "
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
                    $FicheArticle->fiart_photos_pref,
                    $FicheArticle->fiart_ing,
                    $FicheArticle->fiart_alg,
                    $FicheArticle->fiart_pays_id,
                    $FicheArticle->fiart_com,
                    $FicheArticle->fiart_com_tech,
                    $FicheArticle->fiart_com_util,
                    $FicheArticle->fiart_desc_fr,
                    $FicheArticle->fiart_desc_eng,
                    $FicheArticle->fiart_desc_esp                    
                );

                $sql = "INSERT INTO fiche_article ("
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_PHOTOS_PREF,"
                        . "FIART_ING,"
                        . "FIART_ALG,"
                        . "PAYS_ID,"
                        . "FIART_COM,"
                        . "FIART_COM_TECH,"
                        . "FIART_COM_UTIL,"
                        . "FIART_DESC_FR,"
                        . "FIART_DESC_ENG,"
                        . "FIART_DESC_ESP) "
                        
                        . "VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

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
