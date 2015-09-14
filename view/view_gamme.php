<?php
if (isset($_REQUEST['action'])) {
    $bNewView = false;
    ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <?php
    } else {
    require '../view/view_new_view_header.php';
    $bNewView = true;
    }
    
    ?>
    <div class="corps">
        <form class="form" id="fGa" action="../index.php">
            <h2>Saisir</h2>
                
            <div> 
                <label for="gaLbl"> Libellé de la gamme: </label>
                <input name="gaLbl" placeholder="Saisie" required type="text">            
                <br>                
                 
            </div>
            <div class="bas">
                <input type="text" value="ga_add_add" name="action">
                <input type="submit">
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
    <?php if ($bNewView)     require '../view/view_new_view_footer.php';?>