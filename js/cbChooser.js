/**
 * Fonction de choix pour les checksbox du formulaire contact  
 * @returns {undefined}
 */ 

function cbChooser() {

    var cbCli   = $('.CB_CLI');
    var cbFour  = $('.CB_FOUR');
    var cbPrspt = $('.CB_PRSPT');

    cbPrspt.click(function () {
        cbCli.attr("checked", false);
        cbFour.attr("checked", false);
        }
    );

    cbCli.click(function () {
        cbPrspt.attr("checked", false);
        }
    );

    cbFour.click(function () {
        cbPrspt.attr("checked", false);
        }
    );
}

