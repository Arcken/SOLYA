<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class ContacterPrsManager {
    //put your code here
     public static function addContacterPrs($CtcPrs){
         try {

            if (!empty($CtcPrs->mail_id) 
               && !empty($CtcPrs->prs_id) 
               && !empty($CtcPrs->mailper_lbl) && (strlen($CtcPrs->mailper_lbl)) > Connection::getLimLbl()) {

                $tParam= array(
                    $CtcPrs->mailper_lbl,
                    $CtcPrs->mail_id,
                    $CtcPrs->prs_id
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
