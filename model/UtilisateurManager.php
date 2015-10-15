<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 * ---------------------Les mots de passes sont concaténés avec !Stage2015!
 * ----------------------------pour les complexifier
 * 
 * 
 */

class UtilisateurManager {

    /**
     * Retourne tous les enregistrements de la table utilisateur 
     * avec le nom du groupe associé
     * sans le mot de passe
     * 
     * @return objet[]
     * Retourne un tableau d'objet
     */
    public static function getAllUtilisateurs() {

        try {
            $sql = 'SELECT ut_nom, ut_prenom, ut_login, ut_actif, grp_nom '
                    . 'FROM utilisateur AS u '
                    . 'JOIN groupe g ON u.grp_id = g.grp_id ';
            
            $result = Connection::request(1, $sql);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne tous les enregistrements de la table utilisateur 
     * avec le nom du groupe associé
     * sans le mot de passe
     * 
     * @return []
     * Retourne un tableau associatif
     */
    public static function getAllUtilisateursTableau() {

        try {
            $sql = 'SELECT ut_nom, ut_prenom, ut_login, ut_actif, grp_nom '
                    . 'FROM utilisateur AS u '
                    . 'JOIN groupe g ON u.grp_id = g.grp_id ';
            
            $result = Connection::request(1, $sql, null,PDO::FETCH_ASSOC);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /**
     * Retourne les détails d'un utilisateur selon son login et mot de passe
     * Sert à vérifier le login
     * @param $oUtilisateur
     * attend un objet de la classe Utilisateur
     * @return objet
     * Retourne un objet
     */
    public static function getUtilisateur($oUtilisateur) {

        try {
            $tParam = array(
                $oUtilisateur->ut_login,
                sha1('!Stage2015!' . $oUtilisateur->ut_pass)
            );

            $sql = "SELECT ut_login, ut_nom, ut_prenom, ut_actif, grp_id, "
                    . "grp_nom "
                    . "FROM utilisateur "
                    . "NATURAL JOIN GROUPE "
                    . "WHERE UT_LOGIN =? AND UT_PASS =?";

            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Retourne les détails d'un utilisateur selon son login
     * 
     * @param $oUtilisateur
     * attend un objet Utilisateur
     * @return string|int
     * Retourne un objet
     */
    public static function getUtilisateurDetail($oUtilisateur) {

        try {

            $tParam = [$oUtilisateur->ut_login];

            $sql = "SELECT ut_login, ut_nom, ut_prenom, ut_actif, grp_id "
                    . "FROM utilisateur "
                    . "WHERE ut_login =?";

            $result = Connection::request(0, $sql, $tParam);
            
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
     * @return Objet[]
     * Retourne un tableau d'objet
     */
    public static function getUtilisateurLim($rowStart, $nbRow, 
            $orderBy = 'ut_login', $sort = 'ASC') {

        try {

            $sql = 'SELECT ut_login, ut_nom, ut_prenom, ut_actif, grp_id '
                    . 'FROM utilisateur '
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
     * Select for update d'un enregistrement selon son id
     * 
     * @param $id
     * attend l'id de l'utilisateur (login)
     * @return objet
     * Retourne un objet
     */
    public static function getUtilisateurDetailForUpd($id) {

        try {
            $tParam = [$id];

            $sql = "SELECT ut_login, ut_nom, ut_prenom, ut_actif, grp_id "
                    . "FROM utilisateur "
                    . "WHERE ut_login =? FOR UPDATE";

            $result = Connection::request(0, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

    
    /**
     * Modifie un enregistrement selon son id
     * 
     * @param $oUtilisateur
     * Attend un objet Utilisateur
     *  @return int 
     * Retourne le nombre de ligne impacté
     */
    public static function updUtilisateur($oUtilisateur) {
        
        try {
            $tParam = array(
                sha1('!Stage2015!' . $oUtilisateur->ut_pass),
                $oUtilisateur->ut_nom,
                $oUtilisateur->ut_prenom,
                $oUtilisateur->ut_actif,
                $oUtilisateur->grp_id,
                $oUtilisateur->ut_login
            );

            $sql = "UPDATE utilisateur SET "
                    . "ut_pass = ?, "
                    . "ut_nom = ?, "
                    . "ut_prenom = ?, "
                    . "ut_actif = ? ,"
                    . "grp_id = ?"
                    . "WHERE ut_login =?";

            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Ajoute un enregistrement dans la table
     * 
     * @param $oUtilisateur
     * Attend un objet Utilisateur
     *  @return int 
     * Retourne un int (nombre de succées) ou un string (échec)
     */
    public static function addUtilisateur($oUtilisateur) {
        try {

            $tParam = array(
                $oUtilisateur->ut_login,
                sha1('!Stage2015!' . $oUtilisateur->ut_pass),
                $oUtilisateur->ut_nom,
                $oUtilisateur->ut_prenom,
                $oUtilisateur->ut_actif,
                $oUtilisateur->grp_id,
            );

            $sql = "INSERT INTO utilisateur ("
                    . "UT_LOGIN,"
                    . "UT_PASS,"
                    . "UT_NOM,"
                    . "UT_PRENOM,"
                    . "UT_ACTIF,"
                    . "GRP_ID)"
                    . "VALUES(?,?,?,?,?,?)";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }

}
