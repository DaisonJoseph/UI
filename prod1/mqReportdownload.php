<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=mqReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=mqReport.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->mq_report;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     $inputcase = $input;
     //$inputs = array('$text'=>array('$search'=>$input));
     $inputs =  array('$or' => array(
          array('component_name' => new MongoRegex("/$input/i")),
          array('component_type' => new MongoRegex("/$input/i")),
          array('app_name' => new MongoRegex("/$inputcase/i")),
          array('app_owner' => new MongoRegex("/$inputcase/i")),
          array('mq_type' => new MongoRegex("/$inputcase/i")),
          array('mq_name' => new MongoRegex("/$inputcase/i")),
          array('instance' => new MongoRegex("/$inputcase/i"))
     ));
     if (isset($_GET['tbname'])) {
          $inputs = array("component_name" => $input);
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
     $results = $collection->find()->sort(array("component_name" => 1));
}

$out = "Component Name,Component Type,Applicaton Name,Application Owner Name,MQ Type,MQ Name,Instance";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_name = $result['component_name'];
     $component_type = $result['component_type'];
     $app_name = $result['app_name'];
     $app_owner = $result['app_owner'];
     $mq_type = $result['mq_type'];
     $mq_name = $result['mq_name'];
     $instance = $result['instance'];

     $app_owner = str_replace(",", " ", $app_owner);

     $out = $component_name . "," . $component_type . "," . $app_name . "," . $app_owner . "," . $mq_type . "," . $mq_name . "," . $instance;
     echo $out . "\r\n";
}
