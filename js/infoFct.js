/**
 *Fichier des fonctions de la vue : view_infos 
 *
 */


/**
 * Change la requète contenue dans l'input request
 * en fonction de la valeur du bouton radio
 * 
 * @returns {undefined}
 */

function changeRequest(){
    //Récupère la valeur du bouton 
    var $radioBtnVal=$('input[type=radio][name=table]:checked').val();
    
    
    //Récupère l'input qui va contenir la requète
    //Par défaut rien n'est dedans
    var $request=$('#request');
    
    switch ($radioBtnVal){
        //Selon sa valeur on vient stocker une requète à l'interieur
        case 'reference':
            
          $request.val('SELECT ref_id as Numéro, '
                              +'ref_code as Code$Référence, '
                              +'ref_lbl as Nom, '
                              +'ref_mrq as Marque, '
                              +'ref_st_min as Stk$Mini, '
                              +'ref_poids_brut as PoidsBrut, '
                              +'ref_poids_net as PoidsNet, '
                              +'ref_emb_lbl as Emballage, '
                              +'ref_com as Commentaire ' 
                              +'FROM reference WHERE ref_lbl LIKE '); 
        break;
        
        case 'lot':
          $request.val("SELECT l.lot_id as Numéro$Lot, "
                + "l.ref_id as Référence$Associée, "
                + "r.ref_code as Code$Référence, "
                + "l.lot_id_producteur as N°Lot$Producteur, "
                + "l.lot_dlc as DLC$DLUO, "
                + "l.lot_qt_stock as Quantité$Stock, "
                + "l.lot_qt_init as Quantité$Initial "
                + "FROM lot l "
                + "NATURAL JOIN "
                + "reference r WHERE r.ref_lbl LIKE ");     
        break;
        
        case 'compte':
          $request.val('SELECT cpt_id as Numéro$Compte, '
                        +'cpt_nom as Nom, '
                        +'cpt_code as Code$Compte, '
                        +'cpt_date as Date$Création, '
                        +'cpt_com as Commentaire '
                        +'FROM compte '
                       + 'WHERE cpt_nom LIKE ');     
        break;
        
                    
    }
}

/**
 * Appel la web service pour qu'elle éxécute la requète contenue dans l'input request
 * 
 * @returns {undefined}
 */

function search(){
    //On récupère la valeur à rechercher
    $value = $('#inptSearch');
    
    //On récupère la div dans laquelle les résultat sont affichés
    $resSearch =$('#resSearch');
    
    //On récupère la requète stocké dans l'input caché
    $request=$('#request').val();
    
    //On cache la div et on la néttoie
    $resSearch.hide();
    $resSearch.text('');
    
    console.log($request);
    console.log($value);
    console.log($value.val());
    
    //Ajax
    $.getJSON(
            'ws/webService.php', // page cible         
            {test: 'Solya', action: 'getSearch',request:$request, value:$value.val()},
          //Callback  
    function (json) {
        //String qui va contenir les entêtes   
        var $strTh='';
        //Tableau qui va contenir toutes les lignes de la table 
        $tab=new Array();
        
        //On boucle une premiere fois sur les objets que ramène le Json
        for (var key in json) {
            
            //On initialise la string qui va contenir les céllule pour former la ligne
            var $strTd='';
            
           //On boucle sur les propriétés contenue par les objets Json  
          for(var prop in json[key]){
              
            //Si c'est la première ligne on mémorise les en-têtes
              if(key==='0'){
                $title=prop.replace('$',' ');
                $strTh+='<th>'+$title+'</th>';  
              }
              
              //On construit la ligne de la table
              $strTd+='<td>' + json[key][prop] +'</td>'; 
           }
           
           //On vient l'ajouter au tableau
           $tab.push($strTd);
        }
        
          //On initialise la string contenant toute les lignes de la table html 
           var $strRows='';
           
           for (var $row in $tab){
              //Construction des lignes 
              $strRows+='<tr>'+$tab[$row]+'</tr>';
           }
           
           
           //Enfin on ajoute le résultat dans notre div
           $resSearch.append('<table id=tabSearch><tr>'+$strTh+'</tr>'+$strRows+'</table>');
           //Et on l'affiche
           $resSearch.show();
        }
        );
}