<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PrixVenteManager {

    /**
     * Retourne le prix de vente le plus récent d'une référence
     * 
     * @param $refId
     * Id de la référence
     * 
     * @return objet
     * retourne un objet
     */
    public static function getCurPrixVente($refId) {

        try {
            $tParam = [$refId];

            $sql = 'SELECT pv.pve_id,'
                    . 'pv.ref_id, '
                    . 'pv.pve_per,'
                    . 'pv.pve_ent, '
                    . 'pv.pve_date '
                    . 'FROM prix_vente pv '
                    . 'WHERE pv.ref_id=? '
                    . 'ORDER BY pv.pve_date DESC LIMIT 0,1 ';

            $result = Connection::request(0, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne tous les enregistrements de la table prix_vente
     * 
     * @return []objet
     * retourne un tableau d'objet
     */
    public static function getAllPrixVentes() {

        try {

            $sql = 'SELECT * FROM prix_vente';

            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $Pve
     * 
     * @return int
     * Retourne le nombre d'insert
     */
    public static function addPrixVente($Pve) {
        
        try {
            $tParam = array(
                $Pve->ref_id,
                $Pve->pve_per,
                $Pve->pve_ent
            );

            $sql = "INSERT INTO prix_vente ("
                    . "REF_ID,"
                    . "PVE_PER,"
                    . "PVE_ENT,"
                    . "PVE_DATE)"
                    . "VALUES(?,?,?,NOW())";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
