<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">       
        <table>
            <tr>
                <th onclick="orderby('<?php echo $sAction?>','fiart_id');">Identifiant                 
                </th>
                <th onclick="orderby('<?php echo $sAction?>','fiart_lbl')">Libellé         
                </th>
                <th onclick="orderby('fiart_id')">Essai           
                </th>
                <th>                   
                </th>
                <th>                   
                </th>
                <th>                   
                </th>
            </tr>
            <?php
            $fiartControl = '';
            $fiartGamme = '';
            
            foreach ($resFiartList as $value) {
                ?>
            
                <tr>
                    <td><?php echo $value->fiart_id ?></td>
                    <td><?php echo $value->fiart_lbl ?></td>               
                    <td><?php echo $value->fiart_alg ?></td>
                    <td><?php echo $value->fiart_ing ?></td>

                    <td><img src="img/icon/modify.png" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=fiart_detail&fiartId=<?php echo $value->fiart_id ?>"'/></td>

                    <td><img src="img/icon/delete.png" alt="" title="Modifier"
                             onclick='delElt(<?php echo $value->fiart_id ?>, "fiartId", "Fiche article", "fiart_supp")'/></td>

                </tr>
                <?php
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

    <?php
} else
    echo 'Le silence est d\'or'
    
?>