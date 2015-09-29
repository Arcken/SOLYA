<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Manager de la table Pays
 */
class PaysManager {

    /**
     * Retourne tous les enregistrements de la table Pays     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllPays() {

        try {

            $sql = 'SELECT pays_id, pays_nom, pays_abv, pays_dvs_nom, '
                    . 'pays_dvs_abv, pays_dvs_sym '
                    . 'FROM pays';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            $result = 0;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table pays
     * @param $oPays
     * Attend un objet Pays
     * @return string
     */
    public static function addPays($oPays) {

        try {

            if (!empty($oPays->pays_nom) &&
                    (strlen($oPays->pays_nom) >= intval(Connection::getLimLbl()))) {

                $tParam = array(
                    $oPays->pays_nom,
                    $oPays->pays_abv,
                    $oPays->pays_dvs_nom,
                    $oPays->pays_dvs_abv,
                    $oPays->pays_dvs_sym
                );

                $sql = "INSERT INTO pays ("
                        . " PAYS_NOM, "
                        . " PAYS_ABV, "
                        . " PAYS_DVS_NOM, "
                        . " PAYS_DVS_ABV, "
                        . " PAYS_DVS_SYM) "
                        . " VALUES(?,?,?,?,?)";

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
     * Retourne le pays selon l'id de la fiche article
     * @param $iFiArtId
     * Attend l'id de la fiche article
     */
    public static function getPaysFromFiArt($fiArtId) {

        $tParam = array(
            $fiArtId
        );

        $sql = "SELECT pays_nom, 
                      pays_abv,
                      pays_dvs_nom,
                      pays_dvs_abv,
                      pays_dvs_sym FROM pays WHERE pays_id = ?";

        Connection::request(0, $sql, $tParam);
    }

}
