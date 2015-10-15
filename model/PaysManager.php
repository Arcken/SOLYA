<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Manager de la table Pays
 */
class PaysManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllPays() {

        try {

            $sql = 'SELECT pays_id, pays_nom, pays_abv, pays_dvs_nom, '
                    . 'pays_dvs_abv, pays_dvs_sym '
                    . 'FROM pays';

            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            $result = 0;
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
    public static function getAllPaysLim($rowStart, $nbRow, 
            $orderBy = 'pays_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT pays_id, pays_nom, pays_abv, '
                    . 'pays_dvs_nom, pays_dvs_abv, pays_dvs_sym '
                    . 'FROM pays '
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
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id du pays
     * @return objet
     * Retourne un objet
     */
    public static function getPaysDetailUpd($id) {

        try {

            $tParam = [$id];
            $sql = 'SELECT pays_id, pays_nom, pays_abv, pays_dvs_nom, '
                    . 'pays_dvs_abv, pays_dvs_sym '
                    . 'FROM pays '
                    . "WHERE pays_id =? FOR UPDATE";

            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oPays
     * Attend un objet Pays
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updPays($oPays) {
        try {

            $tParam = array(
                $oPays->pays_nom,
                $oPays->pays_abv,
                $oPays->pays_dvs_nom,
                $oPays->pays_dvs_abv,
                $oPays->pays_dvs_sym,
                $oPays->pays_id
            );

            $sql = "UPDATE pays SET "
                    . "PAYS_NOM = ?, "
                    . "PAYS_ABV = ?, "
                    . "PAYS_DVS_NOM = ?, "
                    . "PAYS_DVS_ABV = ?, "
                    . "PAYS_DVS_SYM = ? "
                    . "WHERE pays_id =?";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table
     * @param $oPays
     * Attend un objet Pays
     * @return int
     * nombre de ligne inséré
     */
    public static function addPays($oPays) {

        try {
            $tParam = array(
                $oPays->pays_nom,
                $oPays->pays_abv,
                $oPays->pays_dvs_nom,
                $oPays->pays_dvs_abv,
                $oPays->pays_dvs_sym
            );

            $sql = "INSERT INTO pays ("
                    . " PAYS_NOM, "
                    . " PAYS_ABV, "
                    . " PAYS_DVS_NOM, "
                    . " PAYS_DVS_ABV, "
                    . " PAYS_DVS_SYM) "
                    . " VALUES(?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'enregistrement
     * @return int 
     * nombre de ligne impacté
     */
    public static function delPays($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM pays WHERE pays_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
