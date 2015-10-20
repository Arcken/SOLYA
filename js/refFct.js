

/**
 * Change la valeur de l'input refcode
 * au retour de la callback 
 * 
 * @returns {undefined}
 */
function changeRefCodeAtTime() {
//On récupère la valeur de la combobox fiche article
    var $fiartId = $('#ficheArticle').val();
    console.log($fiartId);
    if ($fiartId !== '') {
        //On déclenche la récupération de l'abréviation pays
        fillFiartPays($fiartId);
        
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
 * Charge les abréviations du pays et des gammes
 * pour la suggestion de code référence.
 * @returns {undefined}
 */

function chargeRefCode() {
//On vide le champ
    $ctrl = $('#refCode').val('');
    //On récupère le pays
     $pays = $('#pays_abv').val();
    //On récupère les gammes
     $gamme = $('#ga_abv').val();
    //Si ils ne sont pas vide on créé la suggestion de RefCode
    if ($pays !== '' && $gamme !== '') {
        $('#refCode').val($pays + $gamme);
    }

}
/**
 * Fonction qui permet de vérifier 
 * si le code référence est disponible
 * @returns {undefined}
 */
function confirmRefCode() {
    //On récupère la valeur du ref code actuel pour le cas d'une modification
    $curRefCode= $('#curRefCode');
    
    //On récupère la valeur du texte présent dans la div
    $sDivSug = $('#divSuggest').text();
    //On trie pour enlever les espace
    $sug=$.trim($sDivSug);
    //On récupère la valeur "longueur" de notre refCode
    $refCodeLgth=$('#refCode').val().length;
    //On récupère sa valeur
    $refCode =$('#refCode').val();
    
    console.log($sug.length);
    //Si aucun texte n'est présent dans la div et que la longueur du code est correct
    //Il est correct
    if ($sug.length === 0 && $refCodeLgth > 6 ) {
        $('#refCodVld').show();
        $('#refCodInvld').hide();
    //Pour la modification si le refCode est égale à celui présent dans curRefCode
    //Alors le résultat est valide
   }else if($refCode == $curRefCode.val()){
       $('#refCodVld').show();
       $('#refCodInvld').hide();
   }//Si c'est deux conditions ne sont pas respecter il n'est pas valide
   else{
        $('#refCodVld').hide();
        $('#refCodInvld').show();
    }
}
/**
 * Fonction permettant de récupérer 
 * les informations de la fiche article(Pays associé) 
 * dans le champs caché afin de récupérer sa valeur 
 * pour construire la suggestion du refcode
 * @param {type} $fiartId
 * @returns {undefined}
 */
function fillFiartPays($fiartId) {

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
        //On déclenche à la fin de la callback la récupération des gammes
        fillFiartGamme($fiartId);
    }
    );

}

/**
 * Fonction permettant de récupérer 
 * les informations de la fiche article(Gammes associé) 
 * dans le champs caché afin de récupérer sa valeur 
 * pour construire la suggestion du refcode
 * @param {type} $fiartId
 * @returns {undefined}
 */
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
        //On déclenche le chargement du refCode à la sortie de la callback
        chargeRefCode();
    }

    );
   
}

/**
 * Fonction qui récupère les refCodes similaire
 * à celui du champs refCode si il en éxiste 
 * et affiche si besoin la div suggestion
 * @returns {undefined}
 */
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
    //Enfin on confirme que le code est valide
confirmRefCode();
}


