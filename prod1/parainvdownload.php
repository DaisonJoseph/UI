<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=paraInv" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=paraInv.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->parainvnetory;	
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
									array( 'component_type' => new MongoRegex("/$input/i")  ),
									array( 'paragraph_name' => new MongoRegex("/$inputcase/i")),
									array( 'loc' => new MongoRegex("/$inputcase/i"))
							
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
						
						$out = "Component Name,Component Type,Paragraph Name,LOC" ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
                                  $component_name = $result['component_name'];
                                  $component_type = $result['component_type'];
                                  $paragraph_name = $result['paragraph_name'];
								  $paragraph_name = str_replace("\n","",$paragraph_name);
                                  $section_name = $result['section_name'];
                                  $loc = $result['loc'];
							
							$out = $component_name . "," . $component_type . "," . $paragraph_name . "," . $loc;
							echo $out . "\r\n";
						}
						
?>