<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TelephoneManager
 *
 */
class TelephoneManager {

    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oTelephone
     * Attend un objet de la classe téléphone
     * 
     * @return int
     * Retourne le nombre d'insert
     */
     public static function addTel($oTelephone){
         
         try {
                $tParam= array(
                    $oTelephone->tel_ind,
                    $oTelephone->tel_num
                );

                $sql = "INSERT INTO telephone ("
                        . "tel_ind,"
                        . "tel_num)"
                        . "VALUES(?,?)";
                
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
     * attend l'id du téléphone
     * @return objet
     * Retourne un objet
     */
    public static function getTelephoneDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT tel_id, tel_num, tel_ind "
                    . "FROM telephone "
                    . "WHERE tel_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oTelephone
     * Attend un objet Telephone
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updTelephone($oTelephone) {
        
        try {
                $tParam = [
                    $oTelephone->tel_num,
                    $oTelephone->tel_ind,
                    $oTelephone->tel_id
                ];

                $sql = "UPDATE telephone SET "
                        . "tel_num = ?, "
                        . "tel_ind = ? "
                        . "WHERE tel_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id du telephone
     * @return int 
     * nombre de ligne impacté
     */
    public static function delTelephone($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM telephone WHERE tel_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
