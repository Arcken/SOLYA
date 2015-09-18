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

            $sql = 'SELECT * FROM duree_conservation';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table mode_conservation
     * @param type $Dc
     */
    public static function addDureeConservation($Dc){
         try {

            if (!empty($Dc->DC_LBL) && (strlen($Dc->DC_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Dc->DC_LBL,
                    $Dc->DC_NB
                );

                $sql = "INSERT INTO duree_conservation ("
                        . "DC_LBL,"
                        . "DC_NB)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

