<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailManager
 *
 * @author Olivier
 */
class MailManager {
    //put your code here
    
    public static function addMail($Mail){
         try {

            if (!empty($Mail->MAIL_ADR) && (strlen($Mail->MAIL_ADR)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Mail->MAIL_ADR
                );

                $sql = "INSERT INTO mail ("
                        . "MAIL_ADR)"
                        . "VALUES(?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans NOM </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

