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

            $sql = 'SELECT pays_id, pays_nom, pays_abv, pays_dvs_nom, pays_dvs_abv, pays_dvs_sym FROM pays';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
/**
 * Insert une enregistrement dans la table pays
 * @param $oPays
 * Attend un objet Pays
 * @return string
 */
    public static function addPays($pays) {

        try {

            if (!empty($pays->pays_nom) && (strlen($pays->pays_nom) > Connection::getLimLbl())) {

                $tParam = array(
                    $pays->pays_nom,
                    $pays->pays_abv,
                    $pays->pays_dvs_nom,
                    $pays->pays_dvs_abv,
                    $pays->pays_dvs_sym
                    
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
    
    public static function getPaysFromFiArt($fiArtId){
        
        $tParam = array(
            $fiArtId
        );

        $sql ="SELECT pays_nom, 
                      pays_abv,
                      pays_dvs_nom,
                      pays_dvs_abv,
                      pays_dvs_sym FROM pays WHERE pays_id = ?";
        
        Connection::request(0,$sql,$tParam);
    
    }
}
