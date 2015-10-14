<?php

/**
 * Class de l'objet Entreprise.
 * Méthode principal :Constructeur
 * @author Olivier
 */

class Entreprise {
    
    //Données membres
    public $ent_nom='';
    public $ent_horaire='';
    public $ent_ecommerce='';
    public $ent_nic='';
    public $ent_naf='';
    public $ent_siren='';
    public $ent_cle_tva='';
    public $ent_com='';
 
    
    
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
