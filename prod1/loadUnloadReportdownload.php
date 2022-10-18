<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=loadunloadReport" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=loadunloadReport.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->loadUnloadReport;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							array( 'component_name' => $input ) ,
									array( 'component_type' => $input ),
									array( 'system' => $inputcase ),
									array( 'subsystem' => $inputcase ),
									array( 'table_name' => $input ),
									array( 'table_system' => $input ),
									array( 'operation' => $input ),
									array( 'file' => $input ),
									array( 'file_system' => $input ),
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
						
						$out = "Component Name,Component Type,Component System,Component Sub System,Table Name,Table System,Operation,File,File System,Query" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['component_name'];
                            $component_type = $result['component_type'];
							$component_system = $result['system'];
							$component_sub_system = $result['subsystem'];
							$table_name = $result['table_name'];
							$table_system = $result['table_system'];
                            $operation = $result['operation'];
                            $file = $result['file'];
							$file_system = $result['file_system'];
                            $query = $result['query'];
							
							$query = str_replace(",",";",$query);
							$query = str_replace("\n"," ",$query);
							
							$out = $component_name . "," . $component_type . "," . $component_system . "," . $component_sub_system . "," . $table_name . "," .$table_system . "," . $operation . ',"' . $file .  '",' .$file_system . "," . $query;
							echo $out . "\r\n";
						}
						
?>