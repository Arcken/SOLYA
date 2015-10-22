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
          $request.val('SELECT * FROM reference WHERE ref_lbl LIKE ');  
        break;
        
        case 'lot':
          $request.val('SELECT * FROM lot l NATURAL JOIN '
                       +'reference r WHERE r.ref_lbl LIKE ');
                       
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
    $value =$('#inptSearch').val();
    
    //On récupère la div dans laquelle les résultat sont affichés
    $resSearch =$('#resSearch');
    
    //On récupère la requète stocké dans l'input caché
    $inptReq=$('#request').val();
    
    //On cache la div et on la néttoie
    $resSearch.hide();
    $resSearch.text('');
    
    //On finalise la requète en y associant la valeur
    $request=$inptReq+" '%"+$value+"%'";
    $.ajax({ 
			url: "ws/webService.php",
			data: { 'test': 'Solya', 'action': 'getSearch','request':$request },
			type: "GET",
			timeout: 30000,
			dataType: "json", // "xml", "json""
			success:function(json) {
				
        // show text reply as-is (debug)
        console.log('Je suis dans la callback');
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
                $strTh+='<th>'+prop+'</th>';  
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
           
           
           //Enfin on ajoute le résultats dans notre div
           $resSearch.append('<table id=tabSearch><tr>'+$strTh+'</tr>'+$strRows+'</table>');
           //Et on l'affiche
           $resSearch.show();
    },
	error: function(jqXHR, textStatus, ex) {
        alert(textStatus + "," + ex + "," + jqXHR.responseText);
    }
   });
    /*
    //Ajax
    $.getJSON(
            'ws/webService.php', // page cible         
            {test: 'Solya', action: 'getSearch',
            request:$request},
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
                $strTh+='<th>'+prop+'</th>';  
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
           
           
           //Enfin on ajoute le résultats dans notre div
           $resSearch.append('<table id=tabSearch><tr>'+$strTh+'</tr>'+$strRows+'</table>');
           //Et on l'affiche
           $resSearch.show();
        }
        );*/
}