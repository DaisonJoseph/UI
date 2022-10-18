<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=dropImpact" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=dropImpact.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->masterinventory;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));

     $inputs = array('$or' => array(
									array( '$and' => array( array('component_name' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('component_type' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('sub_type' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('uloc' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('cloc' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('tloc' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('instance' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('app_code' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('app_name' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('app_owner_name' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes"))),
									array( '$and' => array( array('platform' => new MongoRegex("/^$input/i")),array( 'drop_impact' => "Yes")))

     ));
     if (isset($_GET['tbname'])) {
          $inputs = array("tablename" => $input);
     }

     $results = $collection->find($inputs);
     $numdocs = 0;
     foreach ($results as $result) {
          $numdocs = 1;
     }
     if ($numdocs == 0) {
          $input = str_replace(" ", "-", $input);
          $results = $collection->find($inputs);
     }
} else {
     $results = $collection->find(array('drop_impact' => 'Yes'))->sort(array("component_type" => 1));
}

$out = "Component Name,Component Type,Sub type,CLOC,ULOC,TLOC,Instance,Appcode,App Name,App owner,platform" ;
echo $out . "\r\n";

foreach ($results as $result) {
										$component_name = $result['component_name'];
										$component_type = $result['component_type'];
										$sub_type = $result['sub_type'];
										$cloc = $result['cloc'];
										$uloc = $result['uloc'];
										$tloc = $result['tloc'];
										$instance = $result['instance'];
										$app_code = $result['app_code'];
										$app_name = $result['app_name'];
										$app_owner_name = $result['app_owner_name'];
										$platform = $result['platform'];

     // $application_name = str_replace(",", ";", $application_name);
    $out = $component_name . "," . $component_type . "," . $sub_type . "," . $cloc . "," . $uloc . "," . $tloc . "," . $instance .  "," . $app_code . "," . $app_name . "," . $app_owner_name . "," . $platform;
     echo $out . "\r\n";
}
