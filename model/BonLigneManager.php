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
