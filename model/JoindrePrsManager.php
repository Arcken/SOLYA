<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JoindrePrsManager
 *
 * @author Olivier
 */
class JoindrePrsManager {
       //put your code here
     public static function addJoindrePrs($JoindrePrs){
         try {

            if (!empty($JoindrePrs->TEL_ID) && (strlen( $JoindrePrs->TEL_ID)) > Connection::getLimLbl()
               && !empty($JoindrePrs->PRS_ID) && (strlen( $JoindrePrs->PRS_ID)) > Connection::getLimLbl()
               && !empty( $JoindrePrs-> TELPER_LBL) && (strlen( $JoindrePrs-> TELPER_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                     $JoindrePrs-> TELPER_LBL,
                     $JoindrePrs->TEL_ID,
                     $JoindrePrs->PRS_ID
                );

                $sql = "INSERT INTO joindre_prs ("
                        . "TELPER_LBL,"
                        . "TEL_ID,"
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
