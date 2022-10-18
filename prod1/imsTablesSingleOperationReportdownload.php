<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=imsSegmentSingleOperation" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=imsSegmentSingleOperation.csv");
						}
						$m = new MongoClient();
						$db = $m->uc;
						$collection = $db->imsTableWithSingleOperation;	
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
									array( 'component_type' => $input ) ,
									array( 'progsystem' => $input ) ,
									array( 'progsubsys' => $input ) ,
									array( 'segment_name' => $input ) ,
									array( 'dbdname' => $input ) ,
									array( 'dbdsystem' => $input ),
									array( 'crud_operation' => $input ) ,
									array( 'ssa' => $input ) ,
									array( 'statement' => $input ) 
									
							
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
							$results = $collection->find()->sort(array("segment_name"=>1));
						}			
						
						$out = "Component Name,Component Type,System,Subsystem,Segment Name,DBD,System,Crud Operation,SSA,Statement" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
								  $component_name = $result['component_name'];
								  $component_type = $result['component_type'];
                                  $progsystem = $result['progsystem'];
                                  $progsubsys = $result['progsubsys'];
                                  $segment_name = $result['segment_name'];
								  $dbdname = $result['dbdname'];
                                  $dbdsystem = $result['dbdsystem'];
                                  $crud_operation = $result['crud_operation'];
								  $ssa = $result['ssa'];
                                  $statement = $result['statement'];
                                  
							$out = $component_name . "," . $component_type. "," . $progsystem. "," . $progsubsys. "," . $segment_name . "," . $dbdname. "," . $dbdsystem . "," . $crud_operation . "," . $ssa . "," . $statement;
							echo $out . "\r\n";
						}
						
?>