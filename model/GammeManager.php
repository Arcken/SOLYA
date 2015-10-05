<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table GAMME
 */
class GammeManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllGammes() {

        try {

            $sql = 'SELECT ga_id, ga_lbl, ga_abv FROM gamme '
                    . 'ORDER BY ga_lbl';
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
    public static function getAllGammesLim($limite, $nombre, $orderby = 'ga_id') {

        try {

            $sql = 'SELECT ga_id, ga_lbl, ga_abv '
                    . 'FROM gamme '
                    . 'ORDER BY ' . $orderby . ' LIMIT ' . $limite . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            if ($e->getCode() === 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table 
     * @param $oGamme
     * attend un objet de la classe Gamme
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addGamme($oGamme) {

        try {

                $tParam = array(
                    $oGamme->GA_LBL,
                    $oGamme->GA_ABV
                );

                $sql = "INSERT INTO gamme ("
                        . " GA_LBL, "
                        . " GA_ABV) "
                        . " VALUES(?,?)";

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
     * attend l'id de la gamme
     * @return objet
     * Retourne un objet
     */
    public static function getGammeDetailUpd($id) {

        try {

            $tParam = array(
                $id
            );
            $sql = "SELECT ga_id, ga_lbl, ga_abv "
                    . "FROM gamme "
                    . "WHERE ga_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        
        }
        return $result;
    }
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oGamme
     * Attend un objet Gamme
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updGamme($oGamme) {
        try {

                $tParam = array(                
                    $oGamme->ga_lbl,
                    $oGamme->ga_abv,
                    $oGamme->ga_id
                );

                $sql = "UPDATE gamme SET "
                        . "GA_LBL = ?, "
                        . "GA_ABV = ? "
                        . "WHERE ga_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de la gamme
     * @return int 
     * nombre de ligne impacté
     */
    public static function delGamme($id) {
        try {
            $tParam = array(
                $id
            );
            $sql = 'DELETE FROM gamme WHERE ga_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
