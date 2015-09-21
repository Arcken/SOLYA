<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Olivier
 */
class ReferenceManager {

    /**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Reference[]
     */
    public static function getAllReferences() {

        try {

            $sql = "SELECT  r.ref_id, 
                            r.dc_id,
                            r.fiart_id,
                            r.dd_id,
                            r.tva_id,
                            r.ref_lbl,
                            r.ref_st_min,
                            r.ref_poids_brut,
                            r.ref_poids_net,
                            r.ref_emb_lbl,
                            r.ref_emb_couleur,
                            r.ref_emb_vlm_ctn,
                            r.ref_emb_dim_lng,
                            r.ref_emb_dim_lrg,
                            r.ref_emb_dim_ht,
                            r.ref_emb_dim_diam FROM reference r";

            $result = Connection::request(1, $sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }

    public static function insReference($reference) {

        try {

            if (!empty($reference->ref_lbl) && (strlen($reference->ref_lbl) > Connection::getLimLbl())) {

                $tParam = array(
                    $reference->dc_id,
                    $reference->fiart_id,
                    $reference->dd_id,
                    $reference->tva_id,
                    $reference->ref_lbl,
                    $reference->ref_st_min,
                    $reference->ref_poids_brut,
                    $reference->ref_poids_net,
                    $reference->ref_emb_lbl,
                    $reference->ref_emb_couleur,
                    $reference->ref_emb_vlm_ctn,
                    $reference->ref_emb_dim_lng,
                    $reference->ref_emb_dim_lrg,
                    $reference->ref_emb_dim_ht,
                    $reference->ref_emb_dim_diam
                );

                $sql = "INSERT INTO reference ("
                        . "dc_id,"
                        . "fiart_id,"
                        . "dd_id,"
                        . "tva_id,"
                        . "ref_lbl,"
                        . "ref_st_min,"
                        . "ref_poids_brut,"
                        . "ref_poids_net,"
                        . "ref_emb_lbl,"
                        . "ref_emb_couleur,"
                        . "ref_emb_vlm_ctn,"
                        . "ref_emb_dim_lng,"
                        . "ref_emb_dim_lrg,"
                        . "ref_emb_dim_ht,"
                        . "ref_emb_dim_diam) " .
                        " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
            } else {
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
        } catch (MySQLException $e) {


            echo $e->RetourneErreur();
        }
        return $result;
    }

}
