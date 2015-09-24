/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function changeRefCodeAtTime() {

    var $fiartId = $('#ficheArticle').val();
    getFiartPays($fiartId);
    getFiartGamme($fiartId);
    chargeRefCode();
}

function chargeRefCode() {

    $ctrl = $('#refCode').val('');
    var $pays = $('#pays_abv').val();
    var $gamme = $('#ga_abv').val();


    if ($pays !== '' && $gamme !== '') {
        $('#refCode').val($pays + $gamme);
    }
}

function sugstRefCode() {
  var  $a = getLastRefCode();
  
    if ($a === true) {
        
        $divSuggest.show();
    } else {
        $divSuggest.hide();
    }
}