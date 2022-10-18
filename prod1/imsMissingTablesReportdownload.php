<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=imsMissing_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=imsMissing.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->imsMissing;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
          array('missing_segments' => new MongoRegex("/$input/i")),
          array('application' => new MongoRegex("/$inputcase/i")),
          array('scope' => new MongoRegex("/$inputcase/i")),
          array('business' => new MongoRegex("/$inputcase/i"))
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
     $results = $collection->find()->sort(array("component_name" => 1));
}

$out = "Segment Name,Segment Application,Segment Business,Segment Scope";
echo $out . "\r\n";

foreach ($results as $result) {
     $segment_application = $result['application'];
     $segment_scope = $result['scope'];
     $segment_business = $result['business'];
     $segment_name = $result['missing_segments'];

     $out = $segment_name . "," . $segment_application . "," . $segment_business . "," . $segment_scope;
     echo $out . "\r\n";
}
