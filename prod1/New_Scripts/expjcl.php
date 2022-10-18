<?php
error_reporting(E_ALL);
    //ob_implicit_flush(true);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0);
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    date_default_timezone_set('Asia/Kolkata');

    echo date('H:i:s') . " JCL XREF - Start" . EOL;
$count = 0;


//$dir = "/var/www/html/cap360/CAP360_Automation/Source_Dump/Source_Code_NEW/JCL/*";
$files1 = array();
// $dirPath = "C:/xampp/htdocs/UC-BANK/Overall_source/JCL";
// $dirPath = "C:/xampp/htdocs/UC-BANK/str_src/JCL_PROCS";
// $dirPath = "C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/JCL";
$dirPath = "C:/xampp/htdocs/UCAB/Source_May_07/Overall_Source_May7_20/JCL";

searchFilesInDirectory($dirPath);
function searchFilesInDirectory($dirPath) 
{
   global $files1;
   if (! is_dir($dirPath)) {
       throw new InvalidArgumentException("$dirPath must be a directory");
   }
   if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
       $dirPath .= '/';
   }
   $files = glob($dirPath . '*', GLOB_MARK);
   foreach ($files as $filee) {
       if (is_dir($filee)) {
           searchFilesInDirectory ($filee);
       } else {
		   if(stripos($filee,"UTPKTX0A") === false && stripos($filee,"UTPKTX1A") === false && stripos($filee,"UTPKTX2A") === false && stripos($filee,"UTPKTX3A") === false && stripos($filee,"UTPKTX4A") === false && stripos($filee,"XSPC") === false)
		   {
			array_push($files1, $filee);
		   }
       }
   }
}
// $files1 = ["Sairam"];
$proc_name = "";
$line1 = "";
$secpart="";
$csvfile = fopen("Missedcomponents.csv","w");
$insert = ("Program Name" . "," . "Missed file name");
$symbolicFlag=false;
fputcsv($csvfile, explode(",",$insert));
$csvfile1 = fopen("foundcomponents.csv","w");
$insert2 = ("Program Name" . "," . "Missed file name");
fputcsv($csvfile1, explode(",",$insert2));
fclose($csvfile1);
global $symbolicFlag;
//foreach (glob($dir) as $file)
foreach ($files1 as $file) 
{
	$count++;
	// echo "<br>ReadingFile" . $file;
	// $file = "C:/xampp/htdocs/UC-BANK/str_src/JCL_PROCS/REOJANMU";
	$folderName = basename(dirname($file));
	$extensionName = pathinfo($file,PATHINFO_EXTENSION);
	$dotExtension = "." . $extensionName;
	$programName = basename($file, $dotExtension);
	echo $count."programName:".$programName."<br>";
	// if (!file_exists("C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/EXPJCL/".$programName))
	if (!file_exists("C:/xampp/htdocs/UCAB/Source_May_07/Expanded_JCL0705/".$programName))
	// if (!file_exists("C:/xampp/htdocs/UC-BANK/str_src/EXPJCL/".$programName))
	{
		// echo "<br>ReadingFile" . $file;

        $file_handle = fopen($file, "r");
	    $i = 0;
		$continueFlag = 0;
	    $outputLine = array();
	    $dsnflag = false;
	    //$write_file=fopen("C:/source/expandjcl/".$programName.".ASCII","w");
	    // $write_file=fopen("C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/EXPJCL/".$programName,"w");
	    $write_file=fopen("C:/xampp/htdocs/UCAB/Source_May_07/Expanded_JCL0705/".$programName,"w");
	    // $write_file=fopen("C:/xampp/htdocs/UC-BANK/str_src/EXPJCL/".$programName,"w");
        while(! feof($file_handle))
	    {
			
	    	$line = strtoupper(fgets($file_handle));
			if(!empty($line)){
				//// echo "line" .$line;			
				$lineuniSpaces = preg_replace("/\s+/"," ",$line); //trim(preg_replace('/[\t\n\r\s]+/','',$line));
				$linearray = array();
				$linearray = explode(" ",$lineuniSpaces);
				// writeOutput($line);
				//// echo "start".$line;
				$line1 ="";
				// if(((stripos($line," EXEC " )!==false) or (stripos($line," PROC=" )!==false)) && stripos($line," PGM=") ==false)
				// {
					// $line1 = str_replace("//","//*",$line);
					// $outputLine[$i] = $line1;
				// }
				// else{
					$outputLine[$i] = $line;
				// }//// echo "line" .substr($line,-1,1);
				
				$i = $i +1;
				if(($continueFlag == 1) && (substr(trim($line),-1,1)!==",")  && (substr($line,0,3) != "//*"))
				{
					$continueFlag = 0;
					
					expandProc($write_file,$csvfile);
				}
				
				if($continueFlag == 0)
				{
					
				findProc($line,$linearray);
				//// echo "<br>kk" . $file;
				}
			}
		}
		
	WriteLine($outputLine);
	fclose($write_file);
	fclose($file_handle);
	}
}
// function writeOutput($line)
// {
	// global $i;
	
// }
fclose($csvfile);

function findProc($findline,$findlinearray)
{
	global $proc_name, $write_file;
	global $dsnflag;
	global $proc_linearray;
    global $proc_line;
	global $formatching;
	global $continueFlag;
	global $csvfile;
	//echo "---***-----" . $findline . "****" ."<br>";
	if(count($findlinearray) > 1)
	{
		if (substr($findline,0,3) != "//*")
		{
		    $findline1 = $findline;
			
			$findline=str_ireplace(","," ",$findline);
			$findline = preg_replace("/\s+/"," ",$findline);
			$findlinearray=explode(" ",$findline);
			$lineCount = count($findlinearray);
			if($lineCount>2)
			{
			$pgm=preg_match("/PGM=/", $findlinearray[2]);
			}
			if(($continueFlag == 1) && (substr($findline,-1,1)==","))
			{
				// $outputLine[$i] = $line;
				// $i = $i +1;
			}
			if(($continueFlag == 1) && (substr($findline1,-1,1)!==","))
			{
				// $outputLine[$i] = $line;
				// $i = $i +1;
		
				$continueFlag = 0;
				expandProc($write_file,$csvfile);
			}
			if(($findlinearray[1] == "EXEC") && ($pgm<>1))
			{  
				
				if(stripos($findline,"PROC=")==true)
				{
					$findline=substr($findline,0,70);
					
					$pos=stripos($findline,"PROC=");
					$pos=$pos+5;
					$proc_name_temp=substr($findline,$pos);
					$proc_name_array=explode(" ",$proc_name_temp);
					//// echo "proc anme in proc= : " . $proc_name_array[0]. "<br>";
					$proc_name=$proc_name_array[0];
					
					
					
					
					
				}
		        else
				{
				//// echo "<br>came here" . "<br>";
				$proc_name = $findlinearray[2];
				$proc_name = str_replace("," ," ",$proc_name);
				$proc_name = trim($proc_name);
				 // echo "<br> procname" .$proc_name . "-" .$formatching ."<br>";
				
				}
				$findLineCheck = trim($findline1);
			//	// echo "findLine" .substr($findLineCheck,-1,1);
				
				if(substr($findLineCheck,-1,1) == ",")
					{
						$continueFlag = 1;
					}
				
				if(($formatching!==trim($proc_name)) && ($continueFlag == 0))
				{
					$dsnflag=false;
					expandProc($write_file,$csvfile);
				}
			  
			}			
             if((stripos($findline,"DSN=")==true) && (stripos($findline,"(")==true))
			 {
				 // echo "here in dsn" .$findline1. "<br>";
				$dsnflag = true;
				$dsnpos = stripos($findline1,"DSN=");
				$dsnpos = $dsnpos + 4;
				$templine = substr($findline1,$dsnpos);
				if(stripos($templine,",")<>0)
				{	
				$commapos = stripos($templine,",");
				$len = strlen($templine);
				$templine = substr($templine,1,$commapos);
				}		
				if(stripos($templine,"("))
				{
                				
				$openbr=explode("(",$templine);
				$template=str_ireplace(")"," ",$openbr[1]);
				$templatearray=explode(" ",$template);
				$proc_name=$templatearray[0];
				 //echo "<br> dsn" .$proc_name . "-" .$formatching ."<br>";
				expandProc($write_file,$csvfile);
				}
			}		
		}	
	}		
}			
			
function expandProc($write_file,$csvfile)
{   global $dsnflag;
	global $proc_name;
	global $outputLine;
	global $line1;
	global $i; 
	global $formatching;
	global $programName;
	global $symbolicFlag;
	global $progname;
	global $nullflag;
	global $m;
	$inputarry=array();
	$type = "";
	$procfile1= "";
	 //// echo "hiii <br>";
	if($dsnflag==true)
	 { 
		// echo "66" . "<br>";
	   $procfile= "C:/xampp/htdocs/UCAB/Source_May_07/Overall_Source_May7_20/CONTROL_CARDS/".$proc_name;
       $dsnflag=false;
	   $procfilecheck = $procfile;
	   $found = check($procfilecheck);
	   $procfile1 = $found;
	   $formatching=$proc_name;
	   $type="PARMLIB";
	 
	 }
	else
	{	
	    // $procfile1 = "C:/xampp/htdocs/UC-BANK/Overall_source_MAR19_v1/Overall_source_MAR06/PROC/".$proc_name;
		$procfile1 = "C:/xampp/htdocs/UCAB/Source_May_07/Combinedproc/".$proc_name;
	    // if(!file_exists($procfile1))
		// {
			// echo "kk";
			// $procfile1 = "C:/xampp/htdocs/UC-BANK/str_src/PROCS/".$proc_name.$programName;
		// }
		// echo "$procfile1<br>";
	     $formatching=$proc_name;
		   $type="PROC";
		 
	}
	// echo "proc file found : " .$procfile1."<br>";
		if(file_exists($procfile1))
		{
			
			// echo "procfile" . $procfile1 . "<br>";
			$csvfile1 = fopen("foundcomponents.csv","a");
		  $insert11 = ($programName . "," . $proc_name . ",". $type);
		  fputcsv($csvfile1, explode(",",$insert11));
		  fclose($csvfile1);
		  
		$proc_file_handle = fopen($procfile1, "r");
		$startstatement="//********************EXPANSION " .$proc_name. " START**********************";
		$endstatement="//*******************EXPANSION " .$proc_name. " END**********************";
		$outputLine[$i]= $startstatement . "\n";
		$i = $i +1;
		//array_push($inputarry,$proc_name)
			while(! feof($proc_file_handle))
			{
				
				$proc_line = strtoupper(fgets($proc_file_handle));	
				$proc_lineuniSpaces = trim(preg_replace("/\s+/"," ",$proc_line));
				//ECHO "IN XXX " . $proc_line. "<BR>";
				$proc_linearray = array();
				$proc_linearray = explode(" ",$proc_lineuniSpaces);
				// if($proc_linearray[1] == "PROC")
				// {
					// $proc_line = str_replace("//","//*",$proc_line);
					// $outputLine[$i] = $proc_line;
				// }
				// else{
					$outputLine[$i] = $proc_line;
				// }
				$i = $i +1;
				findProc($proc_line,$proc_linearray);
				$proc_line = "";
                print_r ($outputLine[$i]);				
			}	
        $outputLine[$i]= $endstatement . "\n";
		$i = $i +1;
		
		fclose($proc_file_handle);
		}
		else
		{			
		  // echo "proc_name not in csv" . $proc_name ;
		  $csvfile = fopen("Missedcomponents.csv","a");
		  $insert1 = ($programName . "," . $proc_name . ",". $type);
		  fputcsv($csvfile, explode(",",$insert1));
		  fclose($csvfile);
		}
		//break; 
	// }
	 
}
//-----------------------------------------------------------------------------------------------//
function check($procfilecheck)
{  
	global $proc_name;
    $found1 = "";
	 foreach(glob($procfilecheck) as $procfile1)
	{  
	    $found1 = $procfile1;
		break;
	}
	$formatching=$proc_name;
	return $found1;
}
//-----------------------------------------------------------------------------------------------//
function WriteLine($outputLine)
{
	global $write_file;
	global $outputLine;
	global $outputLine_dsn;
	global $startstatement;
	global $endstatement;
	$execFlag = 0;
	$procFlag = 0;
	$u=0;
	global $gotFlag;
	// echo "<pre>";
	// print_r($outputLine);
	for($j = 0; $j < count($outputLine); $j++)
	{       
		$outputLine[$j] = substr($outputLine[$j],0,72);
          $qflag = false;
		 $stop_flag =0 ;
		 global $continueFlag;
		 if((stripos($outputLine[$j]," PROC")!==false) && (substr($outputLine[$j],0,3)!="//*")) 
		 {
			 
			 $procFlag = 1;
		 }
		 if((stripos($outputLine[$j]," EXEC ")!==false) && (substr($outputLine[$j],0,3)!="//*") && (stripos($outputLine[$j]," PGM=")==false))
		 {
			 
			 $execFlag = 1;
		 }
		
         if(((stripos($outputLine[$j],"&")!== false) || (stripos($outputLine[$j],"&&")==false)) && ($execFlag == 0) && ($procFlag == 0))
		 {   
			if(substr($outputLine[$j],0,3)!="//*")
			{
				$startPos=0;
				$ampersandCount = substr_count($outputLine[$j],"&");
				
				$prognameLength = 0;
				$stop_flag = 0;
				
				
			    while((stripos($outputLine[$j],"&")!==false) && ($stop_flag <= $ampersandCount) && ($procFlag == 0) && ($execFlag == 0))
			    { 
			
					$array_rev_start=$j;
					$stop_flag = $stop_flag + 1;
			        $ampos=stripos($outputLine[$j],"&",$startPos);
					
				    $tempstore = substr($outputLine[$j],($ampos+1));
					   $checkArray = array();
					   if(stripos($tempstore,")")==true)
					   {
						   $bracePos = stripos($tempstore,")");
						   array_push($checkArray,$bracePos);
					   }
			            if(stripos($tempstore,",")==true)
			            { 
							//// echo "\ntemP".$tempstore;
							$commaPos = stripos($tempstore,",");
							
							array_push($checkArray,$commaPos);
			            }
						if(stripos($tempstore,"'")==true)
			            { 
							$quotePos = stripos($tempstore,"'");
							array_push($checkArray,$quotePos);
			            }
			            if(stripos($tempstore," ")==true)
			            {
							$spacePos = stripos($tempstore," ");
							array_push($checkArray,$spacePos);
			            }
						if(stripos($tempstore,"/")==true)
			            {
							$slashPos = stripos($tempstore,"/");
							array_push($checkArray,$slashPos);
			            }
						if(stripos($tempstore,"&")==true)
			            {
							$ampersandPos = stripos($tempstore,"&");
							array_push($checkArray,$ampersandPos);
			            }
						if(stripos($tempstore,".")==true)
						{
							$dotPos = stripos($tempstore,".");
							array_push($checkArray,$dotPos);
						}
						
						if(count($checkArray)>0)
						{
						//$allArray = array($commaPos,$dotPos,$ampersandPos,$spacePos,$bracePos);
						$gap = min($checkArray);
						//// echo "gap".$gap;
						$progname11=trim(substr($tempstore,0,$gap));
						 // echo "tell".$progname11;
						$change = $progname11;
						}
						else
						{
								$progname11 = trim(substr($tempstore,0));
						}
			    			$checkProg = $progname11;
							// echo $progname11."     ".$j."<br>";
							// echo "\n send".$progname11;
							list($change,$gotFlag) = symbolicParm($progname11,$j,$array_rev_start);
							// echo "got flag".$gotFlag;
							if(trim($change) == ",")
							{
								$change = str_replace(",","",$change);
							}
							
								if($gotFlag == 1)
								{
									$change = str_replace(array("'","&"),'', $change);
									// echo "in got flag" . $change . "<br>";
								}
							
			            $newinsert = "&".$progname11;
						//$check_quote = "'&".$progname11."'";
						if(stripos($outputLine[$j],"&".$progname11."..")!==false)
						{
						$check_dot = "&".$progname11."..";
						
						$change1 = $change.".";
						// echo "-----final-----" . $change1 . "<br>";
						$outputLine[$j] = str_ireplace($check_dot,$change1,$outputLine[$j]);
						 // echo "check".$outputLine[$j] . "<br>";
						}
						else
						{
						// echo "in this loop<br>";
						//$outputLine[$j] = str_ireplace($check_quote,$change,$outputLine[$j]);
	                    
						$outputLine[$j] = str_ireplace($newinsert,$change,$outputLine[$j]);
						
						//echo "check2".$outputLine[$j]."<br>";
						$outputLine[$j] = str_replace("..",".",$outputLine[$j]);
						/***********************************************
						if((stripos($outputLine[$j],"DSN=")!==false) && (stripos($change,".")==false) && ($change!=="") && ($change!=="."))
						{
							 $procfile_dsn= "C:/UC_DUMP/Overall_source/Overall_source/CONTROL_CARDS/".$change;
							 echo "probl" . $outputLine[$j] . "<br>";
							 if(file_exists($procfile_dsn))
							{
								$proc_file_handle_dsn = fopen($procfile_dsn, "r");
								$startstatement="//********************EXPANSION " .$change. " START**********************";
								$endstatement="//*******************EXPANSION " .$change. " END**********************";
								$outputLine_dsn[$u]= $startstatement . "\n";
								$u = $u +1;
								while(! feof($proc_file_handle_dsn))
								{
									$proc_line_dsn = strtoupper(fgets($proc_file_handle_dsn));
									$outputLine_dsn[$u] = $proc_line_dsn;
									$u = $u +1;
									
								}
								$outputLine_dsn[$u]= $endstatement . "\n";
							}
						}
						**********************************************/
							
						}
						
			        
			    }
			    
			}
			 
		}
		// echo "check3".$outputLine[$j]."<br>";
		if((($execFlag == 1) || ($procFlag == 1)) && (substr(trim($outputLine[$j]),-1,1)!==","))
		 {
			 $execFlag =0;
			 $procFlag = 0;
		 }
		if($qflag == true)
		{  
	        $outputLine[$j] = str_ireplace("?","&",$outputLine[$j]);
		}
		
	    $outputLine[$j] = $outputLine[$j] . "\n";
		//$outputLine[$j] = $outputLine[$j];
		$outputLine[$j] = preg_replace('/^[ \t]*[\r\n]+/m', '', $outputLine[$j]);
		//echo "<br>write pl".$outputLine[$j];
		if(!empty($outputLine[$j]))
		{
			fwrite($write_file, $outputLine[$j]);
			/*if(count($outputLine_dsn>0))
			{
				foreach ($outputLine_dsn as $dsnlines)
				{
					fwrite($write_file, $dsnlines);
				}
				$outputLine_dsn=array();
			}*/
			
		}
	}
}
//-----------------------------------------------------------------------------------------------//
function symbolicParm($progname11,$n,$array_rev_start)
{
	
	global $write_file;
	global $outputLine;
	global $progname;
	$nullflag=false;
	global $nullflag;
	global $m;
	$inloop = false;
	$tempstore = $progname11."=";
	$progname = "";
	$setProcFlag = 0;
	$valueGotInProc = 0;
	//global $val;
	//// echo "coutn".$n;
	//echo "\nprogramname". $progname11;
	$gotFlag = 0;
	$value_got_in_exec=true;
	//echo "array_rev_start" . $array_rev_start . "n is" . $n ."<br>";
	for($m = $array_rev_start; $m > 0; $m--)
	{
		//echo "in loop".$m . "-----". $outputLine[$m] . "<br>";
		$outputLine[$m] = substr($outputLine[$m],0,72);
		/*if((stripos($outputLine[$m],"EXEC")!== false) && (stripos($outputLine[$m]," PGM=")== false))
		{
			$setProcFlag = 1;
		}*/
		if(is_numeric(substr($tempstore,0,1)))
		{
			
			if((stripos($outputLine[$m],"PARM=")!== false) && (substr($outputLine[$m],0,2)=="//"))
			{
				$ampos=stripos($outputLine[$m],"PARM=");
				// echo "output".$outputLine[$m];
				$tempstore1 = substr($outputLine[$m],($ampos+5));
				if(stripos($tempstore1,")"))
				{
					if(substr(trim($tempstore),0,1)=="1")
					{
						$gap = stripos($tempstore1,")");
						$comPos = stripos($tempstore1,",");
						if($comPos < $gap)
						{
							$gap = $comPos;
						}
					}
					if(substr(trim($tempstore),0,1)=="2")
					{
						// echo "\nbefore".$tempstore1;
						$secondParm = stripos($tempstore1,",");
						$tempstore1 = substr($tempstore1,$secondParm+1);
						// echo "\nafter".$tempstore1;
						//$lastBracePos = stripos($tempstore1,
						$gap = stripos($tempstore1,")");
					}
				}
				elseif(stripos($tempstore1,","))
				{
					$gap = stripos($tempstore1,",");
				}
				elseif(stripos($tempstore1," "))
				{ 
					$gap = stripos($tempstore1," ");
				}
				else 
				{ 
					$gap = strlen($tempstore1);
				}
				$progname=substr($tempstore1,0,$gap);
					
						$progname = str_replace(array(",","'","(",")"),"",$progname);
						$gotFlag = 1;
				//// echo "\nin Parm: ".$progname;	
					$progname = trim($progname);
						
				//// echo "\nprogname".$progname;
			}
			
		}
       // echo "hfjdhf" .$outputLine[$m] . "<br>";
		// if((stripos($outputLine[$m],trim($tempstore))) && (stripos($outputLine[$m],"*")!=2) &&(!is_numeric(substr($tempstore,0,1))))
		if((stripos($outputLine[$m],trim($tempstore))!==false) && (stripos($outputLine[$m],"*")!=2) &&(!is_numeric(substr($tempstore,0,1))) && (stripos($outputLine[$m],"SYSOUT=")==false) )
		{ 
	
			    //echo $outputLine[$m]. "gujanj" . "<br>";
			    $ampos=stripos($outputLine[$m],$tempstore);
			    $checkAlphabetic = substr($outputLine[$m],$ampos-1,1);
			    
			    $tempstore1 = trim(substr($outputLine[$m],($ampos+strlen($tempstore))));
			    // echo $outputLine[$m]."    line<br>";
			    // echo $tempstore1."    tempstore<br>";
				if(substr($tempstore1,0,1)!==",")
				{
					$val=trim($tempstore1);
				}
				else{
					$val="";
				}
			   // echo $ampos."    ampos<br>";
			    //echo $checkAlphabetic."    alpha<br>";
				if(stripos($outputLine[$m]," EXEC ")==false)
				{
					
					$val=new_symbolic($m,$outputLine,$tempstore);
					if($val=="")
					{
						
						$val=trim($tempstore1);
						
					}
				}
				
				//$value_got_in_exec=false;
			// echo "yes" . $val."<br>";
			if((!is_null($val)) || ($val!==" ") || ($val!=="."))
			{
				if(stripos($val,",")!==false)
				{
					$gap = stripos($val,",");
				}
				elseif(stripos($val," "))
				{ 
					$gap = stripos($val," ");
				}
				else 
				{ 
					$gap = strlen($val);
				}
				if(!ctype_alpha($checkAlphabetic))
				{
					if(stripos($outputLine[$m],"SET")!==false)
					{
					 
					$progname=substr($val,0,$gap);
					$progname = trim($progname);
					//// echo "in check" .$progname;
					$gotFlag = 1;
					}
					//if((strlen($progname)==0) && ($valueGotInProc ==0) )
					if($valueGotInProc ==0)
					{
						$progname=substr($val,0,$gap);
						if($progname == ",")
						{
							$progname = str_replace(",","",$progname);
							$gotFlag = 1;
							
						}
						$progname = trim($progname);
						//echo "program name" . $progname . "<br>";
						$gotFlag = 1;
					}
					/*if($setProcFlag == 1)
					{
						$valueGotInProc = 1;
					}*/
						
				}
			}
			break;
		 }/***orginal***/
		 
		
		/*if(($setProcFlag == 1) &&(substr(trim($outputLine[$m]),-1,1)!==","))
		{
			$setProcFlag = 0;
		}*/
	}
	
	
	if($gotFlag == 0)
	{
		$progname = "&".$progname11;
	}
	
	    // echo "last".$progname;
		return array($progname,$gotFlag);	
}

function new_symbolic($m,$outputLine,$tempstore)
{
	global $outputLine;
	$execCount = 0;
	//global $tempstore1;
	// ECHO "head" . $tempstore . "<br>";
	$tempstoree="";
	for($z = $m; $z > 0; $z--)
	{
		if((strpos($outputLine[$z]," EXEC ")!==false) && (stripos($outputLine[$z]," PGM=")==false))
		{
			$execCount = 1;
		}
		if((stripos($outputLine[$z]," EXEC ")!==false) && (stripos($outputLine[$z],$tempstore)!==false))
		{
			 // echo "mm----" . $outputLine[$z] . "<br>";
			 $ampos=stripos($outputLine[$z],$tempstore);
			 $checkAlphabetic = substr($outputLine[$z],$ampos-1,1);
			 $tempstoree = substr($outputLine[$z],($ampos+strlen($tempstore)));
			 break;
		}
		if($execCount == 1)
		{
			break;
		}
			
	}
	
	return $tempstoree;
	
}


echo "</br> Expanding JCL completed";
?>
