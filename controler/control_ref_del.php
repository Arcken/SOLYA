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
    
    if (($resDelRef)>0){
        
        $resMessage ="La référence:\n".$refCode."\n".$refLbl." à bien était Supprimé";
    }

}catch(MySQLException $e){
    if(isset($resEr)){
        switch ($resEr){
            case '23000':
                $resMessage="Impossible de supprimer la référence :\n".$refCode."\n".$refLbl;
        }
    }
}
require_once $path.'/controler/control_ref_list.php';
$sAction="ref_list";