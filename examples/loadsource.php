<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->loadSource;

// Source Available,Load NA
$filter = array( "Source Available,Load NA" => "Load Not Available" );
$loadNA = $collection->find($filter)->count();

// Load Available, Source NA
$filter = array( "Load Available, Source NA" => "Soruce Not Available" ); // there is a type here. Need to be fixed in DB
$sourceNA = $collection->find($filter)->count(); 

echo "Load NA ".$loadNA." Source NA ".$sourceNA;

?>