<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @description Manager de la table ExportManager
 */
class ExportManager {

     
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllBonsEntrees() {

        try {

            $sql = "SELECT 
                    be_id AS 'ID', 
                    cpt_id AS 'ID', 
                    be_lbl AS 'Libellé', 
                    be_date AS 'Date', 
                    be_fact_num AS 'Facture numéro', 
                    be_frais_douane AS 'Frais de Douane Bon', 
                    be_frais_bancaire AS 'Frais de Banque Bon', 
                    be_frais_trans AS 'Frais de Transport Bon', 
                    be_com AS 'Commentaire', 
                    be_info_trans AS 'Info Transport', 
                    be_total AS 'Total', 
                    be_mode_pai AS 'Mode de paiement', 
                    be_com_pai AS 'Commentaire paiement', 
                    belig_pu AS 'prix unitaire', 
                    lig_qte as 'quantité', 
                    lot_qt_stock 'quantité restante
                    FROM bon_entree be 
                    LEFT JOIN be_ligne bel ON be.be_id = bel.be_id 
                    JOIN ligne li ON bel.lig_id = li.lig_id 
                    JOIN lot lo ON li.lot_id = lo.lot_id";
            $result = Connection::request(1, $sql, null,PDO::FETCH_ASSOC);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne tous les enregistrements de la table utilisateur 
     * avec le nom du groupe associé
     * sans le mot de passe
     * 
     * @return []
     * Retourne un tableau associatif
     */
    public static function getAllUtilisateurs() {

        try {
            $sql = "SELECT ut_nom AS Nom, "
                    . "ut_prenom AS 'Prénom', "
                    . "ut_login AS Login, "
                    . "ut_actif AS 'Activé', "
                    . "grp_nom AS Groupe "
                    . "FROM utilisateur AS u "
                    . "JOIN groupe g ON u.grp_id = g.grp_id ";
            
            $result = Connection::request(1, $sql, null,PDO::FETCH_ASSOC);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
}
