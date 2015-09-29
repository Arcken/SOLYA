<?php

/**
 * Manager de la table INFORMER
 */
class InformerManager {

    /**
     * Retourne tous les enregistrements de la table INFORMER
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllInformer() {

        try {

            $sql = 'SELECT * FROM informer';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

    /**
     * Retourne les nutritions selon l'id de la fiche article
     * @param $iFiartId
     * Id de la fiche article
     * @return objet[]
     * Retoourne un tableau d'objet
     */
    public static function getFiartInformer($iFiartId) {

        try {
            $tParam = [$iFiartId];
            $sql = 'SELECT fiart_id,nut_id, nutfiart_val, nutfiart_ajr FROM informer WHERE fiart_id = ?';
            $result = Connection::request(1, $sql, $tParam);
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table informer
     * @param $oInformer
     * attend un objet de la classe Informer
     * @return int
     * Retourne le nombre de ligne inséré
     */
    public static function addInformer($oInformer) {

        try {

            if ($oInformer->nutfiart_ajr != '' || $oInformer->nutfiart_val != '') {

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
            } else {
                $result = 0;
            }
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

    /**
     * Efface un élément de la table informer selon l'id de la fiche article
     * @param $iFiartId
     * id de la fiche article
     * @return int
     * renvoie le nombre de ligne supprimé
     */
    public static function delInformerFiart($iFiartId) {
        try {
            $tParam = array(
                $iFiartId
            );
            $sql = 'DELETE FROM informer WHERE fiart_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

}
