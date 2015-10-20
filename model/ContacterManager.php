<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ContacterManager {

    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oContacter
     * Attend un objet de la classe Contacter
     */
    public static function addContacter($oContacter) {

        try {
            $tParam = array(
                $oContacter->mail_lbl,
                $oContacter->mail_id,
                $oContacter->cpt_id
            );

            $sql = "INSERT INTO contacter ("
                    . "mail_lbl,"
                    . "mail_id,"
                    . "cpt_id) "
                    . "VALUES(?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
     /**
     * Retourne toutes les adresses mails associé à un compte
     * @param $id
     * ID du compte
     * @return objet[]
     * Renvoie un tableau d'objet
     */
    public static function getContacterCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'SELECT mail_id, cpt_id, mail_lbl '
                    . 'FROM contacter '
                    . 'WHERE cpt_id=?';
            
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Efface tous les enregistrements de la table Contacter 
     * concernant un compte
     * @param $id
     * ID du compte
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delContacterCpt($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM contacter WHERE cpt_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
