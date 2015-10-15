<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
<div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=nut_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Nom
                    </th>                    
                </tr>
            <?php
            if ($resAllNut != 0 && is_array($resAllNut)) {
                foreach ($resAllNut as $nut) { ?>
                    <tr>
                    <td style="border-right: solid 2px black;">
                        <?php echo $nut->nut_id?>
                    </td>
                    <td>
                        <?php echo $nut->nut_lbl ?>
                    </td>
                    <td><img src="img/icon/modify.png" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=nut_detail&nutId=<?php echo $nut->nut_id ?>"'/></td>

                    <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                             onclick='delElt(<?php echo $nut->nut_id ?>, "nutId", "nutrition", "nut_del")'/></td>

                </tr>
                    
                    <?php
                }
            }
            ?>
            </table>
            <?php
        if ($iTotal > $iNbPage) {
            // affichage des liens vers les pages
            Tool::affichePages($rowStart, $iNbPage, $iTotal, $sAction);
        }
        ?>
        </div>
</div>

<?php
    } else
    echo 'Le silence est d\'or'

    
?>