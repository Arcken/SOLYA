<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CiviliteManager
 *
 * @author Olivier
 */
class CiviliteManager {
    //put your code here
    public static function getAllCivilites($Civilite){
        
        try {
            $sql    = "SELECT * FROM civilite";
            $result = Connection::request(1, $sql);
            return $result;
            
        } catch (MySQLException $e) {
            $e->RetourneErreur();
        }
    }
}
