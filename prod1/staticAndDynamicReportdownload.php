<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=StaticAndDynamic_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=StaticAndDynamic.csv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->staticDynamic;
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
							$results = $collection->find()->sort(array("Type" => -1, "Program_Name" => 1));
						}			
						
						$out = "Component_Name,Component_Type,Called_Component_Name";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$Component_Name = $result['Program Name'];
							$Component_Type = $result['Type'];
							$Called_Component = $result['Called_Component'];
							
							$out = $Component_Name . "," . $Component_Type . "," . $Called_Component;
							echo $out . "\r\n";
						}
						
?>



    