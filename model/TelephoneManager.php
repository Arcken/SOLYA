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
                    $oTelephone->TEL_IND,
                    $oTelephone->TEL_NUM
                );

                $sql = "INSERT INTO telephone ("
                        . "TEL_IND,"
                        . "TEL_NUM)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
