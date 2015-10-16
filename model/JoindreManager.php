<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JoindreManager
 *
 */
class JoindreManager {
    
    
    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oJoindre
     * Attend un objet de la classe Joindre
     * 
     * @return int
     * Retourne le nombre d'insert
     */
     public static function addJoindre($oJoindre){

         try {
                $tParam= array(
                     $oJoindre->tel_lbl,
                     $oJoindre->tel_id,
                     $oJoindre->cpt_id
                );

                $sql = "INSERT INTO joindre ("
                        . "tel_lbl,"
                        . "tel_id,"
                        . "cpt_id)"
                        . "VALUES(?,?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Retourne toutes les téléphones associé à un compte
     * @param $id
     * ID du compte
     * @return objet[]
     * Renvoie un tableau d'objet
     */
    public static function getJoindreCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'SELECT tel_id, cpt_id, tel_lbl '
                    . 'FROM joindre '
                    . 'WHERE cpt_id=?';
            
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Efface tous les enregistrements de la table Joindre 
     * concernant un compte
     * @param $id
     * ID du compte
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delJoindreCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM joindre WHERE cpt_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
