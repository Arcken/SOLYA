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
            $tParam = array(
                $oAdresse->pays_id,
                $oAdresse->adr_num,
                $oAdresse->adr_voie,
                $oAdresse->adr_rue1,
                $oAdresse->adr_rue2,
                $oAdresse->adr_rue3,
                $oAdresse->adr_cp,
                $oAdresse->adr_ville,
                $oAdresse->adr_etat,
            );

            $sql = "INSERT INTO adresse ("
                    . "pays_id,"
                    . "adr_num,"
                    . "adr_voie,"
                    . "adr_rue1,"
                    . "adr_rue2,"
                    . "adr_rue3,"
                    . "adr_cp,"
                    . "adr_ville,"
                    . "adr_etat)"
                    . "VALUES(?,?,?,?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
