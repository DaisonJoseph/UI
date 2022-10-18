<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=clonedQueryReport_" . $_GET['input'] . "_Download.tsv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=clonedQueryReport.tsv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->clonedquery;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							$inputs = array('$text'=>array('$search'=>$input));
							
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
							$results = $collection->find()->sort(array("Query" => -1));
						}			
						
						$out = "Component" .  "\t" .  "Query";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component_name = $result['Componet'];
                            $query = $result['Query'];


							
							$out = $component_name . "\t" . $query;
							echo $out . "\r\n";
						}
						
?>

