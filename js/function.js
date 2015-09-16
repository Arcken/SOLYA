/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend la page à afficher en paramètre
 * @param {type} string action a effectuer pour le contrôleur
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

    if (window.focus) {
        newwin.focus()
    }
    return false;
}

function getGamme() {

    console.log('dedans');
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllGamme'},
    function maj(json) {
        console.log('dedans');
        var $selectCol1 = $('#selGamme');       
        $selectCol1.empty();
        $selectCol1.append('<option value="0">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="'+json[key].GA_ID +'">'+json[key].GA_LBL+'</option>');            
        }
       
    }
    );
}

function getPays() {

    console.log('dedans');
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllPays'},
    function maj(json) {
        console.log('dedans');
        var $selectCol1 = $('#selPays');       
        $selectCol1.empty();
        $selectCol1.append('<option value="0">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="'+json[key].PAYS_ID +'">'+json[key].PAYS_NOM+'</option>');            
        }
       
    }
    );
}