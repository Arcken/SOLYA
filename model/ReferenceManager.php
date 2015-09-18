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
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    public static function insReference($reference) {
        
        try {
            
            if(!empty($reference->ref_lbl)&&(strlen($reference->ref_lbl)>Connection::getLimLbl())){
                
                $tParam =array(
                            $reference->ref_id,
                            $reference->dc_id             ,
                            $reference->fiart_id          ,
                            $reference->dd_id             ,
                            $reference->tva_id            ,
                            $reference->ref_lbl           ,
                            $reference->ref_st_min        ,
                            $reference->ref_poids_brut    ,
                            $reference->ref_poids_net     ,
                            $reference->ref_emb_lbl       ,
                            $reference->ref_emb_couleur   ,
                            $reference->ref_emb_vlm_ctn   ,
                            $reference->ref_emb_dim_lng   ,
                            $reference->ref_emb_dim_lrg   ,
                            $reference->ref_emb_dim_ht    ,
                            $reference->ref_emb_dim_diam  
                             );
                
                $sql = "INSERT INTO reference ("
                        . "REF_ID,"
                        . "DC_ID,"
                        . "FIART_ID,"
                        . "DD_ID,"
                        . "TVA_ID,"
                        . "REF_LBL,"
                        . "REF_ST_MIN,"
                        . "REF_POIDS_BRUT,"
                        . "REF_POIDS_NET,"
                        . "REF_EMB_LBL,"
                        . "REF_EMB_COULEUR,"
                        . "REF_EMB_VLM_CTN,"
                        . "REF_EMB_DIM_LNG,"
                        . "REF_EMB_DIM_LRG,"
                        . "REF_EMB_DIM_HT,"
                        . "REF_EMB_DIM_DIAM) ".
                    " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                
                $result = Connection::request(2,$sql,$tParam);
           
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
                
        } catch (MySQLException $e) {
          
           
            echo $e->RetourneErreur();
           
          
        }
        return $result;
    }
}
