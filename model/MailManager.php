<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailManager
 *
 */
class MailManager {

    /**
     * Ajoute un enregistrement dans la base
     * 
     * @param $oMail
     * Attend un objet de la classe Mail
     * 
     * @return int 
     * Retourne le nombre d'enregistrement
     */
    public static function addMail($oMail) {

        try {

            $tParam = array(
                $oMail->mail_adr
            );

            $sql = "INSERT INTO mail ("
                    . "mail_adr) "
                    . "VALUES(?)";

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
     * attend l'id de l'adresse mail
     * @return objet
     * Retourne un objet
     */
    public static function getMailDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT mail_id, mail_adr "
                    . "FROM mail "
                    . "WHERE mail_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Select for update de tous les enregistrements associé à un compte
     * 
     * @param $id
     * attend l'id de l'adresse mail
     * @return objet
     * Retourne un objet
     */
    public static function getMailsFromCptForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql =  " SELECT ctc.mail_lbl, m.mail_id, m.mail_adr "
                    . "FROM mail m "
                    . "INNER JOIN contacter ctc "
                    . "ON m.mail_id=ctc.mail_id  "
                    . "INNER JOIN compte cpt "
                    . "ON ctc.cpt_id=cpt.cpt_id "
                    . "WHERE cpt.cpt_id =? FOR UPDATE";
            
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oMail
     * Attend un objet Mail
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updGamme($oMail) {
        
        try {
                $tParam = [
                    $oMail->mail_adr,
                    $oMail->mail_id
                ];

                $sql = "UPDATE mail SET "
                        . "mail_adr = ?, "
                        . "WHERE mail_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'adresse mail
     * @return int 
     * nombre de ligne impacté
     */
    public static function delMail($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM mail WHERE mail_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
