<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FicheArticle {

    //Données membres
    public $fiart_id        = '';    
    public $fiart_lbl       = '';
    public $fiart_photos    = '';
    public $fiart_photos_pref    = '';
    public $fiart_ing       = '';
    public $fiart_alg       = '';
    public $fiart_com       = '';
    public $fiart_com_tech  = '';
    public $fiart_com_util  = '';
    public $fiart_desc_fr   = '';
    public $fiart_desc_eng  = '';
    public $fiart_desc_esp  = '';
    
    //clef étrangère
    public $pays_id = '';
    
    //Valeur table étrangére
    public $fiart_pays_nom;
    
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
