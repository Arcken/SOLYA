<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table Be Ligne
 */
class BeLigneManager {

    
    /**
     * Retourne un enregistrements de la table
     * selon lig_id
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getBeLigne($ligId) {

        try {
            $tParam= [$ligId];
            
            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_taxe '
                    . 'FROM be_ligne WHERE lig_id=?';
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Retourne l' enregistrements de la table associé au lot
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getBeLigneFromLot($lotId) {

        try {
            
            $tParam=[$lotId];
            
            $sql =  'SELECT be.lig_id, '
                    . 'be.be_id,'
                    . 'be.belig_pu,'
                    . 'be.belig_cu_achat,'
                    . 'be.belig_fb,'
                    . 'be.belig_ft,'
                    . 'be.belig_dd,'
                    . 'be.belig_taxe '
                    . 'FROM be_ligne be '
                    . 'INNER JOIN ligne lig '
                    . 'ON be.lig_id=lig.lig_id '
                    . 'INNER JOIN lot lt '
                    . 'ON lig.lot_id = lt.lot_id '
                    . 'WHERE lt.lot_id = ?';
            
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Retourne les enregistrements de la table
     * 
     * selon le beId
     * @param $beId
     * Id du bon d'entré
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getBesLignesBeId($beId) {

        try {

            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_taxe '
                    . 'FROM be_ligne '
                    . 'WHERE be_id = ' . $beId;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne les enregistrements de la table avec limite définie
     * 
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
    public static function getBesLignesLim($rowStart, $nbRow, $orderBy = 'be_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_taxe '
                    . 'FROM be_ligne '
                    . 'ORDER BY ' 
                    . $orderBy 
                    . ' ' . $sort 
                    . ' LIMIT ' . $rowStart . ' , ' . $nbRow;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table
     * 
     * @param $oBeLigne
     * attend un objet de la classe BeLigne
     * @return int
     * Renvoie le nombre de ligne insérée
     */
    public static function addBeLigne($oBeLigne) {

        try {

            $tParam = [$oBeLigne->lig_id,
                $oBeLigne->be_id,
                $oBeLigne->belig_pu,
                $oBeLigne->belig_cu_achat,
                $oBeLigne->belig_fb,
                $oBeLigne->belig_ft,
                $oBeLigne->belig_dd,
                $oBeLigne->belig_taxe];

            $sql = "INSERT INTO be_ligne ("
                    . " lig_id, "
                    . " be_id, "
                    . " belig_pu, "
                    . " belig_cu_achat, "
                    . " belig_fb, "
                    . " belig_ft, "
                    . " belig_dd, "
                    . " belig_taxe) "
                    . " VALUES(?,?,?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {

            throw $e;
        }
        return $result;
    }

    /**
     * Select for update des enregistrements selon l'id du bon d'entrée 
     * 
     * @param $beId
     * attend l'id du bon d'entrée
     * @return []objet
     * retourne un tableau d'objet
     */
    public static function getBesLignesDetailForUpd($beId) {

        try {

            $tParam = [$beId];
            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_taxe '
                    . 'FROM be_ligne '
                    . 'WHERE be_id =? FOR UPDATE';
            $result = Connection::request(1, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param objet
     * Attend un objet BonEntree
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updBeLigne($oBeLigne) {
        try {

           $tParam = [$oBeLigne->belig_pu,
                $oBeLigne->belig_cu_achat,
                $oBeLigne->belig_fb,
                $oBeLigne->belig_ft,
                $oBeLigne->belig_dd,
                $oBeLigne->belig_taxe,
                $oBeLigne->be_id,
               $oBeLigne->lig_id];

            $sql = "UPDATE be_ligne SET "
                    . " belig_pu = ?, "
                    . " belig_cu_achat = ?, "
                    . " belig_fb = ?, "
                    . " belig_ft = ?, "
                    . " belig_dd = ?, "
                    . " belig_taxe = ? "
                    . "WHERE be_id = ? AND lig_id =?";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Supprime l'enregistrement de la table selon son id
     * l'id est composé de deux id
     * @param $beId
     * Id du bon entrée
     * @param $ligId
     * Id de ligne
     * @return int 
     * nombre de ligne impacté
     */
    public static function delBeLigne($beId,$ligId) {
        try {
            $tParam = [$beId,
                $ligId];
            
            $sql = 'DELETE FROM be_ligne WHERE be_id = ? AND lig_id = ?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
