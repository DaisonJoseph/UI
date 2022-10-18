<?php
	error_reporting(E_ALL);
    //ob_implicit_flush(true);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0);
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    date_default_timezone_set('Asia/Kolkata');

    echo date('H:i:s') . " JCL XREF - Start" . PHP_EOL;

    // $dir = "C:/xampp/htdocs/UCAB/Source_May_07/ExpandedSkeleton0705/*";
    $dir = "C:/xampp/htdocs/UCAB/xxx/*";
    $invalidJCLFile = fopen('singleskeleton.csv', 'w');
	$myfile = fopen('skeleton0705.csv', 'w');
	$title = array("calling_component_name","calling_component_type","called_component_name","called_component_type","folder_name","step_name","program name","dd_name","disp_name","jcl_name","job_name");
	fputcsv($myfile, $title);
    
	$readutilities = fopen("utilities.csv","r");
	$utilities = array();
	while(!feof($readutilities))
	{
		$line = fgetcsv($readutilities);
		$utilities[] = $line[0];
	}
	fclose($readutilities);
	// $utilities=array("IKJEFT01","BPXBATCH","ICEGENER","IDCAMS","FASTGENR","IEBCOMPR","IEBCOPY","IEBDG","IEBGENER","IEBIMAGE","IEBISAM","IEBPTPCH","IEBTCRIN","IEBUPDAT","IEBUPDTE","IEFBR14","IEHLIST","IEHMOVE","IEHPROGM","IFHSTATR","IBCDASD","IBCDMPRS","IBCRCVRP"," ICAPRTBL","ICEMAN","ICETOOL","FTP","DSNUTILB","SORT","IEFB14","ADRDSSU","DFSRRC00","ADUUMAIN","NGTUTIL","CTMAPI","ACBGENR","ACPMAIN","ARCHIVE","ICEGENER","ICEGENER","ICETOOL","IDIUTIL","IEFBR14","SAS","IKJEFT1B");
    
	$filecount = 0;
	
	foreach(glob($dir) as $file)
    {	 
		// echo "\n File name is" . $file."<br>";
	   // echo "<br>foreCH LOOP<br>";
	    global $calledtype;
		$jobname="";
        $stepname="";
        $pgmname="";
        $ddname="";
        $dispname="";
        $filecount = $filecount + 1;
       // // echo "</br> reading file name is " .$file;
        $file_handle1 = fopen($file, "r");
        $pos4 = strrpos($file,"/");	
        $path = substr($file,$pos4+1);	// Path contains FileName
        $foldername = substr($file,0,$pos4);	// Path of the JCL Expansion Folder
        $pos3 = strrpos($foldername,"/");
        $foldername = substr($foldername,$pos3+1);		// FolderName
		$extensionName = pathinfo($file, PATHINFO_EXTENSION);
		$dotExtension = "." .$extensionName;
		$programName = basename($file,$dotExtension);
		// echo "program:".$programName."<br>";
        //// echo date('H:i:s') . " " . $filecount . " - " . $file . EOL;
        $ikjeftflag = false;
        $idcams = false;
        $setSysin = false;
        $callingtype = "JCL";
        $name2;
        $pos = 0;
        $jobname;
        $stepname;
        $pgmname;
        $ddname;
        $dispname;
        $data;
        $jobnamefound=false;
        $execfound = 0;
        $dsnfound = 0;
		$sysinfounded = 0;
        $sysinfound = false;
        $linecounter = 0;
		$focus=false;
		$imsBatch = false;
		$nopgm = false;
		$rexxflag=false;
		$dispflag = 0;
		$imsbatchproc=false;
		$renameFlag=false;
		$DelFlag=false;
		$manydsn=false;
		$joblib_dsn=false;
		$steplib_dsn=false;
		$dispflag_got=0;
		$setProcFlag = 0;
		$noFileName = 0;
		$dscrrc00Flag = false;
        while (!feof($file_handle1)) 
        {
		
            $line = fgets($file_handle1);
			//// echo "\n line is" . $line;
			$line = trim($line);
			$line=substr($line,0,72);
            if ((substr($line,0,3) != "//*") && (substr($line,0,1) != "*"))
            {
                $linecounter = $linecounter + 1;

                if ((substr($line,0,2) == "//") && (stripos($line," JOB ")!== false))
                {
                    $jobname = substr($line,2);
                    $jobname = strtok($jobname," ");
					//// echo "gowresankar".$jobname."<br>";
                    $jobnamefound = true;
                }
		
				//$jobname = $programName;
                // // echo $jobname . "<br>";
				$jobnamefound = true;
				if (stripos(trim($line),"//JOBLIB")!==false)
					{
						$joblib_dsn=true;
					}
				if (stripos(trim($line),"//STEPLIB")!==false)
					{
						$steplib_dsn=true;
					}
					if (stripos($line,"EXEC")!==false)
					{
							$joblib_dsn=false;
						//	$steplib_dsn=false;
						
					}
					
				 if ((stripos($line,"DSN=")!=false) &&($joblib_dsn==true))
                    {
						$joblib_dsn=true;
                     //  // echo "DSN LINE outside\n"; 
                       $pos = (stripos($line,"DSN="));
                       $name2 = substr($line, $pos+4);
                       $filename = strtok($name2,",");
                       $filename = preg_replace( "/\r|\n/", "", $filename );
                       $filename = strtok($filename," ");
                       $stepname = preg_replace( "/\r|\n/", "", $stepname );
                       $stepname = strtok($stepname," ");                                 
                       $calledtype = "FILE";
					   if(stripos($line,"DISP=")!=FALSE)
					   {
						   $pos = (stripos($line,"DISP="));
						  
						   $dispname = substr($line, $pos+5);
						   if (stripos($dispname,",")!==false)
						   {
							   $dispname = strtok($dispname,",");
						   }
					   }
					   else{
							$line = fgets($file_handle1);
							$line = trim($line);
							$line=substr($line,0,72);
							if((strpos($line,"DISP=") !== false) && (substr($line,0,3) != "//*"))
							{
								$dispname = substr($line,strpos($line,"DISP=")+5);
							}
					   }
                        $stepname="JOBLIB";
						//// echo "joblib" .$filename."<br>";
						$ddname = "JOBLIB";
						
						// echo $line."<br>";
						 fputcsv($myfile, array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,"",$ddname,$dispname,$path,$jobname));
						
					}
					
					// if ((stripos($line,"DSN=")!==false) &&($steplib_dsn==true))
                    // {
						// $steplib_dsn=true;
						
                       // // echo "steplib outside\n".$line; 
                       // $pos = (stripos($line,"DSN="));
                       // $name2 = substr($line, $pos+4);
                       // $filename = strtok($name2,",");
                       // $filename = preg_replace( "/\r|\n/", "", $filename );
                       // $filename = strtok($filename," ");
                       // $stepname = preg_replace( "/\r|\n/", "", $stepname );
                       // $stepname = strtok($stepname," ");                                 
                       // $calledtype = "FILE";
					   // if(stripos($line,"DISP=")!=FALSE)
					   // {
						   // $pos = (stripos($line,"DISP="));
						  
						   // $dispname = substr($line, $pos+5);
						   // if (stripos($dispname,",")!==false)
						   // {
							   // $dispname = strtok($dispname,",");
						   // }
						   
						   
					   // }
                        // $stepname=" ";
						// // echo "joblib" .$filename."<br>";
						// $ddname = "STEPLIB";
						
							
						 // fputcsv($myfile, array($jobname,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path));
						
					// }
					
				
                if (($linecounter > 3) && (!$jobnamefound))
				{
	                fputcsv($invalidJCLFile, array($foldername,$file));
				}
				if($manydsn==true)
				{
					$file_in_sysin=$line;
					$file_in_sysin_pgm = str_ireplace(","," ",$file_in_sysin);
					$file_in_sysin_pgm = str_ireplace("-"," ",$file_in_sysin_pgm);
					$count=substr_count($file_in_sysin_pgm,")");
					if($count>1){
						
						// for($j=1;$j<=($count-1);$j++)
						// {
							// $file_in_sysin_pgm_reverse=strrev($file_in_sysin_pgm);
							// $file_in_sysin_pgm = preg_replace("/)/"," ",$file_in_sysin_pgm_reverse,1);
							// // do {/
							// // $file_in_sysin_pgm =TRIM(substr_replace($file_in_sysin_pgm," ",-1,1));
							// // $count=substr_count($file_in_sysin_pgm,")");
							// } 
							
							//$file_in_sysin_pgm =strrev($file_in_sysin_pgm);
							
						//}
						$sysinPos = stripos($file_in_sysin_pgm,")");
					$file_in_sysin_pgm = substr($file_in_sysin_pgm,0,$sysinPos+1);
					//// echo "hema". $file_in_sysin_pgm;
					}
				$file_in_sysin_pgm = trim($file_in_sysin_pgm);
				//// echo "manytrue".$file_in_sysin_pgm;
				if (($file_in_sysin_pgm !==")") && ($file_in_sysin_pgm !==""))
				{
					$calledtype="FILE";
					$tempFilename = explode(" ",$file_in_sysin_pgm);
					if(count($tempFilename) > 1)
					{
						$file_in_sysin_pgm = $tempFilename[0];
					}
					fputcsv($myfile, array($programName,$callingtype,$file_in_sysin_pgm,$calledtype,$foldername,$stepname,$pgmname,"","",$path,$jobname));
					unset($tempFilename);
				}
				if(stripos($file_in_sysin,",")==false)
					{
						//// echo "entered" .$file_in_sysin;
						$manydsn=false;
					}
				}
				
                if($jobnamefound)
                {
					//// echo "main loop";
                    if ($execfound == 1)
                    {
                        if ($ikjeftflag)
                        {
							
                            $pos1 = strpos($line,"RUN");
                            if ($pos1 > 0)
                            {
								
                                $linea4pos1 = substr($line,$pos1);
                                $pos1 = strpos($linea4pos1,"PROGRAM");
                                $linea4pos1 = substr($linea4pos1,$pos1);
                                $pos1 = strpos($linea4pos1,"(");
                                if ($pos1 > 0)
                                {
                                    $pos1 = strpos($line,"(");
                                    $pos2 = strpos($line,")");
                                    $pgmname = substr($line,$pos1+1,($pos2 - ($pos1+1)));
									//// echo " chenged here-->ikjeftflag";
									//$calledtype= "COBOL";
									if(stripos($pgmname,",")==true){
									$pgmname=str_ireplace(",","-",$pgmname);
									}
                                    fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
									//print_r($new11= array($jobname,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path));
									//// echo "<br>shiva<br>";
                                }
                            }
							else
							{
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
								$ikjeftflag=false;
							}
                             /*else
							 {
								
								if($rexxflag==true){
								 $pgmname="";
							  //  // echo "REXXXXXXX";
							   // // echo "line : ". $line;
								$foldername=trim($line);
								$calledtype= "IKJEFT01";
								$rexxexplode=explode(" ",trim($line));
								$pgmname=trim($rexxexplode[0]);
								//// echo "pgmnamw is: " . $pgmname . "<br>";
								
								if(stripos($pgmname,",")==true)
							    {
								   $pgmname=str_ireplace(","," ",$pgmname);
								}
								 fputcsv($myfile, array($jobname,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path));
								 $ikjeftflag=false;
								 $rexxflag=false;
								 }	
								$ikjeftflag=TRUE;
							 }	*/						
                        }
						if (($idcams) or ($ikjeftflag))
						{
							
							$systsinpos = strpos($line,"/SYSTSIN");
							$sysinpos = strpos($line,"/SYSIN");
							$systsinendpos = substr($line,0,2);
							
							if (($systsinpos != false) or ($sysinpos != false))
							{
								$setSysin = true;
							}
							if (($systsinpos == false) and ($systsinendpos == "/*"))
							{
								$setSysin = false;
								$idcams = false;
							}
							
							if ($setSysin == true)
							{
								$line1 = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $line)));
								$linearray = explode(" ",$line1);
								if(($linearray[0]=="//SYSTSIN") && (stripos($line1,"DUMMY")==FALSE) && (stripos($line1,"DISP=SHR")==FALSE))
								{
							    //  print_r($linearray);
								  $rexxflag=true;
								}
                               							
								if ((trim($linearray[0]) == "DEL") or ($linearray[0] == "HMIG"))
								{
								//	// echo "in del";
									$pgmname = $linearray[1];
									$calledtype = "FILE";
									//// echo "de;".$filename."<br>";
									if(stripos($pgmname,",")==true)
							    {
								   $pgmname=str_ireplace(",","-",$pgmname);
								}
									fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","",$linearray[0],$path,$jobname));
								      $new33 = array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","",$linearray[0],$path,$jobname);
                                     								  
								}
								
							}
							
						}
                        					
                        $pos1 = strpos($line," DD ");
						//// echo "pos1".$pos1;
                        //if ((substr($line,2,1) != " " ) && $pos1>1)
						if ($pos1>1)
                        {
                           // $ddname = substr($line,2);
                            
							//// echo "ddname" .$ddname;
							
							if(substr($line,2,1)!== " ")
							{
							  $ddname = strtok($line,' ');
							  $ddname=substr($ddname,2);
							}
							
                        }
                        if ((stripos($line,"DSN=")!==false) && ($joblib_dsn == false))
                        {
                             // echo "DSN LINE-------------!!!-------------\n".$line."<br>";
                                    $dsnfound = 1;
									$filename = "";
                                    $pos = (stripos($line,"DSN="));
                                    $name2 = substr($line, $pos+4);
									$calledtype = "FILE";
									if(substr($name2,0,1)!== ",")
									{
										$noFileName = 1;
										$filename = strtok($name2,",");
										$filename = preg_replace( "/\r|\n/", "", $filename );
										$filename = strtok($filename," ");
										$temp_File1 = $filename;
										if(strpos(" ".$filename,"&") === 1)
										{
											$calledtype = "FILE";
										}
										else if(stripos($filename,"(") !== false)
										{
											$dsnValue = $filename;
											// echo $dsnValue.PHP_EOL;
											$filename = substr($filename,stripos($filename,"(")+1);
											$filename = strtok($filename,")");											
											if(strpos($dsnValue,"JCL.INTRDR") !== false || strpos($dsnValue,"JCL.CNTLCTM") !== false)
											{
												// echo ":JCL".PHP_EOL;
												$calledtype = "JCL";	
												// echo $filename."		".$calledtype.PHP_EOL;
											}
											elseif(strpos($dsnValue,"COPY.SOURCE") !== false)
											{
												$calledtype = "COPYBOOK";												
											}
											else{
												$calledtype = "CONTROL_CARD";
											}
											if(is_numeric($filename) || empty(trim($filename)) || (strpos($filename,"&") !== false) || (strpos($filename,"?") !== false))
											{  
												$filename = substr($temp_File1,0,stripos($temp_File1,"("));
										       $calledtype = "FILE";
											}
										}
									}
                                    $stepname = preg_replace( "/\r|\n/", "", $stepname );
                                    $stepname = strtok($stepname," ");      
									$ddname = trim($ddname);
									if (($ddname == "") && ($steplib_dsn  == true))
									{
										$calledtype = "FILE";
										$steplib_dsn = false;
									}	
									if(stripos($line,"DISP")==true)
							        {
										$dispflag_got=1;
										//*****************************************************//
								         $dispname = substr($line, (stripos($line,"DISP"))+5);
                                         if (substr($dispname, 0, 1) == '(')
                                         {
                                             $pos1 = stripos($dispname,"(");
                                             $pos2 = stripos($dispname,")");
                                             $dispname = trim(substr($dispname,$pos1+1,(($pos2 - $pos1)-1)));
								             
								             if(stripos($dispname,",")!=1)
								             {
								             	
								             	$dispname=str_ireplace(","," ",$dispname);
								             
								             }
                                         }
                                         else
                                         {
                                             $dispname = str_replace(","," ",$dispname);
                                             $dispname = strtok($dispname," ");
							             	 //// echo "<br>dispname value" . $dispname;
							             	 if(stripos($dispname,",")==true)
											 {
							             		 $dispname=str_ireplace(","," ",$dispname);
							             	 }
                                         }                            
							//*********************************************************************//
								    }
								if($dispname == "CREATE")
								{
									$dispname = "";
								}
                                    //$data=array($jobname,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path);
									//fputcsv($myfile, $data);
                             if ($dispflag == 1)
                            {								
                               
							   if(($filename !== "')") &&($noFileName == 1)&&($filename!==""))
							   { 
						   
								$data=array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path,$jobname);
                                fputcsv($myfile, $data);
							   }
								/************here added $dispflag********/
								$dispflag = 0;
								/************here added $dispflag********/
								$dsnfound = 0;
                            }
							else
							{
								if($dispflag_got=0){
								if(($filename !== "')") &&($noFileName == 1)&&($filename!==""))
								{
									
								fputcsv($myfile, array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,"","",$path,$jobname));
								$dispflag = 0;
								}
								}
							}
                            $noFileName = 0;									
                        }
						if(($DelFlag==true) && (stripos(trim($line),"/")==false) && (trim(stripos($line," DEL ")!==false)))
						{
							$ddname="";
							$delpos=stripos(trim($line),"DEL");
							$filename=trim(substr($line,$delpos+3));
							$calledtype="FILE";
							if($filename!=""){
								
							fputcsv($myfile, array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,"","",$path,$jobname));
							}
							$DelFlag=false;
						}
						if(stripos($line,"SYSIN"))
						{  
					       $DelFlag=true;
							if(stripos($line,"DSN="))
							{
							    $sysinfounded = 1;
								$pos=stripos($line,"DSN=");
								$pos=$pos+4;
							    $name2 = substr($line, $pos);
								$name2 = str_ireplace(","," ",$name2);
								$name2= strtok($name2," ");
							    $data=array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,"",$path,$jobname);
							}
						}
							$sysinfounded = 0;
                        if(substr($line,0,2) == "/*")
                        $sysinfound=false;
                        if($sysinfound)
                        { // // echo "hello 2<br>";
                            $pos = stripos($line,"DELETE");
                            if ($pos > 0)
                            {
                                $pos = $pos + 6;
                                $dispname = "DELETE";
                            }
                            else
                            {
                                $pos = stripos($line,"FILE=");
                                if ($pos > 0)
                                {
                                    $pos = $pos + 5;
                                    $dispname = "NOT APPLICABLE";
                                }
                                else
                                {
                                    $pos = stripos($line,"NAME(");
                                    if ($pos > 0)
                                    {
                                        $pos = $pos + 5;
                                        $dispname = "DELETE DEFINE";
                                    }
                                    else 
                                    {
                                        $pos = stripos($line,"NAME");
                                        if ($pos > 0)
                                        {
                                            $linea4name = substr($line, $pos);
                                            $pos = stripos ($linea4name, "(");
                                            if ($pos > 0)
                                            {
                                                $pos = stripos($line,"(") + 1;
                                                $dispname = "DELETE DEFINE";
                                            }
                                        }
                                    }
                                }
                            }

                            if ($pos > 0)
                            { 
								//// echo "hello 3<br>";
                                //$dsnfound = 1;
                                $name2 = trim(substr($line, $pos));
                                $filename = str_replace(","," ",$name2);
								
                                $filename = str_replace(")"," ",$filename);
                                $filename = preg_replace( "/\r|\n/", "", $filename );
                                $filename = strtok($filename," ");
                                $stepname = preg_replace( "/\r|\n/", "", $stepname );
                                $stepname = strtok($stepname," ");
								$calledtype = "FILE";
								/****saiiiiii***/
								// echo "pos" .$filename."<br>";
                                fputcsv($myfile, array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path,$jobname));
                            }
                        }                       
                        if 	(stripos($line,"DISP="))
                        {   $dispflag = 1;
					       // // echo "hello 4<br>";
                            $pos = stripos($line,"DISP=");
                            $dispname = substr($line, $pos+5);
                            if (substr($dispname, 0, 1) == '(')
                            {
                                $pos1 = stripos($dispname,"(");
                                $pos2 = stripos($dispname,")");
                                $dispname = trim(substr($dispname,$pos1+1,(($pos2 - $pos1)-1)));
								//$dispname = str_ireplace(","," ",$dispname);
								//// echo "<br>dispname value" . $dispname;
								if(stripos($dispname,",")!=1)
								{
									
									$dispname=str_ireplace(","," ",$dispname);
								
								}
                            }
                            else
                            {
                                $dispname = str_replace(","," ",$dispname);
                                $dispname = strtok($dispname," ");
								//// echo "<br>dispname value" . $dispname;
								if(stripos($dispname,",")==true){
									$dispname=str_ireplace(",","-",$dispname);
									
								}
                            }                            
                            if ($dsnfound == 1)
                            {		
                                 						
                                //***this one i chnaged  array_push($data,$dispname);
                                 //array_push($data,$path);   *****/
								if($filename !== "')")
								{
									// echo "file	".$filename.PHP_EOL;
									if(strpos($filename,".") === false && strpos($filename,"&") === false && ($calledtype=="FILE"))
									{
										$calledtype = "CONTROL_CARD";
									}
									// echo $calledtype;
									$data=array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path,$jobname);
									// echo $calledtype."<br>";
									fputcsv($myfile, $data);
								}
								$dispflag=0;
                                // print_r($data);
                                // // echo "<br>BALA<br>";
                            }
                            $dsnfound = 0; 
                            $sysinfound=false;
                        }
                        if (stripos($line,"SYSIN") && stripos($line," DD ") && stripos($line," * "))
                            $sysinfound=true;
                    }
                    if (strpos($line," EXEC "))
                    {// // echo "hello 5<br>";
                        $sysinfound = false;
                        $ikjeftflag = false;
                        $pgmname = "";
                        $stepname = trim(substr($line,2,8));
						if(stripos($stepname," ")!==false)
						{ $gap = stripos($stepname," ");
					      $stepname = substr($stepname,0,$gap);
						  // echo "corrected stepname". $stepname."<br>";
						}
						$line = preg_replace("/\s+/"," ",$line);
						$lineary = explode(" ",$line);
                        if ((stripos($line," PGM="))  && (!in_array("COMPATABILITY",$lineary)))
                               

                        {      
							if(stripos($line,"PGM=FOCUS"))
							{
								$focus = true;
								
							}
							// echo $line.PHP_EOL;
							$pos1 = stripos($line,"PGM=");
                            $pgmname = substr($line,$pos1+4);
                            $pgmname = str_replace(","," ",$pgmname);	
                            $pgmname = strtok($pgmname," ");
							//// echo "new name" . $pgmname."<br>";
							if(in_array($pgmname,$utilities)==true)
							{
							//	// echo "UTILITIES CONDITION CAME" . "<BR>";
								if (strpos($line,"PGM=DFSRRC00")> 0){
									$dscrrc00Flag = true;
								}
								$calledtype = "UTILITY";
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
							}
							else
							{
								$calledtype = "COBOL";
								//fputcsv($myfile, array($jobname,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path));
								if (strpos($line,"PGM=IKJEFT01") == 0){
									//// echo "gowre<br>";
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));}
                                else {
                                    $ikjeftflag = true;
								if (strpos($line,"PGM=IDCAMS") != 0)
									$idcams = true;
								}
							}
                        }
/*else starts*/      else
                        {
                            $pos1 = stripos($line," EXEC ");
							//// echo "// echopos".$pos1."<br>";
                            $pgmname = substr($line,$pos1+6);	
                            $pgmname = str_replace(","," ",$pgmname);	
                            $pgmname = TRIM(strtok($pgmname," "));
							//// echo "MAIN PGM NAME IS : " . $pgmname. "<br>";
							if($pgmname =="IMSBATCH" || $pgmname =="FMSBMP")
							{
								$imsbatchproc=true;
								$imsBatch=true;
								if($imsbatchproc==true)
								{
								$calledtype="PROC";
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"IMS",$jobname));
								$imsbatchproc=false;
								}
								if(stripos($line,"MBR=")!==false)
								{
									//// echo "<br>IN MBR LOOP<br>";
									//$pos = stripos($line,"PROG=");
									$pos100 = stripos($line,"MBR=");
								//	// echo "mbrpos".$pos100."<br>";
									$pgmname = substr($line,$pos100+4);
									$pgmname = str_replace(","," ",$pgmname);	
									//// echo "$pgmname<br>";
									$pgmname = strtok($pgmname," ");
								//	// echo "new here ". $pgmname ."<br>";
									$calledtype = "COBOL";
									$imsBatch=false;
									$PRINT = array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname);
								//	print_r($PRINT);
									
									fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"IMS",$jobname));
								
								}
								if(stripos($line,"PSB=")!==false)
								{
									// echo $line.PHP_EOL;
									$calledtype="";
									$pos101 = stripos($line,"PSB=");
									$pgmname = substr($line,$pos101+4);
									$pgmname = str_replace(","," ",$pgmname);	
									$pgmname = strtok($pgmname," ");
									$calledtype = "PSB";
									$imsBatch=false;
									$PRINT = array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname);
									if($pgmname!=" "){
									fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"IMS",$jobname));
									}
								
								}
							
							}
							if (($pos1 > 0) && (stripos($line," PGM= ") == false)  && (stripos($line," PROC=") == false) && (stripos($line,"IMSBATCH")!=true) && (!in_array("COMPATABILITY",$lineary)))
							{    
						   
								$nopgm=true;
								
								if((stripos($line,"IMSBATCH")!==TRUE) OR (stripos($line,"FMSBMP")!==TRUE))
								{
									$calledtype = "PROC";
									$PRINT = array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname);
									
									fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
								}
							}
                            if (stripos($pgmname,"PROC=")!==false)
							{
							
                                $pgmname = substr($pgmname,5);
								
								 $calledtype = "PROC";
								 $PRINT = array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname);
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
              
							}
                        }
                        $execfound = 1;
                    }
					// echo $line."<br>";
					if($dscrrc00Flag == true)
					{
						if(stripos($line,"PARM=")!==false)
						{
							// echo $line.PHP_EOL;
							$line = trim(substr($line,stripos($line,"PARM=")+5));					// Comment 2
							$parmexp = explode(",",$line);
							$pgm_in_dfrrc= $parmexp[1];
							$pgm_in_dfrrc = str_replace("'","",$pgm_in_dfrrc);		//ccc
							$calledtype = "COBOL";
							$psbprograms = $parmexp[2];
							$psbprograms = str_replace("'","",$psbprograms);		//ccc
							$dscrrc00Flag = FALSE;
							// echo $pgm_in_dfrrc.PHP_EOL;
							fputcsv($myfile, array($programName,$callingtype,$pgm_in_dfrrc,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
							if(!empty(trim($psbprograms))){
								fputcsv($myfile, array($programName,$callingtype,$psbprograms,"PSB",$foldername,$stepname,"","","",$path,$jobname));
							}
						}
					}
					if($imsBatch== true)
						{
							//// echo "u came in separate imsbatch flag";
							if(stripos($line," MBR=")!==false)
							{
							    $pos1 = stripos($line," MBR=");
							    $pgmname = substr($line,$pos1+5);
							    $pgmname = str_replace(","," ",$pgmname);	
							    
                                $pgmname = strtok($pgmname," ");
							 //   // echo "$pgmname<br>";
							    if($pgmname=="TEMPNAME")
							    {
							    	$expansion_issue=true;
							    	$imsBatch= false;
							    }
							    else
							    {
							    $calledtype = "COBOL";
							    $imsBatch== false;
								$expansion_issue==false;
                                fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"IMS",$jobname));	
							    }
							}
                        
						}
						// if(stripos($line,"MBR=")!==false)
							// {
						        // $pos1 = stripos($line,"MBR=");
						        // $pgmname = substr($line,$pos1+4);
								// // echo $pgmname;
								// if(stripos($pgmname,",") == ",")		//comment 12
								// {
									// // echo "12";
									// $pgmname = "";
								// }
								// else{
									// $pgmname = str_replace(","," ",$pgmname);	
									// $pgmname = trim(strtok($pgmname," "));
								// }
						        // $calledtype = "COBOL";
							    // $expansion_issue=false;
								// // echo "<br>".$pgmname."<br>";
                                // fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"MBR",$jobname));	
							// }
							if(stripos($line,"PSB=")!==false)
							{
								echo "<pre>";
								// echo $line.PHP_EOL;
						        $pos1 = stripos($line,"PSB=");
								$substring=substr($line,$pos1+4);
								if(stripos($substring,",")!=0)
								{
								$commapos1=stripos($substring,",");
								$pgmname=substr($substring,0,$commapos1);
								}
								else{
									$pgmname= $substring;
								}
						        $calledtype = "PSB";
								// echo $pgmname.PHP_EOL;
								if($pgmname!=" " && (stripos($pgmname," psb") === false)){
								// echo "line1 : $line<br>";	
								// echo $pgmname.PHP_EOL;
                                fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,"PSB",$jobname));	
								}

							}
						if($nopgm== true)
						{  
							if(stripos($line," PROG=")!==false)
							{
							   
						        $pos1 = stripos($line,"PROG=");
							    $pgmname = substr($line,$pos1+5);
							    $pgmname = str_replace(","," ",$pgmname);	
							  
							    $pgmname = strtok($pgmname," ");
							  
							    if($pgmname=="FTP")
							    {
							    	$calledtype = "UTILITY";
									$nopgm=false;
							    	fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));	
							    }
							    else
							    {
							    $calledtype = "COBOL";
							    $nopgm=false;
							    fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
							    }
							}
							if(stripos($line," PGM(")!==false)
								{
							
						        $pos1 = stripos($line,"PGM(");
							    $pgmname = substr($line,$pos1+4);
							    $pgmname = str_replace(")"," ",$pgmname);	
							   
							    $pgmname = strtok($pgmname," ");
							 
							        if($pgmname=="FTP")
							        {
							        	$calledtype = "UTILITY";
								    	$nopgm=false;
							        	fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));	
							        }
							        else
							        {
							        $calledtype = "COBOL";
							        $nopgm=false;
							        fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
							        }
							    }
							
						}
						if(strpos(trim($line),"RENAMEU")!==false)
					{
						//// echo "rename flag true"."<br>";
						$renameFlag=true;	
						//// echo "renameu" . $line;
					}
					
						
					if($renameFlag==true)
					{
						//$renamePos= 0;
					   // // echo "in rename flag" ."<br>";
						$line = str_replace(")"," ",$line);
						$line = trim(str_replace("("," ",$line));
						$renamePos = stripos($line,"RENAMEU");
						//// echo "linebypass".$line;
						if(stripos($line,"BYPASSACS")!==false)
						{
							$renameFlag = false;
						}
						if (stripos($line,"RENAMEU")!==false)
						{	
							$remaining_name=substr($line,$renamePos+7);
							//// echo "rename" .$remaining_name;
						}
						else
						{
							$remaining_name = $line;
							//// echo "out rename" .$remaining_name;
						}
							$commapos_rename=stripos($remaining_name,",");
							$first_pgmanme=trim(substr($remaining_name,0,$commapos_rename));
							$remaining_name=substr($remaining_name,$commapos_rename+1);
							$first_pgmanme = trim(str_replace("-"," ",$first_pgmanme));
							$first_pgmanme = trim(str_replace(","," ",$first_pgmanme));
							$calledtype="FILE";
							$first_pgmanme = trim($first_pgmanme);
							if(($first_pgmanme!== "") && ($renameFlag == true))
							{	
							//// echo "test". $first_pgmanme;
							fputcsv($myfile, array($programName,$callingtype,$first_pgmanme,$calledtype,$foldername,$stepname,"","","",$path,$jobname));	
							}
					//while(stripos($remaining_name,",")!=false);
						
						$remaining_name = trim(str_replace("-"," ",$remaining_name));
						$second_name = trim(str_replace(","," ",$remaining_name));
						if(($second_name!== "") && ($renameFlag == true))
							{	
						fputcsv($myfile, array($programName,$callingtype,$second_name,$calledtype,$foldername,$stepname,"","","",$path,$jobname));
							}
					  $count=substr_count($remaining_name,")");
					if($count>1){
						
						// for($j=1;$j<=($count-1);$j++)
						// {
							// $file_in_sysin_pgm_reverse=strrev($file_in_sysin_pgm);
							// $file_in_sysin_pgm = preg_replace("/)/"," ",$file_in_sysin_pgm_reverse,1);
							// // do {/
							// // $file_in_sysin_pgm =TRIM(substr_replace($file_in_sysin_pgm," ",-1,1));
							// // $count=substr_count($file_in_sysin_pgm,")");
							// } 
							
							//$file_in_sysin_pgm =strrev($file_in_sysin_pgm);
							
						//}
						$sysinPos = stripos($remaining_name,")");
					$remaining_name = substr($remaining_name,0,$sysinPos+1);
					//// echo "hema". $file_in_sysin_pgm;
					}
					//// echo "hema". $file_in_sysin_pgm;
					$calledtype="FILE";
					//fputcsv($myfile, array($jobname,$callingtype,$file_in_sysin_pgm,$calledtype,$foldername,$stepname,"","","",$path));
						if(stripos($remaining_name,",")==false)
						{
							//// echo "entered" .$file_in_sysin;
							$renameFlag=false;
						}
								
								
						//$renameFlag=false;
					}
                    if (strpos($line," INCLUDE "))
                    { 
                        $pos1 = stripos($line," MEMBER=");
						if($pos1 > 0)
						{
							$pgmname = substr($line,$pos1+8);
							$pgmname = str_replace(","," ",$pgmname);	
							$pgmname = strtok($pgmname," ");
							$calledtype = "PROC";
							if(strpos($pgmname,"&") !== 0)
							{
								fputcsv($myfile, array($programName,$callingtype,$pgmname,$calledtype,$foldername,$stepname,"","","",$path,$jobname));	
							}
						}
                    }
					if((stripos(trim($line),"DS(INCL(")!==false) || (stripos(trim($line),"DATASET(INC(")!==false) || (stripos(trim($line),"DS(INC(")!==false) )
					{
						//// echo "today work" . $line;
						if (stripos(trim($line),"DS(INCL(")!==false)
						{
						$incpos=strpos($line,"INCL");
					    $dataset_in_sysin=substr($line,$incpos+5);
						}
						elseif(stripos(trim($line),"DS(INC(")!==false)
						{
							$incpos=strpos($line,"INC");
							$dataset_in_sysin=substr($line,$incpos+4);
						}
					
						$pgmNameNot = $dataset_in_sysin;
						$pgmname1 = str_replace(")"," ",$dataset_in_sysin);
						
						$pgmname1 = trim(str_replace("-"," ",$pgmname1));
						$pgmFirstName = trim(str_replace("-"," ",str_replace(","," ",$pgmNameNot)));
						$pgmFirstName = strtok($pgmFirstName," ");
						$calledtype="FILE";
						//// echo "first".$pgmFirstName;
						if(stripos($pgmname1,",")!=false)
						{
							fputcsv($myfile, array($programName,$callingtype,$pgmFirstName,$calledtype,$foldername,$stepname,$pgmname,"","",$path,$jobname));
							$manydsn=true;
							
						}
						elseif($pgmname1!=""){
						fputcsv($myfile, array($programName,$callingtype,$pgmname1,$calledtype,$foldername,$stepname,$pgmname,"","",$path,$jobname));
						}
					}
					// if(strpos(trim($line),"RENAMEU")!==false)
					// {
						// // echo "rename flag true"."<br>";
						// $renameFlag=true;	
					// }
					if(strpos(trim($line),"PATH=")!==false)
					{
						// echo $line."<br>";

						$pathpos=strpos($line,"PATH=");
						$pathname=trim(substr($line,$pathpos+5));
						$pathname = str_replace("'"," ",$pathname);
						$pathname = trim(str_replace(","," ",$pathname));
						$tempArray = explode(" ",$pathname);
						if(count($tempArray) > 1)
						{
							$pathname = $tempArray[0];
						}
						$calledtype="shell path";
						$dispname="CREATE";
						fputcsv($myfile, array($programName,$callingtype,$pathname,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path,$jobname));
						unset($tempArray);
					}
					if(strpos(trim($line)," PROC ")!==false)
					{
						$setProcFlag = 1;
					}
					if(($setProcFlag = 1) && (substr(trim($line),-1,1)!==","))
					{
						$setProcFlag = 0;
					}
					if((strpos(trim($line),"DELETE ")!==false) || (strpos(trim($line)," DEL ")!==false))
					{
						$pathpos=strpos($line,"DELETE ");
						$pathname=substr($line,$pathpos+7);
						$pathname = str_replace("PURGE","",$pathname);		// comment 13
						$pathname = str_replace("CLUSTER","",$pathname);
						$pathname = trim($pathname);
						$calledtype="FILE";
						// echo $filename."<br>";
						if(substr($pathname,0,1) == "(")
						{
							
							$pathname = substr_replace($pathname,"",0,1);
							$pathname = substr_replace($pathname,"",-1,1);
						}
						$pathname = str_replace(" -","",$pathname);
						if (strpos(trim($line),"FROM ")!==false)
						{
							$pathpos=strpos($line,"FROM ");
							$pathname=substr($line,$pathpos+5);
							$pathname = str_replace(";","",$pathname);	//comment 10
							$pathname = trim($pathname);
							$calledtype="TABLE";
						}
						
						$dispname=" ";
						$str1 = stripos(trim($line),"/*");
						//// echo "lienlist".$str1;
						if (($pathname == "S-R1720-01") || ($pathname == "S-R1720-02") || ($pathname == "S-R1720-03") ||  ($pathname == "S-R1722-01") || ($pathname == "S-R1750-01") || ($pathname == "S-R1750-04"))
						{
							$calledtype = "RECORD";
						}
						if ((stripos(trim($line),"DATA ")==false) && (stripos(trim($line),"EXEC ")==false) && (stripos(trim($line),"DD ")==false) && (stripos(trim($line),"EXEC ")==false) && (stripos(trim($line),"/*")!==0) && (trim($line)!==""))
						{

						fputcsv($myfile, array($programName,$callingtype,$pathname,$calledtype,$foldername,$stepname," ",$ddname,"DELETE",$path,$jobname));
						}
					}
					if(strpos(trim($line),"DSNAME=")!==false) 
					{
						$dspos=strpos($line,"DSNAME=");
						$dsname=substr($line,$dspos+7);
						$dsname = str_replace(","," ",$dsname);
						$calledtype="FILE";
						//$dispname="CREATE";
						//// echo "dsname" .$filename."<br>";
						$tempDsn = explode(" ",trim($dsname));
						// echo $dsname;
						if(count($tempDsn) > 1 )
						{
							$dsname = $tempDsn[0];
						}
						if(strpos($line,"DISP=") !== false)
						{
							$dispname = substr(trim($line),strpos($line,"DISP=")+5);		// comment 15
							// $dispname = str_replace(","," ",$dispname);
							// $tempdisp = explode(" ",$dispname);
							// $dispname = $tempdisp[0];
						}
						fputcsv($myfile, array($programName,$callingtype,$dsname,$calledtype,$foldername,$stepname,$pgmname,$ddname,$dispname,$path,$jobname));
					}
					if((stripos(trim($line),"FNAME=")!== false) && ($setProcFlag == 0))
					{
						$dspos=strpos($line,"FNAME=");
						$dsname=substr($line,$dspos+6);
						$dsname = str_replace("'","",$dsname);
						$calledtype="FILE";
						//$dispname="CREATE";
						//// echo "dsname" .$filename."<br>";
						fputcsv($myfile, array($programName,$callingtype,$dsname,$calledtype,$foldername,$stepname,$pgmname,$ddname,"",$path,$jobname));
					}
					if((stripos(trim($line)," DUMMY")!== false)&& (stripos($line,"DSN=")!==false))
					{
						$dspos=strpos($line,"DSN=");
						$dsname=substr($line,$dspos+4);
						//// echo "dsname full".$dsname;
						if(stripos($dsname,",")!== false)
						{
							$endPos = stripos($dsname,",");
							$diffPos = $endPos - $dspos;
							$dsname = substr($dsname,$dspos,$diffPos);
							//// echo "dsname 1".$dsname;
						}
						elseif(stripos($dsname," ")!== false)
						{
							$endPos = stripos($dsname," ");
							$diffPos = $endPos - $dspos;
							$dsname = substr($dsname,$dspos,$diffPos);
							//// echo "dsname2".$dsname;
						}
						// $diffPos = $endPos - $dspos;
						// $dsname = substr($dsname,$dspos,$diffpos);
						$dsname = str_replace(",","",$dsname);
						$calledtype="FILE";
						//$dispname="CREATE";
						//// echo "dsname" .$filename."<br>";
						fputcsv($myfile, array($programName,$callingtype,$filename,$calledtype,$foldername,$stepname,$pgmname,$ddname,"",$path,$jobname));
					}
											
                }
            }						
        }
		 
    }
	echo date('H:i:s') . " JCL XREF - End" . EOL;
   
    fclose($myfile);

?>
