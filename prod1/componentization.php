<?php
$m = new MongoClient();
$db = $m->aflac;
$componentization_collection = $db->componentization;
$starting_business_collection = $db->starting_business;
$crossreference_collection = $db->crossreference_dummy;
$bus_crossreference_collection = $db->bus_crossreference_dummy;
$db->dropCollection('componentization');
$db->dropCollection('starting_business');
$db->dropCollection('bus_crossreference_dummy');
$readcsv = fopen("Componentization/Capability Map for domain mapping.csv","r");
$records = array();
while(!feof($readcsv))
{
	$records[] = fgetcsv($readcsv);
}
// array_filter($records);
$records = (array_filter($records));

for($i=1;$i<count($records);$i++)
{
	$records[$i] = array_values(array_filter($records[$i]));
	$dot = substr_count($records[$i][0],".");
	$id = $records[$i][0];
	$name = $records[$i][1];
	if(isset($records[$i][2]))
	{	
		$jcl = $records[$i][2];
		$srt_type = $records[$i][3];
	}
	else
	{
		$jcl = "";
		$srt_type = "";
	}
	$level = $dot+1;
	$level_array[] = $level; 
	unset($record);
	$record = array('id'=>$id,'name'=>$name,'jcl'=>$jcl,'srt_type'=>$srt_type,'level'=>$level);
	$componentization_collection -> insert($record);
	
}
// print_r($level_array);
$maximum_level = max($level_array);
$starting_business_collection -> insert(array('data'=>"Maxlevel",'maxlevel'=>$maximum_level));
// echo $maximum_level;
for($level = 1;$level<=$maximum_level;$level++)
{
	echo $level."\n";
	$results = $componentization_collection->find(array('level'=>$level));
	foreach($results as $result)
	{
		// print_r($result);
		getCalled($result['id'],$result['name'],$result['jcl'],$result['srt_type'],$result['level'],$maximum_level);
	}
	
}
// $results = $componentization_collection->find(array('level'=>1));
// $resultscount = $componentization_collection->find(array('level'=>1))->count();
// echo $results;

function getCalled($id,$name,$jcl,$srt_type,$level,$maximum_level)
{
	global $componentization_collection;
	global $bus_crossreference_collection;
	global $crossreference_collection;
	global $starting_business_collection;
	if($jcl !== "") 
	{
		echo $name."->".$jcl."\n";
		$bus_crossreference_collection -> insert(array('component_name'=>$name,'component_type'=>"Level_$level",'calling_component'=>$jcl,'calling_type'=>$srt_type));
	}
	// else
	{
		$nextLevel = $level + 1;
		$calledResults = $componentization_collection->find(array('level'=>$nextLevel));
		// $calledResultsCount = $componentization_collection->find(array('level'=>$nextLevel))->count();
		// echo $calledResultsCount."\n";
		
		foreach($calledResults as $calledResult)
		{
			if($level == 1)
			{
				if(stripos($calledResult['id'],$id.".")!==false)
				{
					echo $name."->".$calledResult['name']."\n";
					$starting_business_collection -> insert(array('business'=>$name,'component_name'=>$calledResult['name'],'type'=>"Level_1"));
				}
			}
			$calledlevel = $calledResult['level'];
			if(stripos($calledResult['id'],$id.".")!==false)
			{
				echo $name."->".$calledResult['name']."\n";
				$bus_crossreference_collection -> insert(array('component_name'=>$name,'component_type'=>"Level_$level",'calling_component'=>$calledResult['name'],'calling_type'=>"Level_$calledlevel"));
			}
		}
	}
}
?>
