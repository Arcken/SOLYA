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
    
    public static function addFicheArticle($FicheArticle) {
        
        try {
            
            if(!empty($FicheArticle->fiart_lbl)&& (strlen($FicheArticle->fiart_lbl))>  Connection::getLimLbl()){
                
                $tParam = array(
                            
                            //$FicheArticle->fiart_pays_id,
                            $FicheArticle->fiart_lbl,
                            $FicheArticle->fiart_photos,
                            $FicheArticle->fiart_ing,
                            $FicheArticle->fiart_alg
                        );
                
                $sql = "INSERT INTO fiche_article ("
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_ING,"
                        . "FIART_ALG)"
                        . "VALUES(?,?,?,?)";
                        //. "PAYS_ID,"
                
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
