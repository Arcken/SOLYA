<?php ?>

<!-- Intégration de Jquery et des fontions js-->
<script type="text/javascript" src="lib/jquery.js"></script>
<script src="js/function.js" type="text/javascript"></script>

</body>

<footer>
    <link href="css/style_footer.css" type="text/css" rel="stylesheet">
    <div id="bloc_footer">
        <?php
     foreach ($_SESSION['msg'] as $msg ){
        echo $msg;
    }?>
     <p><?php if (isset($resEr)) echo '!'.$resEr.'!';?></p>
    </div>
</footer>


