<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
<div class="list">
            <h2> Liste des éléments </h2>
            <input type="button" onclick='location.href = "index.php?action=pays_add"' value="Ajouter">
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Nom
                    </th>
                    <th>
                        Abréviation pays
                    </th>
                    <th>
                        Devise
                    </th>
                    <th>
                        Abréviation devise
                    </th>
                    <th>
                        Symbole devise
                    </th>
                </tr>
            <?php
            if ($resAllPays != 0 && is_array($resAllPays)) {
                foreach ($resAllPays as $pays) { ?>
                    <tr>
                    <td style="border-right: solid 2px black;">
                        <?php echo $pays->pays_id?>
                    </td>
                    <td>
                        <?php echo $pays->pays_nom ?>
                    </td>
                    <td>
                        <?php echo $pays->pays_abv ?>
                    </td>
                    <td>
                        <?php echo $pays->pays_dvs_nom ?>                        
                    </td>
                    <td>
                        <?php echo $pays->pays_dvs_abv ?>
                    </td>
                    <td>
                        <?php echo $pays->pays_dvs_sym ?>
                    </td>
                    <td><img src="img/icon/modify.png" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=pays_detail&paysId=<?php echo $pays->pays_id ?>"'/></td>

                    <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                             onclick='delElt(<?php echo $pays->pays_id ?>, "paysId", "pays", "pays_del")'/></td>

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