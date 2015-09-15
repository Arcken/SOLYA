<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ ?>
<div>
    <form>
        <div> 
            <label for="nutLbl"> Libellé: </label>
            <input name="nutLbl" placeholder="Saisie" required type="text">
            <br>
            <input type="submit">
            <input name="clear" type="reset"> 
        </div>
    </form>
    <div>
        <p> Liste des éléments </p>
        <!-- affichage de la liste des éléments de "GAMMME" 
        avec foreach label pour chaque et bouton modifier
        -->
        <p> nutrition1 <img src="../img/icon/process.png" alt="" onclick="" title="Modifier"/> </p>
    </div>
</div>

<?php
}
else echo 'Le silence est d\'or'
?>