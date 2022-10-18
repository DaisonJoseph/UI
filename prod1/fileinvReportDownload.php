<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=FileInventory_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=FileInventory.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->fileInventory;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
									array( 'calling_component' => new MongoRegex("/$input/i") ) ,
									array( 'calling_component_type' => new MongoRegex("/$input/i") ) ,
									array( 'calling_application' => new MongoRegex("/$input/i") ) ,
									array( 'calling_scope' => new MongoRegex("/$input/i") ) ,
									array( 'calling_business' => new MongoRegex("/$input/i") ) ,
									array( 'called_component' => new MongoRegex("/$input/i") ) ,
									array( 'called_component_type' => new MongoRegex("/$input/i") ) ,
									array( 'called_application' => new MongoRegex("/$input/i") ) ,
									array( 'called_scope' => new MongoRegex("/$input/i") ) ,
									array( 'called_business' => new MongoRegex("/$input/i") ) ,
									array( 'step_name' => new MongoRegex("/$input/i") ) ,
									array( 'dd_name' => new MongoRegex("/$input/i") ) ,
									array( 'disp_name' => new MongoRegex("/$input/i") ) ,
									array( 'unit' => new MongoRegex("/$input/i") ) 
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
							$results = $collection->find()->sort(array("component_name"=>1));
						}			
						
						$out = "Calling Component Name,Calling Component Type,Calling Application, Calling Business, Calling scope, Called Component name, called component type, called application, called business, called scope, step name, dd name, disp name, unit";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
                                  $calling_component = $result['calling_component'];
                                  $calling_component_type = $result['calling_component_type'];
                                  $calling_application = $result['calling_application'];
                                  $calling_scope = $result['calling_scope'];
                                  $calling_business = $result['calling_business'];
                                  $called_component = $result['called_component'];
                                  $called_component_type = $result['called_component_type'];
                                  $called_application = $result['called_application'];
                                  $called_scope = $result['called_scope'];
                                  $called_business = $result['called_business'];
                                  $step_name = $result['step_name'];
                                  $dd_name = $result['dd_name'];
                                  $disp_name = $result['disp_name'];
                                  $unit = $result['unit'];
							//$result = $result['Result'];

							
							$out = $calling_component . "," . $calling_component_type . "," . $calling_application . "," . $calling_business . "," . $calling_scope . "," . $called_component . "," . $called_component_type . "," . $called_application . "," . $called_business . "," . $called_scope . "," . $step_name . "," . $dd_name . "," . $disp_name . "," . $unit;
							echo $out . "\r\n";
						}
