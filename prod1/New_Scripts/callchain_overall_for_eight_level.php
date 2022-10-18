<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Kolkata');
echo date('H:i:s') . "<br>"."Start for 8 levels" ;
try {

// require(__DIR__.'/Config/AutoMyMongo.php'); 				//# 
// require(__DIR__.'/Class/AutoCAP360_Class.php'); 	//# change php file name
// require(__DIR__.'/DAL/AutoCAP360_DAL.php'); 				//# change to common DAL file name
	
// $MasterInventory_coll = "masterinventory";		//# collection name?

// //#******* Update the status of the report in the Cap360 Reports Collection ****
// $report_name = "callchain_overall";						//#report name?
// $report_status = "RUNNING";
// changeExecution_DAL($report_name,$report_status);
//#******* Update the status of the report in the Cap360 Reports Collection ****
$component_id = 0;
echo "Generating Masterinventory at = " .time();

//ini_set('max_execution_time',0);  

$startTime = microtime(true);
		
$m = new MongoClient();
$db = $m->cap360_sample;
$master_coll = $db->masterinventory;
$crossref_coll = $db->crossreference;
$callchain_coll = $db->callchain_overall;
//$master_coll3 = $db->startingpoint;

$progcount = 0;
$json = "";

	$results = $master_coll->find(array("component_type"=>"JCL"))->batchSize(2000);
	foreach ($results as $result)
	{	
		$callcount = 0;	
		$component_name = trim($result['component_name']);
		$component_type = $result['component_type'];
		$business = $result['component_name'];
		$progcount = $progcount + 1;
		echo  "\n"." processing the PROGRAM -" . $component_name . "========" .$progcount ." === at === ".date('H:i:s');
		
		$results4 = $callchain_coll->find(array("business"=>$business,"first_level"=>$component_name))->limit(1);
		$results4count = 0;
		foreach($results4 as $result4)
		{
				$results4count = 1;
		}
	
		if ($results4count == 0)
		{			
			$input = array("calling_component_name"=>$component_name,"calling_component_type"=>$component_type);			
			$outputarray = array("business"=>$business,"first_level"=>$component_name,"first_type"=>$component_type);
			$callchain_coll->insert($outputarray);
			//echo "Here";
			$crossreferences = $crossref_coll->find($input);
			$callcount = $callcount + 1;
			foreach ($crossreferences as $crossreference)
			{
				$second_component_name = $crossreference['called_component_name'];
				$second_component_type = $crossreference['called_component_type'];
				$noprocessing = 0;
					
			//	{
					if (($second_component_type != "FILE") and ($second_component_type != "BINDCARD") and ($second_component_type != "VSAMDEF") and ($second_component_type != "PLANCARD") and ($second_component_type != "DBRM")) 
					{						
						$cycliclooping = 0;
																
						if (($component_name == $second_component_name) and ($component_type == $second_component_type))
						{
							$cycliclooping = 1;
						}
						
						if ($cycliclooping == 0)
						{
							$outputarray = array("business"=>$business,
												 "first_level"=>$component_name,
												 "first_type"=>$component_type,
												 "second_level"=>$second_component_name,
												 "second_type"=>$second_component_type);
												 
							$nowrite = 0;
							$nowriteresults = $callchain_coll->find($outputarray);
							foreach($nowriteresults as $nowriteresult)
							{
								$nowrite = 1;
							}					
							if ($nowrite == 0)
							{					
								$callchain_coll->insert($outputarray);
							}					 
					
							$callcount = $callcount + 1;					
							$typetobesearched = $second_component_type;
							
							
							$input = array("calling_component_name"=>$second_component_name,"calling_component_type"=>$second_component_type);								
								
							
							if ($noprocessing == 0)
							{
								$third_levels = $crossref_coll->find($input);
								foreach ($third_levels as $third_level)
								{
									$third_component_name = $third_level['called_component_name'];
									$third_component_type = $third_level['called_component_type'];	
									$noprocessing = 0; 									
									
									//if ($noprocessing == 0)
									//{
										if (($third_component_type != "FILE") and ($third_component_type != "DBRM") and ($third_component_type != "PLANCARD") and ($third_component_type != "BINDCARD") and ($third_component_type != "VSAMDEF"))
										{	
											////echo "<br> Value of the processing - " . $noprocessing . " - third component - " . $second_component_name  . "- type " . $third_component_type;	
											
											$cycliclooping = 0;
											
											if (($component_name == $second_component_name) and ($component_type == $second_component_type))
											{
												$cycliclooping = 1;
											}
											
											if (($component_name == $third_component_name) and ($component_type == $third_component_type))
											{
												$cycliclooping = 1;
											}
																
											
											//if (($component_name != $third_component_name) and ($third_component_name != $second_component_name) and ($component_type != $third_component_type) and ($third_component_type != $second_component_type))
											if ($cycliclooping == 0)
											{
												$outputarray = array("business"=>$business,
														 "first_level"=>$component_name,
														 "first_type"=>$component_type,
														 "second_level"=>$second_component_name,
														 "second_type"=>$second_component_type,
														 "third_level"=>$third_component_name,
														 "third_type"=>$third_component_type
														 );
														 
												$nowrite = 0;
												$nowriteresults = $callchain_coll->find($outputarray);
												foreach($nowriteresults as $nowriteresult)

												{
													$nowrite = 1;
												}					
												if ($nowrite == 0)
												{					
													$callchain_coll->insert($outputarray);
												}		 
										//		$callchain_coll->insert($outputarray);			
												$callcount = $callcount + 1;		
											
												$noprocessing = 0;						
												
												if ($noprocessing == 0)
												{
													$input = array("calling_component_name"=>$third_component_name,"calling_component_type"=>$third_component_type);
													
													$fourth_levels = $crossref_coll->find($input);
													foreach ($fourth_levels as $fourth_level)
													{
													
														$fourth_component_name = $fourth_level['called_component_name'];
														$fourth_component_type = $fourth_level['called_component_type'];	
										
														$noprocessing = 0;
												
													//	{
															if (($fourth_component_type != "FILE")  and ($fourth_component_type != "DBRM")  and ($fourth_component_type != "VSAMDEF")   and ($fourth_component_type != "PLANGRNT")  and ($fourth_component_type != "BINDCARD") )
															{
												
																$cycliclooping = 0;
																
																
																if (($component_name == $third_component_name) and ($component_type == $third_component_type))
																{
																	$cycliclooping = 1;
																}
																
																if (($second_component_name == $third_component_name) and ($second_component_type == $third_component_type))
																{
																	$cycliclooping = 1;
																}
																
																if (($fourth_component_name == $third_component_name) and ($fourth_component_type == $third_component_type))
																{
																	$cycliclooping = 1;
																}
																
																//if (($fourth_component_name != $component_name) and ($fourth_component_name != $second_component_name) and ($fourth_component_name != $third_component_name) and ($fourth_component_type != $component_type) and ($fourth_component_type != $second_component_type) and ($fourth_component_type != $third_component_type) )
																if ($cycliclooping == 0)
																{
															//		echo "writing data to the database <br>";
																	$outputarray = array("business"=>$business,
																						 "first_level"=>$component_name,
																						 "first_type"=>$component_type,
																						 "second_level"=>$second_component_name,
																						 "second_type"=>$second_component_type,
																						 "third_level"=>$third_component_name,
																						 "third_type"=>$third_component_type,
																						 "fourth_level"=>$fourth_component_name,
																						 "fourth_type"=>$fourth_component_type

																						 );
																	$nowrite = 0;
																	$nowriteresults = $callchain_coll->find($outputarray);
																	foreach($nowriteresults as $nowriteresult)

																	{
																		$nowrite = 1;
																	}					
																	if ($nowrite == 0)
																	{					
																		$callchain_coll->insert($outputarray);
																	}					 
											//						$callchain_coll->insert($outputarray);			
																	$callcount = $callcount + 1;
																
																	
																	$input = array("calling_component_name"=>$fourth_component_name,"calling_component_type"=>$fourth_component_type);
															
																	
																	//echo "<br> Value of the procedure processing <br>";
																	
															//		echo "<br>";	
																	
															//		echo "<br> value of the no processing - " . $noprocessing;
																	$noprocessing = 0;
																	
																		
																	if ($noprocessing == 0)
																	{
																//		$input = array("component_name"=>$third_component_name,"component_type"=>$third_component_type);
																		//echo  "<br>value of component name in level 3 at loop 2-" . $third_component_name;				
																		$fifth_levels = $crossref_coll->find($input);
																		foreach ($fifth_levels as $fifth_level)
																		{
																			$fifth_component_name = $fifth_level['called_component_name'];
																			$fifth_component_type = $fifth_level['called_component_type'];
	
																			// //echo  "<br>value of component name in level 5 --" . $fifth_component_name;
																			// //echo  "<br>value of component name in level 5 --" . $fifth_component_type;	
																
																			$noprocessing = 0;
																									
																			
																//			 $noprocessing = 0;
																
																			//if ($noprocessing == 0)
																			//{
																				if (($fifth_component_type != "FILE") and ($fifth_component_type != "PLANGRNT")  and ($fifth_component_type != "BINDCARD")  and ($fifth_component_type != "DBRM")  and ($fifth_component_type != "VSAMDEF"))
																				{
																					////echo "<br> Value of the processing - " . $noprocessing . " - fifth component - " . $fifth_component_name  . "- type " . $fifth_component_type;
																					$cycliclooping = 0;
																
																
																					if (($component_name == $fifth_component_name) and ($component_type == $fifth_component_type))
																					{
																						$cycliclooping = 1;
																					}
																					if (($second_component_name == $fifth_component_name) and ($second_component_type == $fifth_component_type))
																					{
																						$cycliclooping = 1;
																					}
																					if (($third_component_name == $fifth_component_name) and ($third_component_type == $fifth_component_type))
																					{
																						$cycliclooping = 1;
																					}
																					if (($fourth_component_name == $fifth_component_name) and ($fourth_component_type == $fifth_component_type))
																					{
																						$cycliclooping = 1;
																					}
																					
																					
																					
																					//if (($fifth_component_name != $component_name) and ($fifth_component_name != $second_component_name) and ($fifth_component_name != $third_component_name)  and ($fifth_component_name != $fourth_component_name) and ($fifth_component_type != $component_type) and ($fifth_component_type != $second_component_type) and ($fifth_component_type != $third_component_type)  and ($fifth_component_type != $fourth_component_type) )
																					if ($cycliclooping == 0)
																					{
																						$outputarray = array("business"=>$business,
																											 "first_level"=>$component_name,
																											 "first_type"=>$component_type,
																											 "second_level"=>$second_component_name,
																											 "second_type"=>$second_component_type,
																											 "third_level"=>$third_component_name,
																											 "third_type"=>$third_component_type,
																											 "fourth_level"=>$fourth_component_name,
																											 "fourth_type"=>$fourth_component_type,
																											 "fifth_level"=>$fifth_component_name,
																											 "fifth_type"=>$fifth_component_type

																											 );
																						$nowrite = 0;
																						$nowriteresults = $callchain_coll->find($outputarray);
																						foreach($nowriteresults as $nowriteresult)

																						{
																							$nowrite = 1;
																						}					
																						if ($nowrite == 0)
																						{					
																							$callchain_coll->insert($outputarray);
																							//echo "<br> Data is written to the database <br>";
																						}					 
										//												$callchain_coll->insert($outputarray);			
																						$callcount = $callcount + 1;
																					
																						$noprocessing = 0;
																											
																						if ($noprocessing == 0)
																						{										
																							
																							$input = array("calling_component_name"=>$fifth_component_name,"calling_component_type"=>$fifth_component_type);
																																														
																							
																							$sixth_levels = $crossref_coll->find($input);
																							foreach($sixth_levels as $sixth_level)
																							{
																								// //echo  "<br>-------------- Value of the sixth level processing ------------<br>";
																								$sixth_component_name = $sixth_level['called_component_name'];
																								$sixth_component_type = $sixth_level['called_component_type'];

																																				
																								// //echo  "<br>-------------------------------------------------------<br>";
																								// //echo  "<br>value of component name in level 6 --" . $sixth_component_name;
																								// //echo  "<br>value of component name in level 6 --" . $sixth_component_type;	
																								
																								$noprocessing = 0;
																								
																								//$noprocessing = 0;
																								
																								
												
																								//if ($noprocessing == 0)
																								//{
																									
																									if (($sixth_component_type != "FILE")  and ($sixth_component_type != "DBRM")  and ($sixth_component_type != "VSAMDEF")  and ($sixth_component_type != "PLANGRNT")  and ($sixth_component_type != "BINDCARD"))
																									{
																										////echo "<br> Value of the processing - " . $noprocessing . " - sixth component - " . $sixth_component_name  . "- type " . $sixth_component_type;
																										$cycliclooping = 0;
																
																
																										if (($component_name == $sixth_component_name) and ($component_type == $sixth_component_type))
																										{
																											$cycliclooping = 1;
																										}
																										if (($second_component_name == $sixth_component_name) and ($second_component_type == $sixth_component_type))
																										{
																											$cycliclooping = 1;
																										}
																										if (($third_component_name == $sixth_component_name) and ($third_component_type == $sixth_component_type))
																										{
																											$cycliclooping = 1;
																										}
																										if (($fourth_component_name == $sixth_component_name) and ($fourth_component_type == $sixth_component_type))
																										{
																											$cycliclooping = 1;
																										}
																										if (($fifth_component_name == $sixth_component_name) and ($fifth_component_type == $sixth_component_type))
																										{
																											$cycliclooping = 1;
																										}
																										
																										
																										
																										//if (($sixth_component_name != $component_name) and ($sixth_component_name != $second_component_name) and ($sixth_component_name != $third_component_name)  and ($sixth_component_name != $fourth_component_name)   and ($sixth_component_name != $fifth_component_name) and ($sixth_component_type != $component_type) and ($sixth_component_type != $second_component_type) and ($sixth_component_type != $third_component_type)  and ($sixth_component_type != $fourth_component_type)   and ($sixth_component_type != $fifth_component_type))
																										if ($cycliclooping == 0)
																										{
																											$outputarray = array("business"=>$business,
																																 "first_level"=>$component_name,
																																 "first_type"=>$component_type,
																																 "second_level"=>$second_component_name,
																																 "second_type"=>$second_component_type,
																																"third_level"=>$third_component_name,
																																 "third_type"=>$third_component_type,
																																 "fourth_level"=>$fourth_component_name,
																																 "fourth_type"=>$fourth_component_type,
																																 "fifth_level"=>$fifth_component_name,
																																 "fifth_type"=>$fifth_component_type,
																																 "sixth_level"=>$sixth_component_name,
																																 "sixth_type"=>$sixth_component_type
																																	 );
																											$nowrite = 0;
																											$nowriteresults = $callchain_coll->find($outputarray);
																											foreach($nowriteresults as $nowriteresult)

																											{
																												$nowrite = 1;
																											}					
																											if ($nowrite == 0)
																											{					
																												$callchain_coll->insert($outputarray);
																											}						 
																			//								$callchain_coll->insert($outputarray);			
																											$callcount = $callcount + 1;
																																													
																											
																												$input = array("calling_component_name"=>$sixth_component_name,"calling_component_type"=>$sixth_component_type);
																											
																											//echo "<br> Value of the procedure processing <br>";
																			
																											//echo "<br>";	
																			
																											$noprocessing = 0;
																											
																																	
																											if ($noprocessing == 0)
																											{
																												$seventh_levels = $crossref_coll->find($input);
																												foreach($seventh_levels as $seventh_level)
																												{
																													$seventh_component_name = $seventh_level['called_component_name'];
																													$seventh_component_type = $seventh_level['called_component_type'];
																													
																													if (($seventh_component_type != "FILE")  and ($seventh_component_type != "DBRM")  and ($seventh_component_type != "BINDCARD")  and ($seventh_component_type != "PLANGRNT")  and ($seventh_component_type != "VSAMDEF") )																																																		
																													{
																														$noprocessing = 0;
																														$cycliclooping = 0;
																
																
																														if (($component_name == $seventh_component_name) and ($component_type == $seventh_component_type))
																														{
																															$cycliclooping = 1;
																														}
																														if (($third_component_name == $seventh_component_name) and ($third_component_type == $seventh_component_type))
																														{
																															$cycliclooping = 1;
																														}
																														if (($fourth_component_name == $seventh_component_name) and ($fourth_component_type == $seventh_component_type))
																														{
																															$cycliclooping = 1;
																														}
																														if (($fifth_component_name == $seventh_component_name) and ($fifth_component_type == $seventh_component_type))
																														{
																															$cycliclooping = 1;
																														}
																														if (($sixth_component_name == $seventh_component_name) and ($sixth_component_type == $seventh_component_type))
																														{
																															$cycliclooping = 1;
																														}
																														
																														
																														
																														
																														
																														
																														
																														//if (($seventh_component_name != $component_name) and ($seventh_component_name != $second_component_name) and ($seventh_component_name != $third_component_name)  and ($seventh_component_name != $fourth_component_name)   and ($seventh_component_name != $fifth_component_name) and ($seventh_component_name != $sixth_component_name) and ($noprocessing == 0) and ($seventh_component_type != $component_type) and ($seventh_component_type != $second_component_type) and ($seventh_component_type != $third_component_type)  and ($seventh_component_type != $fourth_component_type)   and ($seventh_component_type != $fifth_component_type) and ($seventh_component_type != $sixth_component_type))
																															if ($cycliclooping == 0)
																														{
																															$outputarray = array("business"=>$business,
																																			 "first_level"=>$component_name,
																																			 "first_type"=>$component_type,
																																			 "second_level"=>$second_component_name,
																																			 "second_type"=>$second_component_type,
																																			"third_level"=>$third_component_name,
																																			 "third_type"=>$third_component_type,
																																			 "fourth_level"=>$fourth_component_name,
																																			 "fourth_type"=>$fourth_component_type,
																																			 "fifth_level"=>$fifth_component_name,
																																			 "fifth_type"=>$fifth_component_type,
																																			 "sixth_level"=>$sixth_component_name,
																																			 "sixth_type"=>$sixth_component_type,
																																			 "seventh_level"=>$seventh_component_name,
																																			 "seventh_type"=>$seventh_component_type
																																				 );
																					
																															$nowrite = 0;
																															$nowriteresults = $callchain_coll->find($outputarray);
																															foreach($nowriteresults as $nowriteresult)

																															{
																																$nowrite = 1;
																															}					
																															if ($nowrite == 0)
																															{					
																																$callchain_coll->insert($outputarray);
																															}				
																									//						$callchain_coll->insert($outputarray);								 
																															$callcount = $callcount + 1;
																															$noprocessing =0;	
																														//	//echo "<br> Before in the stop entry point at seventh level " . $sixth_component_name;
																																						
																															
																															$input = array("calling_component_name"=>$seventh_component_name,"calling_component_type"=>$seventh_component_type);
																															
																															if ($noprocessing == 0)
																															{
																																$eight_levels = $crossref_coll->find($input);
																																foreach($eight_levels as $eight_level)
																																{
																																	$eight_component_name = $eight_level['called_component_name'];
																																	$eight_component_type = $eight_level['called_component_type'];
																																												
																																	
																																	$cycliclooping = 0;
																																	
																																	if (($component_name == $seventh_component_name) and ($component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	
																																	if (($second_component_name == $seventh_component_name) and ($second_component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	
																																	if (($third_component_name == $seventh_component_name) and ($third_component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	
																																	if (($fourth_component_name == $seventh_component_name) and ($fourth_component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	
																																	if (($fifth_component_name == $seventh_component_name) and ($fifth_component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	if (($sixth_component_name == $seventh_component_name) and ($sixth_component_type == $seventh_component_type))
																																	{
																																		$cycliclooping = 1;
																																	}
																																	
																																	//if (($eight_component_name != $component_name) and ($eight_component_name != $second_component_name) and ($eight_component_name != $third_component_name)  and ($eight_component_name != $fourth_component_name)   and ($eight_component_name != $fifth_component_name) and ($eight_component_name != $sixth_component_name) and ($eight_component_name != $seventh_component_name) and    ($eight_component_name != "BINDCARD") and ($noprocessing == 0) and ($eight_component_type != $component_type) and ($eight_component_type != $second_component_type) and ($eight_component_type != $third_component_type)  and ($eight_component_type != $fourth_component_type)   and ($eight_component_type != $fifth_component_type) and ($eight_component_type != $sixth_component_type) and ($eight_component_type != $seventh_component_type))																			
																																	if ($cycliclooping == 0)
																																	{
																																	//	if ($eight_component_type != "FILES")
																																	//	{
																																		if (($eight_component_type != "FILE")  and ($eight_component_type != "DBRM")  and ($eight_component_type != "BINDCARD")  and ($eight_component_type != "PLANGRNT")  and ($eight_component_type != "VSAMDEF") )																																																		
																																		{		
																																			$outputarray = array("business"=>$business,
																																					 "first_level"=>$component_name,
																																					 "first_type"=>$component_type,
																																					 "second_level"=>$second_component_name,
																																					 "second_type"=>$second_component_type,
																																					 "third_level"=>$third_component_name,
																																					 "third_type"=>$third_component_type,
																																					 "fourth_level"=>$fourth_component_name,
																																					 "fourth_type"=>$fourth_component_type,
																																					 "fifth_level"=>$fifth_component_name,
																																					 "fifth_type"=>$fifth_component_type,
																																					 "sixth_level"=>$sixth_component_name,
																																					 "sixth_type"=>$sixth_component_type,
																																					 "seventh_level"=>$seventh_component_name,
																																					 "seventh_type"=>$seventh_component_type,
																																					 "eight_level"=>$eight_component_name,
																																					 "eight_type"=>$eight_component_type
																																					 );
																																			$nowrite = 0;
																																			$nowriteresults = $callchain_coll->find($outputarray);
																																			foreach($nowriteresults as $nowriteresult)

																																			{
																																				$nowrite = 1;
																																			}					
																																			if ($nowrite == 0)
																																			{					
																																				$callchain_coll->insert($outputarray);
																																			}		 
																																//			$callchain_coll->insert($outputarray);								 
																																			$callcount = $callcount + 1;
																																		}
																																	}
																																}
																															}
																														}
																													}	
																													else
																													{
																														if (($seventh_component_name != $component_name) and ($seventh_component_name != $second_component_name) and ($seventh_component_name != $third_component_name)  and ($seventh_component_name != $fourth_component_name)   and ($seventh_component_name != $fifth_component_name) and ($seventh_component_name != $sixth_component_name) and    ($seventh_component_name != "BINDCARD"))
																														{
																													
																															$outputarray = array("business"=>$business,
																																		 "first_level"=>$component_name,
																																		 "first_type"=>$component_type,
																																		 "second_level"=>$second_component_name,
																																		 "second_type"=>$second_component_type,
																																		 "third_level"=>$third_component_name,
																																		 "third_type"=>$third_component_type,
																																		 "fourth_level"=>$fourth_component_name,
																																		 "fourth_type"=>$fourth_component_type,
																																		 "fifth_level"=>$fifth_component_name,
																																		 "fifth_type"=>$fifth_component_type,
																																		 "sixth_level"=>$sixth_component_name,
																																		 "sixth_type"=>$sixth_component_type,
																																		 "seventh_level"=>$seventh_component_name,
																																		 "seventh_type"=>$seventh_component_type
																																 );
																									//						$callchain_coll->insert($outputarray);	
																									//						$callcount = $callcount + 1;																	
																														}
																													}																						
																												}
																											}																											
																										}
																									}	
																									else
																									{
																										if (($sixth_component_name != $component_name) and ($sixth_component_name != $second_component_name) and ($sixth_component_name != $third_component_name)  and ($sixth_component_name != $fourth_component_name)   and ($sixth_component_name != $fifth_component_name) and    ($sixth_component_name != "BINDCARD"))
																										{
																											$outputarray = array("business"=>$business,
																																 "first_level"=>$component_name,
																																 "first_type"=>$component_type,
																																 "second_level"=>$second_component_name,
																																 "second_type"=>$second_component_type,
																																 "third_level"=>$third_component_name,
																																 "third_type"=>$third_component_type,
																																 "fourth_level"=>$fourth_component_name,
																																 "fourth_type"=>$fourth_component_type,
																																 "fifth_level"=>$fifth_component_name,
																																 "fifth_type"=>$fifth_component_type,
																																 "sixth_level"=>$sixth_component_name,
																																 "sixth_type"=>$sixth_component_type
																																 );
																								//			$callchain_coll->insert($outputarray);								 
																								//			$callcount = $callcount + 1;
																										}
																									}
																								//}																			
																							}
																						}
																					}	
																				}
																				else
																				{
																					if (($fifth_component_name != $component_name) and ($fifth_component_name != $second_component_name) and ($fifth_component_name != $third_component_name)  and ($fifth_component_name != $fourth_component_name) and   ($fifth_component_name != "BINDCARD") )
																					{
																						$outputarray = array("business"=>$business,
																											 "first_level"=>$component_name,
																											 "first_type"=>$component_type,
																											 "second_level"=>$second_component_name,
																											 "second_type"=>$second_component_type,
																											 "third_level"=>$third_component_name,
																											 "third_type"=>$third_component_type,
																											 "fourth_level"=>$fourth_component_name,
																											 "fourth_type"=>$fourth_component_type,
																											 "fifth_level"=>$fifth_component_name,
																											 "fifth_type"=>$fifth_component_type

																											 );
																				//		$callchain_coll->insert($outputarray);			
																				//		$callcount = $callcount + 1;												
																					}
																				}
																			//}
																					
																		}
																	}	
																}	
															}
															else
															{
																if (($fourth_component_name != $component_name) and ($fourth_component_name != $second_component_name) and ($fourth_component_name != $third_component_name)  and ($fourth_component_name != "BINDCARD") )
																{
																	$outputarray = array("business"=>$business,
																	                     "first_level"=>$component_name,
																						 "first_type"=>$component_type,
																						 "second_level"=>$second_component_name,
																						 "second_type"=>$second_component_type,
																						 "third_level"=>$third_component_name,
																						 "third_type"=>$third_component_type,
																						 "fourth_level"=>$fourth_component_name,
																						 "fourth_type"=>$fourth_component_type
																									 
																									 );
															//		$callchain_coll->insert($outputarray);			
															//		$callcount = $callcount + 1;
																}
															}
														//}
													}
												}	
												}
										}	
										else
										{
											if (($component_name != $third_component_name) and ($third_component_name != $second_component_name) and ($third_component_name != "BINDCARD")) 
											{
												$outputarray = array("business"=>$business,
																	 "first_level"=>$component_name,
																	 "first_type"=>$component_type,
																	 "second_level"=>$second_component_name,
																	 "second_type"=>$second_component_type,
																	 "third_level"=>$third_component_name,
																	 "third_type"=>$third_component_type
																				 
																	 );
														
											}
										}
									//}
								}
							}
							
						
						}
					}
					else
					{	
						if (($component_name  != $second_component_name) and ($second_component_type != "BINDCARD"))
						{
							$outputarray = array("business"=>$business,
												"first_level"=>$component_name,
												"first_type"=>$component_type,
												 "second_level"=>$second_component_name,
												 "second_type"=>$second_component_type
																					 
												 );
					//		$callchain_coll->insert($outputarray);			
					//		$callcount = $callcount + 1;
						}
					}
				//}
			}
			 //echo  "<br> Value of the JCL name processed - " .  $component_name . "- " . $callcount . "<br>";
		}
	}
}

catch(Exception $e)
{
	// //echo  $e->getMessage();
}

//#******* Update the status of the report in the Cap360 Reports Collection ****
$report_name = "callchain_overall"; 	//#report name?
$report_status = "COMPLETED";
// changeExecution_DAL($report_name,$report_status);
//#******* Update the status of the report in the Cap360 Reports Collection ****
?>