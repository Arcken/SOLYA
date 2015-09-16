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

            if (!empty($Personne->PRS_NOM) && (strlen($Personne->PRS_NOM)) > Connection::getLimLbl()) {

                $tParamPrs = array(
                    $Personne->PRS_NOM,
                    $Personne->PRS_PRENOM1,
                    $Personne->PRS_PRENOM2,
                    $Personne->PRS_PRENOM3,
                    $Personne->PRS_DTN
                );

                $sqlPrs = "INSERT INTO personne ("
                        . "PRS_NOM,"
                        . "PRS_PRENOM1,"
                        . "PRS_PRENOM2,"
                        . "PRS_PRENOM3,"
                        . "PRS_DTN)"
                        . "VALUES(?,?,?,?,?)";
              

                $result = Connection::request(2, $sqlPrs, $tParamPrs);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans NOM </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }

}
