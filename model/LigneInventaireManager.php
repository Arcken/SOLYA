<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table LIGNE_INVENTAIRE
 */
class LigneInventaireManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllLigneInventaires() {

        try {

            $sql = 'SELECT liginv_id, liginv_lbl, liginv_qt_stock, '
                    . 'liginv_qt_reel , lot_id, inv_id '
                    . 'FROM ligne_inv '
                    . 'ORDER BY liginv_id';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $rowStart
     * debut de limite
     * @param $nbRow
     * nombre d'élément à recevoir
     * @param $orderBy
     * champs pour le tri
     * @param $sort
     * tri croissant ou décroissant (ASC ou DESC)
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getLigneInventairesLim($rowStart, $nbRow, $orderBy = 'liginv_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT liginv_id, liginv_lbl, liginv_qt_stock, '
                    . 'liginv_qt_reel, lot_id, inv_id '
                    . 'FROM ligne_inv '
                    . 'ORDER BY ' . $orderBy 
                    . ' ' . $sort
                    . ' LIMIT ' . $rowStart . ' , ' 
                    . $nbRow;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Retourne tous les enregistrements de la table
     * @param $id
     * id de l'ligne_inv
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getLigneInventairesFromInventaireForUpd($id) {

        try {

            $sql = 'SELECT liginv_id, liginv_lbl, liginv_qt_stock, '
                    . 'liginv_qt_reel , lot_id, inv_id '
                    . 'FROM ligne_inv '
                    . 'WHERE inv_id =' . $id
                    . ' FOR UPDATE';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table 
     * @param $oLigneInventaire
     * attend un objet de la classe LigneInventaire
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addLigneInventaire($oLigneInventaire) {

        try {
                $tParam = [
                    $oLigneInventaire->liginv_lbl,
                    $oLigneInventaire->liginv_qt_stock,
                    $oLigneInventaire->liginv_qt_reel,
                    $oLigneInventaire->lot_id,
                    $oLigneInventaire->inv_id
                ];

                $sql = "INSERT INTO ligne_inv ("
                        . " liginv_lbl, "
                        . " liginv_qt_stock, "
                        . " liginv_qt_reel,"
                        . " lot_id, "
                        . " inv_id) "
                        . " VALUES(?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de la ligne ligne_inv
     * @return objet
     * Retourne un objet
     */
    public static function getLigneInventaireDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT liginv_id, liginv_lbl, liginv_qt_stock, "
                    . "liginv_qt_reel, lot_id "
                    . "FROM ligne_inv "
                    . "WHERE liginv_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oLigneInventaire
     * Attend un objet LigneInventaire
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updLigneInventaire($oLigneInventaire) {
        
        try {
                $tParam = [
                    $oLigneInventaire->liginv_lbl,
                    $oLigneInventaire->liginv_qt_stock,
                    $oLigneInventaire->liginv_qt_reel,
                    $oLigneInventaire->lot_id,
                    $oLigneInventaire->liginv_id
                ];

                $sql = "UPDATE ligne_inv SET "
                        . "liginv_lbl = ?, "
                        . "liginv_qt_stock = ?, "
                        . "liginv_qt_reel = ?, "
                        . "lot_id = ? "
                        . "WHERE liginv_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la ligne ligne_inv
     * @return int 
     * nombre de ligne impacté
     */
    public static function delLigneInventaire($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM ligne_inv WHERE liginv_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Supprime les enregistrements de la table selon l'id de l'inventaire
     * @param $id
     * id de l'inventaire
     * @return int 
     * nombre de ligne impacté
     */
    public static function delLigneInventaireFromInventaire($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM ligne_inv WHERE inv_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
