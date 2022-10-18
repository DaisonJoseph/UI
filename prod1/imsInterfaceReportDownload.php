<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=imsInterfaceReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=imsInterfaceReport.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->imsInterface;
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
          array('ims_application' => new MongoRegex("/^$inputcase/i")),
          array('ims_scope' => new MongoRegex("/^$inputcase/i")),
          array('ims_business' => new MongoRegex("/^$inputcase/i"))
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

$out = "Component Application,Component Scope,Component Business,IMS Application,IMS Scope,IMS Business";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_application = trim(preg_replace('/\s\s+/', ' ', $result['component_application']));
     $component_scope = trim(preg_replace('/\s\s+/', ' ', $result['component_scope']));
     $component_business = trim(preg_replace('/\s\s+/', ' ', $result['component_business']));
     $ims_application = trim(preg_replace('/\s\s+/', ' ', $result['ims_application']));
     $ims_scope = trim(preg_replace('/\s\s+/', ' ', $result['ims_scope']));
     $ims_business = trim(preg_replace('/\s\s+/', ' ', $result['ims_business']));

     $out = $component_application . "," . $component_scope . "," . $component_business . "," . $ims_application . "," . $ims_scope . "," . $ims_business;
     echo $out . "\r\n";
}
