<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
<div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=ga_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        Libellé de la gamme
                    </th>
                    <th>
                        Abréviation de la gamme
                    </th>                        
                </tr>
            <?php
            if ($resAllGa != 0 && is_array($resAllGa)) {
                foreach ($resAllGa as $gamme) { ?>
                    <tr>
                    <td style="border-right: solid 2px black;">
                        <?php echo $gamme->ga_lbl?>
                    </td>
                    <td>
                        <?php echo $gamme->ga_abv ?>
                    </td>
                    <td><img src="img/icon/modify.png" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=ga_detail&gaId=<?php echo $gamme->ga_id ?>"'/></td>

                    <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                             onclick='delElt(<?php echo $gamme->ga_id ?>, "gaId", "gamme", "ga_supp")'/></td>

                </tr>
                    
                    <?php
                }
            }
            ?>
            </table>
        </div>
</div>

<?php
    } else
    echo 'Le silence est d\'or'

    
?>