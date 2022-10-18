<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=db2FieldCrud" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=db2FieldCrud.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->fieldcrud;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							
									array( 'table_name' => new MongoRegex("/$input/i") ) ,
									array( 'operation' => new MongoRegex("/$input/i") ),
									array( 'component_name' => new MongoRegex("/$input/i") ),
									array( 'component_type' => new MongoRegex("/$input/i")),
									array( 'field_name' => new MongoRegex("/$input/i") ),
									// array( 'query' => $inputcase ),
									// array( 'system' => $inputcase ),
									// array( 'subsystem' => $inputcase ),
									// array( 'database' => $inputcase ),
									// array( 'tablesystem' => $inputcase )
							
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
						
						$out = "Component Name,Component Type,Table Name,Operation,Field Name";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$table_name = $result['table_name'];
                            $operation = $result['operation'];
                            $component_name = $result['component_name'];
                            $component_type = $result['component_type'];
                            $field_name = $result['field_name'];
								  $component_type = str_replace("properties","JAVA (Properties)",$component_type);
								  $component_type = str_replace("sql","JAVA (SQL)",$component_type);
								  $component_type = str_replace("xml","JAVA (XML)",$component_type);
							// $query = $result['query'];
							// $system = $result['system'];
						    // $subsystem = $result['subsystem'];
							// $database = $result['database'];
							// $tablesystem = $result['tablesystem'];
							
							$query = str_replace(",",";",$query);
							
							$out = $component_name . "," .$component_type . "," .$table_name . "," . $operation . "," .  $field_name;
							echo $out . "\r\n";
						}
						
?>