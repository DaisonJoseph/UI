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
	$path = 'C:/xampp/htdocs/Crud_SAIRAM.csv';
	$outfile = fopen($path,'w');

	//$outputfile = fopen("C:/xampp/htdocs/sample1.csv","w");
	fputcsv($outfile,array("Table Name", "Operation", "Component Name", "Component Type", "SQL Query"));
	$directorypath = "C:/xampp/htdocs/CBL";
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
	 $componentname = $a[4];
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
		 
		 $line2 = fgets($file1);
		 // echo "line2";
		 
		 // echo "<br>".$line;
		 if(substr($line2,6,1) == "*")
		 {
			 //echo "comments ".$line2."<br>";
			 continue;
		 }
		 $line = substr($line2,7,65);
		 if((stripos($line,"IDENTIFICATION") !== false) && (stripos($line,"DIVISION.") !== false))
		 {
				echo "<br> $componentname";
				$flag = true;
		 }
		
		if($flag !== false)
		{	
			$var1 = " ";
			$inc =0;
			
			if(((strpos($line,"EXEC") !== false) && (strpos($line,"SQL") !== false))||($crudflag == true))
			{  	
				
				//echo "<br>in loop" .$inc1;
				$count1 = 1;
				$crudflag = true;
				//echo "<br> EXECSQLline". $line;
				$queryflag = true;
				//$arr1[$inc1][$inc2] = $line ;
				$inc2++;	
				$arr0 = $arr0 . $line;
					//if(strpos($line,"EXEC SQL")!== false && $count1 !== 1)
					//{
					//echo $inc1 ."iruku";
					//$flag = false;
					
				//	}
					
				// $line1 = $line;
				// echo "<br> line". $line1;
				
			}
			//echo "<br> var ".$arr0;
			if(strpos($line,"END-EXEC") !== false)
			{
			$arr1[$inc1] = $arr0;	
			$crudflag = false;
			$queryflag = false;
			$inc1++;
			$arr0 = 0;
			}
			if($crudflag !== false)
			{
				$type = "COBOL";
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
			
	 }
	 
                echo "<pre>";
				//print_r($arr1);	
				$count = count($arr1);
				Echo "cc:".$count;
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
			//	print_r($arr2);
				//$arr2 = explode($arr1[,"END-EXEC");
				//print_r($arr2);
	// //if((strpos($line,"END") !== false) && (strpos($line,"EXEC") !== false))
			// //{
		
			// $queryflag = false; 
			// $crudflag = false;
			// //	print_r($que2);
			// //echo "<br>";
			
			// $count = count($que2);
			// $inc2 = 0;
			// while($inc2 < $count)
			// {
		//	print_r($arr2);	
			$new_count= count($arr2);
			echo "ccc:".$new_count;
			while($inc5 < $new_count) 	
			{
			if(((preg_match("/\bINSERT\b/i",$arr2[$inc5])) && (preg_match("/\bINTO\b/i",$arr2[$inc5]))) && (((strpos($arr2[$inc5],"FETCH")) == FALSE) && (strpos($arr2[inc5],"-INSERT-") == FALSE)) )
			{
			if(strpos($arr2[inc5],"-INSERT-") !== TRUE)
			{
			//	ECHO "<BR> YESSSSSSSSSSSSSSSSSSSSSSSS $arr2[$inc5]";
				$insertflag = true;	
			}
			
				echo "<pre>";
				
			}
			elseif(preg_match("/\bDELETE\b/i",$arr2[$inc5])) 
			{	
			ECHO "<BR> YESSSSSSSSSSSSSSSSSSSSSSSS $arr2[$inc5]";
			
			$deleteflag = true;	
			}
			elseif( (strpos($arr2[$inc5]," UPDATE ") == false) &&(strpos($arr2[$inc5],"SELECT") !== false) )
			{
				$selectflag = true;
				echo "<br>  $arr2[$inc5]";
			}
			elseif( (strpos($arr2[$inc5]," UPDATE ") !== false) && (strpos($arr2[$inc5],"PIC") == false) )
			{
				$updateflag = true;
			}
			elseif(preg_match("/\bFROM\b/i",$arr2[$inc5]))
			{
			$fromflag = true;		
			}
				if(($deleteflag == true) && (strpos($arr2[$inc5],"-DELETE") == false))
			{
				//ECHO " <br> POKE";
				 $d = explode("FROM ",$arr2[$inc5]);
				//print_r($d);
			//	 if(preg_match("/T_IB/" ,$d[1]))
			//	 {
			//	ECHO "<br> $d[1]";
					 $dd = explode(" ",TRIM($d[1]));
			 //	var_dump($dd);
				$table3 = trim($dd[0]);
				ECHO "<br> $table3"."<BR>";
			//	 }
			if(strpos($table3,".") !== false)
			{
				 $table3 = explode(".",TRIM($table3));
			 //	var_dump($dd);
				$table31 = trim($table3[1]);
				ECHO "<br> $table31"."<BR>";
				
			}
			else
			{
				$table31 = $table3;
			}
				
				 $operation = "DELETE";
				 $deleteflag = false;
				 $fromflag = false;
				   if($table3 == "")
				 {
				 $operation = "";
				 continue;
					
				 }
				 $query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
				 $query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				$query = trim($query);
				 fputcsv($outfile,array($table31,$operation,$componentname,$type,$query));
				 if(strpos($query,"SELECT") !== false)
				 {
			        $selectflag = true;
				 }
		
				
			}
			ELSE
			{
			}
			if(($insertflag == true))
			{
			print_r($arr2[$inc5]);
			
			
				 $b = explode("INTO",$arr2[$inc5]);
			//	var_dump($b);
			//	  if(preg_match("/T_IB/",$b[1]))
			//	 {
					 $sr = trim($b[1]," ");
				//	echo "<br> $sr";
					 $arr11 = explode(" ",$sr);
				//	 echo "<br> $arr11[0]";
					 if(strpos($arr11[0],"(") !== false)
					 {
						 $mon = explode("(",$arr11[0]);
						 $table1 = trim($mon[0]);
					 }
					 elseif(strpos($arr11[0],".") !== false)
					 {
						 $mon = explode(".",$arr11[0]);
						 $table1 = trim($mon[1]);
					 }
					 else
					 {
					//print_r($arr);
				 $table1 = trim($arr11[0]);
					 }
		    //	 ECHO "<br> $table1"."<BR>";
			//	 }
				 $operation = "INSERT";
				 $insertflag = false;
				 // if($table1 == ":WSBCHAND-HAND-ID,")
				 // {
					 // $table1 = "";
				 // }
				   if($table1 == "")
				 {
				//	
				// $componentname = "";
				// $type = "";
				 $operation = "";
			//	 $query = $li;
				 continue;
					
				 }
		//	 echo "<br> helloooooooooooooooo";
	         	$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
				$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				 fputcsv($outfile,array($table1,$operation,$componentname,$type,$query));
 				 if(strpos($query,"SELECT") !== false)
				 {
				  // $ar12 = explode("FROM",$query);
				  // $ar13 = explode("WHERE",$ar12[1]);
				  $selectflag = true;
				 }

				 
			}
			
			if($updateflag !== false)
			{
				//echo "<br> D====== $line";
				//echo "<br> $line1";
				 $c = explode("UPDATE ",$arr2[$inc5]);
				//print_r($c);
			//	 if(preg_match("/T_IB/" ,$c[1]))
			//	 {
				//	 ECHO "<br> $c[1]";
				     $sr1 = trim($c[1]," ");
				//	 echo "<br> $sr1";
					 $arr1 = explode(" ",$sr1);
				//	 var_dump($arr1);
				 $table2 = trim($arr1[0]);
		//		 ECHO "<br> $table2";
			//	 }
			if(strpos($table2,".") !== false)
			{
				 $table2 = explode(".",TRIM($table2));
			 //	var_dump($dd);
				$table21 = trim($table2[1]);
				ECHO "<br> $table21"."<BR>";
				
			}
			else
			{
				$table21 = $table2;
			}
				 $operation = "UPDATE";
				 $updateflag = false;
				   if($table2 == "")
				 {
				 $operation = "";
				 continue;	
				 }
				 $query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
				 $query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				 fputcsv($outfile,array($table21,$operation,$componentname,$type,$query));
				 if(strpos($query,"SELECT") !== false)
				 {
				  // $ar12 = explode("FROM",$query);
				  // $ar13 = explode("WHERE",$ar12[1]);
				  $selectflag = true;
				 }
				
			}
			if(($selectflag == true))
		    	{
				 $rs = "";
				 // $query1 = array();
				 // $query1[] = $que2[$inc2];
				 // $fquery .= implode($query1);
				  echo "<pre>";
			   // print_r($fquery);
				 $q = explode(" FROM ",$arr2[$inc5]);
				// echo "<pre>";
			//    print_r($q);
			//	 if(preg_match("/T_IB/",$q[1]))
			//	 {
					$rs = trim($q[1]," ");
				//	 echo "<br> $rs";
					 $arr22 = explode("WHERE",$rs);
			 
			  if((strpos($arr22[0],"JOIN") !== false))
			  {
			   $k = trim($arr22[0]);
			   
			  
			//   if(strpos($arr22[0],"T_IB") !== false)
			//   { 
		   if((strpos($arr22[0],"(((") !== false) || (strpos($arr22[0],"((((") !== false))
		   { 
			$tab4  = explode("(((",$arr22[0]);   
			   $ta4 = explode(" ",trim($tab4[1]));
			   $table4 = $ta4[0];
		//	   echo "<br>TABLE 8 - $table4";
			   if($table4 == "S")
			   {
				   $table4 = "";
			   }
			    $operation = "READ";
				 $selectflag = false;
				 $fromflag = false;
				 if($table4 == "")
				 {
				 $operation = "";
				 continue;
				 }
				// $query = implode($que2[$inc2]);
				$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			//	echo " arrya<br>";
			// echo"<pre>";
			// print_r($exp);
			 
				// $i1=0;
				// while($i1<$arr_count)
				// {
					$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table4," ") !== false)
				{
					$table4 = explode(" ",$table4);
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace(array("REGISTR_TIME_AT_UC","MAKRO_VARIABEL"),"INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE64 - $table4[0]";
					fputcsv($outfile,array($table4[0],$operation,$componentname,$type,$query));
					
				}
				elseif($table4 !== "")
				{
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE54 - $table4";
					 fputcsv($outfile,array($table4,$operation,$componentname,$type,$query));
				}
		
		   }
		   // if(strpos($arr2[0],"JOIN") !== false)
		   // {
			  // $tab4  = explode("JOIN",$arr2[0]);
			   // $ta4 = explode(" ",trim($tab4[1]));
				// $table4 = $ta4[0];			  
		   // }
		  
		   
		   elseif(strpos($arr22[0]," ") !== false)
		   {
			   $tab4  = explode(" ",$arr22[0]);   
			   $table4 = $tab4[0];
		//	   echo "<br>TABLE 6 - $table4";
			   if($table4 == "S")
			   {
				   $table4 = "";
			   }
			    $operation = "READ";
				 $selectflag = false;
				 $fromflag = false;
				 if($table4 == "")
				 {
				 $operation = "";
				 continue;
				 }
				// $query = implode($que2[$inc2]);
				$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			//	echo " arrya<br>";
			// echo"<pre>";
			// print_r($exp);
			 
				// $i1=0;
				// while($i1<$arr_count)
				// {
					$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table4," ") !== false)
				{
					$table4 = explode(" ",$table4);
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE10 - $table4";
					fputcsv($outfile,array($table4[0],$operation,$componentname,$type,$query));
					
				}
				elseif($table4 !== "")
				{
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE9 - $table4";
					 fputcsv($outfile,array($table4,$operation,$componentname,$type,$query));
				}
		   }
			//   }
			   }
		  
			  elseif(strpos($arr22[0],",") !== false)
			  {
				//echo "<br> $arr2[0]";
				$exp =  explode(",",$arr22[0]);
				// $table4 = $exp;
				$l = 0;
				$count2 = count($exp);
				while($l < $count2)
				{
					$t4 = explode(" ",trim($exp[$l]));
					$table4 = $t4[0];
			//		echo "<br>TABLE 5 - $table4";
				//	echo "<br> $table4";
					$l++;
				$operation = "READ";
				 $selectflag = false;
				 $fromflag = false;
				 if($table4 == "")
				 {
				 $operation = "";
				 continue;
				 }
				// $query = implode($que2[$inc2]);
				$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			//	echo " arrya<br>";
			// echo"<pre>";
			// print_r($exp);
			 
				// $i1=0;
				// while($i1<$arr_count)
				// {
					$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table4," ") !== false)
				{
					$table4 = explode(" ",$table4);
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE8 - $table4";
					fputcsv($outfile,array($table4[0],$operation,$componentname,$type,$query));
					
				}
				elseif($table4 !== "")
				{
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace("OBJEKTNR","OBJTREKL",$table4);
					$table4 = str_replace("KOMKOD","ATGTKOMM",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE7 - $table4";
					 fputcsv($outfile,array($table4,$operation,$componentname,$type,$query));
				}
				}
				
			  }
			
			  else
			  {
				$table4 =  trim($arr22[0]);
	//			echo "<br>TABLE 4 - $table4";
				if($table4 == "S")
			   {
				   $table4 = "";
			   }
				$operation = "READ";
				 $selectflag = false;
				 $fromflag = false;
				 if($table4 == "")
				 {
				 $operation = "";
				 continue;
				 }
				// $query = implode($que2[$inc2]);
				$query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
			//	echo " arrya<br>";
			// echo"<pre>";
			// print_r($exp);
			 
				// $i1=0;
				// while($i1<$arr_count)
				// {
					$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table4," ") !== false)
				{
					$table4 = explode(" ",$table4);
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					$table4 = str_replace("OBJEKTNR","OBJTREKL",$table4);
					$table4 = str_replace("KOMKOD","ATGTKOMM",$table4);
					// if((strpos($query,"SELECT CASE") !== false) && ($table !== "ANSTKRLM"))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE7 - $table4[0]";
					fputcsv($outfile,array($table4[0],$operation,$componentname,$type,$query));
					
				}
				elseif($table4 !== "")
				{
			//		$table4 = str_replace("SYSIBM.","",$table4);
					$table4 = str_replace("EFF_DATUM","OBJTSPFU",$table4);
					$table4 = str_replace("HAGR_ID","WSBTPRGR",$table4);
					$table4 = str_replace("A.RISK_DAT","OBJTRIH1",$table4);
					$table4 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table4);
					$table4 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table4);
					$table4 = str_replace("A.OBJEKTNR","OBJTRIH1",$table4);
					$table4 = str_replace("OMSAR","INDTKOMS",$table4);
					$table4 = str_replace(")","",$table4);
					// if((strpos($query,"SELECT CASE") !== false) && ($table4 !== "ANSTKRLM"))
					// {
					// $table4 = str_replace("S","SYSIBM.SYSDUMMY1",$table4);
					// }
					echo "<br>TABLE6 - $table4";
					 fputcsv($outfile,array($table4,$operation,$componentname,$type,$query));
				}				
			  }
			   

				
				
				if((strpos($arr22[0],"JOIN") !== false) )
		    	{
				
			//	ECHO"<BR> JOINNNNNN";
//				  echo "<pre> $que2[$inc2]";
			   // print_r($fquery);
				  $tab5  = explode("JOIN",$arr22[0]);
			//	  print_r($tab5);
				 $i = 1;
			  $co1 = count($tab5);
				// $ta5 = array();	
					 while($i < $co1) 
					 {
					$ta5 = explode(" ",trim($tab5[$i]));
					$table5 = $ta5[0];
			//		ECHO "<br> haha $table5";
			    $query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
				$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table5," ") !== false)
				{
					$table5 = explode(" ",$table5);
				//	ECHO "<br>7 $table5[0]";
			//		$table5 = str_replace("SYSIBM.","",$table5[0]);
					$table5 = str_replace("EFF_DATUM","OBJTSPFU",$table5);
					$table5 = str_replace("HAGR_ID","WSBTPRGR",$table5);
					$table5 = str_replace("A.RISK_DAT","OBJTRIH1",$table5);
					$table5 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table5);
					$table5 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table5);
					$table5 = str_replace("A.OBJEKTNR","OBJTRIH1",$table5);
					$table5 = str_replace("OMSAR","INDTKOMS",$table5);
					$table5 = str_replace(")","",$table5);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table5 = str_replace("S","SYSIBM.SYSDUMMY1",$table5);
					// }
					echo "<br>TABLE5 - $table5";
					fputcsv($outfile,array($table5,$operation,$componentname,$type,$query));
					
				}
				else
				{
					  ECHO "<br>8 $table5";
			//		  $table5 = str_replace("SYSIBM.","",$table5);
					  $table5 = str_replace("EFF_DATUM","OBJTSPFU",$table5);
					  $table5 = str_replace("HAGR_ID","WSBTPRGR",$table5);
					  $table5 = str_replace("A.RISK_DAT","OBJTRIH1",$table5);
					  $table5 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table5);
					  $table5 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table5);
					  $table5 = str_replace("A.OBJEKTNR","OBJTRIH1",$table5);
					  $table5 = str_replace("OMSAR","INDTKOMS",$table5);
					  $table5 = str_replace(")","",$table5);
					// if((strpos($query,"SELECT CASE") !== false))
					// {
					// $table5 = str_replace("S","SYSIBM.SYSDUMMY1",$table5);
					// }
					echo "<br>TABLE4 - $table5";
					 fputcsv($outfile,array($table5,$operation,$componentname,$type,$query));
				}
					$i++;
				 }  
				
				}
		
					$ta6 = explode(" ",trim($q[2]));
					$table6 = $ta6[0];
				//	echo "TABLE03 - $table6";
				//	ECHO "<br> $table6";
			    $query = trim(preg_replace('/\s+/'," ",$arr2[$inc5]));
				$query = str_replace("0 EXEC SQL","",$query);
				$query = str_replace("END-EXEC","",$query);
				$query = str_replace("END-EXEC.","",$query);
				if(strpos($table6,".") !== false)
				{
				//	echo "TABLE044 - $table6[0]";
			//		$table6 = explode(".",$table6);
				//	$table6 = str_replace("SYSIBM.","",$table6);
					$table6 = str_replace("EFF_DATUM","OBJTSPFU",$table6);
					$table6 = str_replace("HAGR_ID","WSBTPRGR",$table6);
					$table6 = str_replace("A.RISK_DAT","OBJTRIH1",$table6);
					$table6 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table6);
					$table6 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table6);
					$table6 = str_replace("A.OBJEKTNR","OBJTRIH1",$table6);
					$table6 = str_replace("OMSAR","INDTKOMS",$table6);
					$table6 = str_replace(")","",$table6);
					// if((strpos($query,"SELECT CASE") !== false) && ($table6 !== "ANSTKRLM"))
					// {
					// $table6 = "SYSIBM.SYSDUMMY1";
					// }
					echo "TABLE2 - $table6";
					fputcsv($outfile,array($table6,$operation,$componentname,$type,$query));
					
				}
				elseif($table6 !== "")
				{
			//		$table6 = str_replace("SYSIBM.","",$table6);
					$table6 = str_replace("EFF_DATUM","OBJTSPFU",$table6);
					$table6 = str_replace("HAGR_ID","WSBTPRGR",$table6);
					$table6 = str_replace("A.RISK_DAT","OBJTRIH1",$table6);
					$table6 = str_replace("REGISTR_TIME_AT_UC","INDTMAVA",$table6);
					$table6 = str_replace("MAKRO_VARIABEL","INDTMAVA",$table6);
					$table6 = str_replace("A.OBJEKTNR","OBJTRIH1",$table6);
					$table6 = str_replace("OMSAR","INDTKOMS",$table6);
					$table6 = str_replace(")","",$table6);
					// if((strpos($query,"SELECT CASE") !== false) && ($table6 !== "ANSTKRLM"))
					// {
					// $table6 = "SYSIBM.SYSDUMMY1";
					// }
					 echo "TABLE2 - $table6";
					 fputcsv($outfile,array($table6,$operation,$componentname,$type,$query));
				}
				if(strpos($query,"SELECT CASE") !== false)
				{
				  $tab12 = explode("FROM",$arr2[$inc5]);
				  $in12 = 0;
				  $c12 = count($tab12);
				  while($in12 < c12)
				  {
					 $tab13 = explode(" ",$tab12[$in12]);
                     if(strpos($tab13[0],")") !== false)
					 {
						 $table = str_replace(")","",trim($tab13[0]));
						 
					 }
					 else
					{
						$table = trim($tab13[0]);
						
					 }
					 // if((strpos($query,"SELECT CASE") !== false) && ($table !== "ANSTKRLM"))
					// {
					// $table = str_replace("S","SYSIBM.SYSDUMMY1",$table);
					// }
					echo "TABLE1 - $table";
					fputcsv($outfile,array($table,$operation,$componentname,$type,$query));					 
					 $in12++; 
				  }
				}
				
			}
			
			$inc5 = $inc5 + 1;
			
				}
			}
?>