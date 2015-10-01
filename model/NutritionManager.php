<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NutritionManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllNutritions() {

        try {

            $sql = 'SELECT nut_id, nut_lbl FROM nutrition';
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
    public static function getAllNutritionsLim($limite, $nombre, $orderby = 'nut_id') {

        try {

            $sql = 'SELECT nut_id, nut_lbl '
                    . 'FROM nutrition '
                    . 'ORDER BY ' . $orderby . ' LIMIT ' . $limite . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

    /**
     * Ajoute un enregistrement dans la table
     * @param $oNut
     * attend un objet de la classe Nutrition
     * @return int
     * Nombre de ligne inséré
     */
    public static function addNutrition($oNut) {
        try {
            
                $tParam = array(
                    $oNut->nut_lbl
                );

                $sql = "INSERT INTO nutrition ("
                        . "NUT_LBL)"
                        . "VALUES(?)";

                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
