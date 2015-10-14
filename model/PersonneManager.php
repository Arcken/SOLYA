<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonneManager
 *
 */
class PersonneManager {

    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oPersonne
     * Attend un objet de la classe Personne
     * 
     * @return int
     * Retoune le nombre d'insert
     */
    public static function addPersonne($oPersonne) {

        try {

                $tParam = array(
                    $oPersonne->civ_id,
                    $oPersonne->prs_nom,
                    $oPersonne->prs_prenom1,
                    $oPersonne->prs_prenom2,
                    $oPersonne->prs_prenom3,
                    $oPersonne->prs_dtn
                );

                $sql = "INSERT INTO personne ("
                        . "civ_id,"
                        . "prs_nom,"
                        . "prs_prenom1,"
                        . "prs_prenom2,"
                        . "prs_prenom3,"
                        . "prs_dtn)"
                        . "VALUES(?,?,?,?,?,?)";


                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
