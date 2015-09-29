<?php

require_once 'Connection.php';

/**
 * Classe manager de l'objet fiche article
 */
class FicheArticleManager {

    /**
     * Retourne un enregistrement de la table fiche_article selon son id
     * @param integer $fiartId
     * ID de la fiche article
     * @return Objet
     * Objet
     */
    public static function getFicheArticleById($fiartId) {

        try {
            $tParam = array($fiartId);
            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_photos_pref, '
                    . 'fiart_ing, fiart_alg, pays_id, fiart_com, fiart_com_tech, '
                    . 'fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article '
                    . 'WHERE fiart_id =?';
            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne tous les enregistrements de la table fiche article
     * 
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllFichesArticles() {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_photos_pref, '
                    . 'fiart_ing, fiart_alg, pays_id, fiart_com, fiart_com_tech, '
                    . 'fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne tous les enregistrements de la table fiche article avec limite
     * @param $limite
     * debut de limite
     * @param $nombre
     * nombre d'élément à recevoir
     * @param $orderby
     * champs pour le tri
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllFichesArticlesLim($limite, $nombre, $orderby = 'fiart_id') {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos_pref, fiart_ing, '
                    . 'fiart_alg, fiart_com, fiart_desc_fr, pays_id '
                    . 'FROM fiche_article '
                    . 'ORDER BY ' . $orderby . ' DESC LIMIT ' . $limite . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Renvoie le détail d'une fiche article
     * @param $iFiartId
     * id de la fiche article (integer)
     * @return Objet
     * Retourne un objet
     */
    public static function getFicheArticleDetail($iFiartId) {

        try {

            $tParam = array($iFiartId);

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_ing, '
                    . 'fiart_alg, pays_id '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, fiart_desc_fr, '
                    . 'fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article f '
                    . 'INNER JOIN pays AS p ON f.pays_id = p.pays_id '
                    . 'WHERE f.fiart_id = ?';
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Select for update détail d'une fiche article
     * @param $iFiartId
     * id de la fiche article (integer)
     * @return Objet
     * Retourne un objet
     */
    public static function getFicheArticleDetailUpd($iFiartId) {

        try {

            $tParam = array($iFiartId);

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_photos_pref, '
                    . 'fiart_ing, fiart_alg, f.pays_id, fiart_com, fiart_com_tech, '
                    . 'fiart_com_util, fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article f '
                    . 'INNER JOIN pays AS p ON f.pays_id = p.pays_id '
                    . 'WHERE f.fiart_id = ? FOR UPDATE';
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
           throw $e;
        }
        return $result;
    }

    /**
     * Modifie une Fiche article selon son id
     * 
     * @param $oFicheArticle
     * Attend un objet Fiche article
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updFicheArticle($oFicheArticle) {
        try {            
                $tParam = array(
                    $oFicheArticle->fiart_lbl,
                    $oFicheArticle->fiart_photos,
                    $oFicheArticle->fiart_photos_pref,
                    $oFicheArticle->fiart_ing,
                    $oFicheArticle->fiart_alg,
                    $oFicheArticle->fiart_pays_id,
                    $oFicheArticle->fiart_com,
                    $oFicheArticle->fiart_com_tech,
                    $oFicheArticle->fiart_com_util,
                    $oFicheArticle->fiart_desc_fr,
                    $oFicheArticle->fiart_desc_eng,
                    $oFicheArticle->fiart_desc_esp,
                    $oFicheArticle->fiart_id
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
            
        } catch (MySQLException $e) {

            throw $e;
        }
        return $result;
    }

    /**
     * Effecute un insert dans la table ficher article à partir de l'objet
     * @param $oFicheArticle
     * Objet de la classe Fiche article
     * @return int
     * renvoie le nombre de ligne inséré
     */
    public static function addFicheArticle($oFicheArticle) {

        try {

            if (!empty($oFicheArticle->fiart_lbl) && (strlen($oFicheArticle->fiart_lbl)) > Connection::getLimLbl()) {

                $tParam = array(
                    $oFicheArticle->fiart_lbl,
                    $oFicheArticle->fiart_photos,
                    $oFicheArticle->fiart_photos_pref,
                    $oFicheArticle->fiart_ing,
                    $oFicheArticle->fiart_alg,
                    $oFicheArticle->fiart_pays_id,
                    $oFicheArticle->fiart_com,
                    $oFicheArticle->fiart_com_tech,
                    $oFicheArticle->fiart_com_util,
                    $oFicheArticle->fiart_desc_fr,
                    $oFicheArticle->fiart_desc_eng,
                    $oFicheArticle->fiart_desc_esp
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
                $result = 0;
            }
        } catch (MySQLException $e) {

            throw $e;
        }
        return $result;
    }

     /**
     * Supprime l'enregistremen de la table selon son id
     * @param $iFiartId
     * id de la fiche article
     * @return int 
     * nombre de ligne impacté
     */
    public static function delFicheArticle($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'DELETE FROM fiche_article WHERE fiart_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
