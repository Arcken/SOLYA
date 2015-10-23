<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table INVENTAIRE
 */
class InventaireManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllInventaires() {

        try {

            $sql = 'SELECT inv_id, inv_date, inv_lbl, inv_vld '
                    . 'FROM inventaire '
                    . 'ORDER BY inv_date';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getInventaireOpen() {

        try {

            $sql = 'SELECT inv_id, inv_date, inv_lbl, inv_vld '
                    . 'FROM inventaire '
                    
                    . 'WHERE inv_vld = 0'
                    . ' ORDER BY inv_date ';
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
    public static function getInventairesLim($rowStart, $nbRow, $orderBy = 'inv_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT inv_id, inv_date, inv_lbl, inv_vld '
                    . 'FROM inventaire '
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
     * Insert une enregistrement dans la table 
     * @param $oInventaire
     * attend un objet de la classe Inventaire
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addInventaire($oInventaire) {

        try {
                $tParam = [
                    $oInventaire->inv_date,
                    $oInventaire->inv_lbl,
                    $oInventaire->inv_vld
                ];

                $sql = "INSERT INTO inventaire ("
                        . " inv_date, "
                        . " inv_lbl, "
                        . "inv_vld) "
                        . " VALUES(?,?,?)";

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
     * attend l'id de l'inventaire
     * @return objet
     * Retourne un objet
     */
    public static function getInventaireDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT inv_id, inv_date, inv_lbl, inv_vld "
                    . "FROM inventaire "
                    . "WHERE inv_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oInventaire
     * Attend un objet Inventaire
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updInventaire($oInventaire) {
        
        try {
                $tParam = [
                    $oInventaire->inv_date,
                    $oInventaire->inv_lbl,
                    $oInventaire->inv_vld,
                    $oInventaire->inv_id
                ];

                $sql = "UPDATE inventaire SET "
                        . "inv_date = ?, "
                        . "inv_lbl = ?, "
                        . "inv_vld = ? "
                        . "WHERE inv_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la inventaire
     * @return int 
     * nombre de ligne impacté
     */
    public static function delInventaire($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM inventaire WHERE inv_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
