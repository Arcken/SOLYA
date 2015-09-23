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
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllNutritions() {

        try {

            $sql = 'SELECT nut_id, nut_lbl FROM nutrition';
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
     * Ajoute un enregistrement dans la table nutrition
     * @param type $Nut
     */
    public static function addNutrition($Nut){
         try {

            if (!empty($Nut->nut_lbl) && (strlen($Nut->nut_lbl)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Nut->nut_lbl
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

