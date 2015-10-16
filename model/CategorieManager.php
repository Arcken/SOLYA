<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table CATEGORIE
 */
class CategorieManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllCategories() {

        try {

            $sql = 'SELECT catent_id, catent_lbl FROM categorie '
                    . 'ORDER BY catent_lbl';
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
    public static function getCategoriesLim($rowStart, $nbRow, 
            $orderBy = 'catent_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT catent_id, catent_lbl '
                    . 'FROM categorie '
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
     * @param $oCategorie
     * attend un objet de la classe Categorie
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addCategorie($oCategorie) {

        try {
                $tParam = [
                    $oCategorie->catent_lbl,
                ];

                $sql = "INSERT INTO categorie ("
                        . " catent_lbl) "
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
     * attend l'id de la categorie
     * @return objet
     * Retourne un objet
     */
    public static function getCategorieDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT catent_id, catent_lbl "
                    . "FROM categorie "
                    . "WHERE catent_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oCategorie
     * Attend un objet Categorie
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updCategorie($oCategorie) {
        
        try {
                $tParam = [
                    $oCategorie->catent_lbl,
                    $oCategorie->catent_id
                ];

                $sql = "UPDATE categorie SET "
                        . "catent_lbl = ?, "
                        . "WHERE catent_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la categorie
     * @return int 
     * nombre de ligne impacté
     */
    public static function delCategorie($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM categorie WHERE catent_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
