<?php
$sPageTitle="Liste des références";
require $path.'/model/Reference.php';
require $path.'/model/ReferenceManager.php';

$toRef = ReferenceManager::getAllReferences();
