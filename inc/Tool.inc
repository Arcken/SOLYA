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
        if (isset($_REQUEST['orderby'])){
        $order = $_REQUEST['orderby'];
        }
        else {
            $order='';
        }
        if ($limite != 0) {
            echo '<td valign="top">' . "\n";
            echo ' <a href ="' . $page . '?action=' . $sAction . '&limite='
            . $limitePrecedente . '&orderby='.$order.'" method="post"><</a></td>' . "\n";
        }

        while ($numeroPages <= $nbpages) {
            echo '<td ><a href =
"' . $page . '?action=' . $sAction . '&limite=' . $lim . '&orderby='.$order.'">'
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
            . $limiteSuivante . '&orderby='.$order.'" method="post">></a></td>' . "\n";
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
            $cnx=  Connection::getConnection();
            $sql = "SELECT COUNT(*) AS nb FROM " . $nomTable;
            $result = $cnx->query($sql);
            $columns = $result->fetch();
            $nb = $columns['nb'];
            return $nb;
        } catch (MySQLException $e) {
            
        }
    }

}
