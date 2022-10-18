<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=stringImpactOverall_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=stringImpactOverall.csv");
						}
						$m = new MongoClient();
						$db = $m->ryder;
						$collection = $db->stringImpactNew;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
									array( 'component_name' => $input ) ,
									array( 'component_type' => $input )
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
							$results = $collection->find()->sort(array("component_name"=>1));
						}			
						
						$out = "component_name,component_type";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['component_name'];
							$component_type = $result['component_type'];

							
							$out = $component_name . "," . $component_type;
							echo $out . "\r\n";
						}
						
?>





