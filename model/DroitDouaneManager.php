<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DroitDouaneManager
 *
 * @author Olivier
 */
class DroitDouaneManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     * Retourne un tableau d'objet
     */
    public static function getAllDroitDouanes() {

        try {

            $sql = 'SELECT d.dd_id, d.dd_lbl, d.dd_taux FROM droit_douane d';

            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * * Retourne un enregistrements de la table selon son id
     * 
     * @param $id
     * Id de l'enregistrement
     * @return objet
     * Retourne un objet
     */
    public static function getDroitDouaneById($id) {

        try {
            $tParam = [$id];

            $sql = 'SELECT d.dd_id, d.dd_lbl, d.dd_taux '
                    . 'FROM droit_douane d '
                    . 'WHERE dd_id =?';

            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }

        return $result;
    }

    
    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param type $oDd
     * Attend un objet de la classe DroitDouane
     * 
     * @return int
     * Renvoie le nombre d'ajout     * 
     */
    public static function addDroitDouane($oDd) {

        try {
                $tParam = array(
                    $oDd->dd_lbl,
                    $oDd->dd_taux
                );

                $sql = "INSERT INTO droit_douane("
                        . "dd_lbl,"
                        . "dd_taux)"
                        . "VALUES(?,?)";

                $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
