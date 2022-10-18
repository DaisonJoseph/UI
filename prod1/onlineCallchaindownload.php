<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=onlinecallChain_" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=onlinecallChain.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->ims_callchain;	
if(isset($_GET['input']))
{
	$input = trim($_GET['input']);
	$input =  str_replace(" ","-",$input);
//	$input =  "\"" . str_replace("+","-",$input) . "\"";
	$input =str_replace("-"," ",$input);
//	$input = '\"' . $input . '\"';

	
	// $inputs = array('$text'=>array('$search'=>$input));
	
	// if (isset($_GET['tbname']))
	// {
		// $inputs = array("tablename"=>$input);
	// }
	$inputs =  array( '$or' => array(
                                  array( '1' => new MongoRegex("/$input/i") ), 
                                  array( '2' => new MongoRegex("/$input/i") ), 
                                  array( '3' => new MongoRegex("/$input/i") ), 
                                  array( '4' => new MongoRegex("/$input/i") ), 
                                  array( '5' => new MongoRegex("/$input/i") ), 
                                  array( '6' => new MongoRegex("/$input/i") ), 
                                  array( '7' => new MongoRegex("/$input/i") ), 
                                  array( '8' => new MongoRegex("/$input/i") ), 
                                  array( '9' => new MongoRegex("/$input/i") ), 
                                  array( '10' => new MongoRegex("/$input/i") )
			));
			
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

for($a=1;$a<11;$a++){
	$out = $out."Level ".$a.","."Level ".$a." Type,";
}
echo $out . "\r\n";

foreach($results as $values)
{
	$out = "";
	for($i=1;$i<11;$i++)
	{
		if((isset($values[$i])) && (isset($values[$i.'t'])))
		{
			$out .= $values[$i].",".$values[$i.'t'].",";
		}
		// print_r($result) . "\r\n";
	}
		echo $out. "\r\n";
}
