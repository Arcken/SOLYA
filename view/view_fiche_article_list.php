<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">        
        <table style="border: solid black 1px">
            <tr>
                <th> Photo                  
                </th>
                <th onclick="orderby('<?php echo $sAction?>','fiart_id');">Identifiant                 
                </th>
                <th onclick="orderby('<?php echo $sAction?>','fiart_lbl')">Libellé         
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
                    <td style="border: solid black 1px;width: 125px;" ><img src="<?php echo $imgMiniPath.$value->fiart_photos_pref.'_lbl.jpg' ?>" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=fiart_detail&fiartId=<?php echo $value->fiart_id ?>"'/></center></td>
                    <td><?php echo $value->fiart_id ?></td>
                    <td><?php echo $value->fiart_lbl ?></td>               
                    
                    <td><img src="img/icon/modify.png" alt="" title="Modifier"
                             onclick='location.href = "index.php?action=fiart_detail&fiartId=<?php echo $value->fiart_id ?>"'/></td>

                    <td><img src="img/icon/delete.png" alt="" title="Modifier"
                             onclick='delElt(<?php echo $value->fiart_id ?>, "fiartId", "Fiche article", "fiart_del")'/></td>

                </tr>
                <?php
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

    <?php
} else
    echo 'Le silence est d\'or'
    
?>