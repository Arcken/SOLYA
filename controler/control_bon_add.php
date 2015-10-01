<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require $path.'/model/DocLibelleManager.php';

try{
    $resDocLbl=DocLibelleManager::getDocLibelles();
    
}catch(MySQLException $e){
    $msg ='Oups une erreur est survenue'+ $resEr;
    Tool::addMsg($msg);
}