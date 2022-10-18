<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=imagecopy_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=imagecopy.csv");
}
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->image_copy;
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
          array('component_type' => new MongoRegex("/^$input/i")),
          array('application' => new MongoRegex("/^$inputcase/i")),
          array('business' => new MongoRegex("/^$inputcase/i")),
          array('scope' => new MongoRegex("/^$inputcase/i")),
          array('database' => new MongoRegex("/^$inputcase/i")),
          array('tablespace' => new MongoRegex("/^$inputcase/i")),
          array('image_copy_file' => new MongoRegex("/^$inputcase/i")),
          // array('table_business' => new MongoRegex("/^$inputcase/i")),
          // array('table_scope' => new MongoRegex("/^$inputcase/i")),
          // array('file_name' => new MongoRegex("/^$inputcase/i")),
          // array('file_application' => new MongoRegex("/^$inputcase/i")),
          // array('file_business' => new MongoRegex("/^$inputcase/i")),
          // array('file_scope' => new MongoRegex("/^$inputcase/i")),
          // array('query' => new MongoRegex("/^$inputcase/i"))

     ));
     if (isset($_GET['tbname'])) {
          $inputs = array("tablespace" => $input);
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
     $results = $collection->find()->sort(array("component_type" => 1));
}

$out = "Component Name,Component Type,Application Name,Business,Scope,database,Table space,image_copy_file";
echo $out . "\r\n";

foreach ($results as $result) {
     $component_name = $result['component_name'];
     $component_type = $result['component_type'];
     $application = $result['application'];
     $business = $result['business'];
     $scope = $result['scope'];
     $database = $result['database'];
     $tablespace = $result['tablespace'];
     //    $table_application = $result['table_application'];
     //    $table_business = $result['table_business'];
     //    $table_scope = $result['table_scope'];
     $image_copy_file = $result['image_copy_file'];
     //$file_name = $result['file_name'];
     // $file_application = $result['file_application'];
     // $file_business = $result['file_business'];
     //         $file_scope = $result['file_scope'];
     //$query = $result['query'];

    // $query = str_replace(",", ";", $query);
    // $query = str_replace("\n", " ", $query);

     $out = $component_name . "," . $component_type . "," . $application . "," . $business . "," . $scope . "," . $database . "," . $tablespace . "," . $image_copy_file;
     echo $out . "\r\n";
}
