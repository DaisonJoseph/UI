<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=queryWithoutIndexReport_" . $_GET['input'] . "_Download.tsv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=queryWithoutIndexReport.tsv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->QueriesWindex;	
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
							$results = $collection->find();
						}			
						
						$out = "Program" . "\t" ."Type" . "\t" . "Query"  . "\t" . "Index";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							 $component_name = $result['Program'];
                             $component_type = $result['Type'];
							 $query = $result['Query'];
							 $index = $result['Index'];

							
							$out = $component_name .  "\t" . $component_type . "\t" . $query . "\t" . $index ;
							echo $out . "\r\n";
						}
						
?>