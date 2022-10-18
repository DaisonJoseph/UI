<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=Masterinventory" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=Masterinventory_Download.csv");
}
$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->MasterInventory;	
if(isset($_GET['input']))
{
	$input = trim($_GET['input']);
	$input =  str_replace(" ","-",$input);

	$input =str_replace("-"," ",$input);
	$inputs = array('$text'=>array('$search'=>$input));
	
	if (isset($_GET['tbname']))
	{
		$inputs = array("Component_Name"=>$input);
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

$out = "Component Name,Component Type,LOC,Application Name,Orphan,Dead Jobs" ;
echo $out . "\r\n";
	
foreach ($results as $result)
{
	$component_name = $result['Component_Name'];
	$component_type = $result['Component_Type'];
	$lloc = $result['LLOC'];
	$uloc = $result['ULOC'];
	$cloc = $result['CLOC'];
	$appname = $result['Application_Name'];
	$orphan = $result['Orphan'];
	$dead = $result['Dead_Jobs'];
	$loc = $lloc + $uloc + $cloc;
	
	$out = $component_name . "," . $component_type . "," . $loc ."," . $appname ."," . $orphan ."," . $dead;
	echo $out . "\r\n";
}

?>
