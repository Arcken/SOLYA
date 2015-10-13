<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0) {?>
<div>
    <form>
        <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
        <div>
            <label for="ddLbl"> Libellé: </label>
            <input name="ddLbl" placeholder="Description" type="text">         
            <br>
            <label for="ddTaux"> Taux: </label>
            <input name="ddTaux" placeholder="###,##" type="text">         
            <br>
            <input type="submit">
            <input name="clear" type="reset">
        </div>
    </form>
    <div
        <p> Liste des éléments </p>
        <!-- affichage de la liste des éléments de "DROIT_DOUANE" 
        avec foreach label pour chaque et bouton modifier
        -->
    </div>
</div>
<?php
}
else echo 'Le silence est d\'or'
?>