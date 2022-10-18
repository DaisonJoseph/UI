
<?php

	$inputname = $_REQUEST["inputname"];
	$inputtype = $_REQUEST["inputtype"];
	$inputId = $_REQUEST["inputId"];
	
	$m = New MongoClient();
	$db = $m->componentization;
	$masterinventory_collection = $db->masterinventory;
	$startingpoint_collection = $db->startingpoint;
	$crossreference_collection = $db->crossreference;
	$missingsource_collection = $db->missingsource;
	
	$inputarray = array('component_name'=>$inputname);
	$crossreferences1 = $crossreference_collection->find($inputarray)->limit(50);
	$direction = "to";					
	$checkarray = array();
	$i = 0;
	$crossrefcount = 0;
	$color = "brown";
	$compid = 0;
	$allcomponents = "";
	
	foreach($crossreferences1 as $crossreference)
	{
		$crossrefcount = $crossrefcount + 1;
		$component_type = $crossreference['component_type'];
		$called_component_name = $crossreference['called_component_name'];
		$called_component_type = $crossreference['called_component_type'];
		$type = $called_component_type;
		
		$returncolor = getColor($type,$color);
		
		$masterresults = $masterinventory_collection->find(array('component_name'=>$called_component_name,'pdsname'=>$called_component_type));
		$appname = "Unknown";
		$orphan = "No";
		$dead = "No";
		$loc = "Unknown";
		$compid = rand();
		$direction = "to";
		$mastercount = 0;
		foreach($masterresults as $masterresult)
		{
			$mastercount = $mastercount + 1;
			$sloc = $masterresult['sloc'];
			$appname = $masterresult['ownership'];
			$status = $masterresult['status'];
			if (isset($masterresult['compid']))
			{
				$compid = $masterresult['compid'];
			}
			
		}
		
		if($mastercount == 0)
		{
			$input = array('component_name'=>$called_component_name,'component_type'=>$called_component_type);
			$missingresults = $missingsource_collection->find($input);
			
			foreach($missingresults as $missingresult)
			{
				$compid = $missingresult['compid'];
			}
		}
		
		$title = "Name:" .$called_component_name ."</br> Type:" .$called_component_type ."</br> LOC:" .$sloc ."</br> Application:" .$appname ."</br> Status:" .$status;
		
		if (!in_array($called_component_name,$checkarray))
		{
			$checkarray[$i] = $called_component_name;
			$componentsdetails = $calling_component ."." .$calling_type ."." .$inputId ."." .$returncolor ."." .$compid ."." .$direction ."." .$title;
			$allcomponents = $allcomponents ."|" .$componentsdetails;
			$i = $i + 1;
		}
	}
	
	if ($crossrefcount > 0)
	{
		$allcomponents = substr($allcomponents,1,strlen($allcomponents));
		echo $allcomponents;
	}

	$inputarray = array('called_component_name'=>$inputname);
	$crossreferences2 = $crossreference_collection->find($inputarray)->limit(50);
	$direction = "from";					
	$checkarray = array();
	$i = 0;
	$crossrefcount2 = 0;
	$color = "brown";
	$compid = 0;
	$allcomponents = "";
	
	foreach($crossreferences2 as $crossreference)
	{
		$crossrefcount2 = $crossrefcount2 + 1;
		$calling_component_name = $crossreference['calling_component_name'];
		$calling_component_type = $crossreference['calling_component_type'];
		$type = $calling_component_type;
		$returncolor = getColor($type,$color);
		
		$masterresults = $masterinventory_collection->find(array('component_name'=>$calling_component_name,'pdsname'=>$calling_component_type));
		$appname = "Unknown";
		$orphan = "No";
		$dead = "No";
		$loc = "Unknown";
		$mastercount = 0;
		$compid = rand();
		foreach($masterresults as $masterresult)
		{
			$mastercount = $mastercount + 1;
			$sloc = $masterresult['tloc'];
			$appname = $masterresult['system'];
			$status = $masterresult['subsystem'];
			if (isset($masterresult['compid']))
			{
				$compid = $masterresult['compid'];
			}
			
			if($mastercount == 0)
			{
				$input = array('component_name'=>$called_component_name,'component_type'=>$called_component_type);
				$missingresults = $missingsource_collection->find($input);
				
				foreach($missingresults as $missingresult)
				{
					$compid = $missingresult['compid'];
				}
			}
			
			$title = "Name:" .$calling_component_name ."</br> Type:" .$calling_component_type ."</br> LOC:" .$sloc ."</br> Application:" .$appname ."</br> Status:" .$status;
		if (!in_array($calling_component_name,$checkarray))
		{
			$checkarray[$i] = $calling_component_name;
			$componentsdetails = $calling_component_name ."." .$calling_component_type ."." .$inputId ."." .$returncolor ."." .$compid. "." .$direction ."." .$title;
			$allcomponents = $allcomponents ."|" .$componentsdetails;
			$i = $i + 1;
		}
		}
	}
	if ($crossrefcount > 0)
	{
		$allcomponents = substr($allcomponents,1,strlen($allcomponents));
		echo $allcomponents;
	}
	
	if(($crossrefcount == 0) and ($crossrefcount2 == 0))
	{
		echo "NOTFOUND";
	}
	
	function getColor($type,$color)
	{
		$get_type = $type;
		if ($get_type == "RPGLE")
		{
			$color = "#ffeb8d";
		}
		if ($get_type == "CLLE")
		{
			$color = "#feaa9f";
		}
		if ($get_type == "SQLRPGLE")
		{
			$color = "#faca88";
		}
		if (($get_type == "PRINTER") or ($get_type == "FILES")or ($get_type == "SCREEN"))
		{
			$color = "#83af9b";
		}
		if ($get_type == "RPGLE/COPYBOOK")
		{
			$color = "#cbbf97";
		}
		if ($get_type == "BNDDIR")
		{
			$color = "#EEAC99";
		}
		if ($get_type == "SQLRPGLE/COPYBOOK")
		{
			$color = "#f55f51";
		}
		if ($get_type == "PROCEDURE")
		{
			$color = "#6D3DC8";
		}
		return $color;
	}
	
	
?>