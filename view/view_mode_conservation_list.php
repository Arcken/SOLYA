<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=mc_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Libellé
                    </th>                        
                </tr>
                <?php
                if ($resAllMc != 0 && is_array($resAllMc)) {
                    foreach ($resAllMc as $modeConservation) {
                        ?>
                        <tr>
                            <td style="border-right: solid 2px black;">
                                <?php echo $modeConservation->cons_id ?>
                            </td>
                            <td>
                                <?php echo $modeConservation->cons_lbl ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = 
                                        "index.php?action=mc_detail&consId=<?php echo $modeConservation->cons_id ?>"'/></td>

                            <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $modeConservation->cons_id ?>, "consId", "Mode conservation", "mc_del")'/></td>
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