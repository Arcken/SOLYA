<?php

/*
 * Class référence  
 */

class Reference {

    //Données membres
    public $ref_id           = '';
    public $dc_id            = '';
    public $cons_id          = '';
    public $fiart_id         = '';
    public $dd_id            = '';
    public $tva_id           = '';
    public $ref_lbl          = '';
    public $ref_mrq          = '';
    public $ref_st_min       = '';
    public $ref_poids_brut   = '';
    public $ref_poids_net    = '';
    public $ref_emb_lbl      = '';
    public $ref_emb_couleur  = '';
    public $ref_emb_vlm_ctn  = '';
    public $ref_emb_dim_lng  = '';
    public $ref_emb_dim_lrg  = '';
    public $ref_emb_dim_ht   = '';
    public $ref_emb_dim_diam = '';
    public $ref_com          = '';
    public $ref_code         = '';
    public $ref_photos       = '';
    public $ref_photos_pref  = '';
    
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
                if (!isset($this->$key)) {
                    throw new MySQLException("propriété '$key' inconnue !");
                }
                $this->$key = $value;
            }
        }
    }
} 