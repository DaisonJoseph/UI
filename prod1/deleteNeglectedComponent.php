<?php 
$m = new MongoClient();
$db = $m->aflac;
$remove_component_collection = $db->neglectComponents;
// $delcomp = "Y2kCOBOL";
$delcomp = (filter_input(INPUT_GET, "compname"));
// $delcomp = "ZXV";
$status = FALSE;
$remove_component_collection->remove(array("remove_name" => $delcomp));
// $remove_component_collection -> insert(array('dummy'=>$delcomp));
$status = TRUE;
echo json_encode(array("Status" => $status));
?>