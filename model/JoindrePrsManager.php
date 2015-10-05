<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JoindrePrsManager
 *
 * @author Olivier
 */
class JoindrePrsManager {
    
    
    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oJoindrePrs
     * Attend un objet de la classe JoindrePersonne
     * 
     * @return int
     * Retourne le nombre d'insert
     */
     public static function addJoindrePrs($oJoindrePrs){

         try {
                $tParam= array(
                     $oJoindrePrs-> TELPER_LBL,
                     $oJoindrePrs->TEL_ID,
                     $oJoindrePrs->PRS_ID
                );

                $sql = "INSERT INTO joindre_prs ("
                        . "TELPER_LBL,"
                        . "TEL_ID,"
                        . "PRS_ID)"
                        . "VALUES(?,?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
        } catch (MySQLException $e) {
            throw $e;
        }
    }
    
}
