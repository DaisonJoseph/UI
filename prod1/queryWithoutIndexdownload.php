<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=queryWithoutIndex" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=queryWithoutIndex.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->queryWithoutIndex;	
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
									array( 'system' => $input ) ,
									array( 'subsystem' => $input ) ,
									array( 'query' => $input ) ,
									array( 'condition' => $input ),
									array( 'ixname' => $inputcase ),
									array( 'table_name' => $inputcase ),
									array( 'database' => $inputcase ),
									array( 'tablesystem' => $inputcase ),
									array( 'column' => $inputcase )
							
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
							$results = $collection->find()->sort(array("system"=>1));
						}			
						
						$out = "Component Name,System,Sub System,Query,Condition,IX Name,Table Name,Database,Table System,Column" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							 $component_name = $result['component_name'];
                                  $system = $result['system'];
                                  $subsystem = $result['subsystem'];
                                  $query = $result['query'];
                                  $condition = $result['condition'];
								  $ixname = $result['ixname'];
                                  $table_name = $result['table_name'];
								  $database = $result['database'];
								  $tablesystem = $result['tablesystem'];
                                  $column = $result['column'];
			
							$column = str_replace(",",";",$column);
							$out = $component_name . "," . $system . "," . $subsystem . "," . $query . "," . $condition . "," . $ixname . "," . $table_name . "," . $database . "," . $tablesystem . ',"' . $column;
							echo $out . "\r\n";
						}
						
?>