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
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllBesLignes() {

        try {

            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_lbl, belig_taxe '
                    . 'FROM be_ligne';
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $limite
     * debut de limite
     * @param $nombre
     * nombre d'élément à recevoir
     * @param $orderby
     * champs pour le tri
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllBesLignesLim($limite, $nombre, $orderby = 'be_id') {

        try {

            $sql = 'SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_lbl, belig_taxe '
                    . 'FROM be_ligne '
                    . 'ORDER BY ' . $orderby . ' DESC LIMIT ' . $limite . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table
     * @param $oBeLigne
     * attend un objet de la classe BeLigne
     * @return int
     * Renvoie le nombre de ligne insérée
     */
    public static function addBeLigne($oBeLigne) {

        try {

            $tParam = array(
                $oBeLigne->be_id,
                $oBeLigne->belig_pu,
                $oBeLigne->belig_cu_achat,
                $oBeLigne->belig_fb,
                $oBeLigne->belig_ft,
                $oBeLigne->belig_dd,
                $oBeLigne->belig_lbl,
                $oBeLigne->belig_taxe
            );

            $sql = "INSERT INTO be_ligne ("
                    . " be_id, "
                    . " belig_pu, "
                    . " belig_cu_achat, "
                    . " belig_fb, "
                    . " belig_ft, "
                    . " belig_dd, "
                    . " belig_lbl, "
                    . " belig_taxe "
                    . " VALUES(?,?,?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {

            throw $e;
        }
        return $result;
    }

    /**
     * Select for update d'un enregistrement selon l'id
     * 
     * @param id
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getBeLigneDetailUpd($id) {

        try {

            $tParam = array(
                $id
            );
            $sql = "SELECT lig_id, be_id, belig_pu, belig_cu_achat, belig_fb,'
                    . 'belig_ft, belig_dd, belig_lbl, belig_taxe '
                    . 'FROM be_ligne '
                    . 'WHERE lig_id =? FOR UPDATE";
            $result = Connection::request(0, $sql, $tParam);
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

           $tParam = array(
                $oBeLigne->be_id,
                $oBeLigne->belig_pu,
                $oBeLigne->belig_cu_achat,
                $oBeLigne->belig_fb,
                $oBeLigne->belig_ft,
                $oBeLigne->belig_dd,
                $oBeLigne->belig_lbl,
                $oBeLigne->belig_taxe,
               $oBeLigne->be_id
            );

            $sql = "UPDATE bon_entree SET "
                    . " be_id = ?, "
                    . " belig_pu = ?, "
                    . " belig_cu_achat = ?, "
                    . " belig_fb = ?, "
                    . " belig_ft = ?, "
                    . " belig_dd = ?, "
                    . " belig_lbl = ?, "
                    . " belig_taxe = ? "
                    . "WHERE lig_id =?";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'enregistrement
     * @return int 
     * nombre de ligne impacté
     */
    public static function delGamme($id) {
        try {
            $tParam = array(
                $id
            );
            $sql = 'DELETE FROM be_ligne WHERE lig_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
