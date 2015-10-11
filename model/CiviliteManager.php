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
}
