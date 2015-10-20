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
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllPersonnes() {

        try {

            $sql = 'SELECT cpt_id, civ_id, prs_prenom1, prs_prenom2, prs_dtn '
                    . 'FROM personne '
                    . 'ORDER BY cpt_id';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Retourne un enregistrements de la table
     * @param $id
      * ID de la personne
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getPersonne($id) {

        try {
            $tParam= [$id];
            
            $sql = 'SELECT cpt_id, civ_id, prs_prenom1, prs_prenom2, prs_dtn '
                    . 'FROM personne WHERE cpt_id=?';
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

   
     /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $rowStart
     * debut de limite
     * @param $nbRow
     * nombre d'élément à recevoir
     * @param $orderBy
     * champs pour le tri
     * @param $sort
     * tri croissant ou décroissant (ASC ou DESC)
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getPersonnesLim($rowStart, $nbRow, 
            $orderBy = 'cpt_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT cpt_id, civ_id, prs_prenom1, prs_prenom2, prs_dtn '
                    . 'FROM personne '
                    . 'ORDER BY ' . $orderBy 
                    . ' ' . $sort
                    . ' LIMIT ' . $rowStart . ' , ' 
                    . $nbRow;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
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
                    $oPersonne->cpt_id,
                    $oPersonne->civ_id,
                    $oPersonne->prs_prenom1,
                    $oPersonne->prs_prenom2,
                    $oPersonne->prs_dtn
                );

                $sql = "INSERT INTO personne ("
                        . "cpt_id,"
                        . "civ_id,"
                        . "prs_prenom1,"
                        . "prs_prenom2,"
                        . "prs_dtn) "
                        . "VALUES(?,?,?,?,?)";


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
     * attend l'id de la personne
     * @return objet
     * Retourne un objet
     */
    public static function getPersonneDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT cpt_id, civ_id, prs_prenom1, prs_prenom2, prs_dtn "
                    . "FROM personne "
                    . "WHERE cpt_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oPersonne
     * Attend un objet Personne
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updPersonne($oPersonne) {
        
        try {
                $tParam = [
                    $oPersonne->civ_id,
                    $oPersonne->prs_prenom1,
                    $oPersonne->prs_prenom2,
                    $oPersonne->prs_dtn,
                    $oPersonne->cpt_id
                ];

                $sql = "UPDATE personne SET "
                        . "civ_id = ?, "
                        . "prs_prenom1 = ?, "
                        . "prs_prenom2 = ?, "
                        . "prs_dtn = ? "
                        . "WHERE cpt_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la personne
     * @return int 
     * nombre de ligne impacté
     */
    public static function delPersonne($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM personne WHERE cpt_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
