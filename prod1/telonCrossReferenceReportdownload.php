<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=TelonCrossReference" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=TelonCrossReference.csv");
						}
						$m = new MongoClient();
						$db = $m->ryder;
						$collection = $db->telonCrossReference;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
									array( 'Calling_Component_name' => $input ) ,
									array( 'Calling_Component_type' => $input ) ,
									array( 'Called_Component_name' => $input ) ,
									array( 'Called_Component_type' => $input ) ,
									array( 'Static/Dynamic' => $input ) 
									
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
							$results = $collection->find()->sort(array("Calling_Component_name"=>1));
						}			
						
						$out = "calling_component_name,calling_component_type,called_component_name,called_component_type,Static/Dynamic";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$callingComponentName = $result['Calling_Component_name'];
							$callingComponentType = $result['Calling_Component_type'];
							$calledComponentName = $result['Called_Component_name'];
							$calledComponentType = $result['Called_Component_type'];
							$typeOfCall = $result['Static/Dynamic'];

							
							$out = $callingComponentName . "," . $callingComponentType.",".$calledComponentName.",".$calledComponentType.",".$typeOfCall ;
							echo $out . "\r\n";
						}
						
?>




