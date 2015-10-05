<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LigneManager
 *
 * @author Olivier
 */
class LigneManager {
    
    /**
     * Ajoute un enregistrement dans la table Ligne
     * @param type $oLigne
     */
    public static function addLigne($oLigne) {
        try {

            $tParam = array(
                $oLigne->lot_id,
                $oLigne->lig_qte,
                $oLigne->lig_com,
                $oLigne->lig_com_dep
                            );

            $sql = "INSERT INTO ligne ("
                    . "lot_id,"
                    . "lig_qte,"
                    . "lig_com,"
                    . "lig_com_dep) "
                    . "VALUES(?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
