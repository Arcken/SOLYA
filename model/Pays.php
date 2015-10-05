<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pays {

    //Données membres
    public $pays_id = '';
    public $pays_nom = '';
    public $pays_abv = '';
    public $pays_dvs_nom = '';
    public $pays_dvs_abv = '';
    public $pays_dvs_sym = '';
    
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