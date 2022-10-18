<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=loadVsSourceReport_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=loadVsSourceReport.csv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->loadSource;	
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
							$results = $collection->find(array("Source Available,Load NA" => "Load Not Available"));
							$results1 = $collection->find(array("Load Available, Source NA" => "Source Not Available"));
						}			
						
						$out = "Component,Source Available,Load NA";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$component = $result['Component'];
                            $string = $result['Source Available,Load NA'];

							
							$out = $component . "," . $string ;
							echo $out . "\r\n";
						}
						$out = "Load,Load Available, Source NA";
						echo $out . "\r\n";
						foreach ($results1 as $result1)
						{
							$component1 = $result1['Load'];
                            $string1 = $result1['Load Available, Source NA'];

							
							$out1 = $component1 . "," . $string1 ;
							echo $out1 . "\r\n";
						}
						
?>
