<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BonEntree {

    //Données membres
    public $be_id = NULL;
    public $cpt_id = NULL;
    public $be_lbl = '';
    public $be_date = '';
    public $be_fact_num = '';
    public $be_frais_douane = '';
    public $be_frais_bancaire = '';
    public $be_frais_trans = '';
    public $be_com = '';
    public $be_info_trans = '';
    public $be_total = '';
    public $be_mode_pai = '';
    public $be_com_pai = '';
    
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