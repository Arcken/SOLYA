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
            
            $tParam = [$oLot->lot_qt_stock,
                $oLot->lot_id];

            $sql = "UPDATE lot SET "
                    . "lot_qt_stock =? "
                    . "WHERE lot_id=?";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    /**
     * Modifie un enregistrement dans la table Lot que
     * dans les champs autres que quantités
     * @param type $oLot
     */
    public static function updInfosLot($oLot) {
        try {
            
            $tParam = [
                $oLot->ref_id,
                $oLot->lot_id_producteur,
                $oLot->lot_dlc,
                $oLot->lot_id];

            $sql = "UPDATE lot SET "
                    . "ref_id =?, "
                    . "lot_id_producteur =?, "
                    . "lot_dlc =? "
                    . "WHERE lot_id=?";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
    
    
    /** 
     * Select d'un enregistrement selon l'id
     * @param $lotId
     * Attend l'id du lot
     * @return objet
     * retourne un objet
     */
    public static function getLot($lotId){
        try{
        $tParam = [$lotId];
        
        $sql= "SELECT lot_id,"
                . "ref_id,"
                . "lot_id_producteur,"
                . "lot_dlc,"
                . "lot_qt_stock,"
                . "lot_qt_init "
                . "FROM lot "
                . "WHERE lot_id =?";
        
         $result = Connection::request(0, $sql, $tParam);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
    }
    
    
    /** 
     * Retourne tous les lots dont le stock est >0
     * @return []objet
     * retourne un tableau d'objets
     */
    public static function getLotStock(){
        try{
                
        $sql= "SELECT lot_id,"
                . "ref_id,"
                . "lot_id_producteur,"
                . "lot_dlc,"
                . "lot_qt_stock,"
                . "lot_qt_init "
                . "FROM lot "
                . "WHERE lot_qt_stock > 0";
        
         $result = Connection::request(1, $sql);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
    }
    
    
    /** 
     * Retourne tous les lots dont le stock est <= stock mini
     * @return []objet
     * retourne un tableau d'objets
     */
    public static function getLotStockMin(){
        try{
                
        $sql= "SELECT lot_id,
                l.ref_id,
                lot_id_producteur,
                lot_dlc,
                lot_qt_stock,
                lot_qt_init 
                FROM lot l 
                JOIN reference r ON l.ref_id = r.ref_id 
                WHERE l.lot_qt_stock <= r.ref_st_min";
        
         $result = Connection::request(1, $sql);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
    }
    
    /** 
     * Select for update d'un enregistrement selon l'id
     * @param $lotId
     * Attend l'id du lot
     * @return objet
     * retourne un objet
     */
    public static function getLotForUpd($lotId){
        try{
        $tParam = [$lotId];
        
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
            $tParam = [$refId];

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
     * Récupère les informations du lot
     * dont la date limite est la plus proche
     * @param type $refId
     * @return object Lot
     * @throws MySQLException
     */
        public static function getLotDlcMin($refId){
         
     
        try{
            $tParam = [$refId];

            $sql= "SELECT lot_id,"
                        . "lot_dlc,"
                        . "lot_qt_stock,"
                        . "lot_qt_init "
                        . "FROM lot "
                        . "WHERE ref_id =? and lot_qt_stock > 0 "
                        . "ORDER BY lot_dlc LIMIT 0,1 ";

             $result = Connection::request(0, $sql, $tParam);
         
        }catch(MySQLException $e){
          throw $e;   
        }
        return $result;
        }
    
        
     /**
     * Modifie un enregistrement dans la table Lot
     * @param type $oLot
     */
    public static function updLot($oLot) {
        try {
            
            $tParam = [$oLot->ref_id,
                $oLot->lot_id_producteur,
                $oLot->lot_dlc,
                $oLot->lot_qt_stock,
                $oLot->lot_qt_init,
                $oLot->lot_id];

            $sql = "UPDATE lot SET "
                    . "ref_id = ?, "
                    . "lot_id_producteur = ?, "
                    . "lot_dlc = ?, "
                    . "lot_qt_stock = ?, "
                    . "lot_qt_init = ? "
                    . "WHERE lot_id=?";

            $result = Connection::request(2, $sql, $tParam);
            
        } catch (MySQLException $e) {
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
    
    
     /**
     * Supprime l'enregistrement de la table selon son id
     * @param $lotId
     * Id du lot
     * @return int 
     * nombre de ligne impacté
     */
    public static function delLot($lotId) {
        try {
            $tParam = [$lotId];
            
            $sql = 'DELETE FROM lot WHERE lot_id = ?';
            
            $result = Connection::request(2, $sql, $tParam);
        } catch (MySQLException $e) {
            throw $e;
        }
        return $result;
    }
}
