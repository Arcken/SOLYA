<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require $path.'/model/DocLibelleManager.php';

try{
    $resDocLbl=DocLibelleManager::getDocLibelles();
    
    if(isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer"){
        
        $tabRefId=$_REQUEST['refId'];
        Tool::printAnyCase($tabRefId);
    }
}catch(MySQLException $e){
    $msg ='Oups une erreur est survenue'+ $resEr;
    Tool::addMsg($msg);
}