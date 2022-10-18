<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=ftpReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=ftpReport.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->ftp_report;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     $inputcase = $input;
     //$inputs = array('$text'=>array('$search'=>$input));
     $inputs =  array('$or' => array(
          array('component_name' => new MongoRegex("/^$input/i")),
          array('component_type' => new MongoRegex("/^$input/i")),
          array('app_name' => new MongoRegex("/^$inputcase/i")),
          array('app_owner' => new MongoRegex("/^$inputcase/i")),
          array('action' => new MongoRegex("/^$inputcase/i")),
          array('server_name' => new MongoRegex("/^$inputcase/i")),
          array('directory_name' => new MongoRegex("/^$inputcase/i")),
          array('source' => new MongoRegex("/^$inputcase/i")),
          array('destination' => new MongoRegex("/^$inputcase/i")),
          array('instance' => new MongoRegex("/^$inputcase/i"))
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

$out = "Component Name,Component Type,Application Name,Application Owner,Action,Server Name,Directory,Source,Destination,Instance";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_name = $result['component_name'];
     $component_type = $result['component_type'];
     $app_name = $result['app_name'];

     $app_owner = $result['app_owner'];
     $app_owner = str_replace(",", " ", $app_owner);
     $action = $result['action'];
     $server_name = $result['server_name'];
     $directory_name = $result['directory_name'];
     $source = $result['source'];
     $source = str_replace(",", " ", trim($source));

     $destination = $result['destination'];
     $destination = str_replace(",", " ", trim($destination));

     $instance = $result['instance'];

     $out = $component_name . "," . $component_type . "," . $app_name . "," . $app_owner . "," . $action . "," . $server_name . "," . $directory_name . "," . $source . "," . $destination . "," . $instance;
     echo $out . "\r\n";
}
