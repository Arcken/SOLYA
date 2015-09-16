<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonneManager
 *
 * @author Olivier
 */
class PersonneManager {

    public static function addPersonne($Personne) {
        
        try {

            if (!empty($Personne->PRS_NOM) && (strlen($Personne->PRS_NOM)) > Connection::getLimLbl()
                && !empty($Personne->PRS_PRENOM1) && (strlen($Personne->PRS_PRENOM1)) > Connection::getLimLbl()
                && !empty($Personne->CIV_ID)){

                $tParam = array(
                    $Personne->CIV_ID,
                    $Personne->PRS_NOM,
                    $Personne->PRS_PRENOM1,
                    $Personne->PRS_PRENOM2,
                    $Personne->PRS_PRENOM3,
                    $Personne->PRS_DTN
                );

                $sql = "INSERT INTO personne ("
                        . "CIV_ID,"
                        . "PRS_NOM,"
                        . "PRS_PRENOM1,"
                        . "PRS_PRENOM2,"
                        . "PRS_PRENOM3,"
                        . "PRS_DTN)"
                        . "VALUES(?,?,?,?,?,?)";
              

                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans NOM,prénom et civilité</p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }

}
