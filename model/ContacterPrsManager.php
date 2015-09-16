<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContacterPrsManager
 *
 * @author Olivier
 */
class ContacterPrsManager {
    //put your code here
     public static function addContacterPrs($CtcPrs){
         try {

            if (!empty($CtcPrs->MAIL_ID) 
               && !empty($CtcPrs->PRS_ID) 
               && !empty($CtcPrs->MAILPER_LBL) && (strlen($CtcPrs->MAILPER_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $CtcPrs->MAILPER_LBL,
                    $CtcPrs->MAIL_ID,
                    $CtcPrs->PRS_ID
                );

                $sql = "INSERT INTO contacter_prs ("
                        . "MAILPER_LBL,"
                        . "MAIL_ID,"
                        . "PRS_ID)"
                        . "VALUES(?,?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans NOM </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}
