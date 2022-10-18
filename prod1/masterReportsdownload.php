<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=MasterInventory_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=MasterInventory.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->masterinventory;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
          array('component_name' => new MongoRegex("/$input/i")),
          array('component_type' => new MongoRegex("/$input/i")),
          array('sub_type' => new MongoRegex("/$inputcase/i")),
          array('uloc' => new MongoRegex("/$inputcase/i")),
          array('cloc' => new MongoRegex("/$inputcase/i")),
          array('tloc' => new MongoRegex("/$inputcase/i")),
          array('instance' => new MongoRegex("/$inputcase/i")),
          array('app_code' => new MongoRegex("/$inputcase/i")),
          array('app_name' => new MongoRegex("/$inputcase/i")),
          array('app_owner_name' => new MongoRegex("/$inputcase/i")),
          array('platform' => new MongoRegex("/$inputcase/i")),
          array('orphan' => new MongoRegex("/$inputcase/i")),
          array('dead' => new MongoRegex("/$inputcase/i")),
          array('drop_impact' => new MongoRegex("/$inputcase/i"))

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
     $results = $collection->find()->sort(array("component_type" => 1));
}

$out = "Component Name,Component Type,Component SubType,ULOC,CLOC,TLOC,Instance,Application Code,Application Name,Application Owner Name,Platform,Orphan,Dead,Drop Impact";
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
     $orphan = $result['orphan'];
     $dead = $result['dead'];
     $dropImpact = $result['drop_impact'];
     $app_name = str_replace(",", ";", $app_name);

     $out = $component_name . "," . $component_type . "," . $sub_type . "," . $uloc . "," . $cloc . "," . $tloc . "," . $instance . "," . $app_code . "," . $app_name . "," . $app_owner_name . "," . $platform . "," . $orphan . "," . $dead . "," . $dropImpact;
     echo $out . "\r\n";
}
