<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Manager de la table GAMME
 */
class GammeManager {

    /**
     * Retourne tous les enregistrements de la table Gamme
     * 
     * @return gamme[]
     */
    public static function getAllGammes() {

        try {

            $sql = 'SELECT * FROM gamme';
            $result = Connection::request($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
/**
 * Insert une enregistrement dans la table gamme
 * @param type $gamme
 * @return string
 */
    public static function addGamme($gamme) {

        try {

            if (!empty($gamme->GA_LBL) && (strlen($gamme->ref_lbl) > Connection::getLimLbl())) {

                $tParam = array(
                    $gamme->GA_LBL
                );

                $sql = "INSERT INTO gamme ("
                        . "GA_LBL) " .
                        " VALUES(?)";

                $result = Connection::request($sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
        } catch (MySQLException $e) {


            $result = '<br/><p class="info">la Référence a bien était ajouté </p>';
        }
        return $result;
    }

}
