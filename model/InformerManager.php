<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Manager de la table INFORMER
 */
class InformerManager {

    /**
     * Retourne tous les enregistrements de la table INFORMER
     * 
     * @return informer[]
     */
    public static function getAllInformer() {

        try {

            $sql = 'SELECT * FROM informer';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    public static function getFiartInformer($informer) {

        try {
            if (isset($informer->fiart_id)) {
                $tParam = [$informer->fiart_id];
                $sql = 'SELECT * FROM informer WHERE fiart_id = ?';
                $result = Connection::request(1, $sql, $tParam);
            } else {
                $result = "Pas de fiche article sélectionné";
            }
        } catch (MySQLException $e) {
            $result = "Erreur de traitement de donnée";
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table gamme
     * @param type $gamme
     * @return string
     */
    public static function addInformer($informer) {

        try {

            if (isset($informer->fiart_id) &&
                    isset($informer->nut_id) &&
                    isset($informer->nutfiart_val) &&
                    $informer->nutfiart_val > 0) {

                $tParam = array(
                    $informer->fiart_id,
                    $informer->nut_id,
                    $informer->nutfiart_val,
                );

                $sql = "INSERT INTO informer ("
                        . " FIART_ID, "
                        . " NUT_ID, "
                        . " NUTRIFIART_VAL) "
                        . " VALUES(?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible</p>';
            }
        } catch (MySQLException $e) {


            $result = '<br/><p class="info">Erreur de données </p>';
        }
        return $result;
    }

}
