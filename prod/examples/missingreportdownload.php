<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=Missingreport" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=Missingreport_Download.csv");
}
$m = new MongoClient();
$db = $m->bnpp;
$collection = $db->missing_report;	
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

$out = "Calling Component Name,Calling Component Type,Missing Component Name,Missing Component Name" ;
echo $out . "\r\n";
	
foreach ($results as $result)
{
	$calling_component_name = $result['calling_component_name'];
	$calling_component_type = $result['calling_component_type'];
	$missing_component_name = $result['missing_component_name'];
	$missing_component_type = $result['missing_component_type'];
	
	$out = $calling_component_name . "," . $calling_component_type . "," . $missing_component_name ."," . $missing_component_type;
	echo $out . "\r\n";
}

?>
