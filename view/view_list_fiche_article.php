<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <table>
        <?php foreach ($resAllFiartFull as $value) { ?>
            <tr><td><?php echo $value->FIART_LBL ?></td>
                <td><?php echo $value->FIART_ING ?></td>
                <td><?php echo $value->FIART_ALG ?></td>
                <td><?php echo $value->PAYS_NOM ?></td>
                <td><img src="img/icon/modify.png" alt=""/></td>
            </tr>
                        <?php } ?>
            </table>
    </div>
    
    
    <?php
} else
    echo 'Le silence est d\'or'
    
?>