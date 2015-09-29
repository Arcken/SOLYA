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
     * Retourne tous les enregistrements de la table Gamme avec limite définie
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllGammesLim($limite, $nombre, $orderby = 'ga_id') {

        try {

            $sql = 'SELECT ga_id, ga_lbl, ga_abv '
                    . 'FROM gamme '
                    . 'ORDER BY ' . $orderby . ' LIMIT ' . $limite . ' , ' . $nombre;
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
    public static function addGamme($oGamme) {

        try {

            if (!empty($oGamme->GA_LBL) && (strlen($oGamme->GA_LBL) >= intval(Connection::getLimLbl()))) {

                $tParam = array(
                    $oGamme->GA_LBL,
                    $oGamme->GA_ABV
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

    /**
     * Select for update d'une gamme selon son id
     * 
     * @param $oGamme
     * attend un objet Gamme
     * @return int
     * Retourne nombre de ligne impacté
     */
    public static function getGammeDetailUpd($oGamme) {

        try {

            $tParam = array(
                $oGamme->ga_id
            );
            $sql = "SELECT ga_id, ga_lbl, ga_abv "
                    . "FROM gamme "
                    . "WHERE ga_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            $result = 0;
            
        }
        return $result;
    }
    
     /**
     * Modifie une gamme selon son id
     * 
     * @param $oGamme
     * Attend un objet Gamme
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updGamme($oGamme) {
        try {

                $tParam = array(                
                    $oGamme->ga_lbl,
                    $oGamme->ga_abv,
                    $oGamme->ga_id
                );

                $sql = "UPDATE gamme SET "
                        . "GA_LBL = ?, "
                        . "GA_ABV = ? "
                        . "WHERE ga_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            $result = 0;
            echo $e->RetourneErreur();
        }
        return $result;
    }

    /**
     * Supprime l'enregistremen de la table selon son id
     * @param int $iGaId
     * @return int nombre de ligne impacté
     */
    public static function delGamme($iGaId) {
        try {
            $tParam = array(
                $iGaId
            );
            $sql = 'DELETE FROM gamme WHERE ga_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            $result = 0;
        }
        return $result;
    }

}
