<?php

require_once 'Connection.php';

/**
 * Classe manager de l'objet fiche article
 */
class FicheArticleManager {

    /**
     * Retourne un enregistrement de la table selon son id
     * @param $fiartId
     * ID de l'enregistrement
     * @return Objet
     * Objet
     */
    public static function getFicheArticleById($fiartId) {

        try {
            $tParam = [$fiartId];
            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, '
                    . 'fiart_photos_pref, fiart_ing, fiart_alg, pays_id, '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, '
                    . 'fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article '
                    . 'WHERE fiart_id =?';
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllFichesArticles() {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, '
                    . 'fiart_photos_pref, fiart_ing, fiart_alg, pays_id, '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, '
                    . 'fiart_desc_fr, fiart_desc_eng, fiart_desc_esp '
                    . 'FROM fiche_article '
                    . 'ORDER BY fiart_id DESC';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []
     * Retourne un tableau associatif
     */
    public static function getAllFichesArticlesTableau() {

        try {

            $sql = 'SELECT f.fiart_id, fiart_lbl, fiart_photos, '
                    . 'fiart_photos_pref, fiart_ing, fiart_alg, pays_nom, '
                    . 'fiart_com, fiart_com_tech, fiart_com_util, '
                    . 'fiart_desc_fr, fiart_desc_eng, fiart_desc_esp, ga_lbl '
                    . 'FROM fiche_article f '
                    . 'JOIN pays p ON f.pays_id = p.pays_id '
                    . 'RIGHT JOIN regrouper r ON f.fiart_id = r.fiart_id '
                    . 'JOIN gamme g ON r.ga_id = g.ga_id '
                    . 'ORDER BY f.fiart_id DESC';
            $result = Connection::request(1, $sql,null,PDO::FETCH_ASSOC);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $limite
     * debut de limite
     * @param $nombre
     * nombre d'élément à recevoir
     * @param $orderby
     * champs pour le tri
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllFichesArticlesLim($limite, $nombre, 
            $orderby = 'fiart_id') {

        try {

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos_pref, fiart_ing, '
                    . 'fiart_alg, fiart_com, fiart_desc_fr, pays_id '
                    . 'FROM fiche_article '
                    . 'ORDER BY ' . $orderby . ' DESC LIMIT ' . $limite 
                    . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Renvoie le détail d'un enregistrement
     * @param $id
     * id de l'enregistrement
     * @return Objet
     * Retourne un objet
     */
    public static function getFicheArticleDetail($id) {

        try {

            $tParam = [$id];

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, fiart_ing, '
                    . 'fiart_alg, pays_id, fiart_com, fiart_com_tech, '
                    . 'fiart_com_util, fiart_desc_fr, '
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
     * Select for update d'un enregistrement
     * @param $id
     * id de l'enregistrement
     * @return Objet
     * Retourne un objet
     */
    public static function getFicheArticleDetailUpd($id) {

        try {

            $tParam = [$id];

            $sql = 'SELECT fiart_id, fiart_lbl, fiart_photos, '
                    . 'fiart_photos_pref'
                    . ',fiart_ing, fiart_alg, f.pays_id, fiart_com, '
                    . 'fiart_com_tech, fiart_com_util, fiart_desc_fr, '
                    . 'fiart_desc_eng, fiart_desc_esp '
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
     * Modifie un enregistrement selon son id
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
                    $oFicheArticle->pays_id,
                    $oFicheArticle->fiart_com,
                    $oFicheArticle->fiart_com_tech,
                    $oFicheArticle->fiart_com_util,
                    $oFicheArticle->fiart_desc_fr,
                    $oFicheArticle->fiart_desc_eng,
                    $oFicheArticle->fiart_desc_esp,
                    $oFicheArticle->fiart_id
                );

                $sql = "UPDATE fiche_article SET "
                        . "fiart_lbl = ?,"
                        . "fiart_photos = ?,"
                        . "fiart_photos_pref = ?,"
                        . "fiart_ing = ?,"
                        . "fiart_alg = ?,"
                        . "pays_id = ?,"
                        . "fiart_com = ?,"
                        . "fiart_com_tech = ?,"
                        . "fiart_com_util = ?,"
                        . "fiart_desc_fr = ?,"
                        . "fiart_desc_eng = ?,"
                        . "fiart_desc_esp = ? "
                        . "WHERE fiart_id = ?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Effecute un insert dans la table
     * @param $oFicheArticle
     * Objet de la classe Fiche article
     * @return int
     * renvoie le nombre de ligne inséré
     */
    public static function addFicheArticle($oFicheArticle) {

        try {
                $tParam = array(
                    $oFicheArticle->fiart_lbl,
                    $oFicheArticle->fiart_photos,
                    $oFicheArticle->fiart_photos_pref,
                    $oFicheArticle->fiart_ing,
                    $oFicheArticle->fiart_alg,
                    $oFicheArticle->pays_id,
                    $oFicheArticle->fiart_com,
                    $oFicheArticle->fiart_com_tech,
                    $oFicheArticle->fiart_com_util,
                    $oFicheArticle->fiart_desc_fr,
                    $oFicheArticle->fiart_desc_eng,
                    $oFicheArticle->fiart_desc_esp
                );

                $sql = "INSERT INTO fiche_article ("
                        . "fiart_lbl,"
                        . "fiart_photos,"
                        . "fiart_photos_pref,"
                        . "fiart_ing,"
                        . "fiart_alg,"
                        . "pays_id,"
                        . "fiart_com,"
                        . "fiart_com_tech,"
                        . "fiart_com_util,"
                        . "fiart_desc_fr,"
                        . "fiart_desc_eng,"
                        . "fiart_desc_esp) "
                        . "VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
     /**
     * Supprime l'enregistremen de la table selon son id
     * @param $id
     * id de l'enregistrement
     * @return int 
     * nombre de ligne impacté
     */
    public static function delFicheArticle($id) {
        
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM fiche_article WHERE fiart_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
