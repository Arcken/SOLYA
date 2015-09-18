<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tool
 *
 * @author Olivier
 */
class Tool {
    //put your code here
    
    public static function printAnyCase ($var){
        
        if(is_array($var)){
            print_r($var);
        }else{
            echo $var;
        }
    }
}
