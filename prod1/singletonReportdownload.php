<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=singleton" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=singleton.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->singleton;	
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
									array( 'query' => new MongoRegex("/$input/i") ),
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
						
						$out = "Component Name,Component Type,Table Name,Operation,Query";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$table_name = $result['table_name'];
                            $operation = $result['operation'];
                            $component_name = $result['component_name'];
                            $component_type = $result['component_type'];
                            $query = $result['query'];
							// $query = $result['query'];
							// $system = $result['system'];
						    // $subsystem = $result['subsystem'];
							// $database = $result['database'];
							// $tablesystem = $result['tablesystem'];
							
							$query = str_replace(",",";",$query);
							
							$out = $component_name . "," .$component_type . "," .$table_name . "," . $operation . "," .  $query;
							echo $out . "\r\n";
						}
						
?>