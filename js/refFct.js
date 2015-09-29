/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function changeRefCodeAtTime() {

    var $fiartId = $('#ficheArticle').val();
    if ($fiartId !== '') {
        getFiartPays($fiartId);
        getFiartGamme($fiartId);
        chargeRefCode();
    } else {
        $('#refCode').val('');
        $('#divSuggest').hide();
    }
}

function chargeRefCode() {

    $ctrl = $('#refCode').val('');
    var $pays = $('#pays_abv').val();
    var $gamme = $('#ga_abv').val();


    if ($pays !== '' && $gamme !== '') {
        $('#refCode').val($pays + $gamme);
    }
}

