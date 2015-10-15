<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TvaManager {
    //put your code here

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     * Retourne un tableau d'objet
     */
    public static function getAllTvas() {

        try {

            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t';

            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne un enregistrement de la table selon son id
     *  
     * @param $id
     * Id de l'enregistrement
     * 
     * @return objet
     * Retourne un objet
     */
    public static function getTvaById($id) {

        try {
            $tParam = [$id];

            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t WHERE t.tva_id=?';

            $result = Connection::request(0, $sql, $tParam);
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
    public static function getAllTvas() {

        try {

            $sql = 'SELECT tva_id, tva_lbl, tva_taux '
                    . 'FROM tva '
                    . 'ORDER BY tva_lbl';
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
    public static function getTvaLim($rowStart, $nbRow, 
            $orderBy = 'tva_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT tva_id, tva_lbl, tva_taux '
                    . 'FROM tva '
                    . 'ORDER BY ' . $orderBy . ' LIMIT ' . $rowStart . ' , ' 
                    . $nbRow;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de la tva
     * @return objet
     * Retourne un objet
     */
    public static function getTvaDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT tva_id, tva_lbl, tva_taux "
                    . "FROM tva "
                    . "WHERE tva_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oTva
     * Attend un objet Tva
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updTva($oTva) {
        
        try {
                $tParam = [
                    $oTva->tva_lbl,
                    $oTva->tva_taux,
                    $oTva->tva_id
                ];

                $sql = "UPDATE tva SET "
                        . "tva_lbl = ?, "
                        . "tva_taux = ? "
                        . "WHERE tva_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

    /**
     * Ajoute un enregistrement dans la table
     * @param $oTva
     * Objet de la classe tva
     * @return string 
     * Retourne le nombre de ligne ajouté
     */
    public static function addTva($oTva) {

        try {
            $tParam = array(
                $oTva->tva_lbl,
                $oTva->tva_taux
            );

            $sql = "INSERT INTO tva ("
                    . "tva_lbl,"
                    . "tva_taux)"
                    . "VALUES(?,?)";

            $result = Connection::request(2, $sql, $tParam);

        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la tva
     * @return int 
     * nombre de ligne impacté
     */
    public static function delTva($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM tva WHERE tva_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
