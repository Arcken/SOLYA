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
     * Select for update d'un enregistrement selon l'id
     * @param $lotId
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getLigneDetailForUpd($lotId) {

        try {

            $tParam = array(
                $lotId
            );
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
     * Ajoute un enregistrement dans la table Ligne
     * @param type $oLigne
     */
    public static function addLigne($oLigne) {
        try {

            $tParam = array(
                $oLigne->lot_id,
                $oLigne->lig_qte,
                $oLigne->lig_com,
                $oLigne->lig_com_dep
                            );

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
}
