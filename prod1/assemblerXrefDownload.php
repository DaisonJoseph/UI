<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=assemblerCrossreference_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=assemblerCrossreference.csv");
						}
						$m = new MongoClient();
						$db = $m->aflac;
						$collection = $db->assembler_crossreference;	
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
							$inputs =  array('$or' => array(array('app_code' => new MongoRegex("/$inputcase/i")),
								 array('calling_component_name' => new MongoRegex("/$inputcase/i")),
								 array('calling_component_type' => new MongoRegex("/$inputcase/i")),
								 array('app_name' => new MongoRegex("/$inputcase/i")),
								 array('app_owner' => new MongoRegex("/$inputcase/i")),
								 array('called_component_name' => new MongoRegex("/$inputcase/i")),
								 array('called_component_type' => new MongoRegex("/$inputcase/i")),
								 array('instance' => new MongoRegex("/$inputcase/i"))
							
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
							$results = $collection->find(array("calling_component_type" => "ASSEMBLER"));
						}			
						
						// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
						$out = "Calling Component Name,Calling Component Type,Application,App Owner,Called Component Name,Called Component Type,Instance";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$calling_component_name = $result['calling_component_name'];
							$calling_component_type = $result['calling_component_type'];
							$app_name = $result['app_name'];
							$app_owner = $result['app_owner'];
							$called_component_name = $result['called_component_name'];
							$called_component_type = $result['called_component_type'];
							$instance = $result['instance'];

							
							$out = $calling_component_name . "," . $calling_component_type . "," . $app_name . "," . $app_owner . "," . $called_component_name . "," . $called_component_type . "," . $instance;
							echo $out . "\r\n";
						}
