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
	$path = 'C:/xampp/htdocs/UC/jclcrud/Crud_ESY_1605.csv';
	$outfile = fopen($path,'w');

	//$outputfile = fopen("C:/xampp/htdocs/sample1.csv","w");
	fputcsv($outfile,array("Table Name", "Operation", "Component Name", "Component Type", "SQL Query"));
	$directorypath = "C:/xampp/htdocs/Overall_Source_May7_20/ESY";
	searchdirectory($directorypath);
function searchdirectory($dirPath) 
{
	if (is_dir($dirPath)== false) 
	{
		echo "Not a valid directory";
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) !== '/') 
	{
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) 
	{
		if (is_dir($file))
		{
			//searchdirectory ($file);
			read_file($file);
		} 
		else
		{
		   read_file($file); 
		}
	}   
}

function read_file($file)
{

	 global $outfile;
	 // echo $file;
	 $a = explode("/",$file);
	  print_r($a);
	 $componentname = $a[5];
	 // $dd = array();
	 $type = "";
	 $table1 = "";
	 $table2 = "";
	 $table3 = "";
	 $table4 = "";
	 $table5 = "";
	 $operation = "";
	 $flag = false;
	 $crudflag = false;
	 $typeflag = false;
	 $selectflag = false;
	 $insertflag = false;
	 $updateflag = false;
	 $deleteflag = false;
	 $other = false;
	 $fromflag = false;
	 $declareflag = false;
	 $queryflag = false;
	 $line1 = NULL; 
	 $q = array();
	 $b = array();
	 $c = array();
		$r = array();
		$d = array();
		$i = 0;
		$que2[$i] = array();
		
	 $file1 = fopen($file,'r');
	//echo "<br> $componentname";
	 $inc2= 0;
	 $inc1 = 0;
	 $inc5 = 0;
	  $arr1[$inc1] ="";
	  $inside_flag = true;
	  $arr0 = "";
	 while(!feof($file1))
	 {
			$line = fgets($file1);
			if((strpos($line,"//*") !== false))
			{
				continue;
			}
			if((strpos($line,"SQL") !== false) || ($crudflag == true))
			{  	
				
				//echo "<br>in loop" .$inc1;
				$count1 = 1;
				$crudflag = true;
				//echo "<br> EXECSQLline". $line;
				$queryflag = true;
				//$arr1[$inc1][$inc2] = $line ;
				$inc2++;	
				$arr0 = $arr0 . $line;
			
				
			}
			if((strpos($line,"*") !== false) && (strpos($line,"';'") == false))
			{
			$arr1[$inc1] = $arr0;	
			$crudflag = false;
			$queryflag = false;
			$inc1++;
			$arr0 = 0;
			}
			if($crudflag !== false)
			{
				$type = "JCL";
				$typeflag = true;
			}
			if($queryflag !== false)
			{
				
				$li = array();
				$li = $line;
				
			
			//	print_r($li);
				$que = explode("EXEC SQL",$li);
			//	print_r($que);
				// $que1 = implode($que);
				// print_r($que2);
				$line1 .= implode($que);
			//	echo "<br> line:" . $line1;
				$que2 = explode("END-EXEC",$line1);
			//
			//	$i = 0;
						
			}
		}
			
	 
	 
                echo "<pre>";
				//print_r($arr1);	
				$count = count($arr1);
	//			Echo "cc:".$count;
				//Echo "cc:".$count;
				$inc3 = 0;
				$inc4 = 0;
				while($inc3 < $count)
				{
				   if($arr1[$inc3] !== 0)
				   {
					$arr2[$inc4] = TRIM($arr1[$inc3]);
					$inc4++;
				   }
					$inc3++;
				}
			print_r($arr2);
			$new_count= count($arr2);
	//		echo "ccc:".$new_count;
			while($inc5 < $new_count) 	
			{
			$sel = explode("SELECT",$arr2[$inc5]);
			//print_r($sel);
			$co1 = count($sel);
			$inc6 = 0;
			while($inc6 < $co1) 	
			{
	        $que = explode("FROM ",$sel[$inc6]);
		//	echo "<br> $query";
			$que1 = explode(" ",trim($que[1]));
			//print_r($que1);
		//	echo "<br> table $que1[0] <br>";
			$table = $que1[0];
			 if(strpos($que[1],",") !== false)
			  {
				//echo "<br> $arr2[0]";
				$exp =  explode(",",$que[1]);
				// $table4 = $exp;
				$l = 0;
				$count2 = count($exp);
				while($l < $count2)
				{
					$t4 = explode(" ",trim($exp[$l]));
					$table = $t4[0];
			//		echo "<br>TABLE 5 - $table4";
				//	echo "<br> $table4";
					$l++;
			$operation = "READ";
			$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			$query = str_replace("0","",$query);
			$table = str_replace(";","",$table);
			//array($table,$operation,$componentname,$type,$query)
			fputcsv($outfile,array($table,$operation,$componentname,$type,$query));
				}
			  }
			  ELSE
			  {
			// echo $table;
			$operation = "READ";
			$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			$query = str_replace("0","",$query);
			$table = str_replace(";","",$table);
			//array($table,$operation,$componentname,$type,$query)
			fputcsv($outfile,array($table,$operation,$componentname,$type,$query));
			  }
			$inc6++;
			}
			$inc5++;
			}
			


     // $file2 = fopen($file,'r');

			// while(!feof($file2))
	        // {
			// $line = fgets($file2);
			// if((strpos($line,"//*") !== false))
			// {
				// continue;
			// }
			// if(((strpos($line," DELETE ") !== false)  && (strpos($line,"SELECT") == false)) || ($crudflag == true))
			// {  	
				
				// //echo "<br>in loop" .$inc1;
				// $count1 = 1;
				// $crudflag = true;
				// //echo "<br> EXECSQLline". $line;
				// $queryflag = true;
				// //$arr1[$inc1][$inc2] = $line ;
				// $inc2++;	
				// $arr0 = $arr0 . $line;
			
				
			// }
			// if(strpos($line,";") !== false)
			// {
			// $arr1[$inc1] = $arr0;	
			// $crudflag = false;
			// $queryflag = false;
			// $inc1++;
			// $arr0 = 0;
			// }
			// if($crudflag !== false)
			// {
				// $type = "JCL";
				// $typeflag = true;
			// }
			// if($queryflag !== false)
			// {
				
				// $li = array();
				// $li = $line;
				
			
			// //	print_r($li);
				// $que = explode("EXEC SQL",$li);
			// //	print_r($que);
				// // $que1 = implode($que);
				// // print_r($que2);
				// $line1 .= implode($que);
			// //	echo "<br> line:" . $line1;
				// $que2 = explode("END-EXEC",$line1);
			// //
			// //	$i = 0;
						
			// }
		// }
			
	 
	 
                // echo "<pre>";
				// //print_r($arr1);	
				// $count = count($arr1);
				// Echo "cc:".$count;
				// //Echo "cc:".$count;
				// $inc3 = 0;
				// $inc4 = 0;
				// while($inc3 < $count)
				// {
				   // if($arr1[$inc3] !== 0)
				   // {
					// $arr2[$inc4] = TRIM($arr1[$inc3]);
					// $inc4++;
				   // }
					// $inc3++;
				// }
			// print_r($arr2);
			// $new_count= count($arr2);
			// echo "ccc:".$new_count;
			// while($inc5 < $new_count) 	
			// {
			// $sel = explode("DELETE ",$arr2[$inc5]);
			// //print_r($sel);
			// $co1 = count($sel);
			// $inc6 = 0;
			// while($inc6 < $co1) 	
			// {
	        // $que = explode("FROM ",$sel[$inc6]);
			// echo "<br> $query";
			// $que1 = explode(" ",trim($que[1]));
			// //print_r($que1);
			// echo "<br> table $que1[0] <br>";
			// $table = $que1[0];
			// // echo $table;
			// $operation = "DELETE";
			// $query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			// $query = str_replace("0","",$query);
			// $table = str_replace(";","",$table);
			// //array($table,$operation,$componentname,$type,$query)
			// fputcsv($outfile,array($table,$operation,$componentname,$type,$query));
			// $inc6++;
			// }
			// $inc5++;
			// }
			
}
?>