<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <table>
        <?php $fiartControl='';
        $fiartGamme = '';
        foreach ($resFiartList as $value) { 
             if ($fiartControl != $value->fiart_id) {
            ?>
            <tr>
                <td><?php echo $value->fiart_id ?></td>
                <td><?php echo $value->fiart_lbl ?></td>               
                <td><?php echo $value->fiart_alg ?></td>
                <td><?php echo $value->fiart_ing ?></td>
                <td><?php echo $value->fiart_ing ?></td>
                
                <td><img src="img/icon/modify.png" alt="" 
                         onclick='location.href = "index.php?action=fiart_detail\n\
&fiartId=<?php echo $value->fiart_id?>"'/></td>
            </tr>
                        <?php
             }
                        $fiartControl = $value->fiart_id;
                        
        } ?>
            </table>
    </div>
    
    
    <?php
} else
    echo 'Le silence est d\'or'
    
?>