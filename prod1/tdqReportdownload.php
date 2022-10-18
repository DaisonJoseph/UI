<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=tdqreport" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=tdqreport.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->tdq;	
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
									array( 'applicaton' => new MongoRegex("/$input/i") ),
									array( 'business' => new MongoRegex("/$input/i") ),
									array( 'scope' => new MongoRegex("/$input/i") ),
									array( 'tdq_name' => new MongoRegex("/$input/i") ),
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
						
						$out = "Component Name,Component Type,Application,Business,Scope,tdq Name,Operation,Line";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
									$component_name = $result['component_name'];
									$component_type = $result['component_type'];
									$application = $result['applicaton'];
									$business = $result['business'];
									$scope = $result['scope'];
									$tdqname = $result['tdq_name'];
									$operation = $result['operation'];
									$line = $result['line'];
							
							$query = str_replace(",",";",$query);
							
							$out =$component_name . "," . $component_type . "," . $application . "," . $business . "," . $scope . "," . $tdqname . "," . $operation . "," . $line;
							echo $out . "\r\n";
						}
						
?>