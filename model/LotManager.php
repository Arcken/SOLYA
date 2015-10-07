<?php

/**
 * Description of LotManager
 *
 * @author Olivier
 */
class LotManager {
   
    
     /**
     * Modifie un enregistrement dans la table Lot
     * @param type $oLot
     */
    public static function updQteLot($oLot) {
        try {
            
            $tParam = array(
                $oLot->lot_qt_stock,
                $oLot->lot_id
            );

            $sql = "UPDATE lot SET "
                    . "lot_qt_stock =? "
                    . "WHERE lot_id=?";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    public static function getLotForUpdate($lotId){
        try{
        $tParam = array($lotId);
        
        $sql= "SELECT lot_id,"
                . "ref_id,"
                . "lot_id_producteur,"
                . "lot_date_max,"
                . "lot_qt_stock,"
                . "lot_qt_init "
                . "FROM lot "
                . "WHERE lot_id =? FOR UPDATE";
        
         $result = Connection::request(0, $sql, $tParam);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
    }
    
    public static function getLotsFromReference($refId){
         
     
        try{
            $tParam = array($refId);

            $sql= "SELECT lot_id,"
                        . "lot_date_max,"
                        . "lot_qt_stock,"
                        . "lot_qt_init "
                        . "FROM lot "
                        . "WHERE ref_id =? and lot_qt_stock >0";

             $result = Connection::request(1, $sql, $tParam);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
        }
}
