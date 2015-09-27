<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class TvaManager {
    //put your code here
    
    /**
     * Retourne tous les enregistrements de la table tva
     * 
     * @return tva[] objet
     */
    public static function getAllTvas() {

        try {

            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
              if ($e->getCode() == 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
        }
        return $result;
    }
    
     /**
     * Retourne un enregistrement de la table tva par son id
     *  
     * @return tva objet
     */
    public static function getTvaById($idTva) {

        try {
            $tParam=array(
                $idTva
                    );
            
            $sql = 'SELECT t.tva_id, t.tva_lbl, t.tva_taux FROM tva t WHERE t.tva_id=?';
            $result = Connection::request(0,$sql,$tParam);
            
        } catch (MySQLException $e) {
              if ($e->getCode() == 00000) {
                return 0;
            } else {
                return $e->getCode();
            }
        }
        return $result;
    }
    /**
     * Ajoute un enregistrement dans la table tva
     * @param type $Tva
     */
    public static function addTva($Tva){
         try {

            if (!empty($Tva->tva_lbl) && (strlen($Tva->tva_lbl)) > Connection::getLimLbl()) {

                $tParam= array(
                    $Tva->tva_lbl,
                    $Tva->tva_taux
                );

                $sql = "INSERT INTO tva ("
                        . "tva_lbl,"
                        . "tva_taux)"
                        . "VALUES(?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

