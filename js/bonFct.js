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
    $ligne = $ligne.replace(/onblur="(.+)">/, 'onblur=\'getReferenceBonFromId("' + nRowCount + '")\'>');
    $ligne = $ligne.replace(/onblur="(.+)">/, 'onblur=\'getReferenceBonFromCode("' + nRowCount + '")\'>');
    $ligne = $ligne.replace(/onclick="(.+)">/, 'onclick=\'delLigne("' + $id + '")\'>');
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    nRowCount++;
}


function getReferenceBonFromId($row) {
    
//Champs sur lequel la valeur va être prise
    $valInput      = $("input[name='refId[" + $row + "]']");
    console.log($valInput.val());
//Récupération des trois objets dont la valeur doit changer
    $inptRefId     =$("input[name='refId["+$row+"]']");
    $inptCodeRef   =$("input[name='refCode["+$row+"]']");
    $txtAreaLblRef = $("textarea[name='refLbl[" + $row + "]']");
    console.log($txtAreaLblRef.val());
   
//requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',  
            //Paramètres
            {test: 'Solya', action: 'getRef',champs:'ref_id', value: $valInput.val()},
            //Callback
    function (json) {

        console.log("json" + json);

        for (var key in json) {
            console.log('lbl' + json[key].ref_lbl);
            $inptRefId.val(json[key].ref_id);
            $inptCodeRef.val(json[key].ref_code);
            $txtAreaLblRef.val(json[key].ref_lbl);
            
        }
    }
    );

}
function getReferenceBonFromRefCode($row) {
    
//Champs sur lequel la valeur va être prise
    $valInput= $("input[name='refCode[" + $row + "]']");
    console.log($valInput.val());
//Récupération des trois objets dont la valeur doit changer
    $inptRefId     =$("input[name='refId["+$row+"]']");
    $inptCodeRef   =$("input[name='refCode["+$row+"]']");
    $txtAreaLblRef = $("textarea[name='refLbl[" + $row + "]']");
    console.log($txtAreaLblRef.val());
   
//requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',  
            //Paramètres
            {test: 'Solya', action: 'getRef', champs:'ref_code', value: $valInput.val()},
            //Callback
    function (json) {

        console.log("json" + json);

        for (var key in json) {
            console.log('lbl' + json[key].ref_lbl);
            $inptRefId.val(json[key].ref_);
            $inptCodeRef.val(json[key].ref_code);
            $txtAreaLblRef.val(json[key].ref_lbl);
            
        }
    }
    );

}