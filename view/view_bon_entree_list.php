<?php
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">


    <div class="corps">
        <div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=be_add"' value="Ajouter">
            <table>
                <tr>
                    <th onclick="orderby('<?php echo $sAction?>',
                                'be_id','ASC');"
                                class="colTitle">
                        AS
                    </th>
                    <th onclick="orderby('<?php echo $sAction?>','be_id','DESC');">
                        ds
                    </th>
                    <th>
                        AS
                    </th>
                    <th>
                        ds
                    </th>
                    <th>
                        AS
                    </th>
                    <th>
                        ds
                    </th>
                    <th>
                        
                    </th>
                    <th>
                        AS
                    </th>
                    <th>
                        ds
                    </th>
                    <th>
                        AS
                    </th>
                    <th>
                        ds
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Id
                    </th>
                    <th onclick="orderby('<?php echo $sAction?>','be_lbl');" colspan="2">
                        Libellé
                    </th>
                    <th onclick="orderby('<?php echo $sAction?>','be_fact_num');" colspan="2">
                        Facture
                    </th>
                    <th>
                        Commentaire
                    </th>
                    <th onclick="orderby('<?php echo $sAction?>','be_total');" colspan="2">
                        Total
                    </th>
                    <th onclick="orderby('<?php echo $sAction?>','be_date');" colspan="2">
                        Date
                    </th>
                </tr>
                <?php
                if ($resBeList != 0 && is_array($resBeList)) {
                    foreach ($resBeList as $be) {
                        ?>
                        <tr>
                            <td style="border-right: solid 2px black;" colspan="2">
                                <?php echo $be->be_id ?>
                            </td>
                            <td colspan="2">
                                <?php echo $be->be_lbl ?>
                            </td>
                            <td colspan="2">
                                <?php echo $be->be_fact_num ?>
                            </td>
                            <td>
                                <?php echo $be->be_com ?>
                            </td>
                            <td colspan="2">
                                <?php echo $be->be_total ?>
                            </td>
                            <td colspan="2">
                                <?php echo $be->be_date ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=be_detail&beId=<?php echo $be->be_id ?>"'/></td>

                            <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $be->be_id ?>, "beId", "Bon entrée", "be_del")'/></td>

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
} else {
    echo 'Le silence est d\'or';
}
?>