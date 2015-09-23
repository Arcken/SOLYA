/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fillRefCode() {
    var $fiartId = $('#ficheArticle').val();
    if ($fiartId !== '') {
        //$('#refCode').val('');
        //console.log($fiartId);
        $abvPays  = getFiartPays($fiartId);
        //console.log("$fiartId");
        $abvGamme = getFiartGamme($fiartId);
        
        $('#refCode').val($abvPays+$abvGamme);
    }else{
    $('#refCode').val('');
}
}
