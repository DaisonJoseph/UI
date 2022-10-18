<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=MissingComponents_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=MissingComponents.csv");
						}
						$m = new MongoClient();
						$db = $m->aflac;
						$collection = $db->missing_report;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
															 array('calling_component_name' => new MongoRegex("/$input/i")),
															 array('called_component_type' => new MongoRegex("/$input/i")),
															 array('instance' => new MongoRegex("/$input/i")),
															 array('application_name' => new MongoRegex("/$input/i")),
															 array('application_owner' => new MongoRegex("/$input/i"))
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
							$results = $collection->find()->sort(array("missing_component_name"=>1));
						}			
						
						$out = "Missing Component Name,Missing Component Type,Instance,Application NAme,Application Owner";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['calling_component_name'];
							$component_type = $result['called_component_type'];
							$instance = $result['instance'];
							$app_name = $result['application_name'];
							$app_owner = $result['application_owner'];
							//$result = $result['Result'];

							
							$out = $component_name . "," . $component_type . "," . $instance . "," . $app_name . "," . $app_owner ;
							echo $out . "\r\n";
						}
