<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NutritionManager {

    /**
     * Retourne tous les enregistrements de la table nutrition
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllNutritions() {

        try {

            $sql = 'SELECT nut_id, nut_lbl FROM nutrition';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

    /**
     * Ajoute un enregistrement dans la table nutrition
     * @param $oNut
     * attend un objet de la classe Nutrition
     * @return int
     * Nombre de ligne inséré
     */
    public static function addNutrition($oNut) {
        try {

            if (!empty($oNut->nut_lbl) && (strlen($oNut->nut_lbl)) > Connection::getLimLbl()) {

                $tParam = array(
                    $oNut->nut_lbl
                );

                $sql = "INSERT INTO nutrition ("
                        . "NUT_LBL)"
                        . "VALUES(?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = 0;
            }
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

}
