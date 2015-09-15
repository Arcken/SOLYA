<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Manager de la table GAMME
 */
class PaysManager {

    /**
     * Retourne tous les enregistrements de la table Gamme
     * 
     * @return gamme[]
     */
    public static function getAllPays() {

        try {

            $sql = 'SELECT * FROM pays';
            $result = Connection::request(1,$sql);
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
    public static function addPays($pays) {

        try {

            if (!empty($pays->PAYS_NOM) && (strlen($pays->PAYS_NOM) > Connection::getLimLbl())) {

                $tParam = array(
                    $pays->PAYS_NOM,
                    $pays->PAYS_ABV,
                    $pays->PAYS_DVS_NOM,
                    $pays->PAYS_DVS_ABV,
                    $pays->PAYS_DVS_SYM
                    
                );

                $sql = "INSERT INTO pays ("
                        . " PAYS_NOM, "
                        . " PAYS_ABV, "
                        . " PAYS_DVS_NOM, "
                        . " PAYS_DVS_ABV, "
                        . " PAYS_DVS_SYM) "
                        . " VALUES(?,?,?,?,?)";

                $result = Connection::request(2,$sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
        } catch (MySQLException $e) {


            $result = '<br/><p class="info">la Référence a bien était ajouté </p>';
        }
        return $result;
    }

}
