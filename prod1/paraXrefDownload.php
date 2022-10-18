<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=paraCrossreference_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=paraCrossreference.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->paraXref;	
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
									array( 'component_name' => new MongoRegex("/$input/i") ) ,
									array( 'calling_para' => new MongoRegex("/$input/i") ),
									array( 'called_para' => new MongoRegex("/$input/i") )
							
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
						
						// $out = "Calling Component Name,Calling Component Type,Called Component Name,Called Component Type,Step Name,Program Name,DD Name,Disp Name";
						$out = "Component Name,Calling Paragraph,Called Paragraph";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
								  $component_name = $result['component_name'];
                                  $calling_para = $result['calling_para'];
								  $called_para = $result['called_para'];

							
							$out = $component_name . "," . $calling_para . "," . $called_para;
							echo $out . "\r\n";
						}
						
?>
