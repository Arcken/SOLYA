<?php

class FicheArticleManager {
    
    /**
     * Retourne tous les enregistrements de la table Référence
     * 
     * @return Reference[]
     */
    public static function getAllFicheArticle() {
        
        try {
           
            $sql = 'SELECT * FROM fiche_article';
            $result = Connexion::requetes($sql);
        } catch (MySQLException $e) {
            die($e->retourneErreur());
        }
        return $result;
    }
    
    public static function addFicheArticle($FicheArticle) {
        
        try {
            
            if(!empty($FicheArticle->fiart_lbl)&&($FicheArticle->fiart_lbl>3)){
                
                $tParam =array(
                            $FicheArticle->fiart_id,
                            $FicheArticle->fiart_pays_id,
                            $FicheArticle->fiart_lbl,
                            $FicheArticle->fiart_photos,
                            $FicheArticle->fiart_ing,
                            $FicheArticle->fiart_alg
                        );
                
                $sql = "INSERT INTO fiche_article ("
                        . "PAYS_ID,"
                        . "FIART_LBL,"
                        . "FIART_PHOTOS,"
                        . "FIART_ING,"
                        . "FIART_ALG)"
                        . "VALUES(?,?,?,?,?,?)";
                
                $result = Connexion::requetes($sql,$tParam);
           
            }else{
                $result = '<br/><p class="info">Enregistrement impossible sans libéllé </p>';
            }
                
        } catch (MySQLException $e) {
          
           
            $result ='<br/><p class="info">la Fiche article a bien était ajouté </p>';
           
          
        }
        return $result;
    }
}
