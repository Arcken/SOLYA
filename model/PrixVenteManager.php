<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class PrixVenteManager {

    /**
     * Retourne le prix de vente le plus récent d'une référence
     * @param INT $refId
     * @return object Prix Vente
     */
    
    public static function getCurPrixVente($refId) {

        try {
            $tParam= array($refId);
            
            $sql = 'SELECT pv.pve_id,'
                          . 'pv.ref_id, '
                          . 'pv.pve_per,'
                          . 'pv.pve_ent, '
                          . 'pv.pve_date '
                          . 'FROM prix_vente pv WHERE pv.ref_id=?'
                          . ' ORDER BY pv.pve_date DESC LIMIT 0,1 ';
            
            $result = Connection::request(0,$sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
            //die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Retourne tous les enregistrements de la table prix_vente
     * 
     * @return prix_vente[] objet
     */
    public static function getAllPrixVentes() {

        try {

            $sql = 'SELECT * FROM prix_vente';
            $result = Connection::request(1,$sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table prix_vente
     * @param type $Pve
     */
    public static function addPrixVente($Pve){
         try {

            if (!empty($Pve->pve_per) && ($Pve->pve_per) > 0 &&
                    !empty($Pve->pve_ent) &&($Pve->pve_ent) > 0) {

                $tParam= array(
                    $Pve->ref_id,
                    $Pve->pve_per,
                    $Pve->pve_ent
                );

                $sql = "INSERT INTO prix_vente ("
                        . "REF_ID,"
                        . "PVE_PER,"
                        . "PVE_ENT,"
                        . "PVE_DATE)"
                        . "VALUES(?,?,?,NOW())";
                
               return $result = Connection::request(2, $sql, $tParam);
            }
        } catch (MySQLException $e) {
            
            if ($e->getCode()===00000){
              return  $result = 0;
            }
        }

    }
}

