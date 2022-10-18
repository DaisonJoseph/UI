<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->MissingComponents;

$missing_count = $collection->find(array("Result"=>"Missing Component"))->count();
echo "Missing Components Count ".$missing_count."<br><br>";

//total no. of component types
$types = $collection->distinct("Type");
$type_arr = array();
foreach($types as $type){
	$count = $collection->find(array("Type"=>$type,"Result"=>"Missing Component"))->count();
	$type_arr[$type]=$count;
}
foreach($type_arr as $key=>$value){
	echo "Component Type is ".$key;
	echo "and its count is ".$value."<br>";
}
?>