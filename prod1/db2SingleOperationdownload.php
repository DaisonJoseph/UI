<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=db2TablesSingleOperation" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=db2TablesSingleOperation.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->db2TableWithSingleOperation;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
									array( 'component_name' => $input ) ,
									array( 'component_type' => $input ),
									array( 'system' => $inputcase ),
									array( 'subsystem' => $inputcase ),
									array( 'table_name' => $input ),
									array( 'database' => $inputcase ),
									array( 'tablesystem' => $inputcase ),
									array( 'operation' => $input ),
									array( 'query' => $inputcase )
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
							$results = $collection->find()->sort(array("component_type"=>1));
						}			
						
						$out = "Component Name,Component Type,System,Sub system,Table Name,Database,Table System,Operation, Query";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
								  $component_name = $result['component_name'];
                                  $component_type = $result['component_type'];
								  $system = $result['system'];
								  $subsystem = $result['subsystem'];
								  $table_name = $result['table_name'];
								  $database = $result['database'];
								  $tablesystem = $result['tablesystem'];
                                  $operation = $result['operation'];
                                  $query = $result['query'];
							$query = str_replace(",",";",$query);
							
							$out = $component_name .",".$component_type.",".$system.",".$subsystem.",".$table_name.",".$database.",".$tablesystem.",".$operation.",".$query;
							echo $out . "\r\n";
						}
						
?>






