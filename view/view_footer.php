<?php ?>

<!-- Intégration de Jquery et des fontions js-->
<script type="text/javascript" src="lib/jquery.js"></script>
<script src="js/function.js" type="text/javascript"></script>

</body>

<footer>
    <link href="css/style_footer.css" type="text/css" rel="stylesheet">
    <p><?php if (isset($resMessage)) echo $resMessage;?></p>
     <p><?php if (isset($resEr)) echo '!'.$resEr.'!';?></p>
    <div id="bloc_footer">
    </div>
</footer>


