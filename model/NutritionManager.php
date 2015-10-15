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
            $sql = 'SELECT nut_id, nut_lbl FROM nutrition '
                    . 'ORDER BY nut_lbl';
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
    public static function getAllNutritionsLim($rowStart, $nbRow, 
            $orderBy = 'nut_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT nut_id, nut_lbl '
                    . 'FROM nutrition '
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
     * Select for update selon l'id de l'enregsitrement
     * 
     * @param $id
     * attend l'id
     * @return objet
     * Retourne un objet
     */
    public static function getNutritionDetailForUpd($id) {

        try {

            $tParam = [$id];
            $sql = "SELECT nut_id, nut_lbl "
                    . "FROM nutrition "
                    . "WHERE nut_id =? FOR UPDATE";
            
            $result = Connection::request(0, $sql, $tParam);
            
            } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oNutrition
     * Attend un objet Nutrition
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updNutrition($oNutrition) {
        try {

                $tParam = array(                
                    $oNutrition->nut_lbl,
                    $oNutrition->nut_id
                );

                $sql = "UPDATE nutrition SET "
                        . "NUT_LBL = ? "
                        . "WHERE nut_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
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
    
    
     /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'élément
     * @return int 
     * nombre de ligne impacté
     */
    public static function delNutrition($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM nutrition WHERE nut_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
