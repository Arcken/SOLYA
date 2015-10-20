<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DomicilierManager
 *
 */
class DomicilierManager {

    /**
     * Ajout un enregistrement dans la table
     * 
     * @param $oDomicilier
     * Attend un objet de la classe DomicilierPersonne
     */
    public static function addDomicilier($oDomicilier) {
        
        try {
            $tParam = array(
                $oDomicilier->adr_lbl,
                $oDomicilier->adr_id,
                $oDomicilier->cpt_id
            );

            $sql = "INSERT INTO domicilier ("
                    . "adr_lbl,"
                    . "adr_id,"
                    . "cpt_id) "
                    . "VALUES(?,?,?)";

            $result = Connection::request(2, $sql, $tParam);

        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne toutes les adresses associé à un compte
     * @param $id
     * ID du compte
     * @return objet[]
     * Renvoie un tableau d'objet
     */
    public static function getDomicilierCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'SELECT adr_id, cpt_id '
                    . 'FROM domicilier '
                    . 'WHERE cpt_id=?';
            
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Efface tous les enregistrements de la table Domicilier 
     * concernant un compte
     * @param $id
     * ID du compte
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delDomicilierCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM domicilier WHERE cpt_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
