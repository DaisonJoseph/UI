<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->clonedquery;

$clonedquery = $collection->find()->count();

echo "Cloned Query counts ".$clonedquery;

?>