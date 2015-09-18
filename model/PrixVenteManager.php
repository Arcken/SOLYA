<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class PrixVenteManager {
    //put your code here
    
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

            if (!empty($Pve->PVE_PER) && ($Pve->PVE_PER) > 0 && ($Pve->PVE_ENT) > 0) {

                $tParam= array(
                    $Pve->PVE_PER,
                    $Pve->PVE_ENT,
                    $Pve->PVE_DATE
                );

                $sql = "INSERT INTO mode_conservation ("
                        . "PVE_PER,"
                        . "PVE_ENT,"
                        . "PVE_DATE)"
                        . "VALUES(?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans prix </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

