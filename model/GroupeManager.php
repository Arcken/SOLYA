<?php

/**
 * Description of GroupeManager
 *
 * 
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
            $result = 0;
        }
        return $result;
    }

    /**
     * Retourne les détails d'un Groupe
     * 
     * @param $oGroupe
     * attend un objet Groupe
     * @return int
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
                $result = 0;
            }
        } catch (MySQLException $e) {
            $result = -1;
        }
        return $result;
    }

}
