<?php

/**
 * Class de l'objet Entreprise.
 * Méthode principal :Constructeur
 * @author Olivier
 */

class Entreprise {
    
    //Données membres
    public $ENT_NOM='';
    public $ENT_HORAIRE='';
    public $ENT_ECOMMERCE='';
    public $ENT_NIC='';
    public $ENT_NAF='';
    public $ENT_SIREN='';
    public $ENT_CLE_TVA='';
    public $ENT_COM='';
 
    
    
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
                if (!isset($this->$key))
                    throw new MySQLException("propriété '$key' inconnue !");
                // Si la propriété de la classe est vide, alors on met à jour sa valeur.
                //if(isset($this->$key))  $this->$key = $value;
                $this->$key = $value;
            }
        }
    }
}
