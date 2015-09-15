<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonneManager
 *
 * @author Olivier
 */
class PersonneManager {

    public static function addPersonne($Personne) {
        $cnx = Connection::getConnection();
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnx->beginTransaction();

        try {

            if (!empty($Personne->PRS_NOM) && (strlen($Personne->PRS_NOM)) > Connection::getLimLbl()) {

                $tParamPrs = array(
                    $Personne->PRS_NOM,
                    $Personne->PRS_PRENOM,
                    $Personne->PRS_PRENOM2,
                    $Personne->PRS_PRENOM3,
                    $Personne->PRS_DTN
                );

                $sqlPrs = "INSERT INTO personne ("
                        . "PRS_NOM,"
                        . "PRS_PRENOM,"
                        . "PRS_PRENOM2,"
                        . "PRS_PRENOM3,"
                        . "PRS_DTN)"
                        . "VALUES(?,?,?,?,?)";
                //. "PAYS_ID,"

                $result = Connection::request(2, $sqlPrs, $tParamPrs);

                if (is_string($_REQUEST['MAIL_ADR']) && strlen($_REQUEST['MAIL_ADR']) > 3) {

                    $tParamAdr = array($_REQUEST['MAIL_ADR']);

                    $sql = "INSERT INTO mail ("
                            . "MAIL_ADR)"
                            . "VALUES(?)";

                    $result = Connection::request(2, $sqlMail, $tParamAdr);
                }

                if (is_string($_REQUEST['MAIL_ADR']) && strlen($_REQUEST['MAIL_ADR']) > 3) {

                    $tParamAdr = array($_REQUEST['MAIL_ADR']);

                    $sql = "INSERT INTO mail ("
                            . "MAIL_ADR)"
                            . "VALUES(?)";

                    $result +=' ' . Connection::request(2, $sqlMail, $tParamAdr);
                }

                if (is_string($_REQUEST['TEL_IND']) && is_string($_REQUEST['TEL_NUM']) && strlen($_REQUEST['TEL_IND']) > 2 && strlen($_REQUEST['TEL_NUM']) > 2) {

                    $tParamTel = array($_REQUEST['TEL_IND'], $_REQUEST['TEL_NUM']);

                    $sqlTel = "INSERT INTO telephone ("
                            . "TEL_IND,"
                            . "TEL,NUM)"
                            . "VALUES(?,?)";

                    $result +=' ' . Connection::request(2, $sqlTel, $tParamTel);
                    
                    print_r($result);
                    $cnx->commit();
                }
            } else {
                $cnx->rollback();
                $result = '<br/><p class="info">Enregistrement impossible sans NOM </p>';
            }
        } catch (MySQLException $e) {

            echo $e->RetourneErreur();

            //$result ='<br/><p class="info">la Fiche article a bien était ajouté </p>';
        }
        // return $result;
    }

}
