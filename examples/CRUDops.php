<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->CRUD_Ops;

// read
$filter = array( "Operation" => "Read" );
$read = $collection->find($filter)->count();

// insert
$filter = array( "Operation" => "Insert" );
$insert = $collection->find($filter)->count(); 

// delete
$filter = array( "Operation" => "Delete" );
$delete = $collection->find($filter)->count();

// Update
$filter = array( "Operation" => "Update" );
$update = $collection->find($filter)->count();

echo "Read ".$read." Insert ".$insert." delete ".$delete." update ".$update;

?>