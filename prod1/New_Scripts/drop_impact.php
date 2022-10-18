<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);  
date_default_timezone_set('Asia/Kolkata');

	$m = new MongoClient();
	$db = $m->uc;
	$masterinventory = $db->masterinventory;
	$crossreference = $db->crossreference;
//run drop impact program for 7 levels
$level 			= 12;
$crossresults1 	= 0;
$drop_impact 	= "No";

//$inputtypes = array ('Yes','No');
for ($n=0;$n<$level;$n++)
{
	//Fetch only orphan components from Master Inventory
	//$mastresults1 = $masterinventory->find(array('$or'=>array("orphan"=>"Yes","dead"=>"Yes","drop_impact"=>"Yes")));
	$calling_component_array = array();
	//$input_array =array("orphan"=>"Yes");
	//$mastresults1 = $MasterInventory_collection->find(array("orphan"=>"Yes"))->batchSize(1000);
	//$mastresults1 = findFromCollection_DAL2($MasterInventory_coll,$input_array);
	//var_dump($mastresults1);
	$filter=array('$or' => array(
								array("orphan" => "Yes"),
								array("dead" => "Yes"),
								array("drop_impact" => "Yes")
								));
	$mastercount1=$masterinventory->find($filter)->count();
	$mastresults1=$masterinventory->find($filter);
	//echo "master count ". $mastercount1;
    if ($mastercount1 > 0)
	{
		//echo "ehere";
	foreach($mastresults1 as $mastresult)
	{
		
		$component_name = $mastresult['component_name'];
		$component_type = $mastresult['component_type'];
		 // echo PHP_EOL . "Component Getting processed - " . $component_name . " - " . $component_type;
		$crossinput1 	= array("calling_component_name"=>$component_name,"calling_component_type"=>$component_type);
		//var_dump ($crossinput1);
		
		$crossCount1 = $crossreference->find($crossinput1)->count();
		$crossresults1 = $crossreference->find($crossinput1);
       		
		// Process only if the component is present in the cross reference
		if ($crossCount1 > 0)
		{
			foreach ($crossresults1 as $crossresult)
			{
				$calling_component_name1 	= $crossresult['calling_component_name'] ;
				$calling_component_type1 	= $crossresult['calling_component_type'] ;
				$called_component_name1 	= $crossresult['called_component_name'] ;
				$called_component_type1 	= $crossresult['called_component_type'] ;
				
				$calling_component_data = $called_component_name1 ."|" .$called_component_type1;
				if (!in_array($calling_component_data,$calling_component_array))
				{	
					array_push($calling_component_array,$calling_component_data);
					//Fetch the called component details from Cross reference

					$crossinput2 = array("called_component_name"=>$called_component_name1,"called_component_type"=>$called_component_type1);
					$crossCount2 = $crossreference->find($crossinput2)->count();
					$crossresults2 = $crossreference->find($crossinput2);
					
					//Process only if the called component is present in the cross reference
					$orphan_count = 0;
					foreach ($crossresults2 as $crossresult3)
					{
						//echo "</br>";
						//var_dump($crossresult3);
						//echo "</br>";
						$calling_component_name2 	= $crossresult3['calling_component_name'] ;
						$calling_component_type2 	= $crossresult3['calling_component_type'] ;
						$called_component_name2 	= $crossresult3['called_component_name'] ;
						$called_component_type2 	= $crossresult3['called_component_type'] ;
						
						// check if the called component is called by any other component in cross-reference //
						// if ($called_component_name2 <> $called_component_name1 and $called_component_type2 <> $called_component_type1)
						//{
							$mastinput2 = array("component_name"=>$calling_component_name2,"component_type"=>$calling_component_type2);
							$mastresults2 = $masterinventory->find($mastinput2);

							foreach($mastresults2 as $mastersult2)
							{
								$orphan	= $mastersult2['orphan'];
								$drop_impact1 = $mastersult2['drop_impact'];
								$dead	= $mastersult2['dead'];

								if ($orphan == "Yes" || $drop_impact1 == "Yes" || $dead == "Yes")
								{
									$orphan_count = $orphan_count + 1;
								}
							}
					}
					if ($orphan_count == $crossCount2)
					{
						$drop_impact = "Yes";
						// echo "</br> The component candidate is ".$called_component_name1;
						drop_impact_BL($called_component_name1,$called_component_type1,$drop_impact) ;
					}
				}
			}
		}
	} 
	}
}

function drop_impact_BL($called_component_name1,$called_component_type1,$drop_impact)
{
	global $drop_impact;
	global $masterinventory;
	/*$DIReport_obj = new DIReport($called_component_name1,$called_component_type1);
	$divalue = array('$set'=>array('drop_impact'=>$drop_impact));
	$masterinventory->update($DIReport_obj,$divalue);	*/
	echo $called_component_name1."<br>";
	$masterinventory->update(
						['component_name' => $called_component_name1,'component_type' => $called_component_type1],
						['$set'=>['drop_impact' => $drop_impact]],
						['multiple' => true , 'upsert' => false]
					  ); 
}


?>