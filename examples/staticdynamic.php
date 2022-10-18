<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->staticDynamic;

// Static calls
$filter = array( "Type" => "Static Call" );
$static = $collection->find($filter)->count();

// Dynamic calls
$filter = array( "Type" => "Dynamic Call" ); 
$dynamic = $collection->find($filter)->count(); 

echo "static ".$static." dynamic ".$dynamic;

?>