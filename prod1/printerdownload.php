<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=printer_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=printer.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->printer;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
          array('component_name' => new MongoRegex("/^$input/i")),
          array('type' => new MongoRegex("/^$input/i")),
          array('application' => new MongoRegex("/^$input/i")),
          array('business' => new MongoRegex("/^$input/i")),
          array('scope' => new MongoRegex("/^$inputcase/i"))

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
     $results = $collection->find()->sort(array("type" => 1));
}

$out = "Component Name,Component Type,Application Name,Business,Scope";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_name = $result['component_name'];
     $component_type = $result['type'];
     $application = $result['application'];
     $business = $result['business'];
     $scope = $result['scope'];
     // $line = $result['line'];

     // $line = str_replace(",", ";", $line);
     // $line = str_replace("\n", " ", $line);

     $out = $component_name . "," . $component_type . "," . $application . "," . $business . "," . $scope;
     echo $out . "\r\n";
}
