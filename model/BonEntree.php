<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BonEntree {

    public $be_id = '';
    public $cpt_id = '';
    public $be_lbl = '';
    public $be_date = '';
    public $be_fact_num = '';
    public $be_frais_douane = '';
    public $be_frais_bancaire = '';
    public $be_frais_trans = '';
    public $be_frais_com = '';
    public $be_infos_trans = '';
    
    
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

}