<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=tableWithoutIndexReport_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=tableWithoutIndexReport.csv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->tableWindex;	
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
							$results = $collection->find()->sort(array("Table wth Index" => 1, "Table Name" => 1));
						}			
						
						$out = "Table Name,Tables Without Index";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$table_name = $result['NAME'];
                            $index = $result['Tables Without Index'];

							
							$out = $table_name . "," . $index;
							echo $out . "\r\n";
						}
						
?>
