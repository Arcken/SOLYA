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
    
    /**
     * Efface un enregistrement de la table Joindre 
     * selon l'id du compte et du téléphone
     * @param $idCpt
     * ID du compte
     * @param $idTel
     * ID du téléphone
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delJoindreFromCptAndTel($idCpt,$idTel) {
        try {
            $tParam = [$idCpt,$idTel];
            $sql = 'DELETE FROM joindre WHERE cpt_id=? AND tel_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
     /**
     * Modifie un enregistrement selon l'id du compte
     * et du téléphone
     * 
     * @param $oJoindre
     * Attend un objet Joindre
     * @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updJoindre($oJoindre) {
        
        try {
                $tParam = [
                    $oJoindre->tel_lbl,
                    $oJoindre->cpt_id,
                    $oJoindre->tel_id
                ];

                $sql = "UPDATE joindre SET "
                        . "tel_lbl=? "
                        . "WHERE cpt_id =? AND tel_id=?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
