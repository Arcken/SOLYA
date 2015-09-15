<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailManager
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
                    $Emb->EMB_TYPE
                );

                $sql = "INSERT INTO emballage ("
                        . "EMB_LBL,"
                        . "EMB_COULEUR,"
                        . "EMB_TYPE) "
                        . "VALUES(?,?,?)";
                
                $result = Connection::request(2, $sql, $tParam);
  
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libellé </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
      
    }
}

