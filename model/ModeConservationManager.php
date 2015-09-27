<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModeConservationManager {
    //put your code here

    /**
     * Retourne tous les enregistrements de la table mode_conservation
     * 
     * @return mode_conservation[] objet
     */
    public static function getAllModeConservations() {

        try {

            $sql = 'SELECT m.cons_id,m.cons_lbl FROM mode_conservation m';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
           
        }
         return $result;
    }

     /**
     * Retourne un enregistrement de la table mode_conservation par son id
     * 
     * @return mode_conservation objet
     */
    public static function getModeConservationById($idMc) {

        try {
            $tParam=array($idMc);
            $sql = 'SELECT m.cons_id, m.cons_lbl FROM mode_conservation m WHERE m.cons_id=?';
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
           
        }
         return $result;
    }
    /**
     * Ajoute un enregistrement dans la table mode_conservation
     * @param type $Cons
     */
    public static function addModeConservation($Cons) {
        try {

            if (!empty($Cons->cons_lbl) && (strlen($Cons->cons_lbl)) > Connection::getLimLbl()) {

                $tParam = array(
                    $Cons->cons_lbl
                );

                $sql = "INSERT INTO mode_conservation ("
                        . "cons_lbl)"
                        . "VALUES(?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
    }

}
