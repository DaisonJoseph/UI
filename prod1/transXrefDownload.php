<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=TransCrossreference_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=TransCrossreference.csv");
						}
						$m = new MongoClient();
						$db = $m->aflac;
						$collection = $db->transaction_crossreference;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							// $inputs = array('$text'=>array('$search'=>$input));
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputcase = $input;
							$inputs = array('$or' => array(
									array( 'calling_component_name' => new MongoRegex("/$input/i") ) ,
									array( 'calling_component_type' => new MongoRegex("/$input/i") ),
									array( 'called_component_name' => new MongoRegex("/$input/i") ),
									array( 'called_component_type' => new MongoRegex("/$input/i") )
							
							));
							if (isset($_GET['tbname']))
							{
								$inputs = array("tablename"=>$input);
							}
							
							$results = $collection->find($inputs)->limit(500);
							$numdocs = 0;
							foreach($results as $result)
							{
								$numdocs = 1;
							}
							if ($numdocs == 0)
							{
								$input =str_replace(" ","-",$input);
								$results = $collection->find($inputs)->limit(500);
							}
						}
						else
						{
							$results = $collection->find();
						}			
						
						// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
						$out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
								  $calling_component_name = $result['calling_component_name'];
                                  $calling_component_type = $result['calling_component_type'];
								  $called_component_name = $result['called_component_name'];
								  $called_component_type = $result['called_component_type'];

							
							$out = $calling_component_name . "," . $calling_component_type . "," . $called_component_name . "," . $called_component_type;
							echo $out . "\r\n";
						}
						
?>
