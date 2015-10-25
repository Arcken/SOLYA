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
                    be.be_id AS 'Bon ID', 
                    be.cpt_id AS 'Compte ID', 
                    cpt_nom AS 'Compte nom',
                    cpt_com AS 'Compte commentaire',
                    be_lbl AS 'Libellé', 
                    be_date AS 'Date', 
                    be_fact_num AS 'Facture numéro', 
                    be_frais_douane AS 'Bon: Frais de Douane', 
                    be_frais_bancaire AS 'Bon: Frais de Banque Bon', 
                    be_frais_trans AS 'Bon: Frais de Transport Bon', 
                    be_com AS 'Commentaire', 
                    be_info_trans AS 'Info Transport', 
                    be_total AS 'Total', 
                    be_mode_pai AS 'Mode de paiement', 
                    be_com_pai AS 'Commentaire paiement', 
                    belig_pu AS 'Prix unitaire', 
                    belig_cu_achat AS 'Cout unitaire',
                    belig_dd AS 'Ligne: Frais de douane',
                    belig_taxe AS 'Ligne: Taxe',
                    belig_fb AS 'Ligne: Frais de banque',
                    belig_ft AS 'Ligne: Frais de transport',
                    lo.lot_id AS 'Lot ID',
                    r.ref_id AS 'Référence ID',
                    r.ref_code AS 'Référence code',
                    lo.lot_id_producteur AS 'Lot producteur',
                    lo.lot_dlc 'Lot DLC AAAA-MM-JJ',
                    lo.lot_qt_init 'Lot quantité livré',
                    lo.lot_qt_stock 'Lot quantité restante'
                    FROM bon_entree be 
                    LEFT JOIN be_ligne bel ON be.be_id = bel.be_id 
                    JOIN compte c ON be.cpt_id = c.cpt_id 
                    JOIN ligne li ON bel.lig_id = li.lig_id 
                    JOIN lot lo ON li.lot_id = lo.lot_id
                    JOIN reference r ON lo.ref_id = r.ref_id 
                    ORDER BY be.be_id,bel.lig_id";
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
