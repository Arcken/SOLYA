<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DomicilierPrsManager
 *
 */
class DomicilierPrsManager {

    /**
     * Ajout un enregistrement dans la table
     * 
     * @param $oDomPrs
     * Attend un objet de la classe DomicilierPersonne
     */
    public static function addDomicilierPrs($oDomPrs) {
        
        try {
            $tParam = array(
                $oDomPrs->ADRPER_LBL,
                $oDomPrs->ADR_ID,
                $oDomPrs->PRS_ID
            );

            $sql = "INSERT INTO domicilier_prs ("
                    . "ADRPER_LBL,"
                    . "ADR_ID,"
                    . "PRS_ID)"
                    . "VALUES(?,?,?)";

            $result = Connection::request(2, $sql, $tParam);

        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
