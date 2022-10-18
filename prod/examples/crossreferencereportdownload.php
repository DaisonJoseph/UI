<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=Crossreference" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=Crossreference_Download.csv");
}
$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->Crossreference;	
if(isset($_GET['input']))
{
	$input = trim($_GET['input']);
	$input =  str_replace(" ","-",$input);

	$input =str_replace("-"," ",$input);
	$inputs = array('$text'=>array('$search'=>$input));
	
	if (isset($_GET['tbname']))
	{
		$inputs = array("calling_component_name"=>$input);
	}
	
	$results = $collection->find($inputs);
	$numdocs = 0;
	foreach($results as $result)
	{
		$numdocs = 1;
	}
	if ($numdocs == 0)
	{
		$input =str_replace(" ","-",$input);
		$results = $collection->find($inputs);
	}
}
else
{
	$results = $collection->find();
}			

$out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Name" ;
echo $out . "\r\n";
	
foreach ($results as $result)
{
	$calling_component_name = $result['calling_component_name'];
	$calling_component_type = $result['calling_component_type'];
	$called_component_name = $result['called_component_name'];
	$called_component_type = $result['called_component_type'];
	
	$out = $calling_component_name . "," . $calling_component_type . "," . $called_component_name ."," . $called_component_type;
	echo $out . "\r\n";
}

?>
