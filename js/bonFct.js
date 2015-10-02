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
    $ligne = $ligne.replace(/onblur="(.+)">/, 'onblur=\'getReferenceBon("' + nRowCount + '")\'>');
    $ligne = $ligne.replace(/onclick="(.+)">/, 'onclick=\'delLigne("' + $id + '")\'>');
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    nRowCount++;
}


function getReferenceBon($row,$choice) {
    

    $valInput = $("input[name='refId[" + $row + "]']");
    console.log($valInput);
    $inptCodeRef=$("input[name='refCode["+$row+"]']");
    $txtAreaLblRef = $("textarea[name='refLbl[" + $row + "]']");
    console.log($txtAreaLblRef);
   

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getRef', refId: $valInput.val(),champs:'ref_id'},
    function (json) {

        console.log("json" + json);

        for (var key in json) {
            console.log('lbl' + json[key].ref_lbl);
            $inptCodeRef.val(json[key].ref_code);
            $txtAreaLblRef.val(json[key].ref_lbl);
            
        }
    }
    );

}