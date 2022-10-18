<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Kolkata');
echo date('H:i:s') . "<br>"."Start" ;
try {

	// require(__DIR__.'/Config/AutoMyMongo.php'); 				//# 
	// require(__DIR__.'/Class/AutoCAP360_Class.php'); 	//# change php file name
	// require(__DIR__.'/DAL/AutoCAP360_DAL.php'); 				//# change to common DAL file name
	$m = new MongoClient();
	$db = $m->cap360_sample;
	$master_coll = $db->masterinventory;
	$crossref_coll = $db->crossreference;
	$callchain_coll = $db->callchain_overall;
	//$master_coll3 = $db->startingpoint;
	$outputfile = "callchain_output_20april_1.json";
	$progcount = 0;
	$json = "";
	// removeCollection('callchain_overall');
	$results = $master_coll->find(array("component_type"=>"JCL"))->batchSize(2000);
	foreach ($results as $result)
	{	
		$json = array();
		$callcount = 1;
		$progcount++;	
		$calltype =  $callcount . "type" ;	
		$component_level = trim($result['component_name']);
		$component_type = $result['component_type'];
		$json['1'] = $component_level;
		$json['1t'] = $component_type;
		echo $component_level . "---->" . $progcount . "\n";
		crossreferencelookup($crossref_coll,$component_level,$component_type,$json,1,$callchain_coll);
	}
}
catch(Exception $e)
{
	// //echo  $e->getMessage();
}
	
function crossreferencelookup($crossref_coll,$component_level,$component_type,$json,$callcount,$callchain_coll)
{
		$outputfile = "callchain_output_20april_1.json";
		$results = $crossref_coll->find(array("calling_component_name"=>$component_level,"calling_component_type"=>$component_type));
		$callcount = $callcount + 1;
		foreach ($results as $result)
		{
			$component_level = trim($result['called_component_name']);
			$component_type = $result['called_component_type'];
			//echo "\n" . "Component Level=>" . $component_level . "=====>Component Type=>" . $component_type;
			// echo $callcount."<br>";
			$jsoncount = count($json);
			
			$set = 0;
			for($m=1;$m<$jsoncount;$m++)
			{
				if(array_key_exists($m, $json) && array_key_exists($m . "t", $json))
				{
					$compsearch = $json[$m];
					$compsearchtype = $json[$m. "t"];
					if (($compsearch == $component_level) and ($component_type == $compsearchtype))
					{
						$set = 1;
						$m = $jsoncount + 1;
					}
				}
			}
			if ($set == 0)
			{
				$calloutname = $callcount. "";
				$callouttype = $callcount. "t";
				$json[$calloutname] = $component_level;
				$json[$callouttype] = $component_type;			
				$jsonencode = json_encode($json,True);				
				file_put_contents($outputfile,$jsonencode . "\r\n",FILE_APPEND | LOCK_EX);
				crossreferencelookup($crossref_coll,$component_level,$component_type,$json,$callcount,$callchain_coll);			
			}
		}					
			
		// echo "\n".$jsonencode
} 

?>