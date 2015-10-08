<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 */
class ReferenceManager {

    /**
     * Retourne les enregistrements de la table Référence
     * par défaut la table remonte les 15 premier résultats.
     * Il est possible cependant de modifier
     * le résultats attendu grace aux paramètres :
     * 
     * @param $limit par défaut 0
     * @param $nombre par défaut 15
     * @param $orderBy par défaut ref_id 
     * @param $tri par défaut DESC
     * @return Reference[]
     */
    public static function getAllReferences($limit=0,
                                            $nombre=15,
                                            $orderby="ref_id",
                                            $tri='DESC') {

        try {

            $sql = "SELECT  ref_id, 
                            dc_id,
                            fiart_id,
                            dd_id,
                            cons_id,
                            tva_id,
                            ref_lbl,
                            ref_mrq,
                            ref_st_min,
                            ref_poids_brut,
                            ref_poids_net,
                            ref_emb_lbl,
                            ref_emb_couleur,
                            ref_emb_vlm_ctn,
                            ref_emb_dim_lng,
                            ref_emb_dim_lrg,
                            ref_emb_dim_ht,
                            ref_emb_dim_diam,
                            ref_com,
                            ref_code, 
                            ref_photos,
                            ref_photos_pref 
                            FROM reference " 
                            ."ORDER BY ".$orderby." ".$tri." "
                            ."LIMIT ".$limit.",".$nombre."";

            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
           throw $e;
        }
        return $result;
    }

    
    /**
     * Ajoute une référence
     * 
     * @param $oReference
     * Attend un objet de la classe référence
     * 
     * @return int
     * Retourne le nombre d'insert
     */
    public static function addReference($oReference) {

        try {

                $tParam = array(
                    $oReference->dc_id,
                    $oReference->cons_id,
                    $oReference->fiart_id,
                    $oReference->dd_id,
                    $oReference->tva_id,
                    $oReference->ref_lbl,
                    $oReference->ref_mrq,
                    $oReference->ref_st_min,
                    $oReference->ref_poids_brut,
                    $oReference->ref_poids_net,
                    $oReference->ref_emb_lbl,
                    $oReference->ref_emb_couleur,
                    $oReference->ref_emb_vlm_ctn,
                    $oReference->ref_emb_dim_lng,
                    $oReference->ref_emb_dim_lrg,
                    $oReference->ref_emb_dim_ht,
                    $oReference->ref_emb_dim_diam,
                    $oReference->ref_com,
                    $oReference->ref_code,
                    $oReference->ref_photos,
                    $oReference->ref_photos_pref
                );

                $sql = "INSERT INTO reference ("
                        . "dc_id,"
                        . "cons_id,"
                        . "fiart_id,"
                        . "dd_id,"
                        . "tva_id,"
                        . "ref_lbl,"
                        . "ref_mrq,"
                        . "ref_st_min,"
                        . "ref_poids_brut,"
                        . "ref_poids_net,"
                        . "ref_emb_lbl,"
                        . "ref_emb_couleur,"
                        . "ref_emb_vlm_ctn,"
                        . "ref_emb_dim_lng,"
                        . "ref_emb_dim_lrg,"
                        . "ref_emb_dim_ht,"
                        . "ref_emb_dim_diam,"
                        . "ref_com,"
                        . "ref_code,"
                        . "ref_photos,"
                        . "ref_photos_pref) " .
                        " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Mets à jour un enregistrement
     * 
     * @param $oReference
     * Attend un objet de la classe Reference
     * 
     * @return int
     * Renvoie le nombre de ligne impacté
     */
     public static function updReference($oReference) {

        try {
  
               $tParam = array(
                    $oReference->dc_id,
                    $oReference->cons_id,
                    $oReference->fiart_id,
                    $oReference->dd_id,
                    $oReference->tva_id,
                    $oReference->ref_lbl,
                    $oReference->ref_mrq,
                    $oReference->ref_st_min,
                    $oReference->ref_poids_brut,
                    $oReference->ref_poids_net,
                    $oReference->ref_emb_lbl,
                    $oReference->ref_emb_couleur,
                    $oReference->ref_emb_vlm_ctn,
                    $oReference->ref_emb_dim_lng,
                    $oReference->ref_emb_dim_lrg,
                    $oReference->ref_emb_dim_ht,
                    $oReference->ref_emb_dim_diam,
                    $oReference->ref_com,
                    $oReference->ref_code,
                    $oReference->ref_photos,
                    $oReference->ref_photos_pref,
                    $oReference->ref_id
                );
                    
               $sql = "UPDATE reference r SET "
                        . "r.dc_id=?,"
                        . "r.cons_id=?,"
                        . "r.fiart_id=?,"
                        . "r.dd_id=?,"
                        . "r.tva_id=?,"
                        . "r.ref_lbl=?,"
                        . "r.ref_mrq=?,"
                        . "r.ref_st_min=?,"
                        . "r.ref_poids_brut=?,"
                        . "r.ref_poids_net=?,"
                        . "r.ref_emb_lbl=?,"
                        . "r.ref_emb_couleur=?,"
                        . "r.ref_emb_vlm_ctn=?,"
                        . "r.ref_emb_dim_lng=?,"
                        . "r.ref_emb_dim_lrg=?,"
                        . "r.ref_emb_dim_ht=?,"
                        . "r.ref_emb_dim_diam=?,"
                        . "r.ref_com=?," 
                        . "r.ref_code=?,"
                        . "r.ref_photos=?,"
                        . "r.ref_photos_pref=? ".
                          "WHERE r.ref_id=? ";

                $result = Connection::request(2, $sql, $tParam);
 
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Select for update d'un enregistrement
     
     * @param $id
     * id de l'enregistrement
     * 
     * @return objet
     * Retourne un objet
     */
    public static function getReferenceForUpd($id) {

        try {
            $tParam= [$id];

            $sql = "SELECT  r.ref_id, 
                            r.dc_id,
                            r.cons_id,
                            r.fiart_id,
                            r.dd_id,
                            r.tva_id,
                            r.ref_lbl,
                            r.ref_mrq,
                            r.ref_st_min,
                            r.ref_poids_brut,
                            r.ref_poids_net,
                            r.ref_emb_lbl,
                            r.ref_emb_couleur,
                            r.ref_emb_vlm_ctn,
                            r.ref_emb_dim_lng,
                            r.ref_emb_dim_lrg,
                            r.ref_emb_dim_ht,
                            r.ref_emb_dim_diam,
                            r.ref_com,
                            r.ref_code,
                            r.ref_photos,
                            r.ref_photos_pref FROM reference r 
                            WHERE r.ref_id = ? FOR UPDATE";

            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
           throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne un enregistrements de la table
     * 
     * @param $id
     * Identifiant de la l'enregistrement
     * 
     * @return objet
     * Retourne un objet
     */
    public static function getReference($id) {

        try {
            $tParam= [$id];

            $sql = "SELECT  r.ref_id, 
                            r.dc_id,
                            r.cons_id,
                            r.fiart_id,
                            r.dd_id,
                            r.tva_id,
                            r.ref_lbl,
                            r.ref_mrq,
                            r.ref_st_min,
                            r.ref_poids_brut,
                            r.ref_poids_net,
                            r.ref_emb_lbl,
                            r.ref_emb_couleur,
                            r.ref_emb_vlm_ctn,
                            r.ref_emb_dim_lng,
                            r.ref_emb_dim_lrg,
                            r.ref_emb_dim_ht,
                            r.ref_emb_dim_diam,
                            r.ref_com,
                            r.ref_code,
                            r.ref_photos,
                            r.ref_photos_pref FROM reference r WHERE r.ref_id = ?";

            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }       

/**
 * Efface un enregistrement selon son id
 * 
 * @param $id
 * Attend l'id de l'enregsitrement
 * 
 * @return int
 * Retourne le nombre de ligne effacé
 */
public static function delReference($id) {

        try {

               $tParam = [$id];
                    
                $sql = "DELETE FROM reference  WHERE ref_id=? ";
                
                $result = Connection::request(2, $sql, $tParam);
        
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}