<?php ?>

<!-- Intégration de Jquery et des fontions js-->
<script type="text/javascript" src="lib/jquery.js"></script>
<script src="js/js_function.js" type="text/javascript"></script>

</body>

<footer>
    <link href="css/style_footer.css" type="text/css" rel="stylesheet">
    <div id="bloc_footer">
        <p class="erreur"><?php //if (isset($resEr)) echo $resEr[1];?></p>
        <?php 
        foreach ($_SESSION['msg'] as $msg){
            echo $msg;
        } ?>
     
    </div>
</footer>


