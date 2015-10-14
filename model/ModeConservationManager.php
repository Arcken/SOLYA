<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModeConservationManager {
    //put your code here

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     */
    public static function getAllModeConservations() {

        try {

            $sql = 'SELECT cons_id,cons_lbl FROM mode_conservation';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $limite
     * debut de limite
     * @param $nombre
     * nombre d'élément à recevoir
     * @param $orderby
     * champs pour le tri
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllGammesLim($limite, $nombre, $orderby = 'cons_id') {

        try {

            $sql = 'SELECT cons_id, cons_lbl '
                    . 'FROM mode_conservation '
                    . 'ORDER BY ' . $orderby . ' LIMIT ' . $limite . ' , ' 
                    . $nombre;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

    /**
     * Retourne un enregistrement de la table selon son id
     * 
     * @param $id
     * id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getModeConservationById($id) {

        try {
            $tParam = [$id];
            $sql = 'SELECT cons_id, cons_lbl FROM mode_conservation '
                    . 'WHERE cons_id=?';
            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de la gamme
     * @return objet
     * Retourne un objet
     */
    public static function getModeConservationDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT cons_id, cons_lbl "
                    . "FROM mode_conservation "
                    . "WHERE cons_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oMc
     * Attend un objet ModeConservation
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updModeConservation($oMc) {
        
        try {
                $tParam = [
                    $oMc->cons_lbl,
                    $oMc->cons_id
                ];

                $sql = "UPDATE mode_conservation SET "
                        . "cons_lbl = ? "
                        . "WHERE cons_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

    /**
     * Ajoute un enregistrement dans la table
     * @param $Cons
     * objet de la classe modeConservation
     */
    public static function addModeConservation($Cons) {
        try {

            $tParam = [$Cons->cons_lbl];

            $sql = "INSERT INTO mode_conservation ("
                    . "cons_lbl) "
                    . "VALUES (?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id du mode de conservation
     * @return int 
     * nombre de ligne impacté
     */
    public static function delModeConservation($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM mode_conservation WHERE cons_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
