<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FicheArticle {

    public $fiart_id        = '';    
    public $fiart_lbl       = '';
    public $fiart_photos    = '';
    public $fiart_ing       = '';
    public $fiart_alg       = '';
    public $fiart_com       = '';
    public $fiart_com_tech  = '';
    public $fiart_com_util  = '';
    public $fiart_desc_fr   = '';
    public $fiart_desc_eng  = '';
    public $fiart_desc_esp  = '';
    
    //clef étrangère
    public $fiart_pays_id = '';
    
    //Valeur table étrangére
    public $fiart_pays_nom;
       
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
