<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=Non - Clerity MasterInventory_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=Non - Clerity MasterInventory.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->nc_masterinventory;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputcase = $input;
							$inputs = array('$or' => array(
									array( 'component_name' => new MongoRegex("/$input/i") ) ,
									array( 'component_type' => new MongoRegex("/$input/i") ),
									array( 'sub_type' => new MongoRegex("/$inputcase/i") ),
									array( 'application_name' => new MongoRegex("/$inputcase/i") ),
									array( 'uloc' => new MongoRegex("/$inputcase/i") ),
									array( 'cloc' => new MongoRegex("/$inputcase/i") ),
									array( 'tloc' => new MongoRegex("/$inputcase/i") ),
							
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
						
						$out = "Component Name,Component Type,Sub type,application_name,ULOC,CLOC,TLOC" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['component_name'];
                            $component_type = $result['component_type'];
							$subType = $result['sub_type'];
							$application_name = $result['application_name'];
                            $cloc = $result['cloc'];
                            $uloc = $result['uloc'];
                            $tloc = $result['tloc'];
							$application_name = str_replace(",",";",$application_name);
							
							$out = $component_name . "," . $component_type . "," . $subType . "," . $application_name . "," . $uloc . "," . $cloc . "," . $tloc;
							echo $out . "\r\n";
						}
						
?>