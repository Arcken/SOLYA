<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocLibelleManager
 *
 * @author Olivier
 */
class DocLibelleManager {
    
     /**
     * Retourne tous les enregistrements de la table DocLibelle
     * par défaut la table remonte les 15 premier résultats.
     * Il est possible cependant de modifier
     * le résultats attendu grace aux paramètres :
     *   
     * @param integer $limit par défaut 15
     * @param integer $nombre par défaut 0
     * @param string orderBy par défaut doclbl_id DESC
     * @return DocLibelle[]
     */
public static function getDocLibelles($limit=15, $nombre=0,$orderby="doclbl_id") {

        try {

            $sql = "SELECT doclbl_id, doclbl_lbl FROM doc_libelle " 
                            ."ORDER BY ".$orderby." ASC "
                            ."LIMIT ".$nombre.",".$limit."";

            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
           throw $e;
        }
        return $result;
    }
}
