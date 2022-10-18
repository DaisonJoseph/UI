<?php
						header("Content-type: text/plain");
						if(isset($_GET['input']))
						{
							header("Content-Disposition: attachment; filename=callchain" . $_GET['input'] . "_Download.csv");
						}
						else
						{
							header("Content-Disposition: attachment; filename=callchain.csv");
						}
						$m = new MongoClient();
						$db = $m->cap360;
						$collection = $db->callchain;	
						if(isset($_GET['input']))
						{
							$input = trim($_GET['input']);
							$input =  str_replace(" ","-",$input);
						//	$input =  "\"" . str_replace("+","-",$input) . "\"";
							$input =str_replace("-"," ",$input);
						//	$input = '\"' . $input . '\"';
						
							
							//$inputs = array('$text'=>array('$search'=>$input));
							$inputcase = $input;
							$inputs = array('$or' => array(
									array( 'first_level' => $input ) ,
									array( 'first_type' => $input ),
									array( 'second_level' => $inputcase ),
									array( 'second_type' => $inputcase ),
									array( 'third_level' => $inputcase ),
									array( 'third_type' => $inputcase ),
									array( 'fourth_level' => $inputcase ),
									array( 'fourth_type' => $inputcase ),
									array( 'fifth_level' => $inputcase ),
									array( 'fifth_type' => $inputcase ),
									array( 'sixth_level' => $inputcase ),
									array( 'sixth_type' => $inputcase ),
									array( 'seventh_level' => $inputcase ),
									array( 'seventh_type' => $inputcase ),
									array( 'eight_level' => $inputcase ),
									array( 'eight_type' => $inputcase )
							
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
							$results = $collection->find();
						}			
						
						$out = "First Level,First Type,Second Level,Second Type,Third Level,Third Type,Fourth Level,Fourth Type,Fifth Level,Fifth Type,Sizth Level,Sixth Type,Seventh Level,Seventh Type,Eight Level,Eight Type," ;
						echo $out . "\r\n";
							
						foreach ($results as $result)
						{
							$first_level = $result['1'];
                            $first_type = $result['1t'];
							$second_level = $result['2'];
                            $second_type = $result['2t'];
                            $third_level = $result['3'];
                            $third_type = $result['3t'];
                            $fourth_level = $result['4'];
                            $fourth_type = $result['4t'];
                            $fifth_level = $result['5'];
                            $fifth_type = $result['5t'];
                            $sixth_level = $result['6'];
                            $sixth_type = $result['6t'];
                            $seventh_level = $result['7'];
                            $seventh_type = $result['7t'];
                            $eight_level = $result['8'];
                            $eight_type = $result['8t'];
							
							$out = $first_level . "," . $first_type . "," . $second_level . "," . $second_type . ',"' . $third_level .  '",' . $third_type . "," . $fourth_level . "," . $fourth_type. "," . $fifth_level. "," . $fifth_type . "," . $sixth_level . "," . $sixth_type . "," . $seventh_level . "," . $seventh_type . "," . $eight_level . "," . $eight_type;
							echo $out . "\r\n";
						}
						
?>