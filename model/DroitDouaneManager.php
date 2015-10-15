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
    public static function getAllDroitsDouanes() {

        try {

            $sql = 'SELECT dd_id, dd_lbl, dd_taux FROM droit_douane '
                    . 'ORDER BY dd_id';

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
    public static function getDroitsDouanesLim($rowStart, $nbRow, $orderBy = 'dd_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT dd_id, dd_lbl, dd_taux '
                    . 'FROM droit_douane '
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
     * attend l'id du droit douane
     * @return objet
     * Retourne un objet
     */
    public static function getDroitDouaneDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT dd_id, dd_lbl, dd_taux "
                    . "FROM droit_douane "
                    . "WHERE dd_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oDd
     * Attend un objet Droit douane
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updDroitDouane($oDd) {
        
        try {
                $tParam = [
                    $oDd->dd_lbl,
                    $oDd->dd_taux,
                    $oDd->dd_id
                ];

                $sql = "UPDATE droit_douane SET "
                        . "dd_lbl = ?, "
                        . "dd_taux = ? "
                        . "WHERE dd_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
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

    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id du droit de douane
     * @return int 
     * nombre de ligne impacté
     */
    public static function delDroitDouane($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM droit_douane WHERE dd_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
}
