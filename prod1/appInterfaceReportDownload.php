<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=appInterfaceReport" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=appInterfaceReport.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->applicationInterface;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     // $input =  str_replace(" ","-",$input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     // $input =str_replace("-"," ",$input);
     //	$input = '\"' . $input . '\"';

     $inputcase = $input;

     //$inputs = array('$text'=>array('$search'=>$input));
     $inputs =  array('$or' => array(
          array('calling_application' => new MongoRegex("/^$input/i")),
          array('calling_scope' => new MongoRegex("/^$input/i")),
          array('calling_business' => new MongoRegex("/^$inputcase/i")),
          array('called_application' => new MongoRegex("/^$inputcase/i")),
          array('called_scope' => new MongoRegex("/^$inputcase/i")),
          array('called_business' => new MongoRegex("/^$inputcase/i"))
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

$out = "Calling Application,Calling Scope,Calling Business,Called Application,Called Scope,Called Business";
echo $out . "\r\n";

foreach ($results as $result) {
     $calling_application = trim(preg_replace('/\s\s+/', ' ', $result['calling_application']));
     $calling_scope = trim(preg_replace('/\s\s+/', ' ', $result['calling_scope']));
     $calling_business = trim(preg_replace('/\s\s+/', ' ', $result['calling_business']));
     $called_application = trim(preg_replace('/\s\s+/', ' ', $result['called_application']));
     $called_scope = trim(preg_replace('/\s\s+/', ' ', $result['called_scope']));
     $called_business = trim(preg_replace('/\s\s+/', ' ', $result['called_business']));

     $out = $calling_application . "," . $calling_scope . "," . $calling_business . "," . $called_application . "," . $called_scope . "," . $called_business;
     echo $out . "\r\n";
}
