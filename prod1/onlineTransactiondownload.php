<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=onlineTransaction_" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=onlineTransaction.csv");
						}
						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->MasterInventory;	
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
							#$results = $collection->find()->sort(array("Transaction" => 1, "Status" => 1));
							$results = $collection->find(array("Component_Type"=>"TRANSACTION"))->sort(array("Component_Name" => 1, "Status" => 1));
						}			
						
						$out = "Transaction,Program,Status";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
                                  $Component_Name = $result['Component_Name'];
                                  $Component_Type = $result['Component_Type'];
                                  $status = $result['Dead_Jobs'];

							$out = $Component_Name . "," . $Component_Type . "," . $status;
							echo $out . "\r\n";
						}
						
?>
