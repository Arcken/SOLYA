<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DroitDouaneManager
 *
 * @author Olivier
 */
class DroitDouaneManager {
     /**
     * Retourne tous les enregistrements de la table droit_douane
     * 
     * @return droit_douane[] objet
     */
    public static function getAllDroitDouanes() {

        try {

            $sql = 'SELECT d.dd_id, d.dd_lbl, d.dd_taux FROM droit_douane d';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000){
                return 0;
            }
            else {
                return $e->getCode ();
            
            }
        }
        
        return $result;
    }
      /**
     * Retourne un enregistrements de la table droit_douane par son id
     * 
     * @return droit_douane objet
     */
    public static function getDroitDouaneById($ddId) {

        try {
            $tParam=array($ddId);
            $sql = 'SELECT d.dd_id, d.dd_lbl, d.dd_taux FROM droit_douane d';
            $result = Connection::request(0,$sql,$tParam);
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000){
                return 0;
            }
            else {
                return $e->getCode ();
            
            }
        }
        
        return $result;
    }
    /**
     * Ajoute un enregistrement dans la table droit_douane
     * @param type $Dd
     */
    public static function addDroitDouane($Dd){
         try {

            if (!empty($Dd->dd_taux) && (strlen($Dd->dd_taux)) >0) {

                $tParam= array(
                    $Dd->dd_lbl,
                    $Dd->dd_taux
                );

                $sql = "INSERT INTO droit_douane("
                        . "dd_lbl,"
                        . "dd_taux)"
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
