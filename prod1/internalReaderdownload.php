<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=internalReader_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=internalReader.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->internalReader;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
          array('calling_component' => new MongoRegex("/$input/i")),
          array('calling_component_type' => new MongoRegex("/$input/i")),
          array('calling_application' => new MongoRegex("/$inputcase/i")),
          array('calling_scope' => new MongoRegex("/$inputcase/i")),
          array('calling_business' => new MongoRegex("/$inputcase/i")),
          array('called_component' => new MongoRegex("/$inputcase/i")),
          array('called_component_type' => new MongoRegex("/$inputcase/i")),
          array('called_application' => new MongoRegex("/$inputcase/i")),
          array('called_cope' => new MongoRegex("/$inputcase/i")),
          array('called_business' => new MongoRegex("/$inputcase/i"))
          // array( 'dead' => new MongoRegex("/$inputcase/i") ),
          // array( 'drop_impact' => new MongoRegex("/$inputcase/i") )

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
     $results = $collection->find()->sort(array("calling_component_type" => 1));
}

$out = "Calling Component,Calling Component Type,Calling Application,Calling Scope,Calling Business,Called Component,Called Component Type,Called Application,Called Scope,Called Business";
echo $out . "\r\n";

foreach ($results as $result) {
     $calling_component = $result['calling_component'];
     $calling_component_type = $result['calling_component_type'];
     $calling_application = $result['calling_application'];
     $calling_scope = $result['calling_scope'];
     $calling_business = $result['calling_business'];
     $called_component = $result['called_component'];
     $called_component_type = $result['called_component_type'];
     $called_application = $result['called_application'];
     $called_cope = $result['called_cope'];
     $called_business = $result['called_business'];

     $out = $calling_component . "," . $calling_component_type . "," . $calling_application . "," . $calling_scope . "," . $calling_business . "," . $called_component . "," . $called_component_type . "," . $called_application . "," . $called_cope . "," . $called_business;
     echo $out . "\r\n";
}
