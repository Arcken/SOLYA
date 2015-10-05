<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class de l'objet Personne.
 * Méthode principal :Constructeur
 */

class Personne {
    
    //Données membre
    public $PRS_ID='';
    public $CIV_ID='';
    public $PRS_NOM='';
    public $PRS_PRENOM1='';
    public $PRS_PRENOM2='';
    public $PRS_PRENOM3='';
    public $PRS_DTN='';
    
     /**
     * Constructeur prenant un tableau associatifs en paramètre
     * Permet la surcharge de la méthode
     * @param Array $args
     * @throws MySQLException
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
