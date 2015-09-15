<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tva {
    
    //Données membres
    public $TVA_ID='';
    public $TVA_LBL='';
    public $TVA_TAUX='';
    
    
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
