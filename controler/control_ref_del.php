<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try{
    
    require_once $path.'/model/ReferenceManager.php';
    require_once $path.'/model/PrixVenteManager.php';

    //On récupère les infos de la référence
    $idRef    = $_REQUEST['idRef'];
    $refCode  = $_REQUEST['refCode'];
    $refLbl   = $_REQUEST['refLbl'];
    
    //On récupère la connexion
    $cnx=  Connection::getConnection();
    //On démarre la transaction
    $cnx->beginTransaction();
    
    //On supprime les prix de ventes associés à la référence
    $resPvDel =  PrixVenteManager::delPrixVentesOfRef($idRef);
    
    //On supprime la référence 
    $resDelRef=  ReferenceManager::delReference($idRef);
    
    $cnx->commit();
    //Si la suppression à bien impacté un enregistrement
    //alors on ajoiute le message de réussite
    if (($resDelRef)>0){  
        $msg ="<p class='info'>".date('H:i:s')." La référence:\n".$refCode."\n".$refLbl." à bien était Supprimé</p>";
        Tool::addMsg($msg);
    }
    
require_once $path.'/controler/control_ref_list.php';
$sAction="ref_list";    

}catch(MySQLException $e){
    $cnx->rollback();
    $msg= $resEr;
    Tool::addMsg($msg);
}
