<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Olivier
 */
class ReferenceManager {
    
    /**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Reference[]
     */
    public static function getAllReferences() {
        
        try {
           
            $sql = 'SELECT * FROM reference';
            $result = Connection::request($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    public static function insReference($reference) {
        
        try {
            
            if(!empty($reference->ref_lbl)&&($reference->ref_lbl>3)){
                
                $tParam =array(
                        $reference->ref_emb_id,
                        $reference->ref_dc_id,
                        $reference->ref_fiart_id,
                        $reference->ref_dd_id ,     
                        $reference->ref_tva_id ,    
                        $reference->ref_lbl ,      
                        $reference->ref_st_min  ,   
                        $reference->ref_poids_brut ,
                        $reference->ref_poids_net , 
                        $reference->ref_vlm_ctn ,   
                        $reference->ref_dim_lng  ,  
                        $reference->ref_dim_lrg  ,  
                        $reference->ref_dim_ht    ,
                        $reference->ref_dim_diam);
                
                $sql = "INSERT INTO reference ("
                        . "EMB_ID,"
                        . "DC_ID,"
                        . "FIART_ID,"
                        . "DD_ID,"
                        . "TV_ID,"
                        . "REF_LBL,"
                        . "REF_ST_MIN,"
                        . "REF_POIDS_BRUT,"
                        . "REF_POIDS_NET,"
                        . "REF_VLM_CTN,"
                        . "REF_DIM_LNG,"
                        . "REF_DIM_LRG,"
                        . "REF_DIM_HT,"
                        . "REF_DIM_DIAM) " .
                    " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                
                $result = Connection::request($sql,$tParam);
           
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
                
        } catch (MySQLException $e) {
          
           
            $result ='<br/><p class="info">la Référence a bien était ajouté </p>';
           
          
        }
        return $result;
    }
}
