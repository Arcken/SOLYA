/**
 * Fonction de multiplication
 * @param $source
 * Tableaus des id des inputs sources
 * @param $cible
 * nom de l'input
 * @returns {undefined}
 */
function ccMultiplier($source, $cible) {
    //console.log("DEBUT MULTIPLICATION");

    //on initilise le résultat à 1, mulitplication oblige
    var $res = 1;
    //On parcours le tableau et à chaque case on multiplie res
    //à la case du tableau
    for (var $i in $source) {
        $a = parseFloat($("input[id='" + $source[$i] + "']").val());
        $res *= $a;
        //console.log($source[$i] + ": " + $a);
    }

    //on effectue le calcul puis on met l'input cible à jour    
    $res = $("input[id='" + $cible + "']").val(parseFloat($res));

    //console.log("Multiplication: " + $res.val());

    //console.log("FIN MULTIPLICATION");
}


/**
 * Fonction d'addition
 * @param $source
 * Tableaus des id des inputs sources
 * @param $cible
 * id de l'input résultat
 * @returns {undefined}
 */
function ccAddition($source, $cible) {
    //console.log("DEBUT ADDITION");

    //on initilise le résultat à 0, addition oblige
    var $res = 0;
    
    //On parcours le tableau et à chaque case on additionne res
    //à la case du tableau
    for (var $i in $source) {
        $a = parseFloat($("input[id='" + $source[$i] + "']").val());
        //console.log($source[$i] + " :" + $a)
        $res += $a;
    }

    //on met l'input cible à jour    
    $res = $("input[id='" + $cible + "']").val(parseFloat($res));

    //console.log("Addition: " + $res.val());
    //console.log("FIN ADDITION");
}
