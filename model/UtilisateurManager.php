<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class UtilisateurManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table utilisateur
     * 
     * @return utilisateur[object]
     */
    public static function getAllUtilisateurs() {

        try {

            $sql = 'SELECT * FROM utilisateur';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            
            if ($e->getCode() == 00000){
                return 0;
            }
            else return $e->getCode ();
        }
        return $result;
    }
    
    public static function getUtilisateur($Utilisateur) {

        try {

            if (!empty($Utilisateur->ut_login) 
                    && (strlen($Utilisateur->ut_login)) > Connection::getLimLbl()
                    && !empty($Utilisateur->ut_pass)
                    && (strlen($Utilisateur->ut_pass)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Utilisateur->ut_login,
                    $Utilisateur->ut_pass
                );

                $sql = "SELECT * FROM utilisateur"
                        . " NATURAL JOIN GROUPE"
                        . " WHERE UT_LOGIN =? AND UT_PASS =?";
                
                $result = Connection::request(0, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible, erreur de données saisies</p>';
            }
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000){
                return 0;
            }
            echo $e->RetourneErreur();
        }
      return $result;
    }
    
    /**
     * Ajoute un utilisateur dans la table utilisateur
     * @param type objet Utilisateur
     */
    public static function addUtilisateur($Utilisateur){
         try {

            if (!empty($Utilisateur->ut_login) 
                    && (strlen($Utilisateur->ut_login)) > Connection::getLimLbl()
                    && !empty($Utilisateur->ut_pass)
                    && (strlen($Utilisateur->ut_pass)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Utilisateur->ut_login,
                    $Utilisateur->ut_pass
                );

                $sql = "INSERT INTO utilisateur ("
                        . "UT_LOGIN,"
                        . "UT_PASS)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible, erreur de données saisies</p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

