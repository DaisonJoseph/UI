<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=missingTables" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=missingTables.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->db2Missing;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							
									array( 'component_name' => new MongoRegex("/$input/i") ),
									array( 'component_type' => new MongoRegex("/$input/i") ),
									array( 'component_application' => new MongoRegex("/$input/i") ),
									array( 'component_business' => new MongoRegex("/$input/i") ),
									array( 'component_scope' => new MongoRegex("/$input/i") ),
									array( 'table_name' => new MongoRegex("/$inputcase/i") ) ,
									array( 'table_application' => new MongoRegex("/$inputcase/i") ),
									array( 'table_scope' => new MongoRegex("/$inputcase/i") ),
									array( 'table_business' => new MongoRegex("/$inputcase/i") ),
									array( 'operation' => new MongoRegex("/$inputcase/i") ),
									array( 'query' => new MongoRegex("/$inputcase/i") )
							
							));
							if (isset($_GET['tbname']))
							{
								$inputs = array("tablename"=>$input);
							}
							
							$results = $collection->find($inputs);
							$numdocs = 0;
							foreach($results as $result)
							{
								$numdocs = 1;
							}
							if ($numdocs == 0)
							{
								$input =str_replace(" ","-",$input);
								$results = $collection->find($inputs);
							}
						}
						else
						{
							$results = $collection->find();
						}			
						
						$out = "Component Name,Component Type,Application,Business,Scope,Table Name,Table Application, Table Business, Table Scope,Operation,Query";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
									$table_application = $result['table_application'];
									$table_scope = $result['table_scope'];
									$table_business = $result['table_business'];
									$application = $result['component_application'];
									$business = $result['component_business'];
									$table_name = $result['table_name'];
									$scope = $result['component_scope'];
									$operation = $result['operation'];
									$component_name = $result['component_name'];
									$component_type = $result['component_type'];
									$query = $result['query'];
							
							$query = str_replace(",",";",$query);
							
							$out = $component_name . "," .$component_type . "," .$application . "," .$business . "," .$scope . "," .$table_name . "," . $table_application . "," . $table_business . "," . $table_scope . "," .  $operation . "," .  $query;
							echo $out . "\r\n";
						}
						
?>