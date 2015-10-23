
/**
 * Fonction de remplissage des comboboxs pays générer dynamiquement
 * dans les formulaires 
 * Elle récupère les données et les ajoutent dans la combobox
 * Il suffit de cibler la combo avec son id(sans NID)
 * @param {String} $id 
 * @returns {undefined}
 */ 

function fillPays($id, $nRowCount){
    //On construit l'identifiant de la combobox
    $idCombo = $id + $nRowCount;
    //On pointe vers la combobox
    $myCombo = $('#'+ $idCombo);
    //requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getAllPays'},
            //Callback
            function (json) {

                console.log("json" + json);

                for (var key in json) {
     
                    console.log('pays_id ' + json[key].pays_id);
                    //Pour chaque valeur récupéré grace à l'ajax on ajoute dans la select box
                    $myCombo.append('<option value ="'+json[key].pays_id+'">'
                                    +json[key].pays_nom
                                    +'</option>');
                }
            }
            );

        }

