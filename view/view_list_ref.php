<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        
    </div>
    
<?php
} else {
    echo 'Le silence est d\'or';
}
?>