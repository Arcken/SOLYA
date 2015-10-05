<?php

/**
 * Description of GroupeManager
 *
 * 
 */
class GroupeManager {

    /**
     * Retourne tous les enregistrement de la table
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
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne les détails d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de l'enregistrement
     * @return int
     * Retourne un objet
     */
    public static function getGroupe($id) {

        try {

                $tParam =[$oGroupe->grp_id];
                $sql = "SELECT grp_nom, grp_des FROM groupe"
                        . " WHERE grp_id =?";
                $result = Connection::request(0, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
