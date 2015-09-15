<?php
if ($nv == 0) {    
    ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <?php
    } else {
    require $path.'/view/view_new_view_header.php';
    }
    ?>
    
    <div class="corps">
        <form class="form" id="fGa" action="index.php">
            <h2>Saisir</h2>
                <?php echo $nv; ?>
            <div> 
                <label for="gaLbl"> Libellé de la gamme: </label>
                <input name="gaLbl" placeholder="Saisie" required type="text">            
                <br>                
                 
            </div>
            <div class="bas">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" >
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset">
            </div>
        </form>
        <div>
            <h2> Liste des éléments </h2>
            <!-- affichage de la liste des éléments de "GAMMME" 
            avec foreach label pour chaque et bouton modifier
            -->
            <p> Essai1 <img src="../img/icon/process.png" alt="" onclick="" title="Modifier"/> </p>
        </div>
    </div>
    <?php if ($nv == 1)     require '../view/view_new_view_footer.php';?>