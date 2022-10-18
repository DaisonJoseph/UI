<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=TelonCobolCrossreference_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=TelonCobolCrossreference.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->crossreference;	
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
									array( '$and' => array( array('calling_component_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('calling_component_type' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('calling_application' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('calling_business' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('calling_scope' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('called_component_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('called_component_type' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('called_application' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('called_business' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('called_scope' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL"))),
									array( '$and' => array( array('call_type' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "TELONCBL")))
							
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
							$results = $collection->find(array( 'calling_component_type' => "TELONCBL"));
						}			
						
						// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
						$out = "Calling Component Name,Calling Component Type,Calling Component Application,Calling Component Business,Calling Component Scope,Called Component Name,Called Component Type,Called Component Application,Called Component Business,Called Component Scope,Call Type";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
								  $calling_component_name = $result['calling_component_name'];
                                  $calling_component_type = $result['calling_component_type'];
                                  $calling_application = $result['calling_application'];
                                  $calling_business = $result['calling_business'];
                                  $calling_scope = $result['calling_scope'];
                                  $called_component_name = $result['called_component_name'];
                                  $called_component_type = $result['called_component_type'];
                                  $called_application = $result['called_application'];
                                  $called_business = $result['called_business'];
                                  $called_scope = $result['called_scope'];
								  $call_type = $result['call_type'];

							
							$out = $calling_component_name . "," . $calling_component_type . "," . $calling_application . "," . $calling_application . "," . $calling_business . "," . $called_component_name . "," . $called_component_type . "," . $called_application . "," . $called_business . "," . $called_scope . "," . $call_type;
							echo $out . "\r\n";
						}
