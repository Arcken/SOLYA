<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BonEntree {

    public $lig_id = '';
    public $be_id = '';
    public $belig_pu = '';
    public $belig_cu_achat = '';
    public $belig_fb = '';
    public $belig_ft = '';
    public $belig_dd = '';
    public $belig_lbl = '';
    public $belig_taxe = '';
    public $belig_dlc_dluo = '';
    
    
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