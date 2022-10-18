<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=deadTransaction" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=deadTransaction.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->deadTransaction;	
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
									array( 'system' => $input ),
									array( 'subsystem' => $input )
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
						
						$out = "Component Name,Component Type,System,Subsystem";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['component_name'];
                            $component_type = $result['component_type'];
                            $system = $result['system'];
							$subsystem = $result['subsystem'];
							
							$out = $component_name.",".$component_type.",".$system.",".$subsystem;
							echo $out . "\r\n";
						}
						
?>






