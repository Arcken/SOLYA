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
     * @return Regrouper[]
     * Retourne un tableau d'objet
     */
    public static function getAllRegroupers() {

        try {

            $sql = 'SELECT ga_id, fiart_id FROM regrouper';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Retourne toutes les gammes associé à une fiche article
     * @param integer
     * ID de la fiche article
     * @return objet[]
     * Renvoie un tableau d'objet
     */
    public static function getRegrouperFiart($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'SELECT fiart_id, ga_id FROM regrouper WHERE fiart_id=?';
            $result = Connection::request(1, $sql, $tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table REGROUPER
     * @param $oRegrouper
     * Attend un objet Rgrouper 
     * @return string
     * Renvoie un chaîne de caractère selon le succés ou non 
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

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement Regrouper impossible</p>';
            }
        } catch (MySQLException $e) {
            $result = '<br/><p class="info">Erreur, insert défectueux</p>';
        }
        return $result;
    }

    /**
     * Efface tous les enregistrements de la table Regrouper concernant une fiche article
     * @param integer
     * ID de la fiche article
     * @return type
     */
    public static function delRegrouperFiart($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'DELETE FROM regrouper WHERE fiart_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

}

?>