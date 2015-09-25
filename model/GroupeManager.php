<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupeManager
 *
 * @author patat
 */
class GroupeManager {

    /**
     * Retourne tous les enregistrement de Groupe
     * 
     * @return objet[]
     * retourne un tableau d'objet
     */
    public static function getAllGroupes() {

        try {

            $sql = 'SELECT grp_id, grp_nom, grp_des '
                    . 'FROM groupe';
                   
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {

            if ($e->getCode() == 00000) {
                return 0;
            } else
                return $e->getCode();
        }
        return $result;
    }

    /**
     * Retourne les détails d'un Groupe
     * 
     * @param $oGroupe
     * attend un objet Groupe
     * @return string|int
     * Retourne un objet
     */
    public static function getGroupe($oGroupe) {

        try {

            if (!empty($oGroupe->grp_id)) {

                $tParam = array(
                    $oGroupe->grp_id
                );

                $sql = "SELECT grp_nom, grp_des FROM groupe"                        
                        . " WHERE grp_id =?";

                $result = Connection::request(0, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible, erreur de données saisies</p>';
            }
        } catch (MySQLException $e) {
            if ($e->getCode() == 00000) {
                return 0;
            }
            echo $e->RetourneErreur();
        }
        return $result;
    }

    /**
     * Ajoute un groupe dans la table groupe
     * 
     * @param $oGroupe
     * Attend un objet Groupe
     *  @return int|string 
     * Retourne un int (succées) ou un string (échec)
     */
    public static function addGroupe($oGroupe) {
        try {

            if ((!empty($oGroupe->grp_nom) && (strlen($oGroupe->grp_nom)) > Connection::getLimLbl()) && (!empty($oGroupe->grp_des) && (strlen($oGroupe->grp_des)) > Connection::getLimLbl())) {

                $tParam = array(
                    $oGroupe->grp_nom,
                    $oGroupe->grp_des                    
                );

                $sql = "INSERT INTO groupe ("
                        . "grp_nom,"
                        . "grp_des)"
                        . "VALUES(?,?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible, erreur de données saisies</p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
        return $result;
    }

}
