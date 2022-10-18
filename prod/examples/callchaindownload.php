<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=Callchain" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=Callchain_Download.csv");
}
$m = new MongoClient();
$db = $m->bnpp;
$collection = $db->callchain_overall;	
if(isset($_GET['input']))
{
	$input = trim($_GET['input']);
	$input =  str_replace(" ","-",$input);

	$input =str_replace("-"," ",$input);
	$inputs = array('$text'=>array('$search'=>$input));
	
	if (isset($_GET['tbname']))
	{
		$inputs = array("business"=>$input);
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

$out = "Business,First Level, First Type,Second Level, Second Type,Third Level, Third Type,Fourth Level, Fourth Type,Fifth Level, Fifth Type,Sixth Level, Sixth Type,Seventh Level, Seventh Type,Eigth Level, Eigth Type," ;
echo $out . "\r\n";
	
foreach ($results as $result)
{
	$business = $result['business'];
	$first_level = $result['first_level'];
	$first_type = $result['first_type'];
	$second_level = $result['second_level'];
	$second_type = $result['second_type'];
	$third_level = $result['third_level'];
	$third_type = $result['third_type'];
	$fourth_level = $result['fourth_level'];
	$fourth_type = $result['fourth_type'];
	$fifth_level = $result['fifth_level'];
	$fifth_type = $result['fifth_type'];
	$sixth_level = $result['sixth_level'];
	$sixth_type = $result['sixth_type'];
	$seventh_level = $result['seventh_level'];
	$seventh_type = $result['seventh_type'];
	$eighth_level = $result['eigth_level'];
	$eighth_type = $result['eighth_type'];		
	
	$out = $business . "," . $first_level . "," . $first_type ."," . $second_level .",". $second_type .",". $third_level .",". $third_type .",". $fourth_level .",". $fourth_type .",". $fifth_level .",". $fifth_type .",". $sixth_level .",". $sixth_type .",". $seventh_level .",". $seventh_type .",". $eighth_level .",". $eighth_type;
	echo $out . "\r\n";
}

?>
