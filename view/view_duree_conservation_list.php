<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=dc_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Libellé
                    </th>
                    <th>
                        Nombre
                    </th>                        
                </tr>
                <?php
                if ($resAllDc != 0 && is_array($resAllDc)) {
                    foreach ($resAllDc as $dc) {
                        ?>
                        <tr>
                            <td style="border-right: solid 2px black;">
                                <?php echo $dc->dc_id ?>
                            </td>
                            <td style="border-right: solid 2px black;">
                                <?php echo $dc->dc_lbl ?>
                            </td>
                            <td>
                                <?php echo $dc->dc_nb ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=dc_detail&dcId=<?php echo $dc->dc_id ?>"'/></td>

                            <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $dc->dc_id ?>, "dcId", "durée conservation", "dc_del")'/></td>
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