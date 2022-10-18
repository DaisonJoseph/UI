<?php 
$m = new MongoClient();
$db = $m->aflac;
$remove_component_collection = $db->neglectComponents;
$delcomp = "Y2kCOBOL";
$remove_component_collection->remove(array("remove_name" => $delcomp));?>