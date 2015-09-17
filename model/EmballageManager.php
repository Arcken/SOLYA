<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Manager de la classe Emballage
 *
 * @author Olivier
 */
class EmballageManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table emballage
     * 
     * @return nutrition[] objet
     */
    public static function getAllEmballages() {

        try {

            $sql = 'SELECT * FROM emballage';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table emballage
     * @param type $Emb
     */
    public static function addEmballage($Emb){
         try {

            if (!empty($Emb->EMB_LBL) && (strlen($Emb->NUT_LBL)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Emb->EMB_LBL,
                    $Emb->EMB_COULEUR,
                    $Emb->EMB_TYPE,
                    $Emb->EMB_VLM_CTN,
                    $Emb->EMB_DIM_LNG,
                    $Emb->EMB_DIM_LRG,
                    $Emb->EMB_DIM_HT,
                    $Emb->EMB_DIM_DIAM
                );

                $sql = "INSERT INTO emballage ("
                        . "EMB_LBL,"
                        . "EMB_COULEUR,"
                        . "EMB_TYPE,"
                        . "EMB_VLM_CTN,"
                        . "EMB_DIM_LNG,"
                        . "EMB_DIM_LRG,"
                        . "EMB_DIM_HT,"
                        . "EMB_DIM_DIAM) "
                        . "VALUES(?,?,?,?,?,?,?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

