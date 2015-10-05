<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table Bon Entree
 */
class BonEntreeManager {

    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllBonsEntrees() {

        try {

            $sql = 'SELECT be_id, cpt_id, be_lbl, be_date, be_fact_num,'
                    . 'be_frais_douane, be_frais_bancaire, be_frais_trans, '
                    . 'be_com, be_info_trans FROM bon_entree';
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
    public static function getAllBonsEntreesLim($limite, $nombre, $orderby = 'be_id') {

        try {

            $sql = 'SELECT be_id, cpt_id, be_lbl, be_date, be_fact_num,'
                    . 'be_frais_douane, be_frais_bancaire, be_frais_trans, '
                    . 'be_com, be_info_trans FROM bon_entree '
                    . 'ORDER BY ' . $orderby . ' DESC LIMIT ' . $limite . ' , ' . $nombre;
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * Insert une enregistrement dans la table
     * @param $oBonEntree
     * attend un objet de la classe BonEntree
     * @return int
     * Renvoie le nombre de ligne insérée
     */
    public static function addBonEntree($oBonEntree) {

        try {

            $tParam = array(
                $oBonEntree->cpt_id,
                $oBonEntree->be_lbl,
                $oBonEntree->be_date,
                $oBonEntree->be_fact_num,
                $oBonEntree->be_frais_douane,
                $oBonEntree->be_frais_bancaire,
                $oBonEntree->be_frais_trans,
                $oBonEntree->be_com,
                $oBonEntree->be_infos_trans
            );

            $sql = "INSERT INTO gamme ("
                    . " cpt_id, "
                    . " be_lbl, "
                    . " be_date, "
                    . " be_fact_num, "
                    . " be_frais_douane, "
                    . " be_frais_bancaire, "
                    . " be_frais_trans, "
                    . " be_frais_com, "
                    . " be_info_trans "
                    . " VALUES(?,?,?,?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {

            throw $e;
        }
        return $result;
    }

    /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param id
     * attend l'id de l'enregistrement
     * @return objet
     * retourne un objet
     */
    public static function getBonEntreeDetailUpd($id) {

        try {

            $tParam = array(
                $id
            );
            $sql = "SELECT be_id, cpt_id, be_lbl, be_date, be_fact_num,'
                    . 'be_frais_douane, be_frais_bancaire, be_frais_trans, '
                    . 'be_com, be_info_trans FROM bon_entree '
                    . 'WHERE be_id =? FOR UPDATE";
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
    public static function updBonEntree($oBonEntree) {
        try {

            $tParam = array(
                $oBonEntree->cpt_id,
                $oBonEntree->be_lbl,
                $oBonEntree->be_date,
                $oBonEntree->be_fact_num,
                $oBonEntree->be_frais_douane,
                $oBonEntree->be_frais_bancaire,
                $oBonEntree->be_frais_trans,
                $oBonEntree->be_com,
                $oBonEntree->be_infos_trans,
                $oBonEntree->be_id
            );

            $sql = "UPDATE bon_entree SET "
                    . " cpt_id = ?, "
                    . " be_lbl = ?, "
                    . " be_date = ?, "
                    . " be_fact_num = ?, "
                    . " be_frais_douane = ?, "
                    . " be_frais_bancaire = ?, "
                    . " be_frais_trans = ?, "
                    . " be_frais_com = ?, "
                    . " be_info_trans = ? "
                    . "WHERE be_id =?";

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
            $sql = 'DELETE FROM bon_entree WHERE be_id=?';
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
