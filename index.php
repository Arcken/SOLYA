<?php
//Démarrage de la session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"></meta>

<?php
//recupere parametre du fichier param.ini
require_once 'inc/ini.inc';

//récupération du chemin du serveur web
$path = $_SERVER['DOCUMENT_ROOT'] . $sWebPath;

//Intégration de la classe gérant la connection PDO
require_once 'model/Connection.php';

//Vérification de connection
//Si on n'est pas identifié on appel la page de connection
if (!isset($_SESSION['auth'])) {

    //Si on a envoyé le formulaire on appel le traitement pour la connection 
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "connexion") {

        require_once 'security/user_control.php';

        //Sinon on appel la vue pour la connection
    } else {
        $sPageTitle = "Connexion";
        require_once 'view/view_connection.php';
    }

//Sinon on est connecté et on appel le controler
} else {

//Intégration du contrôleur principale
    require_once 'controler/control.php';
}
?>
    </footer>
</html>
