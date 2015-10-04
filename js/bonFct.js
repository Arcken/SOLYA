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
             $('#zoneBtnBon').hide();
            break;
            
       default:
             $('#divTable').show();
             $('#zoneBtnBon').show();
           break;
       
    }
}

nRowCount = 1;
function ajoutBonLigne($table) {
    
    $('#nbLigne').val(nRowCount);
    $ligne = $('#' + "bonligne").html();
    $id = "bonligne" + nRowCount;
    
    console.log($('#nbLigne').val());
    
    //$ligne = $ligne.replace(/\[\]/g, '[' + nRowCount + ']');
    //
   
   
    //Modifictaion des fonctions
    $ligne = $ligne.replace(/onblur="(.+)">/ ,
                            'onblur=\'getReferenceBonFromId("' + nRowCount + '")\'>');
                            
    $ligne = $ligne.replace(/onblur="(.+)">/ ,
                            'onblur=\'getReferenceBonFromRefCode("' + nRowCount + '")\'>');
                            
    $ligne = $ligne.replace(/onfocus="(.+)">/,
                           'onfocus=\'getLotsFromReference("' + nRowCount + '")\'>');
                           
    $ligne = $ligne.replace(/onfocus="(.+)">/,
                           'onfocus=\'limitQteMax("' + nRowCount + '")\'>');
                           
    $ligne = $ligne.replace(/onclick="(.+)">/,
                           'onclick=\'delLigne("' + $id + '")\'>');
                           
    //Changement des ID
     $ligne = $ligne.replace(/id="refId"/g ,"id=\'refId"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="refCode"/g ,"id=\'refCode"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="refLbl"/g ,"id=\'refLbl"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="lotId"/g ,"id=\'lotId"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="ligQte"/g ,"id=\'ligQte"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="bonligDepot"/g ,"id=\'bonligDepot"+nRowCount+"\'" );
    $ligne = $ligne.replace(/id="bonligCom"/g ,"id=\'bonligCom"+nRowCount+"\'" );
                           
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    nRowCount++;
}


function getReferenceBonFromId($row) {
    
//Champs sur lequel la valeur va être prise
    $refId         ='refId'+$row; 
    $valInput      = $('#'+$refId);
    console.log($valInput.val());
//Récupération des trois objets dont la valeur doit changer
    $refIdId ='refId'  +$row;
    $refCodId='refCode'+$row;
    $refLblId='refLbl' +$row;
    
    $inptRefId     = $('#'+$refIdId);
    $inptCodeRef   = $('#'+$refCodId);
    $txtAreaLblRef = $('#'+$refLblId);
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
    
    
/*//Champs sur lequel la valeur va être prise
    $valInput = $("input[name='refCode[" + $row + "]']");
    console.log($valInput.val());
//Récupération des trois objets dont la valeur doit changer
    $inptRefId     = $("input[name='refId["+$row+"]']");
    $inptCodeRef   = $("input[name='refCode["+$row+"]']");
    $txtAreaLblRef = $("textarea[name='refLbl[" + $row + "]']");
    console.log($txtAreaLblRef.val());*/
    
    //Champs sur lequel la valeur va être prise
     
    
    
    //Récupération des trois objets dont la valeur doit changer
    $refIdId ='refId'  +$row;
    $refCodId='refCode'+$row;
    $refLblId='refLbl' +$row;
    
    $valInput      = $('#'+$refCodId);
    $inptRefId     = $('#'+$refIdId);
    $inptCodeRef   = $('#'+$refCodId);
    $txtAreaLblRef = $('#'+$refLblId);
    
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
            $inptRefId.val(json[key].ref_id);
            $inptCodeRef.val(json[key].ref_code);
            $txtAreaLblRef.val(json[key].ref_lbl);
            
        }
    }
    );

}


function getLotsFromReference($row){
    
    console.log('getLotsFromReference()');
    $refIdId='refId'+$row;
    $valInput      = $('#'+$refIdId);
    $divAlert      = $('#alert');
    $divAlert.text('');
    
    //requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',  
            //Paramètres
            {test: 'Solya', action: 'getLots', refId:$valInput.val()},
            //Callback
    function (json) {

        console.log("json" + json);
        $divAlert.append('<table id="tabAlert">\n\
                               <th>N°Lot</th>\n\
                               <th>DLUO</th>\n\
                               <th>QTE STOCK</th>');
        
        for (var key in json) {
            console.log('lot_id' + json[key].lot_id);
            d = new Date(json[key].lot_date_max);
            $divAlert.append('<tr>\n\
                                  <td>'+json[key].lot_id+'</td>\n\
                                  <td>'+d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear().toString().substring(2,4)+'</td>\n\
                                  <td>'+json[key].lot_qt_stock+'</td>\n\
                             </tr>');      
        }
        $divAlert.append('</table>');
        $divAlert.show();
    }
    );

    
    
}
function limitQteMax($row){
    $lotIdId='lotId'+$row;
    $lotQteId ='ligQte'+$row;
    
    var $valInput      = $('#'+$lotIdId);
    var $inptQte   = $('#'+$lotQteId);
    console.log($valInput.val());
    $.getJSON(
            // url cible
            'ws/webService.php',  
            //Paramètres
            {test: 'Solya', action: 'getLotQte', lotId: $valInput.val()},
            //Callback
    function (json) {

        console.log("json" + json);
        var $nb='';
        for (var key in json) {
            
            console.log('lot_Qte ' + json[key].lot_qt_stock);
            $nb  =  parseInt(json[key].lot_qt_stock);
            console.log($nb);
            
        }
        $inptQte.attr('max',$nb);
    }
    );
}