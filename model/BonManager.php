<?php

/**
 * Manager de la classe Bon
 * Contient des Méthodes static pour
 * l'ajout, la suppression, la modification et la lecture
 * de la table Bon.
 * 
 */
class BonManager {
    /**
     * Retourne un enregistrement de la table Bon pour mise a jour
     * selon son ID.
     *  
     * @param type $bonId
     * @return type
     * @throws MySQLException
     */
     public static function getBon($bonId) {
        try {

          $tParam=[$bonId];

            $sql = "SELECT bon_id, "
                         ."doclbl_id,"
                         ."bon_fact_num,"
                         ."bon_date,"
                         ."bon_com,"
                         ."bon_sortie_assoc FROM bon "
                         ."WHERE bon_id=?";
            
          $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne un enregistrement de la table Bon pour mise a jour
     * selon son ID.
     *  
     * @param type $bonId
     * @return type
     * @throws MySQLException
     */
     public static function getBonForUpd($bonId) {
        try {

          $tParam=[$bonId];

            $sql = "SELECT bon_id, "
                         ."doclbl_id,"
                         ."bon_fact_num,"
                         ."bon_date,"
                         ."bon_com,"
                         ."bon_sortie_assoc FROM bon "
                         ."WHERE bon_id=? FOR UPDATE";
            
          $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
 
   /**
     * Retourne tous les enregistrements de la table Bon
     * par défaut la table remonte les 15 premiers résultats.
     * Il est possible cependant de modifier
     * le résultats attendu grace aux paramètres :
     * 
     * @param orderBy par défaut ref_id 
     * @param $tri par défaut ASC 
     * @param $limite par défaut 0
     * @param $nombre par défaut 15
     * @return Bon []
     */
    public static function getAllBon($limite=0,
                                     $nombre=15,
                                     $orderby="bon_id",
                                     $tri="ASC") {
        try {

          

            $sql = "SELECT bon_id, "
                         ."doclbl_id,"
                         ."bon_fact_num,"
                         ."bon_date,"
                         ."bon_com,"
                         ."bon_sortie_assoc FROM bon "
                         ."ORDER BY ".$orderby
                         ." " . $tri 
                         ." LIMIT " 
                         .$limite . " , " . $nombre;

          $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

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
                $oBon->bon_com,
                $oBon->bon_sortie_assoc
            );

            $sql = "INSERT INTO bon("
                    . "doclbl_id,"
                    . "bon_fact_num,"
                    . "bon_date,"
                    . "bon_com,"
                    . "bon_sortie_assoc) "
                    . "VALUES(?,?,?,?,?)";

          $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Ajoute un enregistrement dans la table Bon
     * @param type $oBon
     */
    public static function updBon($oBon) {
        try {



            $tParam = array(
                
                $oBon->doclbl_id,
                $oBon->bon_fact_num,
                $oBon->bon_date,
                $oBon->bon_com,
                $oBon->bon_sortie_assoc,
                $oBon->bon_id    
            );

            $sql = "UPDATE bon SET "
                    . "doclbl_id = ?,"
                    . "bon_fact_num = ?,"
                    . "bon_date = ?,"
                    . "bon_com  = ?,"
                    . "bon_sortie_assoc = ? "
                    . "WHERE bon_id = ? ";

          $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
