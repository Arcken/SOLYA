<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DureeConservationManager {
    
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return []objet
     * Retourne un tableau d'objet
     */
    public static function getAllDureeConservations() {

        try {

            $sql = 'SELECT d.dc_id,d.dc_lbl,d.dc_nb '
                    . 'FROM duree_conservation d';
            
            $result = Connection::request(1,$sql);
            
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
    public static function getAllDureesConservationsLim($limite, $nombre, $orderby = 'dc_id') {

        try {

            $sql = 'SELECT dc_id, dc_lbl, dc_nb '
                    . 'FROM duree_conservation '
                    . 'ORDER BY ' . $orderby . ' LIMIT ' . $limite . ' , ' 
                    . $nombre;
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
     * @return mode_conservation objet
     */
    public static function getDureeConservationById($id) {

        try {
            $tParam=[$id];
            
            $sql = 'SELECT d.dc_id,d.dc_lbl,d.dc_nb '
                    . 'FROM duree_conservation d '
                    . 'WHERE d.dc_id =?';
            
            $result = Connection::request(0,$sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }  
    
    
    /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de la durée de conservation
     * @return objet
     * Retourne un objet
     */
    public static function getDureeConservationDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = "SELECT dc_id, dc_lbl, dc_nb "
                    . "FROM duree_conservation "
                    . "WHERE dc_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oDc
     * Attend un objet Durée conservation
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updDureeConservation($oDc) {
        
        try {
                $tParam = [
                    $oDc->dc_lbl,
                    $oDc->dc_nb,
                    $oDc->dc_id
                ];

                $sql = "UPDATE duree_conservation SET "
                        . "dc_lbl = ?, "
                        . "dc_nb = ? "
                        . "WHERE dc_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param type $oDc
     * Attend un objet de la classe DureeConservation
     * 
     * @return int
     * Retourne le nombre d'insert
     */
    public static function addDureeConservation($oDc){

        try {
                $tParam= array(
                    $oDc->dc_lbl,
                    $oDc->dc_nb
                );

                $sql = "INSERT INTO duree_conservation ("
                        . "dc_lbl,"
                        . "dc_nb)"
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
     * id de la durée de conservation
     * @return int 
     * nombre de ligne impacté
     */
    public static function delDureeConservation($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM duree_conservation '
                    . 'WHERE dc_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}

