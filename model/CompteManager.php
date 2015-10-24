<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompteManager
 *
 * @author Olivier
 */
class CompteManager {
    
    
    /**
     * Retourne un les enregistrements de la table selon son id
     * @param $cptId identifiant de la ligne
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getCompte($cptId) {

        try {
            $tParam=[$cptId];
            
            $sql = 'SELECT cpt_id, cpt_date, cpt_nom, cpt_com, cpt_code,cpt_type FROM compte '
                  .'WHERE cpt_id =?';
            
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllComptes() {

        try {

            $sql = 'SELECT cpt_id, cpt_date, cpt_nom, cpt_com, cpt_code,cpt_type FROM compte '
                  .'ORDER BY cpt_nom';
            $result = Connection::request(1, $sql);
            
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
    public static function getComptesLim($rowStart, $nbRow, $orderBy = 'cpt_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT cpt_id, cpt_date, cpt_nom, cpt_com, cpt_code, cpt_type '
                    . 'FROM compte '
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
     * Insert une enregistrement dans la table 
     * @param $oCompte
     * attend un objet de la classe Compte
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addCompte($oCompte) {

        try {
                $tParam = [
                    $oCompte->cpt_date,
                    $oCompte->cpt_nom,
                    $oCompte->cpt_com,
                    $oCompte->cpt_code,
                    $oCompte->cpt_type
                ];

                $sql = "INSERT INTO compte ("
                        . " cpt_date,"
                        . " cpt_nom,"
                        . " cpt_com,"
                        . " cpt_code,"
                        . " cpt_type) "
                        . " VALUES(?,?,?,?,?)";

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
     * attend l'id de la compte
     * @return objet
     * Retourne un objet
     */
    public static function getCompteDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT cpt_id, cpt_date, cpt_nom, cpt_com, cpt_code,cpt_type "
                    . "FROM compte "
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
     * @param $oCompte
     * Attend un objet Compte
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updCompte($oCompte) {
        
        try {
                $tParam = [
                    $oCompte->cpt_nom,
                    $oCompte->cpt_com,
                    $oCompte->cpt_code,
                    $oCompte->cpt_id
                ];

                $sql = "UPDATE compte SET "
                        . "cpt_nom=?,"
                        . "cpt_com=?,"
                        . "cpt_code=? "
                        . "WHERE cpt_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
