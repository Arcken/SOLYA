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
                    be_info_trans AS 'Info Transport, 
                    be_total AS 'Total', 
                    be_mode_pai AS 'Mode de paiement, 
                    be_com_pai AS 'Commentaire paiement' 
                    FROM bon_entree";
            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    
}
