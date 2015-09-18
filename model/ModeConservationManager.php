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

            $sql = 'SELECT * FROM mode_conservation';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table mode_conservation
     * @param type $Cons
     */
    public static function addModeConservation($Cons){
         try {

            if (!empty($Cons->CONS_LBL) && (strlen($Cons->CONS_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Cons->CONS_LBL
                );

                $sql = "INSERT INTO mode_conservation ("
                        . "CONS_LBL)"
                        . "VALUES(?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

