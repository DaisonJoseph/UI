<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=emailReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=emailReport.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->email_report;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     // $input =  str_replace(" ","-",$input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     // $input =str_replace("-"," ",$input);
     //	$input = '\"' . $input . '\"';

     $inputcase = $input;

     //$inputs = array('$text'=>array('$search'=>$input));
     $inputs =  array('$or' => array(
          array('component_name' => new MongoRegex("/^$input/i")),
          array('component_type' => new MongoRegex("/^$input/i")),
          array("app_name" => new MongoRegex("/^$inputcase/i")),
          array("app_owner" => new MongoRegex("/^$inputcase/i")),
          array("from_email" => new MongoRegex("/^$inputcase/i")),
          array("to_email" => new MongoRegex("/^$inputcase/i")),
          array("subject" => new MongoRegex("/^$inputcase/i")),
          array("instance" => new MongoRegex("/^$inputcase/i"))

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

$out = "Component Name,Component Type,Application Name,Application Owner,From Email,To Email,Subject,Instance";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_name = $result['component_name'];
     $component_type = $result['component_type'];
     $app_name = $result['app_name'];
     $app_owner = $result['app_owner'];
     $app_owner = str_replace(",", " ", $app_owner);

     $from_email = $result['from_email'];
     $from_email = str_replace("<", "", $from_email);
     $from_email = str_replace(">", "", $from_email);
     $to_email = $result['to_email'];
     $to_email = str_replace("<", "", $to_email);
     $to_email = str_replace(">", "", $to_email);
     $subject = $result['subject'];
     $subject = str_replace(",", " ", $subject);

     $instance = $result['instance'];

     $out = $component_name . "," . $component_type . "," . $app_name . "," . $app_owner . "," . $from_email . "," . $to_email . "," . $subject . "," . $instance;
     echo $out . "\r\n";
}
