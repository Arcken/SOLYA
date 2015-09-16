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
            die($e->retourneErreur());
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
    
    public static function addFicheArticle($FicheArticle) {
        
        try {
            
            if(!empty($FicheArticle->fiart_lbl)&& (strlen($FicheArticle->fiart_lbl))>  Connection::getLimLbl()){
                
                $arg = '';
                $param = '?,?,?,?';
                $tParam = array(
                            $FicheArticle->fiart_lbl,
                            $FicheArticle->fiart_photos,
                            $FicheArticle->fiart_ing,
                            $FicheArticle->fiart_alg                                                        
                        );
                        
                if ($FicheArticle->fiart_pays_id > 0){
                    $tParam[] = $FicheArticle->fiart_pays_id;
                    $arg = 'PAYS_ID,';
                    $param += ',?';
                }
                
                $sql = "INSERT INTO fiche_article (".
                        $arg
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_ING,"
                        . "FIART_ALG)"                                               
                        . "VALUES(".$param.")";                        
                
                $result = Connection::request(2,$sql,$tParam);
                print_r($result);
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
                
        } catch (MySQLException $e) {
          
           echo $e->RetourneErreur();
          
            //$result ='<br/><p class="info">la Fiche article a bien était ajouté </p>';
           
          
        }
       // return $result;
    }
}
