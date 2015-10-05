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
                    $oPersonne->CIV_ID,
                    $oPersonne->PRS_NOM,
                    $oPersonne->PRS_PRENOM1,
                    $oPersonne->PRS_PRENOM2,
                    $oPersonne->PRS_PRENOM3,
                    $oPersonne->PRS_DTN
                );

                $sql = "INSERT INTO personne ("
                        . "CIV_ID,"
                        . "PRS_NOM,"
                        . "PRS_PRENOM1,"
                        . "PRS_PRENOM2,"
                        . "PRS_PRENOM3,"
                        . "PRS_DTN)"
                        . "VALUES(?,?,?,?,?,?)";


                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
