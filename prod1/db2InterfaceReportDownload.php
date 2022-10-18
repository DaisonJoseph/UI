<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=db2InterfaceReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=db2InterfaceReport.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->db2Interface;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     // $input =  str_replace(" ","-",$input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     // $input =str_replace("-"," ",$input);
     //	$input = '\"' . $input . '\"';

     $inputcase = $input;

     //$inputs = array('$text'=>array('$search'=>$input));
     $inputs =  array('$or' => array(
          array('component_application' => new MongoRegex("/^$input/i")),
          array('component_scope' => new MongoRegex("/^$input/i")),
          array('component_business' => new MongoRegex("/^$inputcase/i")),
          array('db2_application' => new MongoRegex("/^$inputcase/i")),
          array('db2_scope' => new MongoRegex("/^$inputcase/i")),
          array('db2_business' => new MongoRegex("/^$inputcase/i"))
          // array('active/inactive' => new MongoRegex("/^$inputcase/i"))

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
     $results = $collection->find();
}

$out = "Component Application,Component Scope,Component Business,DB2 Application,DB2 Scope,DB2 Business";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_application = trim(preg_replace('/\s\s+/', ' ', $result['component_application']));
     $component_scope = trim(preg_replace('/\s\s+/', ' ', $result['component_scope']));
     $component_business = trim(preg_replace('/\s\s+/', ' ', $result['component_business']));
     $db2_application = trim(preg_replace('/\s\s+/', ' ', $result['db2_application']));
     $db2_scope = trim(preg_replace('/\s\s+/', ' ', $result['db2_scope']));
     $db2_business = trim(preg_replace('/\s\s+/', ' ', $result['db2_business']));

     $out = $component_application . "," . $component_scope . "," . $component_business . "," . $db2_application . "," . $db2_scope . "," . $db2_business;
     echo $out . "\r\n";
}
