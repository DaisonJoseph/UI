<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=compositeCrossreference_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=compositeCrossreference.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->composite_crossreference;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     // $inputs = array('$text'=>array('$search'=>$input));
     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
				 array('instance' => new MongoRegex("/$inputcase/i")),
				 array('jcl_component' => new MongoRegex("/$inputcase/i")),
				 array('jcl_app_name' => new MongoRegex("/$inputcase/i")),
				 array('jcl_app_owner' => new MongoRegex("/$inputcase/i")),
				 array('composite_component' => new MongoRegex("/$inputcase/i")),
				 array('called_component' => new MongoRegex("/$inputcase/i")),
				 array('app_name' => new MongoRegex("/$inputcase/i"))

     ));
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
     $results = $collection->find();
}

// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
$out = "Jcl Component,JCL App,JCL Owner,Composite Component,Called Component,Instance";
echo $out . "\r\n";

foreach ($results as $result) {
						$jcl_component = $result['jcl_component'];
						$jcl_app_name = $result['jcl_app_name'];
						$jcl_app_owner = $result['jcl_app_owner'];
						$composite_component = $result['composite_component'];
						$called_component = $result['called_component'];
						$instance = $result['instance'];


     $out = $jcl_component . "," . $jcl_app_name . "," . $jcl_app_owner . "," . $composite_component . "," . $called_component . "," . $instance;
     echo $out . "\r\n";
}
