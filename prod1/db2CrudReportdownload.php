<?php
header("Content-type: text/plain");
if (isset($_GET['input'])) {
     header("Content-Disposition: attachment; filename=db2Crud_" . $_GET['input'] . "_Download.csv");
} else {
     header("Content-Disposition: attachment; filename=db2Crud.csv");
}
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->crud;
if (isset($_GET['input'])) {
     $input = trim($_GET['input']);
     $input =  str_replace(" ", "-", $input);
     //	$input =  "\"" . str_replace("+","-",$input) . "\"";
     $input = str_replace("-", " ", $input);
     //	$input = '\"' . $input . '\"';


     //$inputs = array('$text'=>array('$search'=>$input));
     $inputcase = $input;
     $inputs = array('$or' => array(
									array( 'component_name' => new MongoRegex("/$input/i") ),
									array( 'component_type' => new MongoRegex("/$input/i") ),
									array( 'app_name' => new MongoRegex("/$input/i") ),
									array( 'app_owner' => new MongoRegex("/$input/i") ),
									array( 'table_name' => new MongoRegex("/$inputcase/i") ) ,
									array( 'operation' => new MongoRegex("/$inputcase/i") ),
									array( 'query' => new MongoRegex("/$inputcase/i") )

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
     $results = $collection->find()->sort(array("component_type" => 1));
}

$out = "Component Name,Component Type,Application,App Owner,Table Name,Operation,Query";
echo $out . "\r\n";

foreach ($results as $result) {
									$component_name = $result['component_name'];
									$component_type = $result['component_type'];
									$app_name = $result['app_name'];
									$app_owner = $result['app_owner'];
									$table_name = $result['table_name'];
									$operation = $result['operation'];
									$query = $result['query'];
									
									$query = str_replace(",",";",$query);

     $out = $component_name . "," . $component_type . "," . $app_name . "," . $app_owner . "," . $table_name . "," . $operation . "," . $query;
     echo $out . "\r\n";
}
