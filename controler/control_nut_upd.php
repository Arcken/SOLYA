<?php

//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    require_once $path . '/model/Nutrition.php';
    require_once $path . '/model/NutritionManager.php';

    //Si le formulaire est envoyé
    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == 'Modifier') {
        
        //Si la modification ne se fait pas le manager léve un exception
        try {
            //Vérification du jeton pour savoir si le formulaire à déja était envoyé
            if ($_SESSION['token'] != $_REQUEST['token']) {

                //Les valeurs sont vérifiées à la saisie
                //On créé un objet contenant les valeurs que l'on passe en paramètre 
                //à la requête
                $oNutrition = new Nutrition();
                $oNutrition->nut_id = $_REQUEST['nutId'];
                $oNutrition->nut_lbl = $_REQUEST['nutLbl'];
                
                $resUpdNutrition = NutritionManager::updNutrition($oNutrition);

                //Message pour le succés
                $msg = '<p class=\'info\'>' . date('H:i:s')
                        . ' La modification de la nutrition: "'
                        . $oNutrition->nut_id
                        . '" intitulé "' . $oNutrition->nut_lbl . '" à été effectué '
                        . 'avec succès </p>';

                //La requète s'est effectué donc on copie le token dans la session
                $_SESSION['token'] = $_REQUEST['token'];
            } else {

                $msg = "<p class= 'erreur'> " . date('H:i:s') . "
                Vous avez déja envoyé ce formulaire </p>";
            }

            //Rappel du controleur de la liste, après update on appel view_ga_list
            //et redéfinition de $sAction

            $sAction = "nut_list";
            require_once $path . '/controler/control_nut_list.php';
            
        } catch (MySQLException $e) {
            //Message pour l'erreur
            $msg = '<p class=\'erreur\'> ' . date('H:i:s') . ''
                    . ' Echec modification Nutrition, code: '
                    . $resEr . '</p>';
        }

        //On insert le message dans le tableau de message
        Tool::addMsg($msg);

        //Sinon on est dans l'affichage du détail
    } else {
        //On définit le titre
        $sPageTitle = "Détail de la nutrition";
        //On contrôle si l'id est définie est on on récupére le détail 
        //de l'enregistrement et on défnit la valeur du button du formulaire
        if (isset($_REQUEST['nutId']) && $_REQUEST['nutId'] != '') {
            $resNutDetail = NutritionManager::getNutritionDetailForUpd($_REQUEST['nutId']);
            $sButton = 'Modifier';
        }
    }
} else {
    echo 'Le silence est d\'or';
}                        