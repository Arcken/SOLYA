function getValueFromJson(json) {

}
/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend la page à afficher en paramètre
 * @param string 
 * action a effectuer pour le contrôleur
 * @returns {Boolean}
 */
function popup(action)
{
    var width = 700;
    var height = 500;
    var left = (screen.width - width) / 2;
    var top = (screen.height - height) / 2;
    var params = 'width=' + width + ', height=' + height;
    params += ', top=' + top + ', left=' + left;
    params += ', directories=no';
    params += ', location=no';
    params += ', menubar=no';
    params += ', resizable=no';
    params += ', scrollbars=no';
    params += ', status=no';
    params += ', toolbar=no';
    newwin = window.open('index.php?action=nv_' + action, 'windowname5', params);
    alert(navigator.userAgent.indexOf);
    if (window.focus) {
        newwin.focus();
    }
    
    return false;
}

/**
 * Fonction pour tester les appels de js
 * Affiche une boite de message
 * @returns rien
 */
function test() {
    alert('Coucou');
}

/**
 * Fonction qui recherche le nombre d'occurence dans une table
 * @param {String} $champs champs cible dans la table
 * @param {String} $table nom de la table
 * @param {String} $source nom de l'input contenant la valeur à chercher
 * @param {String} $cible id du bloc html à modifier, affiche une image de validation si aucun doublon
 * ou une croix pour un doublon
 * @returns {undefined}
 */
function verifUnique($champs, $table, $source, $cible) {
    $valeur = $("input[name=" + $source + "]").val();
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getNombre', table: $table, champs: $champs, valeur: $valeur},
    function (json) {
        if (json.total == 0) {
            $('#' + $cible).html('<img src="img/icon/accept.png">');

        }
        else {
            $('#' + $cible).html('<img src="img/icon/delete.png">');
        }
    }
    );
}

/**
 * fonction qui rend visible une image si le pass et la confirmation sont identique
 * @returns {undefined}
 */
function verifPassImg() {
    if ($('#pass').val() != ''
            && $('#confirmPass').val() != ''
            && $('#pass').val() == $('#confirmPass').val())
    {
        $('#passValid').show();
    }
    else
        $('#passValid').hide();
}

/**
 * fonction qui test la solidité du mot de passe
 * @returns {undefined}
 */
function verifPassForce() {
    if ($('#pass').val() != ''
            )
    {
        // Doit contenir des majuscules, des chiffres et des minuscules
        var strongRegex = new RegExp("^(?=.{10,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$", "g");


        // Doit contenir soit des majuscules et des minuscules soit des minuscules et des chiffres
        var mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");


        // Doit faire au minimum huit caractères
        var okRegex = new RegExp("(?=.{8,}).*", "g");

        if (okRegex.test($('#pass').val()) === false) {
            // If ok regex doesn't match the password
            alert('Le mot de passe doit contenir 8 caractères minimum');

        } else if (strongRegex.test($('#pass').val())) {
            // If reg ex matches strong password
            $('#passForce').text('Mot de passe fort!');
        } else if (mediumRegex.test($('#pass').val())) {
            // If medium password matches the reg ex
            $('#passForce').text('Mot de passe moyen!');
        } else {
            // If password is ok
            $('#passForce').text('Mot de passe faible!');
        }
    }

}


/**
 * fonction qui teste si le pass et sa confirmation sont identique, affiche une alertbox si différents
 * @returns {Boolean}
 */
function verifPass() {
    var test = false;

    if ($('#pass').val().length >= 8
            ) {
        if ($('#pass').val() != ''
                && $('#confirmPass').val() != ''
                && $('#pass').val() == $('#confirmPass').val())
        {
           return true;                       
        }
        else {
            alert('Le mot de passe et sa confirmation doivent être identique');
            return false;
        }
    }
    else
        alert('Le mot de passe doit être au moins de huit caractères');
    return false;

}


/**
 * Fonction qui appel une page en spécifier le choix du trie pour les reqêtes
 * @param string action
 *  action à effectuer pour le contrôleur
 * @param string champs
 *  champs sur lequel porte le tri de la requéte
 * @returns rien
 */
function orderby(action, champs) {
    window.open('index.php?action=' + action + "&orderby=" + champs, '_self');
}

/**
 * Fonction qui affiche une boite de confirmation pour la suppression
 * @param {string ou int} id
 *  id de l'élément à effacer
 * @param string codetype
 *  champs id l'élément
 * @param string type
 * Type d'élément à supprimer (s'affiche dans la message box)
 * @param string action
 * Action à effectuer pour le contrôleur
 * @returns {undefined}
 */
function delElt(id, codetype, type, action) {
    $resBool = confirm("Voulez-vous supprimez l'élément: " + type + " numéro: " + id);
    if ($resBool) {
        window.open('index.php?action=' + action + "&" + codetype + "=" + id, '_self')
    }
}

/**
 * Fonction qui définit le script à effectuer sur le bloc unload de la page affiché
 * @returns {undefined}
 */
function selMaj() {
    var $action = $('#action').val();

    switch ($action) {

        case 'nv_nut_add' :
            $("#newView").prop('onunload', window.opener.getNut());
            break;

        case 'nv_ga_add':
            $("#newView").prop('onunload', window.opener.getGamme());
            break;

        case 'nv_pays_add':
            $("#newView").prop('onunload', window.opener.getPays());
            break;
    }
}

/**
 * Met à jour un bloc html selon les choix d'une combobox
 * @param $select
 * combobox source des données
 * @param $target
 * bloc p, div ou autre à modifier
 * @returns {undefined}
 */
function listSelect($select, $target) {
    //on récupére la combox et ses options choisis
    $a = $('#' + $select + ' option:selected');
    //On écrit les valeurs récupérés dans un bloc html
    $('#' + $target).html($a.text());
}

//------------------------------AJAX---------------------------------

/**
 * Récupére les enregistrements de la table GAMME et met à jour la combobox
 * @returns {undefined}
 */
function getGamme() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllGamme'},
    function (json) {
        console.log('dedans');
        var $selectCol1 = $('#selGamme');
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="' + json[key].GA_ID + '">'
                    + json[key].GA_LBL + '</option>');
        }
    }
    );
}

/**
 * * Récupére les enregistrements de la table PAYS et met à jour la combobox
 * @returns {undefined}
 */
function getPays() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllPays'},
    function (json) {
        console.log('dedans');
        var $selectCol1 = $('#selPays');
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="' + json[key].PAYS_ID + '">'
                    + json[key].PAYS_NOM + '</option>');
        }
    }
    );
}

/**
 * * Récupére les enregistrements de la table NUTRITION et met à jour la combobox
 * @returns {undefined}
 */
function getNut() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllNut'},
    function (json) {
        console.log('dedans');
        var $divNut = $('#divNut');
        $('#divNut').empty();

        $divNut.append('<label> Table de nutrition: </label><br><br>');
        for (var key in json) {
            $divNut.append('<label for="nut' + json[key].NUT_ID + '">'
                    + json[key].NUT_LBL + '</label><br>');
            $divNut.append('<input type="text" value="nut' + json[key].NUT_ID
                    + '"></input><br>');
        }
    }
    );
}

function getFiartPays($fiartId) {
    $("#pays_abv").val('');
    var $sRes = '';

    $.ajaxSetup({async: false});
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getFiartPays', fiartId: $fiartId},
    function (json) {
        var $str = '';
        for (var key in json) {
            $str += json[key].PAYS_ABV;
        }
        $sRes = $str;
        $("#pays_abv").val($sRes.toUpperCase());

    }
    );
    $.ajaxSetup({async: true});
}


function getFiartGamme($fiartId) {

    $("#ga_abv").val('');
    var $sRes = '';

    $.ajaxSetup({async: false});
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getFiartGamme', fiartId: $fiartId},
    function (json) {
        var $str = '';
        for (var key in json) {
            $str += json[key].GA_ABV;
        }
        $sRes = $str;
        $("#ga_abv").val($sRes.toUpperCase());

    }
    );
    $.ajaxSetup({async: true});
}



function getLastRefCode() {

    var $refCode = $('#refCode').val();
    var $divSuggest = $('#divSuggest');
    var verif;
    var $divSuggest = $('#divSuggest');
    //$.ajaxSetup({async: false});
    console.log($refCode);
    $divSuggest.empty();
    $divSuggest.hide();

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getRefCode', refCode: $refCode.toString().toUpperCase()},
    function (json) {
        var $hideShow = false;
        for (var key in json) {
            if (json[key].ref_code.length === 0) {
                $hideShow = false;
                break;
            } else {
                $divSuggest.append(json[key].ref_code + '<br>');
                $hideShow = true;
            }
        }
        if ($hideShow === true) {
            $divSuggest.show();
        } else {
            $divSuggest.hide();
        }
    }
    );
    //$.ajaxSetup({async: true});

}