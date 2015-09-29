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
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllRegroupers() {

        try {

            $sql = 'SELECT ga_id, fiart_id FROM regrouper';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            $result = 0;
        }
        return $result;
    }

    /**
     * Retourne toutes les gammes associé à une fiche article
     * @param $iFiartId
     * ID de la fiche article
     * @return objet[]
     * Renvoie un tableau d'objet
     */
    public static function getRegrouperFiart($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'SELECT fiart_id, ga_id '
                    . 'FROM regrouper '
                    . 'WHERE fiart_id=?';
            $result = Connection::request(1, $sql, $tParam);
        } catch (MySQLException $e) {
           $result = 0;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table REGROUPER
     * @param $oRegrouper
     * Attend un objet de la classe Regrouper 
     * @return int
     * Renvoie le nombre d'insert
     */
    public static function addRegrouper($oRegrouper) {

        try {

            if (!empty($oRegrouper->ga_id) && !empty($oRegrouper->fiart_id)) {

                $tParam = array(
                    $oRegrouper->ga_id,
                    $oRegrouper->fiart_id
                );

                $sql = "INSERT INTO regrouper ("
                        . " GA_ID, "
                        . " FIART_ID) "
                        . " VALUES(?,?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = 0;
            }
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

    /**
     * Efface tous les enregistrements de la table Regrouper concernant une fiche article
     * @param $iFiartId
     * ID de la fiche article
     * @return int
     * retourne le nombre de ligne supprimmé
     */
    public static function delRegrouperFiart($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'DELETE FROM regrouper WHERE fiart_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

}

?>