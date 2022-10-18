<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=tsqreport" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=tsqreport.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->tsq;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							// $input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							// $input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							
									array( 'component_name' => new MongoRegex("/$input/i") ),
									array( 'component_type' => new MongoRegex("/$input/i") ),
									array( 'application' => new MongoRegex("/$input/i") ),
									array( 'business' => new MongoRegex("/$input/i") ),
									array( 'scope' => new MongoRegex("/$input/i") ),
									array( 'tsq_name' => new MongoRegex("/$input/i") ),
									array( 'operation' => new MongoRegex("/$input/i") ),
									array( 'line' => new MongoRegex("/$input/i") )
							
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
							$results = $collection->find();
						}			
						
						$out = "Component Name,Component Type,Application,Business,Scope,TSQ Name,Operation,Line";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
									$component_name = $result['component_name'];
									$component_type = $result['component_type'];
									$application = $result['application'];
									$business = $result['business'];
									$scope = $result['scope'];
									$tsqname = $result['tsq_name'];
									$operation = $result['operation'];
									$line = $result['line'];
							
							$query = str_replace(",",";",$query);
							
							$out =$component_name . "," . $component_type . "," . $application . "," . $business . "," . $scope . "," . $tsqname . "," . $operation . "," . $line;
							echo $out . "\r\n";
						}
