
<?php

$inputname = $_REQUEST["inputname"];
$inputtype = $_REQUEST["inputtype"];
$inputId = $_REQUEST["inputId"];
$tableInc = $_REQUEST["tableInc"];

// $inputname = "Procurement & Logistics";
// $inputname = "PCAEM040";
// $inputname = "AECB0010";
// $inputtype = "JCL";
// $tableInc = "yes";

$m = new MongoClient();
$db = $m->aflac;
$masterinventory_collection = $db->masterinventory;
$startingpoint_collection = $db->startingpoint;
$startingpoint_collection = $db->starting_business;
$crossreference_collection = $db->crossreference_dummy;
$bus_crossreference_collection = $db->bus_crossreference_dummy;
$remove_component_collection = $db->neglectComponents;
$crud_collection = $db->crud;
$missingsource_collection = $db->missingsource;
$table_inv_collection = $db->table_inv;
$startDistict = $bus_crossreference_collection->distinct("calling_component");
// print_r($startDistict);
$businessflag = false;
$inputarray = array('component_name' => $inputname);
$crossreferences1 = $crossreference_collection->find($inputarray)->limit(50);
$direction = "to";
$checkarray = array();
$i = 0;
$crossrefcount = 0;
$color = "brown";
$compid = 0;
$allcomponents = "";

//to neglect components
$neglectedComponents =array();
$neglectedresults = $remove_component_collection->find();
foreach($neglectedresults as $neglectedresult)
{
	$neglectedComponents[] = $neglectedresult['remove_name'];
}

//Added for Business Xref
$businessresults = $bus_crossreference_collection->find($inputarray)->limit(50);
foreach($businessresults as $businessresult)
{
	// echo $businessresult['component_type']."-----";
	$crossrefcount = $crossrefcount + 1;
	$component_type = $businessresult['component_type'];
	$calling_component = $businessresult['calling_component'];
	$calling_type = $businessresult['calling_type'];
	$type = $calling_type;
	
	$returncolor = getColor($type, $color);

	$masterresults = $masterinventory_collection->find(array('component_name' => $calling_component, 'component_type' => $calling_type));
	$appname = "Unknown";
	$orphan = "No";
	$dead = "No";
	$sloc = "";
	$compid = rand();
	$direction = "to";
	$mastercount = 0;
	$status ="";
	foreach ($masterresults as $masterresult) {
		$mastercount = $mastercount + 1;
		$sloc = $masterresult['tloc'];
		$appname = $masterresult['app_name'];
		$status = $masterresult['status'];
		if (isset($masterresult['Compid'])) {
			$compid = $masterresult['Compid'];
		}
	}

	if ($mastercount == 0) {
		$input = array('component_name' => $calling_component, 'component_type' => $calling_type);
		$missingresults = $missingsource_collection->find($input);

		foreach ($missingresults as $missingresult) {
			$compid = $missingresult['Compid'];
		}
	}

	$title = "Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status;

	if (!in_array($calling_component, $checkarray)) {
		$checkarray[$i] = $calling_component;
		$componentsdetails = $calling_component . "." . $calling_type . "." . $inputId . "." . $returncolor . "." . $compid . "." . $direction . "." . $title;
		$allcomponents = $allcomponents . "|" . $componentsdetails;
		$i = $i + 1;
	}
}

//Added for Crossreference
foreach ($crossreferences1 as $crossreference) {
	$crossrefcount = $crossrefcount + 1;
	$component_type = $crossreference['component_type'];
	$calling_component = $crossreference['calling_component'];
	$calling_type = $crossreference['calling_type'];
	$type = $calling_type;

	$returncolor = getColor($type, $color);

	$masterresults = $masterinventory_collection->find(array('component_name' => $calling_component, 'component_type' => $calling_type));
	$appname = "Unknown";
	$orphan = "No";
	$dead = "No";
	$loc = "Unknown";
	$compid = rand();
	$direction = "to";
	$mastercount = 0;
	foreach ($masterresults as $masterresult) {
		$mastercount = $mastercount + 1;
		$sloc = $masterresult['tloc'];
		$appname = $masterresult['app_name'];
		$status = $masterresult['status'];
		if (isset($masterresult['Compid'])) {
			$compid = $masterresult['Compid'];
		}
	}

	if ($mastercount == 0) {
		$input = array('component_name' => $calling_component, 'component_type' => $calling_type);
		$missingresults = $missingsource_collection->find($input);

		foreach ($missingresults as $missingresult) {
			$compid = $missingresult['Compid'];
		}
	}
	
	$businessinputarray = array('calling_component' => $calling_component);
	$businesschecks = $bus_crossreference_collection->find($businessinputarray);
	$businesscheckcount = $bus_crossreference_collection->find($businessinputarray)->count();
	
	if($businesscheckcount > 0)
	{
		foreach($businesschecks as $businesscheck)
		{
			// $businessflag = true;
			$calling_component = $businesscheck['component_name'];
			$calling_type = $businesscheck['component_type'];
			$direction = "to";
			$returncolor = getColor($calling_type, $color);
			$compid  = rand();
			$title = "This business is starting point for $inputname";
		}
	}
	
	$title = "Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status;
	// $title = str_replace("VEEB0015","Manage Customer",$title);
	if ((!in_array($calling_component, $checkarray))&&(!in_array($calling_component, $neglectedComponents))) {
		$checkarray[$i] = $calling_component;
		$componentsdetails = $calling_component . "." . $calling_type . "." . $inputId . "." . $returncolor . "." . $compid . "." . $direction . "." . $title;
		$allcomponents = $allcomponents . "|" . $componentsdetails;
		$i = $i + 1;
	}
}
//Added for Crud
if($tableInc == "yes")
{
	$crudresults = $crud_collection->find($inputarray)->limit(50);
	foreach($crudresults as $crudresult)
	{
	// print_r($crudresult);
		$crossrefcount = $crossrefcount + 1;
		$component_type = $crudresult['component_type'];
		$calling_component = $crudresult['table_name'];
		$calling_type = $crudresult['operation'];
		$appname = $crudresult['app_name'];
		$status = "";
		$sloc = "";
		$type = $calling_type;
		
		$returncolor = getColor($type, $color);
		
		$tableresults = $table_inv_collection->find(array('table_name' => $calling_component));
		$compid = rand();
		$direction = "to";
		// $mastercount = 0;
		foreach ($tableresults as $tableresult) {
			if (isset($tableresult['Compid'])) {
				$compid = $tableresult['Compid'];
			}
		}
		
		$title = "Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status;

		if (!in_array($calling_component, $checkarray)) {
			$checkarray[$i] = $calling_component;
			$componentsdetails = $calling_component . "." . $calling_type . "." . $inputId . "." . $returncolor . "." . $compid . "." . $direction . "." . $title;
			$allcomponents = $allcomponents . "|" . $componentsdetails;
			$i = $i + 1;
		}
	}
}
// print_r($checkarray);


//
if ($crossrefcount > 0) {
	$allcomponents = substr($allcomponents, 1, strlen($allcomponents));
	echo $allcomponents;
}

if (($crossrefcount == 0)) {
	echo "NOTFOUND";
}

function getColor($type, $color)
{
    $get_type = $type;
    if ($get_type == "JCL") {
        $color = "#CD9DEA";
    }
    if ($get_type == "PROC") {
        $color = "#B8F7BE";
    }
    if ($get_type == "COBOL") {
        $color = "#A6C4F6";
    }
    if ($get_type == "UTILITY") {
        $color = "#F3DCB4";
    }
    if ($get_type == "CONTROL_CARD") {
        $color = "#FC899E";
    }
    if (($get_type == "ASSEMBLER")or ($get_type == "EZPLUS")) {
        $color = "#B0E4E3";
    }
    if ($get_type == "READ") {
        $color = "#E4B0BF";
    }
    if ($get_type == "INSERT") {
        $color = "#BEE4B0";
    }
    if ($get_type == "UPDATE") {
        $color = "#B0BEE4";
    }
    if ($get_type == "DELETE") {
        $color = "#F75169";
    }
    if (($get_type == "COPYBOOK") or ($get_type == "DCLGEN") or ($get_type == "MAPS") ){
        $color = "#E9DBAD";
    }
    if ($get_type == "TRANSACTION") {
        $color = "#F9A9A2";
    }
    if (stripos($get_type,"Level_")!==false) {
        $color = "#BAF5F4";
    }
    return $color;
}


?>