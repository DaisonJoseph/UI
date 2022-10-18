<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=imsOrphanTables" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=imsOrphanTables.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->imsOrphan;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputs =  array( '$or' => array(
									array( 'orphan_segments' => new MongoRegex("/$input/i") )
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
							$results = $collection->find()->sort(array("orphan_segments"=>1));
						}			
						
						$out = "Orphan Segment Name";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$table_name = $result['orphan_segments'];
							
							
							$out = $table_name;
							echo $out . "\r\n";
						}
						
?>






