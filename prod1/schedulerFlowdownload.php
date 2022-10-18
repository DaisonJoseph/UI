<?php
header("Content-type: text/plain");
if(isset($_GET['input']))
{
	header("Content-Disposition: attachment; filename=schedulerFlow" . $_GET['input'] . "_Download.csv");
}
else
{
	header("Content-Disposition: attachment; filename=schedulerFlow.csv");
}
$m = new MongoClient();
$db = $m->uc;
$collection = $db->schedulerFlow;	
if(isset($_GET['input']))
{
	$input = trim($_GET['input']);
	$input =  str_replace(" ","-",$input);
//	$input =  "\"" . str_replace("+","-",$input) . "\"";
	$input =str_replace("-"," ",$input);
//	$input = '\"' . $input . '\"';

	
	//$inputs = array('$text'=>array('$search'=>$input));
	
	$inputs =  array( '$or' => array(
			array( 'level1' => $input ),
			array( 'level2' => $input ),
			array( 'level3' => $inputcase ),
			array( 'level4' => $inputcase ),
			array( 'level5' => $inputcase ),
			array( 'level6' => $inputcase ),
			array( 'level7' => $inputcase ),
			array( 'level8' => $inputcase ),
			array( 'level9' => $inputcase ),
			array( 'level10' => $inputcase ),
			array( 'level11' => $inputcase ),
			array( 'level12' => $inputcase ),
			array( 'level13' => $inputcase ),
			array( 'level14' => $inputcase ),
			array( 'level15' => $inputcase ),
			array( 'level16' => $inputcase ),
			array( 'level17' => $inputcase ),
			array( 'level18' => $inputcase ),
			array( 'level19' => $inputcase )
	
	));
	if (isset($_GET['tbname']))
	{
		$inputs = array("tablename"=>$input);
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
	$results = $collection->find()->batchSize(100000);
}
for($a=1;$a<20;$a++){
	$out = $out."Level".$a.",";
}
echo $out . "\r\n";

while($results->hasNext()){
	$out = "";
	$values = $results->getNext();
	for($a=1;$a<20;$a++){
		// if(isset($values[$a])){
			$out .= $values['level'.$a] . ",";
		// }
	}
	echo $out ."\r\n";
}
?>