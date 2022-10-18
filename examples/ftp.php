<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->ftp;

$ftp = $collection->find()->count();

echo "FTP counts ".$ftp;

?>