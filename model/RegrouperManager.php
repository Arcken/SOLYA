<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Manager de la table REGROUPER
 */
class RegrouperManager {

    /**
     * Retourne tous les enregistrements de la table REGROUPER
     * 
     * @return gamme[]
     */
    public static function getAllRegroupers() {

        try {

            $sql = 'SELECT * FROM regrouper';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    
    public static function getRegrouperFiart($iFiartId) {
        try {
            $tParam = array(
                    $iFiartId
                    );
            $sql = 'SELECT fiart_id,ga_id FROM regrouper WHERE fiart_id=?';
            $result = Connection::request(1,$sql,$tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
 * Insert une enregistrement dans la table REGROUPER
 * @param type $regrouper
 * @return string
 */
    public static function addRegrouper($regrouper) {

        try {

            if (!empty($regrouper->ga_id) && !empty($regrouper->fiart_id)) {

                $tParam = array(
                    $regrouper->ga_id,
                    $regrouper->fiart_id
                );

                $sql = "INSERT INTO regrouper ("
                        . " GA_ID, "
                        . " FIART_ID) "
                        . " VALUES(?,?)";

                $result = Connection::request(2,$sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement Regrouper impossible</p>';
            }
        } catch (MySQLException $e) {


            $result = '<br/><p class="info">Erreur, insert défectueux</p>';
        }
        return $result;
    }

    public static function delRegrouperFiart($iFiartId){
        try {
            $tParam = array(
                    $iFiartId
                    );
            $sql = 'DELETE FROM regrouper WHERE fiart_id=?';
            $result = Connection::request(2,$sql,$tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    
    }
    
}
?>