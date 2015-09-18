<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class TvaManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table tva
     * 
     * @return tva[] objet
     */
    public static function getAllTvas() {

        try {

            $sql = 'SELECT * FROM tva';
            $result = Connection::request(1,$sql);
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
     * Ajoute un enregistrement dans la table tva
     * @param type $Tva
     */
    public static function addTva($Tva){
         try {

            if (!empty($Tva->TVA_LBL) && (strlen($Tva->TVA_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Tva->TVA_LBL,
                    $Tva->TVA_TAUX
                );

                $sql = "INSERT INTO tva ("
                        . "TVA_LBL,"
                        . "TVA_TAUX)"
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

