<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BonLigneManager
 *
 * @author Olivier
 */
class BonLigneManager {
    
    
    /**
     * Retourne tout les lignes de bon associées à un bon
     * 
     * @param $bonId
     * Id du bon 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getBonLignesFromBon($bonId) {

        try {

            $sql = 'SELECT bon_id, lig_id'
                   .' FROM bon_ligne '
                   .' WHERE bon_id = ' . $bonId;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table Bon_Ligne
     * @param type $oBonLigne
     */
    public static function addBonLigne($oBonLigne) {
        try {
            
            $tParam = array(
                $oBonLigne->lig_id,
                $oBonLigne->bon_id
            );

            $sql = "INSERT INTO bon_ligne ("
                    . "lig_id,"
                    . "bon_id) "
                    . "VALUES(?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
