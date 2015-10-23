<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bon
 *
 * @author Olivier
 */
class Bon {
    //Données membres
    public $bon_id='';
    public $cpt_id=NULL;
    public $doclbl_id='';
    public $bon_fact_num='';
    public $bon_date='';
    public $bon_com='';
    public $bon_sortie_assoc='';
    
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
