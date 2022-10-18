<?php 

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->tableWindex;

$filter = array( "Table wth Index" => "No");
$tableWithoutIndex = $collection->find()->count();

echo "tableWithoutIndex counts ".$tableWithoutIndex;

?>