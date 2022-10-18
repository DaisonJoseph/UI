<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->VSAM;

$vsam = $collection->find()->count();

echo "VSAM counts ".$vsam;

?>