<?php

/*
 * Class référence  
 */

class Reference {

    public $ref_id         = '';
    public $ref_emb_id     = '';
    public $ref_dc_id      = '';
    public $ref_fiart_id   = '';
    public $ref_dd_id      = '';
    public $ref_tva_id     = '';
    public $ref_lbl        = '';
    public $ref_st_min     = '';
    public $ref_poids_brut = '';
    public $ref_poids_net  = '';
    public $ref_vlm_ctn    = '';
    public $ref_dim_lng    = '';
    public $ref_dim_lrg    = '';
    public $ref_dim_ht     = '';
    public $ref_dim_diam   = '';

    /**
     * PHP 5 ne supportant pas la surcharge de méthode, on ne peut définir plusieurs
     * constructeurs avec des paramètres différents.
     * Pour contourner cette limitation, on passe un tableau associatif en argument
     * le parcours de ce tableau permettra d'alimenter la ou les données membres
     * 
     * @param tableau associatif $args
     */
    public function __construct($args = null) {
        if (is_array($args) && !empty($args)) {


            // Pour chaque clé, on récupère sa valeur.
            foreach ($args as $key => $value) {
                if (!isset($this->$key))
                    throw new MySQLException("propriété '$key' inconnue !");
                // Si la propriété de la classe est vide, alors on met à jour sa valeur.
                //if(isset($this->$key))  $this->$key = $value;
                $this->$key = $value;
            }
        }
    }
} ?>