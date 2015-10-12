<?php

require_once $path . '/model/Lot.php';
require_once $path . '/model/LotManager.php';
require_once $path . '/model/ReferenceManager.php';

//On récupère tous les lots en stock
$resStock = LotManager::getLotStock();
