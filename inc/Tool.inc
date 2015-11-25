<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Boite à outils
 *
 */
class Tool {

    /**
     * Fonction qui affiche la variable quelque soit son type
     * @param $var
     * tableau, objet ou variable simple
     */
    public static function printAnyCase($var) {

        if (is_array($var)) {
            print_r($var);
        } elseif (is_object($var)) {
            print_r($var);
        } else {
            echo $var;
        }
    }

    /**
     * Fonction qui créer l'affichage des puces de navigation pour l'affichage
     * par page
     * @param type $rowStart
     * chiffre de départ du select
     * @param type $nbRow
     * nombre de ligne retourné du select
     * @param type $total
     * Nombre total d'enregistrement de la table
     * @param type $sAction
     * Action pour le controleur
     */
    public static function affichePages($rowStart, $nbRow, $total, $sAction) {

        $page = 'index.php';
        //On calcul le nombre de page
        $nbpages = ceil($total / $nbRow);
        //on initialise 
        $numeroPages = 1;
        $compteurPages = 1;
        $lim = 0;
        //On détermine les valeurs des extrémités
        $rowStartSuivante = $rowStart + $nbRow;
        $rowStartPrecedente = $rowStart - $nbRow;


        //On commence le tableau
        echo '<table class="puceNav" border = "0" ><tr>' . "\n";
        // on détermine le orderby et le tri
        if (isset($_REQUEST['orderby'])) {
            $order = $_REQUEST['orderby'];
        } else {
            $order = '';
        }
        if (isset($_REQUEST['tri'])) {
            $sort = $_REQUEST['tri'];
        } else {
            $sort = '';
        }

        //cas pour le précédent
        if ($rowStart != 0) {
            echo '<td valign="top">' . "\n";
            echo ' <a href ="' . $page . '?action=' . $sAction . '&limite='
            . $rowStartPrecedente . '&orderby=' . $order . '&tri=' . $sort . '" method="post"><<</a></td>' . "\n";
        } else {
            echo '<td class="puceNavDesactive" valign="top">' . "\n";
            echo ' <a href =""><<</a></td>' . "\n";
        }

        //Tant que la page en cours est inférieur au nombre de page
        while ($numeroPages <= $nbpages) {

            //Page en cours
            if ($numeroPages == ($rowStart / $nbRow + 1)) {
                echo '<td class="puceNavActive"><a href ="' . $page
                . '?action=' . $sAction
                . '&limite=' . $lim
                . '&orderby='
                . $order
                . '&tri=' . $sort . '">'
                . $numeroPages . '</a></td>' . " \n";
            } else {

                //autre page
                echo '<td ><a href ="' . $page
                . '?action=' . $sAction
                . '&limite=' . $lim
                . '&orderby='
                . $order
                . '&tri=' . $sort . '">'
                . $numeroPages . '</a></td>' . " \n";
            }
            //on clacul la limite suivante
            $lim = $lim + $nbRow;
            //on incrémente la puce
            $numeroPages++;
            //on incrémente le compteur de page
            $compteurPages++;
            //on incrémente le compteur pour le saut à la ligne
            if ($compteurPages == 10) {
                $compteurPages = 1;
                echo '<tr />' . "\n";
            }
        }

        //cas pour le suivant
        if ($rowStartSuivante < $total) {
            echo '<td valign="top">' . "\n";
            echo ' <a href ="' . $page . '?action=' . $sAction . '&limite='
            . $rowStartSuivante . '&orderby=' . $order . '&tri=' . $sort . '" method="post">>></a></td>' . "\n";
        } else {
            echo '<td class="puceNavDesactive" valign="top">' . "\n";
            echo ' <a href ="">>></a></td>' . "\n";
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

    /**
     * Fonction qui traite les photos uploader en mémoire
     * @param $imgPath
     * dossier cible de l'image normale
     * @param $imgMiniPath
     * dossier cible de la miniature
     * @param $imgExtension
     * tableau extension autorisé
     * @return string
     */
    public static function uplImg($imgPath, $imgMiniPath, $imgExtension, $imgMaxSize) {


        //on récupére les extensions valide
        $extensions_valides = explode(",", $imgExtension);

        //Raccourci d'écriture
        $image = $_FILES['img_upload'];

        //Pour toutes les images uploadé
        for ($i = 0; $i < count($image['name']); $i++) {
            $erreur = "aucune";

            //On récupére le nom de l'image
            $IMGNOM = $image['name'][$i];
            //On récupére l'image
            $IMGTMP = $image['tmp_name'][$i];

            //on véfifie sa taille
            if ($image['size'][$i] > $imgMaxSize) {
                $erreur = $IMGNOM . ": Fichier trop grand";
            }

            //on vérifie si l'upload c'est bien passé
            if ($image['error'][$i] > 0) {
                $erreur = $IMGNOM . ": Erreur lors du transfert";
            }

            //On récupére l'extension du fichier
            $extension_upload = strtolower(substr(strrchr($IMGNOM, '.'), 1));

            //On vérifie qu'elle est autorisée
            if (!in_array($extension_upload, $extensions_valides)) {
                $erreur = $IMGNOM . ": Extension incorrecte $extension_upload";
            }
            if ($erreur == "aucune") {
                //Tableau de contrôle de création de fichier, on la passe à faux si une erreur survient
                $bCopy[];
                
                //Création du nom de l'image
                $tNom = explode('.', $IMGNOM);
                $tNom[0] = md5(uniqid(rand(), true));
                if (strtolower($extension_upload) == "png") {
                    $tNom[1] = "png";
                } else {
                    $tNom[1] = 'jpg';
                }
                $imgNom = implode('.', $tNom);

                //Nom de la vingnette
                $tNom[0] = $tNom[0] . '_lbl';
                $imgMiniNom = implode('.', $tNom);

                //obtention taille img uploader
                list($width, $height) = getimagesize($IMGTMP);

                //-----------------------traitement image --------------------------
                //definition taille
                $new_height = 400;
                $new_width = ($width / $height) * $new_height;
                $new_label_height = 100;
                $new_label_width = ($width / $height) * $new_label_height;

                //creation d’une image vide en mémoire
                $image_grande_tmp = imagecreatetruecolor($new_width, $new_height);
                $image_mini_tmp = imagecreatetruecolor($new_label_width, $new_label_height);

                //copie de l'image à duppliquer en mémoire vers $image_tmp
                if ($tNom[1] == "png") {
                    $image_tmp = imagecreatefrompng($IMGTMP);
                    // copie du contenu de $image_tmp, vers $image_grande_tmp 
                    // en appliquant les nouvelles dimensions
                    imagecopyresampled($image_grande_tmp, $image_tmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagecopyresampled($image_mini_tmp, $image_tmp, 0, 0, 0, 0, $new_label_width, $new_label_height, $width, $height);
                    //Création du fichier image
                    $bCopy[] = imagepng($image_grande_tmp, $imgPath . $imgNom);                    
                    $bCopy[] = imagepng($image_mini_tmp, $imgMiniPath . $imgMiniNom);
                } else {
                    $image_tmp = imagecreatefromjpeg($IMGTMP);
                    // copie du contenu de $image_tmp, vers $image_grande_tmp 
                    // en appliquant les nouvelles dimensions
                    imagecopyresampled($image_grande_tmp, $image_tmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagecopyresampled($image_mini_tmp, $image_tmp, 0, 0, 0, 0, $new_label_width, $new_label_height, $width, $height);
                    //création du fichier image
                    $bCopy[] = imagejpeg($image_grande_tmp, $imgPath . $imgNom);
                    $bCopy[] = imagejpeg($image_mini_tmp, $imgMiniPath . $imgMiniNom);
                }                
                
                if (in_array("FALSE", $bCopy)) {

                    $res[] = $imgNom;
                } else {
                    Tool::addMsg("Erreur d'écriture de l'image");
                }
            } else {
                Tool::addMsg($erreur);
            }
            return $res;
        }
    }

    /**
     * Fonction qui ajoute le message au tableau
     * on ne conserve que les 5 derniers 
     * @param $msg
     */
    public static function addMsg($msg) {
        $_SESSION['msg'][4] = $_SESSION['msg'][3];
        $_SESSION['msg'][3] = $_SESSION['msg'][2];
        $_SESSION['msg'][2] = $_SESSION['msg'][1];
        $_SESSION['msg'][1] = $_SESSION['msg'][0];
        $_SESSION['msg'][0] = $msg;
    }

}
