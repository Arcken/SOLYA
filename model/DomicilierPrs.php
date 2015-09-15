<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DomicilierPrs
 *
 * @author Olivier
 */
class DomicilierPrs {
    //put your code here
    public $ADRPER_LBL='';
    public $ADR_ID='';
    public $PRS_ID='';
    
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
