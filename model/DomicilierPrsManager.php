<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DomicilierPrsManager
 *
 * @author Olivier
 */
class DomicilierPrsManager {
    //put your code here
     public static function addDomicilierPrs($DomPrs){
         try {

            if (!empty($DomPrs->ADR_ID) && (strlen($DomPrs->ADR_ID)) > Connection::getLimLbl()
               && !empty($DomPrs->PRS_ID) && (strlen($DomPrs->PRS_ID)) > Connection::getLimLbl()
               && !empty($DomPrs->ADRPER_LBL) && (strlen($DomPrs->ADRPER_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $DomPrs->ADRPER_LBL,
                    $DomPrs->ADR_ID,
                    $DomPrs->PRS_ID
                );

                $sql = "INSERT INTO domicilier_prs ("
                        . "ADRPER_LBL,"
                        . "ADR_ID,"
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
