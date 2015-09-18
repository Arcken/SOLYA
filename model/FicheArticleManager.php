<?php
require_once 'Connection.php';
class FicheArticleManager {
    
    /**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Reference[]
     */
    public static function getAllFichesArticles() {
        
        try {
           
            $sql = 'SELECT * FROM fiche_article';
            $result = Connection::request(0,$sql);
        } catch (MySQLException $e) {
            
            if ($e->getCode() == 0000){
                return 0;
            }
            else return $e->getCode ();
        }
        return $result;
    }
    
    public static function getMaxIdFicheArticle() {
        
        try {
           
            $sql = 'SELECT MAX(fiart_id) FROM fiche_article';
            $result = Connection::request(0,$sql, null ,$format = PDO::FETCH_ASSOC);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    public static function getAllFicheArticleFull() {
        
        try {
           //jointure avec pays_id
            $sql = 'SELECT * FROM fiche_article '
                    . 'NATURAL JOIN pays';
            $result = Connection::request(0,$sql, null ,$format = PDO::FETCH_ASSOC);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    public static function addFicheArticle($FicheArticle) {
        
        try {
            
            if(!empty($FicheArticle->fiart_lbl)&& (strlen($FicheArticle->fiart_lbl))>  Connection::getLimLbl()){
                
                $tParam = array(
                            $FicheArticle->fiart_lbl,
                            $FicheArticle->fiart_photos,
                            $FicheArticle->fiart_ing,
                            $FicheArticle->fiart_alg,
                            $FicheArticle->fiart_pays_id
                        );
                
                $sql = "INSERT INTO fiche_article ("                        
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_ING,"
                        . "FIART_ALG,"
                        . "PAYS_ID)"
                        . "VALUES(?,?,?,?,?)";                        
                
                $result = Connection::request(2,$sql,$tParam);
                print_r($result);
            }else{
                $result = '<p class="info">Enregistrement FIART impossible, erreur de données insérées</p><br/>';
            }
                
        } catch (MySQLException $e) {
          
           echo $e->RetourneErreur();
          
            $result ='Enregsitrement fiart erreur';
           
          
        }
       // return $result;
    }
}
