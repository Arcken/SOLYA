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
 * Récupère le cout d'achat moyen de la référencepar rapport à sa valeurs en stock actuel
 * 
 * @param refId identifiant de la référénce
 * @return numeric  le stock actuelle de la référence
 */    
public static function getRefCurCaMoyen($refId){
    
    try{
        $tParam=[$refId];
    $sql = "SELECT AVG(be.belig_cu_achat) as nb "
         . "FROM be_ligne be "
         . "INNER JOIN ligne l "
         . "ON be.lig_id=l.lig_id "
         . "INNER JOIN lot lt "
         . "ON l.lot_id=lt.lot_id "    
         . "WHERE lt.lot_qt_stock > 0 AND lt.ref_id=?";
    
    $result = Connection::request(0, $sql, $tParam);
    
    } catch (MySQLException $e) {
           throw $e;
    }
        return $result;
}    
    
    
    
/**
 * Récupère la somme total du stock associé à la référence
 * 
 * @param refId identifiant de la référénce
 * @return numeric  le stock actuelle de la référence
 */    
public static function getRefCurSumStk($refId){
    
    try{
        $tParam=[$refId];
    $sql = "SELECT SUM(lt.lot_qt_stock) as nb "
         . "FROM lot lt INNER JOIN "
         . "reference r "
         . "ON r.ref_id=lt.ref_id "
         . "WHERE lt.lot_qt_stock > 0 AND lt.ref_id=?";
    
    $result = Connection::request(0, $sql, $tParam);
    
    } catch (MySQLException $e) {
           throw $e;
    }
        return $result;
}


/**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllReferences() {

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
                            ref_photos_pref,
                            ref_code_douane
                            FROM reference  
                            ORDER BY ref_id";
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
   /**
     * Retourne tous les enregistrements de la table avec limite définie
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
    public static function getReferencesLim($limit,
                                            $nbRow,
                                            $orderBy="ref_id",
                                            $sort='ASC') {

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
                            ref_photos_pref,
                            ref_code_douane
                            FROM reference " 
                            ."ORDER BY ".$orderBy." ".$sort." "
                            ."LIMIT ".$limit.",".$nbRow."";

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
                    $oReference->ref_photos_pref,
                    $oReference->ref_code_douane
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
                        . "ref_photos_pref,"
                        . "ref_code_douane) " 
                        ." VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
                    $oReference->ref_code_douane,
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
                        . "r.ref_photos_pref=?,"
                        . "r.ref_code_douane=? "
                        . "WHERE r.ref_id=? ";

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
                            r.ref_photos_pref,
                            r.ref_code_douane
                            FROM reference r 
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
                            r.ref_photos_pref,
                            r.ref_code_douane 
                            FROM reference r WHERE r.ref_id = ?";

            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    } 
    
    
    /**
     * Retourne le ref code 
     * associé à un enregistrement de la table
     * 
     * @param $id
     * Identifiant de la l'enregistrement
     * @return objet
     * Retourne un objet
     */
    public static function getRefCode($id) {

        try {
            $tParam= [$id];

            $sql = "SELECT ref_code
                    FROM reference 
                    WHERE ref_id = ?";

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