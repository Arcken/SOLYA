<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LigneManager
 *
 */
class LigneManager {
    
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllLignes() {

        try {

            $sql = 'SELECT lig_id, lot_id, lig_qte, lig_com_dep, lig_com '
                    . 'FROM ligne';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * retourne un enregistrement selon l'id
     * @param $ligId
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getLignesByLot($lotId) {

        try {

            $tParam = [$lotId];
            
            $sql = 'SELECT lig_id, lot_id, lig_qte, lig_com_dep, lig_com '
                    . 'FROM ligne '
                    . 'WHERE lot_id =?';
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * retourne un enregistrement selon l'id
     * @param $ligId
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getLigneDetail($ligId) {

        try {

            $tParam = [$ligId];
            
            $sql = 'SELECT lig_id, lot_id, lig_qte, lig_com_dep, lig_com '
                    . 'FROM ligne '
                    . 'WHERE lig_id =?';
            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Select for update d'un enregistrement selon l'id
     * @param $ligId
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getLigneDetailForUpd($ligId) {

        try {

            $tParam = [$ligId];
            
            $sql = 'SELECT lig_id, lot_id, lig_qte, lig_com_dep, lig_com '
                    . 'FROM ligne '
                    . 'WHERE lig_id =? FOR UPDATE';
            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Modifie un enregistrement dans la table Ligne
     * @param $oLigne
     * Attend un objet ligne
     */
    public static function updLigne($oLigne) {
        try {
            
            $tParam = [
                $oLigne->lig_qte,
                $oLigne->lig_com,
                $oLigne->lig_com_dep,
                $oLigne->lig_id];

            $sql = "UPDATE ligne SET "
                    . "lig_qte = ?, "
                    . "lig_com = ?, "
                    . "lig_com_dep = ? "
                    . "WHERE lig_id = ?";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table Ligne
     * @param type $oLigne
     */
    public static function addLigne($oLigne) {
        try {

            $tParam = [$oLigne->lot_id,
                $oLigne->lig_qte,
                $oLigne->lig_com,
                $oLigne->lig_com_dep];

            $sql = "INSERT INTO ligne ("
                    . "lot_id,"
                    . "lig_qte,"
                    . "lig_com,"
                    . "lig_com_dep) "
                    . "VALUES(?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $ligId
     * Id de ligne
     * @return int 
     * nombre de ligne impacté
     */
    public static function delLigne($ligId) {
        try {
            $tParam = [$ligId];
            
            $sql = 'DELETE FROM ligne WHERE lig_id = ?';
            
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
