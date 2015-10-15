<?php

/**
 * Class contenant les Managers
 * de la table Entreprise
 */


class EntrepriseManager {
   
    
    public static function getEntreprisesLim($rowStart,$nbRow,$orderBy="ENT_ID",$sort="ASC"){
        
        $sql="SELECT ent_id,"
                    . "catent_id, "
                    . "fmju_id, "
                    . "ent_nom, "
                    . "ent_horaire, "
                    . "ent_ecommerce, "
                    . "ent_siren, "
                    . "ent_num_tva, "
                    . "ent_com "
                    . "FROM entreprise"
                    . "ORDER BY ".$orderBy." ".$sort
                    . "LIMIT ".$rowStart.",".$nbRow;
    }
    
}
