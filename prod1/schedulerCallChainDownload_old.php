<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=schedulerCallChain_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=schedulerCallChain.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->schedulerCallChainReport;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     $inputs = array('$text' => array('$search' => $input));

     if (isset($_GET['tbname'])) {
          $inputs = array("tablename" => $input);
     }

     $results = $collection->find($inputs)->limit(500);
     $numdocs = 0;
     foreach ($results as $result) {
          $numdocs = 1;
     }
     if ($numdocs == 0) {
          $input = str_replace(" ", "-", $input);
          $results = $collection->find($inputs)->limit(500);
     }
} else {
     $results = $collection->find()->batchSize(80000);
}

$out = "component_name";
echo $out . "\r\n";

foreach ($results as $result) {
     $calling_component_name = $result['chain'];

     $out = $calling_component_name;
     echo $out . "\r\n";
}
