<?php

$sAction = $_REQUEST['action'];
//Comme la fenétre est une popup on passe la variable de contrôle d'affichage
// à 1
$nv = 1;
$msg='';
/* ----------------------------Traitement--------------------------------- */

switch ($sAction) {

    //Droit de douane
    case "nv_dd_add":
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_dd_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //Durée de conservation
    case "nv_dc_add":
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_dc_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //gammme
    case "nv_ga_add":
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_ga_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //Mode de conservation
    case 'nv_mc_add':
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_mc_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //nutrition
    case 'nv_nut_add':
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_nut_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //pays
    case 'nv_pays_add':
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_pays_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;

        
    //TVA
    case "nv_tva_add":
        
        //On appel le controleur de l'ajout
        require $path . '/controler/control_tva_add.php';
        
        //Si le controleur fait un insert $mes est définie, $lignemessage apparait
        //dans la popup
        if (isset($msg)){
            $ligneMessage = $msg;
        }
        break;
        
    case 'nv_bon_pdf':
        //On appel le controleur qui créé le pdf
        require $path . '/controler/control_bon_pdf.php';
}

/* ----------------------------Affichage--------------------------------- */
switch ($sAction) {

    //Droit de douane
    case "nv_dd_add":
        require $path . '/view/view_droit_douane_add.php';
        break;

    //Durée de conservation
    case "nv_dc_add":
        require $path . '/view/view_duree_conservation_add.php';
        break;

    //gamme
    case "nv_ga_add":
        require $path . '/view/view_gamme_add.php';
        break;

    //Mode conservation
    case "nv_mc_add":
        require $path . '/view/view_mode_conservation_add.php';
        break;

    //nutrition
    case "nv_nut_add":
        require $path . '/view/view_nutrition_add.php';
        break;

    //pays
    case "nv_pays_add":
        require $path . '/view/view_pays_add.php';
        break;

    //tva
    case "nv_tva_add":
        require $path . '/view/view_tva_add.php';
        break;
}