

/**
 * Change la valeur de l'input refcode
 *  au retour de la callback 
 * 
 * @returns {undefined}
 */
function changeRefCodeAtTime() {
//On récupère la valeur de la combobox fiche article
    var $fiartId = $('#ficheArticle').val();
    console.log($fiartId);
    if ($fiartId !== '') {
        
        fillFiartInfos($fiartId);
        
    } else {
        $('#pays_abv').val('');
        $('#ga_abv').val('');
        $('#refCode').val('');
        $('#divSuggest').hide();
        $('#refCodVld').hide();
        $('#refCodInvld').hide();
    }
}

/**
 * 
 * @returns {undefined}
 */

function chargeRefCode() {

    $ctrl = $('#refCode').val('');
    
     $pays = $('#pays_abv').val();
    
     $gamme = $('#ga_abv').val();
    
    if ($pays !== '' && $gamme !== '') {
        $('#refCode').val($pays + $gamme);
    }

}

function confirmRefCode() {
    $curRefCode =$('#curRefCode');
    $sDivSug = $('#divSuggest').text();
    $sug=$.trim($sDivSug);
    $refCodeLgth=$('#refCode').val().length;
    $refCode =$('#refCode').val();
    
    console.log($sug.length);
    
    if ($sug.length === 0 && $refCodeLgth > 6 ) {
        $('#refCodVld').show();
        $('#refCodInvld').hide();
   }else if($refCode == $curRefCode.val()){
       $('#refCodVld').show();
       $('#refCodInvld').hide();
   }
   else{
        $('#refCodVld').hide();
        $('#refCodInvld').show();
    }
}

function fillFiartInfos($fiartId) {

    $("#pays_abv").val('');
    var $sRes = '';

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getFiartPays', fiartId: $fiartId},
    function (json) {
        var $str = '';
        for (var key in json) {
            $str += json[key].pays_abv;
        }
        $sRes = $str;
        $("#pays_abv").val($sRes.toUpperCase());
        fillFiartGamme($fiartId);
    }
    );

}


function fillFiartGamme($fiartId) {

    $("#ga_abv").val('');

    var p = $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getFiartGamme', fiartId: $fiartId},
    function (json) {
        var $sRes = '';
        var $str = '';
        for (var key in json) {
            $str += json[key].ga_abv;
        }
        $sRes = $str;
        $("#ga_abv").val($sRes.toUpperCase());
        chargeRefCode();
    }

    );
   
}


function getLastRefCode() {

    var $refCode = $('#refCode').val();
    var $divSuggest = $('#divSuggest');
    var $spnSug =$('#resSugg');
   

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getRefCode', refCode: $refCode.toString().toUpperCase()},
    function (json) {
        var $hideShow = false;
        var $string='';
        for (var key in json) {
            
            if (json[key].ref_code.length === 0) {
                $hideShow = false;
                break;
            } else {
                $string+=json[key].ref_code + '<br>';
                $hideShow = true;
            }
            
        }
       
        $spnSug.html($string);
        if ($hideShow === true) {
            
            $spnSug.show();
            $divSuggest.show();
            
        } else {
            
            $spnSug.hide();
            $spnSug.empty();
            $divSuggest.hide();
        }
    }
    );
confirmRefCode();
}


