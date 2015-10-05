<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ContacterPrsManager {

    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oCtcPrs
     * Attend un objet de la classe ContaterPersonne
     */
    public static function addContacterPrs($oCtcPrs) {

        try {
            $tParam = array(
                $oCtcPrs->mailper_lbl,
                $oCtcPrs->mail_id,
                $oCtcPrs->prs_id
            );

            $sql = "INSERT INTO contacter_prs ("
                    . "MAILPER_LBL,"
                    . "MAIL_ID,"
                    . "PRS_ID)"
                    . "VALUES(?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
