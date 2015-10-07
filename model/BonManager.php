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
     * Retourne tous les enregistrements de la table Bon
     * par défaut la table remonte les 15 premiers résultats.
     * Il est possible cependant de modifier
     * le résultats attendu grace aux paramètres :
     * 
     * @param $limit par défaut 15
     * 
     * @param $nombre par défaut 0
     * @param orderBy par défaut ref_id DESC
     * @return Reference[]
     */
    public static function getAllBon($limit=15,
                                     $nombre=0,
                                     $orderby="ref_id") {
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
