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
    /**
     * Efface un enregistrement de la table Contacter 
     * selon l'id du compte et du mail
     * @param $idCpt
     * ID du compte
     * @param $idMAil
     * ID du mail
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delContacterFromCptAndMail($idCpt,$idMail) {
        try {
            $tParam = [$idCpt,$idMail];
            
            $sql = 'DELETE FROM contacter WHERE cpt_id=? AND mail_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
     /**
     * Modifie un enregistrement selon l'id du compte
     * et de l'email
     * 
     * @param $oContacter
     * Attend un objet Compte
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updContacter($oContacter) {
        
        try {
                $tParam = [
                    $oContacter->mail_lbl,
                    $oContacter->cpt_id,
                    $oContacter->mail_id
                ];

                $sql = "UPDATE contacter SET "
                        . "mail_lbl=? "
                        . "WHERE cpt_id =? AND mail_id=?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
