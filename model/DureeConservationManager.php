<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DureeConservationManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table mode_conservation
     * 
     * @return mode_conservation[] objet
     */
    public static function getAllDureeConservations() {

        try {

            $sql = 'SELECT d.dc_id,d.dc_lbl,d.dc_nb FROM duree_conservation d';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
             if ($e->getCode() == 00000){
                return 0;
            }
            else {
                return $e->getCode ();
            
            }
        }
        return $result;
    }
   /**
     * Retourne un enregistrement de la table mode_conservation par son id
     * 
     * @return mode_conservation objet
     */
    public static function getDureeConservationById($dcId) {

        try {
            $tParam=array($dcId);
            $sql = 'SELECT d.dc_id,d.dc_lbl,d.dc_nb FROM duree_conservation d WHERE d.dc_id =?';
            $result = Connection::request(0,$sql,$tParam);
            
        } catch (MySQLException $e) {
             if ($e->getCode() == 00000){
                return 0;
            }
            else {
                return $e->getCode ();
            
            }
        }
        return $result;
    }  
    /**
     * Ajoute un enregistrement dans la table mode_conservation
     * @param type $Dc
     */
    public static function addDureeConservation($Dc){
         try {

            if (!empty($Dc->dc_lbl) && (strlen($Dc->dc_lbl)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Dc->dc_lbl,
                    $Dc->dc_nb
                );

                $sql = "INSERT INTO duree_conservation ("
                        . "dc_lbl,"
                        . "dc_nb)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {
            die($e->retourneErreur());
           
        }
    }
}

