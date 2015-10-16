<?php

/**
 * Class contenant les Managers
 * de la table Entreprise
 */


class EntrepriseManager {
   
    
    /**
     * Retourne tous les enregistrements de la table
     * 
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getAllEntreprises() {

        try {

            $sql = 'SELECT cpt_id, catent_id, fmju_id, ent_horaire, ent_siren, '
                    . 'ent_num_tva, ent_site, ent_ecommerce '
                    . 'FROM entreprise '
                    . 'ORDER BY cpt_id';
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Retourne un enregistrements de la table
     * @param $id
      * ID de l'entreprise (compte)
     * @return objet[]
     * Renvoie tableau d'objet
     */
    public static function getEntreprise($id) {

        try {
            $tParam= [$id];
            
            $sql = 'SELECT cpt_id, catent_id, fmju_id, ent_horaire, ent_siren, '
                    . 'ent_num_tva, ent_site, ent_ecommerce '
                    . 'FROM entreprise '
                    . 'WHERE cpt_id=?';
            $result = Connection::request(0, $sql,$tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    

   
     /**
     * Retourne tous les enregistrements de la table avec limite définie
     * @param $rowStart
     * debut de limite
     * @param $nbRow
     * nombre d'élément à recevoir
     * @param $orderBy
     * champs pour le tri
     * @param $sort
     * tri croissant ou décroissant (ASC ou DESC)
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getEntreprisesLim($rowStart, $nbRow, 
            $orderBy = 'cpt_id', $sort = 'ASC') {

        try {

            $sql = 'SELECT cpt_id, catent_id, fmju_id, ent_horaire, ent_siren, '
                    . 'ent_num_tva, ent_site, ent_ecommerce '
                    . 'ORDER BY ' . $orderBy 
                    . ' ' . $sort
                    . ' LIMIT ' . $rowStart . ' , ' 
                    . $nbRow;
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
     /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oEntreprise
     * Attend un objet de la classe Entreprise
     * 
     * @return int
     * Retoune le nombre d'insert
     */
    public static function addEntreprise($oEntreprise) {

        try {

                $tParam = array(
                    $oEntreprise->cpt_id,
                    $oEntreprise->catent_id,
                    $oEntreprise->fmju_id,
                    $oEntreprise->ent_horaire,
                    $oEntreprise->ent_siren,
                    $oEntreprise->ent_num_tva,
                    $oEntreprise->ent_site,
                    $oEntreprise->ent_ecommerce
                );

                $sql = "INSERT INTO entreprise ("
                        . "cpt_id,"
                        . "catent_id,"
                        . "fmju_id,"
                        . "ent_horaire,"
                        . "ent_siren,"
                        . "ent_num_tva,"
                        . "ent_site,"
                        . "ent_ecommerce)"
                        . "VALUES(?,?,?,?,?,?,?,?)";


                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
     /**
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id d'entreprise
     * @return objet
     * Retourne un objet
     */
    public static function getEntrepriseDetailForUpd($id) {

        try {

            $tParam = [$id];
            
            $sql = 'SELECT cpt_id, catent_id, fmju_id, ent_horaire, ent_siren, '
                    . 'ent_num_tva, ent_site, ent_ecommerce '
                    . 'FROM entreprise '
                    . 'WHERE cpt_id =? FOR UPDATE';
            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oEntreprise
     * Attend un objet Entreprise
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updEntreprise($oEntreprise) {
        
        try {
                $tParam = [
                    $oEntreprise->catent_id,
                    $oEntreprise->fmju_id,
                    $oEntreprise->ent_horaire,
                    $oEntreprise->ent_siren,
                    $oEntreprise->ent_num_tva,
                    $oEntreprise->ent_site,
                    $oEntreprise->ent_ecommerce,
                    $oEntreprise->cpt_id
                ];

                $sql = "UPDATE entreprise SET "
                        . "catent_id = ?, "
                        . "fmju_id = ?, "
                        . "ent_horaire = ?, "
                        . "ent_siren = ?,"
                        . "ent_num_tva = ?,"
                        . "ent_site = ?,"
                        . "ent_ecommerce = ? "
                        . "WHERE cpt_id =?";

                $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Supprime l'enregistrement de la table selon son id
     * @param $id
     * id de l'entreprise
     * @return int 
     * nombre de ligne impacté
     */
    public static function delEntreprise($id) {
        try {
            $tParam = [$id];
            $sql = 'DELETE FROM entreprise WHERE cpt_id=?';
            
            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
