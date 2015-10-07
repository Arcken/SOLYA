<?php

/**
 * Description of LotManager
 *
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
                . "lot_dlc,"
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
                        . "lot_dlc,"
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
        
        /**
     * Insert une enregistrement dans la table 
     * @param $oLot
     * attend un objet de la classe Lot
     * @return string
     * Renvoie le nombre de ligne insérée
     */
    public static function addLot($oLot) {

        try {
                $tParam = [
                    $oLot->ref_id,
                    $oLot->lot_id_producteur,
                    $oLot->lot_dlc,
                    $oLot->lot_qt_stock,
                    $oLot->lot_qt_init
                ];

                $sql = "INSERT INTO lot ("
                        . " ref_id, "
                        . " lot_id_producteur, "
                        . " lot_dlc, "
                        . " lot_qt_stock, "
                        . " lot_qt_init) "
                        . " VALUES(?,?,?,?,?)";

                $result = Connection::request(2, $sql, $tParam);
                
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
