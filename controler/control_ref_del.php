<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once $path.'/model/ReferenceManager.php';

try{
    $idRef   = $_REQUEST['idRef'];
    $refCode = $_REQUEST['refCode'];
    $refLbl  = $_REQUEST['refLbl'];
    $resDelRef=  ReferenceManager::delReference($idRef);
    
    //Si la suppression à bien impacté un enregistrement
    //alors on ajoiute le message de réussite
    if (($resDelRef)>0){  
        $msg ="<p class='info'>".date('H:i:s')." La référence:\n".$refCode."\n".$refLbl." à bien était Supprimé</p>";
        Tool::addMsg($msg);
    }
    

}catch(MySQLException $e){
    
}
require_once $path.'/controler/control_ref_list.php';
$sAction="ref_list";