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
     * Retourne un enregistrements de la table selon son id
     * @param $docLblId
     * Identifiant du libellé
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getDocLibelle($docLblId) {

        try {
            $tParam=[$docLblId];
            $sql = "SELECT doclbl_id, doclbl_lbl FROM doc_libelle " 
                            ."WHERE doclbl_id=? ";
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllDocsLibelles() {

        try {

            $sql = "SELECT doclbl_id, doclbl_lbl FROM doc_libelle " 
                            ."ORDER BY doclbl_id";
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $rowStart
     * debut de limite
     * @param $nbRow
     * nombre d'élément à recevoir
     * @param $orderBy
     * champs pour le tri
     * @param $sort
     * tri croissant ou décroissant (ASC ou DESC)
     * @return Objet[]
     * Retourne un tableau d'objet
     */
public static function getDocLibellesLim($limit, $nbRow,$orderBy="doclbl_id", $sort = "ASC") {

        try {

            $sql = "SELECT doclbl_id, doclbl_lbl FROM doc_libelle " 
                            ."ORDER BY ".$orderBy
                            ." " . $sort
                            ." LIMIT ".$nbRow.",".$limit."";

            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
           throw $e;
        }
        return $result;
    }
}
