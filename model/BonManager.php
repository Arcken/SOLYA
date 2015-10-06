<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BonManager
 *
 * @author Olivier
 */
class BonManager {

    /**
     * Ajoute un enregistrement dans la table Bon
     * @param type $oBon
     */
    public static function addBon($oBon) {
        try {



            $tParam = array(
                $oBon->doclbl_id,
                $oBon->bon_fact_num,
                $oBon->bon_date,
                $oBon->bon_sortie_assoc
            );

            $sql = "INSERT INTO bon("
                    . "doclbl_id,"
                    . "bon_fact_num,"
                    . "bon_date,"
                    . "bon_sortie_assoc) "
                    . "VALUES(?,?,?,?)";

          $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
