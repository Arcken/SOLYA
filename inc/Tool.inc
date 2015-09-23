<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tool
 *
 * @author Olivier
 */
class Tool {

    //put your code here

    public static function printAnyCase($var) {

        if (is_array($var)) {
            print_r($var);
        } elseif (is_object($var)) {
            print_r($var);
        } else {
            echo $var;
        }
    }

    //affichage numero  navigation
    public static function affichePages($limite, $nombre, $total, $sAction) {

        $page = 'index.php';
        $nbpages = ceil($total / $nombre);
        $numeroPages = 1;
        $compteurPages = 1;
        $lim = 0;
        $limiteSuivante = $limite + $nombre;
        $limitePrecedente = $limite - $nombre;

        echo '<table border = "0" ><tr>' . "\n";
        if (isset($_REQUEST['orderby'])) {
            $order = $_REQUEST['orderby'];
        } else {
            $order = '';
        }
        if ($limite != 0) {
            echo '<td valign="top">' . "\n";
            echo ' <a href ="' . $page . '?action=' . $sAction . '&limite='
            . $limitePrecedente . '&orderby=' . $order . '" method="post"><</a></td>' . "\n";
        }

        while ($numeroPages <= $nbpages) {
            echo '<td ><a href =
"' . $page . '?action=' . $sAction . '&limite=' . $lim . '&orderby=' . $order . '">'
            . $numeroPages . '</a></td>' . " \n";
            $lim = $lim + $nombre;
            $numeroPages = $numeroPages + 1;
            $compteurPages = $compteurPages + 1;
            if ($compteurPages == 10) {
                $compteurPages = 1;
                echo '<br />' . "\n";
            }
        }

        if ($limiteSuivante < $total) {
            echo '<td valign="top">' . "\n";
            echo ' <a href ="' . $page . '?action=' . $sAction . '&limite='
            . $limiteSuivante . '&orderby=' . $order . '" method="post">></a></td>' . "\n";
        }

        echo '</tr></table>' . "\n";
    }

    /**
     * Renvoie le nombre d'enregistrement d'une table
     * @param String
     * Nom de la table
     * @return integer
     * Retourne un nombre
     */
    public static function getCountTable($nomTable) {
        try {
            $cnx = Connection::getConnection();
            $sql = "SELECT COUNT(*) AS nb FROM " . $nomTable;
            $result = $cnx->query($sql);
            $columns = $result->fetch();
            $nb = $columns['nb'];
            return $nb;
        } catch (MySQLException $e) {
            
        }
    }

    //Traitement upload image
    public static function uplImg($imgPath, $imgMiniPath, $imgExtension) {

//tableau extension valide
        $extensions_valides = explode(",", $imgExtension);
        $image = $_FILES['img_upload']; //Raccourci d'écriture
        for ($i = 0; $i < count($image['name']); $i++) {
//nom fichier dans variable
            $IMGNOM = $image['name'][$i];
            $IMGTMP = $image['tmp_name'][$i];

//verif nom
            if (preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $IMGNOM)) {
                die("Fichier image: Nom de fichier non valide");
            }

            if (file_exists($imgPath . $IMGNOM)) {
                die("Fichier déja existant");
            }
            /*
            if ($_FILES['img_upload']['error'] > 0)
                die("Fichier image: Erreur lors du transfert");
            */
            $extension_upload = strtolower(substr(strrchr($IMGNOM, '.'), 1));

            if (!in_array($extension_upload, $extensions_valides))
                die("Fichier image: Extension incorrecte");

//Création nom vignette
            $tNom = explode('.', $IMGNOM);
            $tNom[0] = $tNom[0] . '_lbl';
            $imgMiniNom = implode('.', $tNom);

//obtention taille img uploader
            list($width, $height) = getimagesize($IMGTMP);

            //-----------------------Vignette-----------------------------
//definition taille
            $new_height = 150;
            $new_width = ($width / $height) * $new_height;

//creation d’une image miniature en mémoire vers $image_mini_tmp
            $image_mini_tmp = imagecreatetruecolor($new_width, $new_height);
//copie de l\'image à duppliquer en mémoire vers $image_tmp
            $image_tmp = imagecreatefromjpeg($IMGTMP);
// copie du contenu de $image_tmp, vers $image_mini_tmp en appliquant les nouvelles dimensions
            imagecopyresampled($image_mini_tmp, $image_tmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//enregistrement de la miniature de crée vers fichier ;
            imagejpeg($image_mini_tmp, $imgMiniPath . $imgMiniNom);

            //-----------------------Grande-----------------------------
//definition taille
            $new_height = 400;
            $new_width = ($width / $height) * $new_height;

//creation d’une image miniature en mémoire vers $image_grande_tmp
            $image_grande_tmp = imagecreatetruecolor($new_width, $new_height);
//copie de l\'image à duppliquer en mémoire vers $image_tmp
            $image_tmp = imagecreatefromjpeg($IMGTMP);
// copie du contenu de $image_tmp, vers $image_grande_tmp en appliquant les nouvelles dimensions
            imagecopyresampled($image_grande_tmp, $image_tmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//enregistrement de la grande image de crée vers fichier ;
            imagejpeg($image_grande_tmp, $imgPath . $IMGNOM);
        }
    }

}
