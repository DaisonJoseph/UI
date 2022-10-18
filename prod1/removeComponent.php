<?php
$m = new MongoClient();
$db = $m->aflac;
$remove_component_collection = $db->neglectComponents;

$remove_name = strtoupper($_POST["component_name"]);
$remove_type = strtoupper($_POST["component_type"]);

if(($remove_name !== "")&&($remove_type !== ""))
{
	$remove_component_collection -> insert(array('remove_name'=>$remove_name,'remove_type'=>$remove_type));
	$message = "The Component is added Successfully";
	header('Location: neglectComponent.php?message="The Component is added Successfully"');
}
if(($remove_name !== "")&&($remove_type === ""))
{
	header('Location: neglectComponent.php?message="Component Type Missing"');	
}
if(($remove_name === "")&&($remove_type !== ""))
{
	header('Location: neglectComponent.php?message="Component Name Missing"');	
}

// header('Location: controlFlow.php');
// header('Location: neglectComponent.php');
?>
