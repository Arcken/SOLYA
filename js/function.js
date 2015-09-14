/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend la page à afficher en paramètre
 * @param {type} url
 * @returns {Boolean}
 */
function popup(url)
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
    newwin = window.open(url, 'windowname5', params);
    if (window.focus) {
        newwin.focus()
    }
    return false;
}

function getGamme() {

    console.log('dedans');
    $.getJSON(
            'ajax/getGamme.php', // code cible         
            function maj(json) {
                console.log('dedans');                
                
                var code ='';
                for (var key in json) {
                    code += ('<option value="' + json[key].GA_ID + '">' + json[key].GA_LBL + '</option>');
                }
                $('#selGamme').append(code);
            }
    );
}