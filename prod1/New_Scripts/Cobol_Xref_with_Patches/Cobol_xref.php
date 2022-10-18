<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Kolkata');
echo date('H:i:s') . "<br>"."COBOL XREF - Start" ;
$dir = "C:/Users/ararames/Downloads/CBL/*";
// $dir = "C:/xampp/htdocs/UCAB/sample/*";
$outfile = fopen("C:/xampp/htdocs/UCAB/Reports/Version_8_1/SAi_RAm.csv","w");
// $outfile = fopen("C:/xampp/htdocs/UCAB/cicslink.csv");
$master = fopen("C:/xampp/htdocs/UCAB/Reports/Masterinvnetory_uc_V6_1.csv","r");
global $csv_data;
global $file;
while(!feof($master))
{
	$get_csv = fgetcsv($master);
	$csv_data[] = $get_csv;
}
fclose($master);
				$writehead = "Calling Component" . "," . "Calling Type" . "," . "Called Component" . "," . "Called Type" . "," . "Call Type";
				fputcsv($outfile,explode(",",$writehead));
foreach(GLOB ($dir) as $file)
{  //$file = "C:/xampp/htdocs/ryder/sourcecode/Splitted_Files/MF_COBOL/AR270P00.txt";
  $file_handle = fopen($file,"r");
  $calling_comp = basename($file,".txt");
  $calling_type = "COBOL";
  $folder_path = "";
  $called_comp = "";
  $call_type = "";
  $linecount = 0;
  $linebefore = 0;
  $assComp = array("AA09A0","ADLAATR ","ADMAATR","BITOP","BTUNP","CGACVD30","CGACVD40","CGACVT","CGACVT30","CGACVT40","CGACVTD","CGADATE","FONET2","FONET2CI","GC9620","GC9630","GC9500","GG0017","GG0026","GG0027","GG7000","GG7100","HYFSAN","HYFSANCI","HYFSEX","HYFSEXCI","MATCH","MTOWAIT","STRING","TIMESTMP","UCDYNALL","UCRBA2","USRTMSTP","WMDYNINQ","CBLTDLM","MOVEFELT","BITBCD","BITNER","HYFSNB","BCDBIT","ADLAATR","WMDYNINQ");
  while(!feof($file_handle))
  {   //$called_type = "COBOL";
	  $line = fgets($file_handle);
			$linecount++;
			// echo $linecount;
			// $linebefore = $linecount - 1;
			// echo $linebefore;
	  $line = substr($line,6,66);
	  $line1 = trim(preg_replace('/\s+/'," ",$line));
	  $ary = explode(" ",$line1);
	  if($ary[0] == "COPY")
	  {
		  {
			  // if($ary[1] !== "SQLCA")
		  $called_comp = $ary[1];
		  $called_type = "COPYBOOK";
		 $call_type = "";
		  if(stripos($called_comp,".")!==false)
		  {
		      $called_comp = trim(str_ireplace(".","",$called_comp));
		  }
		      // $receive = checktype($called_comp);
			  // echo "the receive folder type is" . $receive[1];
			  // $called_type = $receive[0];
			  // $folder_path = $receive[1];
		  }  
	  }
	  
	  if($ary[0] == "INCLUDE")
	  {
		  {
			  if($ary[1] !== "SQLCA")
		  $called_comp = $ary[1];
		  $called_type = "DCLGEN";
		 $call_type = "";
		  if(stripos($called_comp,".")!==false)
		  {
		      $called_comp = trim(str_ireplace(".","",$called_comp));
		  }
		      // $receive = checktype($called_comp);
			  // echo "the receive folder type is" . $receive[1];
			  // $called_type = $receive[0];
			  // $folder_path = $receive[1];
		  }  
	  }
	  
	  if($ary[0] == "CALL")
	  {
		  $check = $ary[1];
		  if((stripos($check,"'")!==false) || (stripos($check,'"')!==false))
		  {  if(stripos($check,"'")!==false)
			    $called_comp = trim(str_ireplace("'","",$check));
		     else
			    $called_comp = trim(str_ireplace('"','',$check));
			 $call_type = "STATIC";
					if(in_array($called_comp,$assComp)) 
					{
						$called_type = "ASSEMBLER";
					}
					else
					{
						$called_type = "COBOL";
					}	
		  }
		  else
		  {

			  $called_comp = call($check,$linecount);
			  if(stripos($called_comp,"'")!==false)
			  {
			    $called_comp = trim(str_ireplace("'","",$called_comp));
			  }
		      else
			  {
			     $called_comp = trim(str_ireplace('"','',$called_comp));
			  }
			  $call_type = "DYNAMIC";
					  if(in_array($called_comp,$assComp)) 
					{
						$called_type = "ASSEMBLER";
					}
					else
					{
						$called_type = "COBOL";
					}
		  }
		  if(stripos($called_comp,".")!==false)
		  {
		      $called_comp = trim(str_ireplace(".","",$called_comp));
		  }
		      // $receive = checktype($called_comp);
			  // echo "the receive folder type is" . $receive[1];
			  // $called_type = $receive[0];
			  // $folder_path = $receive[1];
	  }
	  
	  if(!empty($called_comp))
	  {   if(stripos($called_type,".")!==false)
		  {
		      $called_type = trim(str_ireplace(".","",$called_type));
		  }
		       
              $write = $calling_comp . "," . $calling_type . "," . $called_comp . "," . $called_type . "," . $call_type;
		      fputcsv($outfile,explode(",",$write));
		      $called_type = "";
		      $called_comp = "";
	  }
	  unset($ary);
  }
  
			// echo $linecount;
}

function call($check,$linecount)
{
	global $file;
	$get_line = fopen($file,"r");
	echo $file;
	$linecount2 = 0;
	$linebefore = 0;
	// echo "Line Count";
	while(!feof($get_line))
	{
		$data = fgets($get_line);
			$linecount2++;
			// echo $linecount."previous";
			// echo $linebefore."<br>";
		$data1= substr($data,6,66);
		if(substr($data1,0,1)!== "*")
		{
		   $line_one = trim(preg_replace('/\s+/'," ",$data1));
		   $ary1 = explode(" ",$line_one);
		   // echo $linebefore."<br>";
		   // if(($ary1[0] == "MOVE") && ($ary1[1] == $check))
		   if(($ary1[0] == "CALL") && ($ary1[1] == $check) && $linecount2==$linecount)
		   {
			   echo $data1."<br>";
			   $store[] = $data1;
			   break;
		   }
		   else
		   {
		   	$store[] = $data1;
			// echo $data1;
		   }
		 }
		 
		unset($ary1);
	}
	// echo $store[count($store)-1];
	for($i=(count($store)-1);$i >=0;$i--)
	{    
		 $called_comp = "";
         if(stripos($store[$i],$check)!==false)
		 {
		   $data2 = trim(preg_replace('/\s+/'," ",$store[$i]));
		   $ary2 = explode(" ",$data2);
		   if(count($ary2)>3)
		   {
		     if((is_numeric($ary2[0])) && (trim($ary2[1]) == trim($check)))
		     {
				 if(trim($ary2[4]) == "VALUE")
			     {   
					$called_comp = $ary2[5];
					// echo $called_comp."@4";
			     }
			     elseif($ary2[2] == "VALUE")
			     {    
					$called_comp = $ary2[3];
					// echo $called_comp."@2";
			     }    
		     }
			 elseif(($ary2[0] == "MOVE") && strpos($store[$i],$check)!== false)
			 {
				 // echo $store[$i]."<br>";
				 $ind = in_array("TO",$ary2);
			   // echo $ind;
				$called_comp = str_replace("'","",$ary2[$ind]);
				// echo $called_comp."@move";
			 }
		   }
		 }
		 if(!empty($called_comp))
		 {   
	       return($called_comp);
		   break;
		 }
		 unset($ary2);
	}		 
		   
}
function checktype($called_comp)
{
	global $csv_data;
	$t_flag = false;
	$types = array("DCLGEN","COPYBOOK","COBOL","BMSMAP");
	// echo "<br>the called_comp is" . $called_comp;
	foreach($csv_data as $csv)
	{
		if(in_array($called_comp,$csv))
		{
			// echo "<br>component name is-----" . $csv[0] . "the given name is-----" . $called_comp . "----type is---- " . $csv[1];
			if(in_array($csv[1],$types))
			{  
		// echo "<br>available" . $csv[3];
			 $t_flag = true;
			 return(array($csv[1],$csv[3]));
			 break;
			}
		}
	}
	if($t_flag == false)
	{
		return (array("UNKNOWN","missing"));
	}
}
echo "</br> XREF completed";
?>