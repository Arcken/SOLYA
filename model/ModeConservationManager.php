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
}
