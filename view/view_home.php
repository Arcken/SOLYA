<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    <!--<link href="css/style_home.css" type="text/css" rel="stylesheet">-->
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_list.css" rel="stylesheet">

    <div class="corpsCenter">
        <div class="colOnlyOne">
            <h2> Liste des éléments </h2>

            <table class="tableList">
                <tr>
                    <th class="colTitle">
                        Lot ID
                    </th>                   
                    <th class="colTitle">
                        Référence ID
                    </th>         
                    <th class="colTitle">
                        Stock Minimum
                    </th>
                    <th class="colTitle">
                        Stock
                    </th>

                </tr>
                <?php
                if ($resStockMin != 0 && is_array($resStockMin)) {
                    for($i = 0;$i < count($resStockMin);$i++) {
                        ?>
                        <tr>
                            <td class="colData" >
                                <?php echo $resStockMin[$i]->lot_id ?>
                            </td>
                            <td class="colData" >
                                <?php echo $resStockMin[$i]->ref_id ?>
                            </td>
                            <td class="colData" >
                                <?php echo $tRef[$i]->ref_st_min ?>
                            </td>
                            <td class="colData" >
                                <?php echo $resStockMin[$i]->lot_qt_stock ?>
                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>
            </table>

        </div>
        <div class="bas">
            <input type="button" onclick='location.href = "index.php?action=ga_add"' value="Ajouter">
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}
