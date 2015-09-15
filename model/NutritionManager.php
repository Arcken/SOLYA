<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NutritionManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table nutrition
     * 
     * @return nutrition[] objet
     */
    public static function getAllNutritions() {

        try {

            $sql = 'SELECT * FROM nutrition';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table nutrition
     * @param type $Nut
     */
    public static function addNutrition($Nut){
         try {

            if (!empty($Nut->NUT_LBL) && (strlen($Nut->NUT_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Nut->NUT_LBL
                );

                $sql = "INSERT INTO nutrition ("
                        . "NUT_LBL)"
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

