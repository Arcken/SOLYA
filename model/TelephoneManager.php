<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TelephoneManager
 *
 * @author Olivier
 */
class TelephoneManager {
    //put your code here
    
     public static function addTel($Telephone){
         try {

            if (!empty($Telephone->TEL_IND) && (strlen($Telephone->TEL_IND)) >2 &&
                !empty($Telephone->TEL_NUM) && (strlen($Telephone->TEL_NUM)) > 5) {

                $tParam= array(
                    $Telephone->TEL_IND,
                    $Telephone->TEL_NUM
                );

                $sql = "INSERT INTO telephone ("
                        . "TEL_IND,"
                        . "TEL_NUM)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans NOM </p>';
            }
            
        } catch (MySQLException $e) {
            
            echo $e->RetourneErreur();
        }
      
    }
}
