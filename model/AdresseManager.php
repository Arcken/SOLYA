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
    public static function addAdresse($oAdresse) {

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
                $oAdresse->adr_etat
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
                    . "adr_etat) "
                    . "VALUES(?,?,?,?,?,?,?,?,?)";

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
     * attend l'id de l'adresse
     * @return objet
     * Retourne un objet
     */
    public static function getAdresseDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT adresse "
                    . "adr_id,"
                    . "pays_id,"
                    . "adr_num,"
                    . "adr_voie,"
                    . "adr_rue1,"
                    . "adr_rue2,"
                    . "adr_rue3,"
                    . "adr_cp,"
                    . "adr_ville,"
                    . "adr_etat "
                    . "WHERE adr_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Select for update de tous les enregistrement
     * selon son  un compte id
     * 
     * @param $id
     * attend l'id du compte
     * @return objet
     * Retourne un objet
     */
    public static function getAdressesFromCptForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql =    "SELECT "
                    . "a.adr_id,"
                    . "a.pays_id,"
                    . "a.adr_num,"
                    . "a.adr_voie,"
                    . "a.adr_rue1,"
                    . "a.adr_rue2,"
                    . "a.adr_rue3,"
                    . "a.adr_cp,"
                    . "a.adr_ville,"
                    . "a.adr_etat, "
                    . "d.adr_lbl "
                    . "FROM adresse a "
                    . "INNER JOIN domicilier d "
                    . "ON d.adr_id = a.adr_id "
                    . "INNER JOIN compte c "
                    . "ON c.cpt_id =d.cpt_id "
                    . "WHERE c.cpt_id =? FOR UPDATE";
            
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oAdresse
     * Attend un objet Adresse
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updAdresse($oAdresse) {
        
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
                $oAdresse->adr_id
            );

                $sql = "UPDATE adresse SET "
                        . "pays_id = ?, "
                        . "adr_num = ?, "
                        . "adr_voie = ?, "
                        . "adr_rue1 = ?, "
                        . "adr_rue2 = ?, "
                        . "adr_rue3 = ?, "
                        . "adr_cp = ?, "
                        . "adr_ville = ?, "
                        . "adr_etat = ? "
                        . "WHERE adr_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
     /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'adresse
     * @return int 
     * nombre de ligne impacté
     */
    public static function delAdresse($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM adresse WHERE adr_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
