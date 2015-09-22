<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe manager des objets fiche article
 *
 *
 */
class AdresseManager {

    //put your code here
    public static function addAddresse($Adresse) {
        try{
          if (isset($Adresse->PAYS_ID) && isset($Adresse->ADR_VILLE) && strlen($Adresse->ADR_VILLE)> Connection::getLimLbl()) {

                    $tParam = array($Adresse->PAYS_ID,
                                    $Adresse->ADR_NUM,
                                    $Adresse->ADR_VOIE,
                                    $Adresse->ADR_RUE1,
                                    $Adresse->ADR_RUE2,
                                    $Adresse->ADR_RUE3,
                                    $Adresse->ADR_CP,
                                    $Adresse->ADR_VILLE,
                                    $Adresse->ADR_ETAT,
                                       );

                    $sql = "INSERT INTO adresse ("
                            . "PAYS_ID,"
                            . "ADR_NUM,"
                            . "ADR_VOIE,"
                            . "ADR_RUE1,"
                            . "ADR_RUE2,"
                            . "ADR_RUE3,"
                            . "ADR_CP,"
                            . "ADR_VILLE,"
                            . "ADR_ETAT)"
                            . "VALUES(?,?,?,?,?,?,?,?,?)";

                    $result = Connection::request(2, $sql, $tParam);
                    
                }else{
                    $result = '<br/><p class="info">Enregistrement impossible sans Ville et sans pays </p>';
                }
    }catch(MySQLException $e){
        $e->RetourneErreur();
    }

  }

}
