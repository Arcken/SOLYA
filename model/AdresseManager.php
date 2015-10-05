<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe manager des objets fiche article
 *
 *
 */
class AdresseManager {

    /**
     * Ajout une enregistrement dans la table
     * 
     * @param $oAdresse
     * Attend un objet de la classe Adresse
     * 
     */
    public static function addAddresse($oAdresse) {

        try {
            $tParam = array($oAdresse->PAYS_ID,
                $oAdresse->ADR_NUM,
                $oAdresse->ADR_VOIE,
                $oAdresse->ADR_RUE1,
                $oAdresse->ADR_RUE2,
                $oAdresse->ADR_RUE3,
                $oAdresse->ADR_CP,
                $oAdresse->ADR_VILLE,
                $oAdresse->ADR_ETAT,
            );

            $sql = "INSERT INTO adresse ("
                    . "PAYS_ID,"
                    . "ADR_NUM,"
                    . "ADR_VOIE,"
                    . "ADR_RUE1,"
                    . "ADR_RUE2,"
                    . "ADR_RUE3,"
                    . "ADR_CP,"
                    . "ADR_VILLE,"
                    . "ADR_ETAT)"
                    . "VALUES(?,?,?,?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
