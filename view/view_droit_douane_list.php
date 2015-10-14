<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=dd_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Libellé
                    </th>
                    <th>
                        Taux
                    </th>                        
                </tr>
                <?php
                if ($resAllDd != 0 && is_array($resAllDd)) {
                    foreach ($resAllDd as $dd) {
                        ?>
                        <tr>
                            <td style="border-right: solid 2px black;">
                                <?php echo $dd->dd_id ?>
                            </td>
                            <td style="border-right: solid 2px black;">
                                <?php echo $dd->dd_lbl ?>
                            </td>
                            <td>
                                <?php echo $dd->dd_taux ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=dd_detail&ddId=<?php echo $dd->dd_id ?>"'/></td>

                            <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $dd->dd_id ?>, "ddId", "droit douane", "dd_del")'/></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
            if ($iTotal > $iNbPage) {
                // affichage des liens vers les pages
                Tool::affichePages($limite, $iNbPage, $iTotal, $sAction);
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}