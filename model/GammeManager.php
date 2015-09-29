<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table GAMME
 */
class GammeManager {

    /**
     * Retourne tous les enregistrements de la table Gamme
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllGammes() {

        try {

            $sql = 'SELECT ga_id, ga_lbl, ga_abv FROM gamme';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            if ($e->getCode() === 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table gamme
     * @param $oGamme
     * attend un objet de la classe Gamme
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addGamme($gamme) {

        try {
            
            if (!empty($gamme->GA_LBL) 
                    && (strlen($gamme->GA_LBL) >= intval(Connection::getLimLbl()))) {

                $tParam = array(
                    $gamme->GA_LBL,
                    $gamme->GA_ABV
                );

                $sql = "INSERT INTO gamme ("
                        . " GA_LBL, "
                        . " GA_ABV) "
                        . " VALUES(?,?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement Gamme impossible sans libéllé </p>';
            }
        } catch (MySQLException $e) {

            $result = 0;
        }
        return $result;
    }

}
