<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=inlineEsytrieve" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=inlineEsytrieve.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->inlineEsytrieve;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							// $input = strtoupper($input);
							$inputs = array('$or' => array(
									array( 'file_name' => new MongoRegex("/^$input/i")),
									array( 'stepname' => new MongoRegex("/^$input/i")),
									array( 'type' => new MongoRegex("/^$input/i")),
									array( 'application' => new MongoRegex("/^$input/i")),
									array( 'business' => new MongoRegex("/^$input/i")),
									array( 'scope' => new MongoRegex("/^$inputcase/i"))
							
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
							$results = $collection->find()->sort(array("file"=>1));
						}			
						
						$out = "File Name,Step Name,Type,Application,Business,Scope";
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
                                  $file_name = $result['file_name'];
                                  $stepname = $result['stepname'];
                                  $type = $result['type'];
                                  $application = $result['application'];
                                  $business = $result['business'];
                                  $scope = $result['scope'];
							
							$out = $file_name.",".$stepname.",".$type.",".$application.",".$business.",".$scope;
							echo $out . "\r\n";
						}
