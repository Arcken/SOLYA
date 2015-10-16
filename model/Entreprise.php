<?php

/**
 * Class de l'objet Entreprise.
 * Méthode principal :Constructeur
 * @author Olivier
 */
class Entreprise {

    //Données membres
    public $cpt_id = '';
    public $catent_id = '';
    public $fmju_id = '';
    public $ent_horaire = '';
    public $ent_siren = '';
    public $ent_num_tva = '';
    public $ent_site = '';
    public $ent_ecommerce = '';

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
