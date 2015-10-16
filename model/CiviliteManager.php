<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CiviliteManager
 *
 * 
 */
class CiviliteManager {
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     * Retourne un tableau d'objet
     */
    public static function getAllCivilites(){
        
        try {
            $sql    = "SELECT civ_id,"
                    . "civ_lbl,"
                    . "civ_code "
                    . "FROM civilite";
            
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
    public static function getCivilitesLim($rowStart, $nbRow, 
            $orderBy = 'civ_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT civ_id,'
                    . 'civ_lbl,'
                    . 'civ_code '
                    . 'FROM civilite '
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
     * @param $oCivilite
     * attend un objet de la classe Civilité
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addCivilite($oCivilite) {

        try {
                $tParam = [
                    $oCivilite->civ_lbl,
                    $oCivilite->civ_code,
                ];

                $sql = "INSERT INTO civilite ("
                        . " civ_lbl, "
                        . " civ_code) "
                        . " VALUES(?,?)";

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
     * attend l'id de la civilité
     * @return objet
     * Retourne un objet
     */
    public static function getCiviliteDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT civ_id, civ_lbl, civ_code "
                    . "FROM civilite "
                    . "WHERE civ_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oCivilite
     * Attend un objet Civilite
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updCivilite($oCivilite) {
        
        try {
                $tParam = [
                    $oCivilite->civ_lbl,
                    $oCivilite->civ_code,
                    $oCivilite->civ_id
                ];

                $sql = "UPDATE civilite SET "
                        . "civ_lbl = ?, "
                        . "civ_code = ? "
                        . "WHERE civ_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la civilité
     * @return int 
     * nombre de ligne impacté
     */
    public static function delCivilite($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM civilite WHERE civ_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
