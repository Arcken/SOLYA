function popup(url) 
{
 var width  = 700;
 var height = 500;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}

function getGamme(){
    $.get(            
                'ajax/getGamme.php',  // code cible
                'false', //aucun paramètre
                // data : ?? paramètre de données
                'majGamme', //appel de la fonction au retour 
                'json'
            );
}
function majGamme(){
    
}