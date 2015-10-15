<?php

/**
 * Manager de la table INFORMER
 */
class InformerManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllInformers() {

        try {
            $sql = 'SELECT * FROM informer';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne les enregistrements selon l'id de la fiche article
     * @param $iFiartId
     * Id de la fiche article
     * @return objet[]
     * Retoourne un tableau d'objet
     */
    public static function getFiartInformer($iFiartId) {

        try {
            $tParam = [$iFiartId];
            $sql = 'SELECT fiart_id,nut_id, nutfiart_val, nutfiart_ajr '
                    . 'FROM informer WHERE fiart_id = ?';
            $result = Connection::request(1, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Insert une enregistrement dans la table
     * @param $oInformer
     * attend un objet de la classe Informer
     * @return int
     * Retourne le nombre de ligne inséré
     */
    public static function addInformer($oInformer) {

        try {
                 $tParam = array(
                    $oInformer->fiart_id,
                    $oInformer->nut_id,
                    $oInformer->nutfiart_val,
                    $oInformer->nutfiart_ajr
                );

                $sql = "INSERT INTO informer ("
                        . " FIART_ID, "
                        . " NUT_ID, "
                        . " NUTFIART_VAL, "
                        . " NUTFIART_AJR) "
                        . " VALUES(?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Efface un élément de la table selon l'id de la fiche article
     * @param $iFiartId
     * id de la fiche article
     * @return int
     * renvoie le nombre de ligne supprimé
     */
    public static function delInformerFiart($iFiartId) {
        try {
            $tParam = [$iFiartId];
            $sql = 'DELETE FROM informer WHERE fiart_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
