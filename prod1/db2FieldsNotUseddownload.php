<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=db2FieldsNotUsed" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=db2FieldsNotUsed.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->db2FieldsNotUsed;
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							
									array( 'table_name' => $input ) ,
									array( 'database' => $input ),
									array( 'system' => $input ),
									array( 'field' => $input )
									
							
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
							$results = $collection->find()->sort(array("table_name"=>1));
						}			
						
						$out = "Table Name,Database,Table System,Field";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$table_name = $result['table_name'];
							$database = $result['database'];
							$tablesystem = $result['system'];
                            $field = $result['field'];
							
							
							$out = $table_name . "," . $database . "," . $tablesystem . "," .$field;
							echo $out . "\r\n";
						}
						
?>