<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FicheArticle
 *
 * @author Olivier
 */
class FicheArticle {

    public $fiart_id      = '';    
    public $fiart_lbl     = '';
    public $fiart_photos  = '';
    public $fiart_ing     = '';
    public $fiart_alg     = '';
    
    public $fiart_pays_id = '';
    public $fiart_ga_id = '';
    
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
