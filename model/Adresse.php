<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adresse
 *
 * @author Olivier
 */
class Adresse {
    //Données membres
    public $PAYS_ID  ='';
    public $ADR_NUM  ='';
    public $ADR_VOIE ='';
    public $ADR_RUE1 ='';
    public $ADR_RUE2 ='';
    public $ADR_RUE3 ='';
    public $ADR_CP   ='';
    public $ADR_VILLE='';
    public $ADR_ETAT ='';
    
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
