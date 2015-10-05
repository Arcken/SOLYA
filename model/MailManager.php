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
                $oMail->MAIL_ADR
            );

            $sql = "INSERT INTO mail ("
                    . "MAIL_ADR)"
                    . "VALUES(?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
    }

}
