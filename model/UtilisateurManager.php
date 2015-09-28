<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UtilisateurManager {
    //put your code here

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

            if ($e->getCode() == 00000) {
                return 0;
            } else
                return $e->getCode();
        }
        return $result;
    }

    /**
     * Retourne les détails d'un utilisateur selon son login et mot de passe
     * 
     * @param $oUtilisateur
     * attend un objet Utilisateur
     * @return string|int
     * Retourne un objet
     */
    public static function getUtilisateur($Utilisateur) {

        try {

            if (!empty($Utilisateur->ut_login) && (strlen($Utilisateur->ut_login)) > Connection::getLimLbl() && !empty($Utilisateur->ut_pass) && (strlen($Utilisateur->ut_pass)) > Connection::getLimLbl()) {

                $tParam = array(
                    $Utilisateur->ut_login,
                    $Utilisateur->ut_pass
                );

                $sql = "SELECT * FROM utilisateur"
                        . " NATURAL JOIN GROUPE"
                        . " WHERE UT_LOGIN =? AND UT_PASS =?";

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
     * Retourne les détails d'un utilisateur selon son login
     * 
     * @param $oUtilisateur
     * attend un objet Utilisateur
     * @return string|int
     * Retourne un objet
     */
    public static function getUtilisateurDetail($oUtilisateur) {

        try {

            if (!empty($oUtilisateur->ut_login) && $oUtilisateur->ut_login != '') {

                $tParam = array(
                    $oUtilisateur->ut_login
                );

                $sql = "SELECT ut_login, ut_nom, ut_prenom, ut_pass, ut_actif, grp_id "
                        . "FROM utilisateur"
                        . " WHERE ut_login =?";

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
     * Select for update d'un utilisateur selon son login
     * 
     * @param $oUtilisateur
     * attend un objet Utilisateur
     * @return string|int
     * Retourne un objet
     */
    public static function getUtilisateurDetailUpd($oUtilisateur) {

        try {

            if (!empty($oUtilisateur->ut_login) && $oUtilisateur->ut_login != '') {

                $tParam = array(
                    $oUtilisateur->ut_login
                );

                $sql = "SELECT ut_login, ut_nom, ut_prenom, ut_pass, ut_actif, grp_id "
                        . "FROM utilisateur"
                        . " WHERE ut_login =? FOR UPDATE";

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
     * Ajoute un utilisateur dans la table utilisateur
     * 
     * @param $oUtilisateur
     * Attend un objet Utilisateur
     *  @return int|string 
     * Retourne un int (succées) ou un string (échec)
     */
    public static function addtilisateur($oUtilisateur) {
        try {

             if ((!empty($oUtilisateur->ut_login) && (strlen($oUtilisateur->ut_login)) > Connection::getLimLbl()) 
                    && (!empty($oUtilisateur->ut_pass) && (strlen($oUtilisateur->ut_pass)) > Connection::getLimLbl())) {

                $tParam = array(
                    $oUtilisateur->ut_login,
                    $oUtilisateur->ut_pass,
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
            } else {
                $result = '<br/><p class="info">Enregistrement impossible, erreur de données saisies</p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();
        }
        return $result;
    }
    
    /**
     * Modifie un utilisateur selon son id
     * 
     * @param $oUtilisateur
     * Attend un objet Utilisateur
     *  @return int|string 
     * Retourne un int (succées) ou un string (échec)
     */
    public static function updtilisateur($oUtilisateur) {
        try {

            if ((!empty($oUtilisateur->ut_login) && !empty($oUtilisateur->ut_pass) )) {

                $tParam = array(
                    
                    $oUtilisateur->ut_pass,
                    $oUtilisateur->ut_nom,
                    $oUtilisateur->ut_prenom,
                    $oUtilisateur->ut_actif,
                    $oUtilisateur->grp_id,
                    $oUtilisateur->ut_login
                );

                $sql = "UPDATE utilisateur set "                        
                        . "UT_PASS = ?, "
                        . "UT_NOM = ?, "
                        . "UT_PRENOM = ?, "
                        . "UT_ACTIF = ?, "
                        . "GRP_ID = ? "
                        . "WHERE ut_login = ?";

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
