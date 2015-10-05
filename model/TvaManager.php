<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TvaManager {
    //put your code here

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     * Retourne un tableau d'objet
     */
    public static function getAllTvas() {

        try {

            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t';

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
     * Id de l'enregistrement
     * 
     * @return objet
     * Retourne un objet
     */
    public static function getTvaById($id) {

        try {
            $tParam = [$id];

            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t WHERE t.tva_id=?';

            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }

        return $result;
    }

    /**
     * Ajoute un enregistrement dans la table
     * @param $oTva
     */
    public static function addTva($oTva) {

        try {
            $tParam = array(
                $oTva->tva_lbl,
                $oTva->tva_taux
            );

            $sql = "INSERT INTO tva ("
                    . "tva_lbl,"
                    . "tva_taux)"
                    . "VALUES(?,?)";

            $result = Connection::request(2, $sql, $tParam);

        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
