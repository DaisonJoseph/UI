<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=imsimageCopyReport" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=imsimageCopyReport.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->imsimageCopyReport;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							
							$inputs = array('$or' => array(
							array( 'component_name' => $input ) ,
									array( 'component_type' => $input ),
									array( 'system' => $input ),
									array( 'subsystem' => $input ),
									array( 'dbd' => $input ),
									array( 'dbd_system' => $input ),
									// array( 'tablespace' => $inputcase ),
									array( 'image_copy_file' => $input),
									array( 'image_copy_file_system' => $input )
							
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
						
						$out = "Component Name,Component Type,Component System,Component Sub System,Database,Database System,Image Copy File,Image Copy File System" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['component_name'];
                            $component_type = $result['component_type'];
							$system = $result['system'];
							$sub_system = $result['subsystem'];
							$database = $result['dbd'];
							$database_system = $result['dbd_system'];
                            // $tablespace = $result['tablespace'];
                            $image_copy_file = $result['image_copy_file'];
							$image_copy_file_system = $result['image_copy_file_system'];
							
							$out = $component_name . "," . $component_type . "," .$system . "," .$sub_system. "," .$database . "," .$database_system . "," . $image_copy_file. "," .$image_copy_file_system;
							echo $out . "\r\n";
						}
						
?>