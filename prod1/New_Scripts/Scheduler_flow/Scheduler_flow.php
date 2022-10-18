<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0); 
//ini_set('memory_limit','16M'); 
date_default_timezone_set('Asia/Kolkata');

	$m = new MongoClient();
	$db = $m->urgent;
	$collection = $db->jobnames;
	$collection1 = $db->crossreference;
	//$input = array("jobname"=>"UTPKTX4E");
	$results = $collection->find($input);
	$results = $collection->find()->sort(array("jobname"=>-1));
	foreach ($results as $result)
	{
		$count=0;
		echo "<br>--------- in loop 1------------<br>";
		var_dump($result);
		echo "<br>--------- end of loop 1------------<br>";
		$jobname = $result['jobname'];
		$jobname1 = $result['jobname'];
		echo "<br> Jobname in progress " . $jobname;
		$input = array("calling_component_name"=>$jobname);
		$testrefs = $collection1->find($input);
		#$filename = "./interface/". $jobname . ".txt";
		$filename = "C:/Users//thilab/Documents/callchain_new". $jobname . ".txt";
		$result1 = $result;
		if (file_exists($filename))
		{
		}
		else
		{
			foreach ($testrefs as $crossref1)
			{
				$result = $result1;
				var_dump($crossref1);
				echo "<br>-----------";
				
				var_dump($result);
				echo "<br>-----------";
				$jobname = $crossref1['called_component_name'];
				array_push($result,$jobname);
				$string = $jobname1 . "," . $jobname;		
				file_put_contents($filename, $string . "\r\n", FILE_APPEND | LOCK_EX);

			//	var_dump($result);
				crossfunc($jobname,$result,$collection1,$filename);
			}
		}
	}
		

function crossfunc($jobname,$result,$collection1,$filename)
{
	//$filename = "crossrefoutput.txt";
	$input = array("calling_component_name"=>$jobname);
	
	$crossrefs = $collection1->find($input);
	$count = $collection1->find($input)->count();
	//echo "<br>  Value of the count - ". $count;
	$result1 = $result;
	foreach ($crossrefs as $crossref)
	{
		$result = $result1;
		//echo "<br>--------here in the loop -------------<br>";
		//var_dump($crossref);
		$calling = $crossref['called_component_name'];
		
		if (in_array($calling,$result))
		{
			//echo "<br> in array";
		}
		else
		{
			$resultcount = count($result);
			if ($resultcount < 20)
			{
				//echo "<br>  Not in array";
				if (in_array($calling,$result))
				{
				}
				else
				{
					array_push($result,$calling);
					//var_dump($result);
					$string = "";
					
					for($i=0;$i<$resultcount-1;$i++)
					{
						if ($i ==0)
						{
							$jobname = $result['jobname'];
						//	$string = $jobname;
							$string = $jobname . "," . $result[$i];
							$count+1;
						}
						else
						{	
								$string = $string . "," . $result[$i];
						}
					}
				//	echo "<br> Output is " . $string;
				if($count>=5){
					break;
				}
					file_put_contents($filename, $string . "\r\n", FILE_APPEND | LOCK_EX);
					crossfunc($calling,$result,$collection1,$filename);
				}
			}
		}
	}
	
}

?>