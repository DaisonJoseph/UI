<?php
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->user;
echo "Connected to DB"."<br>";


// $insert = array("Connection"=>"True","Insert"=>"True","Update"=>"False");
// $collection->insert($insert);
// echo "Inserted to DB";

$results = $collection->find();
echo "DB Records---"."<br>";
foreach ($results as $result)
{
	print_r($result);
}

// $collection->update(array("Connection"=>"True"), 
      // array('$set'=>array("Update"=>"True")));
	  
// $updated = $collection->find();
// echo "<br>"."Updated DB Records---"."<br>";
// foreach ($updated as $update)
// {
	// print_r($update);
// }
?>