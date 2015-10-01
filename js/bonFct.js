/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function formChooserBon(){
    //Listener pour click sur le bouton réinitialiser
   $('#clearForm').click(function(){
       location.href='index.php?action=bon_add';
   });
       
   
    var typeBon = $("#typeBon").val();
    
    console.log(typeBon);
    
    switch (typeBon){
        
         case "":
             $('#divTable').hide();
            break;
            
       default:
           $('#divTable').show();
           break;
       
    }
}

nRowCount = 1;
function ajoutBonLigne($table) {

    $ligne = $('#' + "bonligne").html();
    $id = "bonligne" + nRowCount;
    $ligne = $ligne.replace(/\[\]/g, '[' + nRowCount + ']');
    $ligne = $ligne.replace(/onblur="(.+)">/, 'onblur=\'getReferenceBon("' + $id + '")\'>');
    $ligne = $ligne.replace(/onclick="(.+)">/, 'onclick=\'delLigne("' + $id + '")\'>');
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    nRowCount++;
}


function getReferenceBon($row) {
    console.log('je suis la');
//On selectionne la ligne 
    $idRow = $('#' + $row);
//On selectionne toutes les cellules de la ligne
    $cells = $('td', $idRow);
//On selectionne l'input refId[] contenue dans l'une des cellules
    $refId = $("[name='refId[]']", $cells);
    console.log($refId.val());
//On selectionne la textArea refLbl[] contenue dans l'une des cellules    
    $refLbl = $("textarea[name='refLbl[]']", $cells);
//Appel à la webService    
    $.getJSON(
            // url de la webService 
            'ws/webService.php',
            //Paramètres ajouté à l'url 
            //Dans ce cas ci url : path.ws/webService.php?test=Solya&action=getRef&refId=(valeur de l'input) 
            {test: 'Solya', action: 'getRef', refId: $refId.val()},
    function (json) {
        
        console.log("json" + json);
        console.log($refId.val());
        for (var key in json) {
            console.log( json[key].ref_lbl );
            $refLbl.val(json[key].ref_lbl);
        }
    }
    );

}