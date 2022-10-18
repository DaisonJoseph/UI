<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=jclCrossreference_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=jclCrossreference.csv");
						}
						$m = new MongoClient();
						$db = $m->aflac;
						$collection = $db->jcl_crossreference;	
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
									array( '$and' => array( array('calling_component_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('calling_component_type' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('calling_application' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('calling_business' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('calling_scope' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('called_component_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('called_component_type' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('called_application' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('called_business' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('called_scope' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('step_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('dd_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL"))),
									array( '$and' => array( array('disp_name' => new MongoRegex("/$input/i")),array( 'calling_component_type' => "JCL")))
							
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
							$results = $collection->find(array( 'calling_component_type' => "JCL"));
						}			
						
						// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
						$out = "Calling Component Name,Calling Component Type,Application,App Owner,Called Component Name,Called Component Type,Step Name,DD Name, Disp name, Instance";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$calling_component_name = $result['calling_component_name'];
							$calling_component_type = $result['calling_component_type'];
							$app_name = $result['app_name'];
							$app_owner = $result['app_owner'];
							$called_component_name = $result['called_component_name'];
							$called_component_type = $result['called_component_type'];
							$step_name = $result['step_name'];
							$dd_name = $result['dd_name'];
							$disp_name = $result['disp_name'];
							$instance = $result['instance'];

							
							$out = $calling_component_name . "," . $calling_component_type . "," . $app_name . "," . $app_owner. "," . $called_component_name . "," . $called_component_type . "," . $step_name . "," . $dd_name . "," . $disp_name . "," . $instance;
							echo $out . "\r\n";
						}
