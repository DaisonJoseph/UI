<?php
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	date_default_timezone_set('Asia/Kolkata');
	// date_default_timezone_set('Asia/Kolkata');
	echo "Generating Masterinventory at = " .time();
	//global $outputfile;
	// $file = fopen("next000.csv","r");
	// print_r(fgetcsv($file));
	// fclose($file);
	$path = 'C:/xampp/htdocs/UC/fcrud/uc/querywhere_apr16.csv';
	$outfile = fopen($path,'w');
	fputcsv($outfile,array( "Component Name","Table Name", "Field", "Query"));
	// $row = 1;
	// if (($handle = fopen("next000.csv", "r")) !== FALSE) {
	// while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	// $num = count($data);
	// if(strpos($data[4],"SELECT") !== false)
	 // {
			// $arr0 = explode("SELECT",$data[4]);
			// $arr01 = explode("FROM",$arr0[1]);
			// $arr02 = explode(",",$arr01[0]);
			// print_r($arr02);
			// fputcsv($outfile,array($data[2],$data[0],"",$data[4]));	
	 // }
		// $row++;
		// echo "<br>" . $row . "<br />\n";

	// }
	// fclose($handle);
	// }
$file = fopen("check04.csv","r");

$csvflag = false;
while(! feof($file))
{
  $data = fgetcsv($file);
  
  echo "<pre>";
 //print_r($data);
  $arr03 = array();
  if(strpos($data[1],"READ") !== false)
	 {
		 echo "<br> $data[4]";
		   $arr0 = explode("SELECT",$data[4]);
	//	   echo "<br> $arr0[1]";
			$arr14 = str_replace(" AND "," ",$arr0[1]);
			$arr14 = str_replace(" FROM "," ",TRIM($arr14));
			$arr14 = str_replace(" WITH "," ",TRIM($arr14));
			$arr14 = str_replace(" OR "," ",TRIM($arr14));
			$arr14 = str_replace(" A "," ",TRIM($arr14));
		//	$arr14 = str_replace(" ORDER "," ",TRIM($arr14));
		//	$arr14 = str_replace(" BY "," ",TRIM($arr14));
			$arr14 = str_replace(" IN ","",TRIM($arr14));
			$arr14 = str_replace(" INTO "," ",TRIM($arr14));
			$arr14 = str_replace(ARRAY("DISTINCT "," DISTINCT "," BETWEEN "," FOR "," HAVING "," JOIN "," INNER "," LIKE "," SUM "," CURRENT ","CURRENT "," DATE("," DATE "," DATE("," DAYS"," NOT ")," ",TRIM($arr14));
			$arr14 = str_replace(ARRAY(" GROUP "," REPLACE "," CHAR "," SUBSTR "," INT"," IN("," FROM "," VALUE "," UPDATE "," FOR "," LEFT "," LEFT("," FETCH "," ROW ", " ROWS "," ONLY"," READ ","MAX("," OF "," ON "," MAX (")," ",TRIM($arr14));
			$arr14 = str_replace(" ASC"," ",TRIM($arr14));
			$arr14 = str_replace(" DESC"," ",TRIM($arr14));
			$arr14 = str_replace(ARRAY(" COUNT "," COUNT("," COUNTER "),"",TRIM($arr14));  			//
			$arr14 = str_replace(" UNION "," ",TRIM($arr14));
			$arr14 = str_replace(" ALL "," ",TRIM($arr14));
			$arr14 = str_replace("="," ",TRIM($arr14));
			$arr14 = str_replace("!"," ",TRIM($arr14));
			$arr14 = str_replace("<","",TRIM($arr14));
			$arr14 = str_replace(">","",TRIM($arr14));
			$arr14 = str_replace("("," ",TRIM($arr14));
			$arr14 = str_replace(")"," ",TRIM($arr14));
			$arr14 = str_replace(","," ",TRIM($arr14));
			$arr14 = str_replace("^"," ",TRIM($arr14));
			$arr14 = str_replace("+"," ",TRIM($arr14));
			if(strpos($arr14,"ORDER") !== FALSE)
			{
			$arr16 = EXPLODE("ORDER",$arr14);
	//		ECHO "<BR> YES $arr16[0]";
			$arr14 = $arr16[0];
			}
			$arr14 = explode(" WHERE ",trim($arr14));
			echo "<br> field";
			print_r($arr14);
			$count1 = count($arr14);
			$inc1 = 1;
			 while($inc1 < $count1)
			 {
				echo "<br> where $inc1 - $arr14[2]"; 
				$arr15 = explode(" ",trim($arr14[$inc1]));
				print_r($arr15);
				$count11 = count($arr15);
			    $inc11 = 0;
			    while($inc11 < $count11)
			    {
				
				if((strpos(trim($arr15[$inc11]),":") == false) && (strpos(trim($arr15[$inc11]),"-") == false))
				{
					if(is_numeric($arr15[$inc11]) == false) 
					{
						if(($arr15[$inc11] == null) || (strpos(trim($arr15[$inc11]),"'") !== false) || (strpos(trim($arr15[$inc11]),"<>") !== false)|| (strpos(trim($arr15[$inc11]),":") !== false) || (strpos(trim($arr15[$inc11]),"-") !== false))
						{
		//				echo "<br> yes";
						}
						elseif(strpos(trim($arr15[$inc11]),".") !== false)
						{
							$dot = explode(".",$arr15[$inc11]);
							echo "<br> dot $dot[0] $dot[1]";
							$from = explode("FROM",$data[4]);
							$where = explode("WHERE",$from[1]);
							if(strpos($where[0],",") !== false)
							{
								$comma = explode(",",$where[0]);
								$count00 = count($comma);
								$com = 0;
								while($com < $count00)
								{
									$comma1 = explode(" ",trim($comma[$com]));
									print_r($comma1);
									if($dot[0] == $comma1[1])
									{
										if(strstr($comma1[0],$data[0]) !== false)
										{
											$table01 = $data[0];
											echo "<br>------------ $table01 $comma1[1]";
										}
										$csvflag = true;
										if($csvflag == true)
										{
											$file1 = fopen("tableinfo.csv","r");
											while(!feof($file1))
											{
												$data1 = fgetcsv($file1);
												if(($dot[1] == $data1[1]) && ($table01 == $data1[0]))
												{
													echo"<br>\n dotttttttttttttttttttt $dot[1] $data1[1] ";
													fputcsv($outfile,array($data[2],$table01,trim($dot[1]),trim($data[4])));													
												}
											}
											$csvflag = false;
											fclose($file1);	
										}
										
									}
									$com++;
								}
							}
							else
							{
							$csvflag = true;
							if($csvflag == true)
							{
								$file1 = fopen("tableinfo.csv","r");
								while(!feof($file1))
								{
									$data1 = fgetcsv($file1);
									if(($dot[1] == $data1[1]) && ($data[0] == $data1[0]))
									{
										echo"<br>\n dotttttttttttttttttttt $dot[1] $data1[1] ";
										fputcsv($outfile,array($data[2],$data[0],trim($dot[1]),trim($data[4])));
										
									}

								}
								$csvflag = false;
								fclose($file1);
								
							}
							// if($dot[2] !== false)
							// {
							// $csvflag = true;
							// if($csvflag == true)
							// {
								// $file1 = fopen("tableinfo.csv","r");
								// while(!feof($file1))
								// {
									// $data1 = fgetcsv($file1);
									// if(($dot[2] == $data1[1]) && ($data[0] == $data1[0]))
									// {
										// echo"<br>\n dotttttttttttttttttttt $dot[2] $data1[1] ";
										// fputcsv($outfile,array($data[2],$data[0],trim($dot[2]),$data[4]));
										
									// }

								// }
								// $csvflag = false;
								// fclose($file1);
								
							// }
							}		
						}
							
			//			fputcsv($outfile,array($data[2],$data[0],trim($dot[1]),$data[4]));							
							
						
						// elseif((in_array("A",$arr14) !== false) || (in_array("ALL",$arr14) !== false) || (in_array("DESC",$arr14) !== false) || (in_array("SUM",$arr14) !== false) || (in_array("VALUE",$arr14) !== false) || (in_array("D",$arr14) !== false) || (in_array(" COUNT ",$arr14) !== false) || (in_array("E",$arr14) !== false))
						// {
							// // $dot = explode(".",$arr14[$inc1]);
							// echo "<br> wrong1 $arr14[$inc1]";
							// // fputcsv($outfile,array($data[2],$data[0],$dot[1],$data[4]));
						// }
						// elseif((in_array("B",$arr14) !== false) || (in_array("F",$arr14) !== false) || (in_array("G",$arr14) !== false) || (in_array("MAX",$arr14) !== false) || (in_array("NOT",$arr14) !== false)  || (in_array("COUNTER",$arr14) !== false) || (in_array("UPDATE",$arr14) !== false) || (in_array("UNION",$arr14) !== false) || (in_array("C",$arr14) !== false) || (in_array("AGED",$arr14) !== false) )
						// {
		// //					if(in_array("*",$arr14) == false)
		// //					{
							// // $dot = explode(".",$arr14[$inc1]);
							// echo "<br> wrong2$arr14[$inc1]";
							// // fputcsv($outfile,array($data[2],$data[0],$dot[1],$data[4]));
		// //					}
						// }
						// elseif(in_array("AS",$arr14) !== false) 
						// {
							// // $dot = explode(".",$arr14[$inc1]);
							// echo "<br> wrong3 $arr14[$inc1]";
							// // fputcsv($outfile,array($data[2],$data[0],$dot[1],$data[4]));
						// }
				
						elseif(strpos("*",$arr15[$inc11]) !== false)
						{
							// $comp = "";
							// $table = "";
							// $que = "";
		//					ECHO "<BR> YESSSSSSSSSSSSSSS";
							echo "<br>\n correct $arr15[$inc1]";
							$comp = $data[2];
							$table = $data[0];
							$que = trim($data[4]);
        //                  echo"<br>\nhhhhhhhhhhhhhhhhhhhh $comp $table $data1[1] $que";							
							$csvflag = true;
							if($csvflag == true)
							{
								$file1 = fopen("tableinfo.csv","r");
								while(!feof($file1))
								{
									$data1 = fgetcsv($file1);
									if($table == $data1[0])
									{
										echo"<br>nhhhhhhhhhhhhhhhhhhhh  $table $data1[1]";
										fputcsv($outfile,array($comp,$table,trim($data1[1]),$que));
									}
									
									
								}
								$csvflag = false;
								fclose($file1);
								
							}	
						}
						elseif($arr15[$inc11] !== "")
						{
		//	            	echo "<br>\n correct1 $arr14[$inc1]";
							$dot = $arr15[$inc11];
							echo "<br> null $dot";
							$csvflag = true;
							if($csvflag == true)
							{
								$file1 = fopen("tableinfo.csv","r");
								while(!feof($file1))
								{
									$data1 = fgetcsv($file1);
									if(($dot == $data1[1]) && ($data[0] == $data1[0]))
									{
										echo"<br>\n nhhhhhhhhhhhhhhhhh $dot $data1[1] ";
										fputcsv($outfile,array($data[2],$data[0],trim($dot),trim($data[4])));
										break;
									}
									
		
								}
								
								$csvflag = false;
								fclose($file1);
								
							}
							// $file2 = fopen("missinguc.csv","r");
						    // while(!feof($file2))
							// {
								// $data2 = fgetcsv($file2);
								// if($data[0] == $data2[0])
								// {
									// echo"<br>\n missing $arr14[$inc1]";
									// fputcsv($outfile,array($data[2],$data[0],trim($arr14[$inc1]),$data[4]));
									// break;
								// }		
							// }
							// $csvflag = false;
							// fclose($file2);	
							
							// break;
			//				fputcsv($outfile,array($data[2],$data[0],trim($arr14[$inc1]),$data[4]));
						}
												
					 }
				}
					 $inc11++; 
				 }
				
			 $inc1++;
			// }
			
			}
	 }
	 
	   if(strpos($data[1],"INSERT") !== false)    // working
	 {
		//    echo "<br> $data[4]";
			$arr2 = explode("WHERE",$data[4]);
		//  print_r($arr2);
			// echo "<br> $arr2[1]";
			$arr13 = str_replace(" AND "," ",$arr2[1]);
			$arr13 = str_replace("="," ",$arr13);
			$arr22 = explode(" ",trim($arr13)); 
		//	print_r($arr22);
			$count2 = count($arr22);
		//	echo "$count2";
			$inc3 = 1;
			while($inc3 < $count2)
			{
				 if((strpos(trim($arr22[$inc3]),":") == false) && (strpos(trim($arr22[$inc3]),"-") == false))
				 {
					$arr23 = explode(".",$arr22[$inc3]);
				    echo "<br> $arr23[1]";
					if($arr23[1] !== null)
					{
				 fputcsv($outfile,array($data[2],$data[0],trim($arr23[1]),$data[4]));
				 }
				 }
				
				$inc3++;
			}
			 
	 }
	  if(strpos($data[1],"UPDATE") !== false)             // working
	 {
		    echo "<br> $data[4]";
			$arr1 = explode("SET",$data[4]);
		//	print_r($arr1);
			$arr11 = str_replace(","," ",$arr1[1]);
			$arr11 = str_replace("="," ",$arr11);
			$arr11 = str_replace("("," ",$arr11);
			$arr11 = str_replace(")"," ",$arr11);
			$arr11 = str_replace("+"," ",$arr11);
			$arr11 = str_replace("^"," ",$arr11);
			$arr11 = str_replace("<"," ",$arr11);
			// $arr11 = str_replace("WHERE "," ",$arr11);
			$arr11 = str_replace("SELECT "," ",$arr11);
			$arr11 = str_replace(ARRAY("AND "," OR ","T5","T4","T3","T2","T1"," IS "," CURRENT "," MAX"," DATE "," OF "," LIKE ","NULL"," TIMESTAMP ","OBJTOBJE","NOT","DAYS"," E ","FROM","OBJTSPFU","WSBTKUND"," IN ","WSBTHARE","WSBTPROF")," ",$arr11);
			$arr12 = explode(" WHERE ",trim($arr11));
			echo "<br> FIELD";
			print_r($arr12);
			$count5 = count($arr12);
			$inc5 = 1;
			while($inc5 < $count5)
			{
				$arr35 = explode(" ",trim($arr12[$inc5]));
				$count31 = count($arr35);
			    $inc31 = 0;
			    while($inc31 < $count31)
			    {
				if((strpos(trim($arr35[$inc31]),":") == false) && (strpos(trim($arr35[$inc31]),"-") == false))
				{
					if(is_numeric($arr35[$inc31]) == false) 
					{
						if(($arr35[$inc31] == "") || (strpos(trim($arr35[$inc31]),"'") !== false) || (strpos(trim($arr35[$inc31]),"<>") !== false)|| (strpos(trim($arr35[$inc31]),":") !== false) || (strpos(trim($arr35[$inc31]),"-") !== false))
						{
						
						}
						elseif(strpos(trim($arr35[$inc31]),".") !== false)
						{
							$dot = explode(".",trim($arr35[$inc31]));
								
							if($dot[1] !== "")
					        {
								echo "<br> dot $dot[1]";
							fputcsv($outfile,array($data[2],$data[0],trim($dot[1]),$data[4]));
							}
						}
						// elseif((in_array(")",$arr12) !== false) || (in_array("SELECT",$arr12) !== false) || (in_array("IN",$arr12) !== false))
						// {
						// }
						elseif((strpos($arr35[$inc31],"DAYS") == false) || (strpos($arr35[$inc31]," B ") == false) || (strpos($arr35[$inc31]," MAX") == false) )
						{
							if(strlen($arr35[$inc31]) !== 1)
							{
							if($arr35[$inc31] !== null)
					        {
							echo "<br> correct $arr35[$inc31]";
							fputcsv($outfile,array($data[2],$data[0],trim($arr35[$inc31]),$data[4]));
							}
							}
						}
					}
				}
				$inc31++;
				}
			$inc5++;
			}
			 
	 }
	   if(strpos($data[1],"DELETE") !== false)                       //working
	  {
		     echo "<br> $data[4]";
			$arr4 = explode("WHERE",$data[4]);
			print_r($arr4);
			$arr41 = str_replace(" AND "," ",$arr4[1]);
			$arr41 = str_replace("SELECT "," ",TRIM($arr41));
			$arr41 = str_replace(" BETWEEN "," ",TRIM($arr41));
			$arr41 = str_replace(" DAYS"," ",TRIM($arr41));
			$arr41 = str_replace(" IN "," ",TRIM($arr41));
			$arr41 = str_replace(" OR "," ",TRIM($arr41));
			$arr41 = str_replace(" FROM "," ",TRIM($arr41));
			$arr41 = str_replace(" O "," ",TRIM($arr41));
			$arr41 = str_replace(" IS "," ",TRIM($arr41));
			$arr41 = str_replace(" ON "," ",TRIM($arr41));
			$arr41 = str_replace(array(" TIMESTAMP "," TIMESTAMP"," T1 "," T2 "," H1 "," H2 "," JOIN "," SELECT "," H2"," T2"," T1")," ",TRIM($arr41));
			$arr41 = str_replace("=","",TRIM($arr41));
			$arr41 = str_replace(" ."," ",TRIM($arr41));
			$arr41 = str_replace("<","",TRIM($arr41));
			$arr41 = str_replace(">","",TRIM($arr41));
			$arr41 = str_replace("(","",TRIM($arr41));
			$arr41 = str_replace(")","",TRIM($arr41));
			$arr41 = str_replace(","," ",TRIM($arr41));
			$arr42 = explode(" ",trim($arr41));
			// echo "<br> FIELD";
			print_r($arr42);
			$count4 = count($arr42);
			$inc4 = 0;
			while($inc4 < $count4)
			{
				if((strpos(trim($arr42[$inc4]),":") == false) && (strpos(trim($arr42[$inc4]),"-") == false))
				{
					if(is_numeric($arr42[$inc4]) == false) 
					{
						if(($arr42[$inc4] == null) || (strpos(trim($arr42[$inc4]),"'") !== false) || (strpos(trim($arr42[$inc4]),"<>") !== false)|| (strpos(trim($arr42[$inc4]),":") !== false) || (strpos(trim($arr42[$inc4]),"-") !== false))
						{
						
						}
						elseif(strpos(trim($arr42[$inc4]),".") !== false)
						{
							$dot = explode(".",$arr42[$inc4]);
							if(strpos($dot[1],null) == false)
							{
							echo "<br> dot $dot[1]";
							fputcsv($outfile,array($data[2],$data[0],trim($dot[1]),$data[4]));
							}
						}
						// elseif(strpos($arr42[$inc4],"A") !== false) 
						// {
							// // $dot = explode(".",$arr14[$inc1]);
							// echo "<br> wrong $arr42[$inc4]";
							// // fputcsv($outfile,array($data[2],$data[0],$dot[1],$data[4]));
						// }
						elseif((strpos($arr42[$inc4],".") !== false)  ||(strpos($arr42[$inc4],"CURRENT") !== false)  ||(strpos($arr42[$inc4]," B ") !== false)  || (strpos($arr42[$inc4]," OR ") !== false)  || (strpos($arr42[$inc4],"LIKE") !== false)   || (strpos($arr42[$inc4],"NOT") !== false)   || (strpos($arr42[$inc4],"NULL") !== false)  || (strpos($arr42[$inc4]," O ") !== false)   || (strpos($arr42[$inc4]," T ") !== false) )
						 {
							// // $dot = explode(".",$arr14[$inc1]);
							 echo "<br> wrong $arr42[$inc4]";
							// // fputcsv($outfile,array($data[2],$data[0],$dot[1],$data[4]));
						 }
						elseif((strpos($arr42[$inc4]," IS ") == false) ||(strpos($arr42[$inc4],"NOT") == false) ||(strpos($arr42[$inc4]," T") == false) || (strpos($arr42[$inc4],"NOT") == false) || (strpos($arr42[$inc4],"NULL") == false)  ||(strpos($arr42[$inc4]," A ") == false) ||(strpos($arr42[$inc4]," B ") == false) || (strpos($arr42[$inc4]," ON ") == false)  || (strpos($arr42[$inc4],"O") == false)|| (strpos($arr42[$inc4],"JOIN") == false) || (strpos($arr42[$inc4],"H1") == false) || (strpos($arr42[$inc4],"H2") == false)  || (strpos($arr42[$inc4],"IS") == false)  || (strpos($arr42[$inc4],"NOT") == false) || (strpos($arr42[$inc4],"NULL") == false) || (strpos($arr42[$inc4]," T ") == false) || (strpos($arr42[$inc4],"ON") !== false)  || (strpos($arr42[$inc4],"T1") == false) || (strpos($arr42[$inc4],"T2") == false) )
						{
							if(strlen($arr42[$inc4]) !== 1)
							{	
							echo "<br>\n correct $arr42[$inc4]";
							fputcsv($outfile,array($data[2],$data[0],trim($arr42[$inc4]),$data[4]));
							}
						}
					}
				}
			$inc4++;
			}
		
			 
	  }
 }
			
fclose($file);


?>