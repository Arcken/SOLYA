<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table FORME_JURIDIQUE
 */
class FormeJuridiqueManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllFormesJuridiques() {

        try {

            $sql = 'SELECT fmju_id, fmju_lbl FROM forme_juridique '
                    . 'ORDER BY fmju_lbl';
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
    public static function getFormesJuridiquesLim($rowStart, $nbRow, 
            $orderBy = 'fmju_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT fmju_id, fmju_lbl '
                    . 'FROM forme_juridique '
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
     * @param $oFormeJuridique
     * attend un objet de la classe FormeJuridique
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addFormeJuridique($oFormeJuridique) {

        try {
                $tParam = [
                    $oFormeJuridique->fmju_lbl
                ];

                $sql = "INSERT INTO forme_juridique ("
                        . " fmju_lbl) "
                        . " VALUES(?)";

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
     * attend l'id de la forme_juridique
     * @return objet
     * Retourne un objet
     */
    public static function getFormeJuridiqueDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT fmju_id, fmju_lbl "
                    . "FROM forme_juridique "
                    . "WHERE fmju_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oFormeJuridique
     * Attend un objet FormeJuridique
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updFormeJuridique($oFormeJuridique) {
        
        try {
                $tParam = [
                    $oFormeJuridique->fmju_lbl,
                    $oFormeJuridique->fmju_id
                ];

                $sql = "UPDATE forme_juridique SET "
                        . "fmju_lbl = ?, "
                        . "WHERE fmju_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la forme_juridique
     * @return int 
     * nombre de ligne impacté
     */
    public static function delFormeJuridique($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM forme_juridique WHERE fmju_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
