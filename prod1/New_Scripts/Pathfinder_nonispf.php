<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	$dirPath = "C:/Users/sbhumija/Desktop/ISPF_LIB_Apr7/ISPF LIBRARIES";
    openDirectoryForFiles($dirPath);
//ORDER: cobol,assembler,bms,dclgen,jcl,proc,copybook,control cards
function openDirectoryForFiles($dirPath) //function to get files and pass it to find path according to file types
{
    if (! is_dir($dirPath)) 
	{
      throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
	{
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);//file names stored as array in $files
    foreach ($files as $file)
	{
        if (is_dir($file))//is_dir() to check if file name is directory or not
		{
          openDirectoryForFiles ($file);
		}
		else 
		{
           FindPath($file);
	    }
    }
	
}
function FindPath($file)//find type of file cobol,assembler...
{ 
   
	$filename=basename($file);//filename
	$filename=mb_convert_encoding($filename, 'ISO-8859-1', 'UTF-8');
    $cobol_flag=false;
    $jcl_flag=false;
    $copybook_flag=false;
    $bms_flag=false;
    $assembler_flag=false;
	$dclgen_flag=false;
	$esy_flag=false;
	$asm_esy_cpy_flag=false;
	$cobol=false;
	$IMS=false;
	$pcb_psb=false;
	$BMS_CPY=false;
	$DB2_flag=false;
	$DBD_flag=false;
	$rexx=false;
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$cobol_flag==false)
	{
		$newfilerexx = fopen($file,"r");
		while(!feof($newfilerexx))
	    {
	       $lines = fgets($newfilerexx);
		   if(stripos($lines,"/*")!==false && (preg_match("/\bREXX\b/i", $lines)>0) && stripos($lines,"*/")!==false)
		   {
			   
			   $path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\REXX\\".$filename;
			   getFileContent($path,$file);
			   $csvfile = fopen("amaster_ISPF.csv","a");
               fputcsv($csvfile,array($filename,"REXX",$file));
               fclose($csvfile);
			   $rexx=true;
			   break;
		   }
		   
		}fclose($newfilerexx);
	}
	

    if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for COBOL
	{   $newfile = fopen($file,"r");
		while(!feof($newfile))
		{
			$lines = fgets($newfile);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{	
				if(((preg_match("/\bIDENTIFICATION\b/i", $lines)>0)&&(preg_match("/\DIVISION\b/i", $lines)>0))||((preg_match("/\bID\b/i", $lines)>0)&&(preg_match("/\DIVISION\b/i", $lines)>0)))
				{
					$cobol=true;
					
				}
				if($cobol==true)
				{   
					if(stripos($lines,"CBLTDLI")==true||stripos($lines,"DLITCBL")==true||((preg_match("/\bEXEC\b/i", $lines)>0)&&(preg_match("/\bDLI\b/i", $lines)>0)))
					{
						
						$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\IMS\\".$filename;
						getFileContent($path,$file);
						$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"IMS",$file));
                        fclose($csvfile);
						$cobol_flag=true;
						$cobol=false;
						$IMS=true;
						break;
					}
				}
				
			}
		}fclose($newfile);
		if($IMS==false && $cobol==true)
				{
					 
				     $path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\COBOL\\".$filename;
					 getFileContent($path,$file);
					 $csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"COBOL",$file));
                        fclose($csvfile);
					 $cobol_flag=true;
					 $cobol=false;
				}
		
	}
	
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for BMS
	{   $newfile1 = fopen($file,"r");
		while(!feof($newfile1))
		{
			$lines = fgets($newfile1);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bDFHMSD\b/i", $lines)>0)|| (preg_match("/\bDFHMDI\b/i", $lines)>0)||(preg_match("/\bDFHMDF\b/i", $lines)>0))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\BMS_SCREENS\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"BMS_SCREENS",$file));
                        fclose($csvfile);
					$bms_flag=true;
					break;
				}
			}
		}fclose($newfile1);
	}
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$bms_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for ASSEMBLER
	{   $newfile5 = fopen($file,"r");
		while(!feof($newfile5))
		{
			$lines = fgets($newfile5);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{    
				if((preg_match("/\bCSECT\b/i", $lines)>0)|| (preg_match("/\bDSECT\b/i", $lines)>0))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\ASSEMBLER\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"ASSEMBLER",$file));
                        fclose($csvfile);
					$assembler_flag=true;
					break;
				}
			}
		}fclose($newfile5);
	}
	
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$bms_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for JCL and PROC
	{   $newfile2 = fopen($file,"r");
		while(!feof($newfile2))
		{
			$lines = fgets($newfile2);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				
				if(((substr($lines,0,2)==="//")&&(preg_match("/\bJOB\b/i", $lines)>0))||((substr($lines,0,2)==="//")&&(preg_match("/\bJOBLIB\b/i", $lines)>0)))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\JCL\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"JCL",$file));
                        fclose($csvfile);
					$jcl_flag=true;
					break;
				}
				elseif((substr($lines,0,2)=="//"&&(preg_match("/\bPROC\b/i", $lines)>0)&&substr($lines,0,3)!=="//*"))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\PROC\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"PROC",$file));
                        fclose($csvfile);
					$jcl_flag=true;
					break;
				}
				
			}
           			
		}fclose($newfile2);
		if($jcl_flag==false){
		 $newfile20 = fopen($file,"r");
		while(!feof($newfile20))
		{
			$lines = fgets($newfile20);
			if(substr($lines,0,3)=="//*" ||substr($lines,0,2)=="//"){
				    $path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\PROC\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"PROC",$file));
                        fclose($csvfile);
					$jcl_flag=true;
					break;
			}
			
           			
		}fclose($newfile20);
		}
		
		
	}
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for DCLGEN
	{   $newfile3 = fopen($file,"r");
		while(!feof($newfile3))
		{
			$lines = fgets($newfile3);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bDCLGEN\b/i", $lines)>0)||((preg_match("/\bDECLARE\b/i", $lines)>0)&&(preg_match("/\bTABLE\b/i", $lines)>0)))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\DCLGEN\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"DCLGEN",$file));
                        fclose($csvfile);
					$dclgen_flag=true;
					break;
				}
			}
		}fclose($newfile3);
	}
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$esy_flag==false&&$dclgen_flag==false&&$rexx==false)//checking for ESY OR ASM COPY
	{   $newfile7 = fopen($file,"r");
		while(!feof($newfile7))
		{
			$lines = fgets($newfile7);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bMACRO\b/i", $lines)>0))
				{
				if((stripos($lines,"MACRO")<2))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\ESY_MACRO\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"ESY_MACRO",$file));
                        fclose($csvfile);
					$asm_esy_cpy_flag=true;
					break;
				}
				elseif((stripos($lines,"MACRO")>2))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\ASM_COPYBOOK\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"ASM_COPYBOOK",$file));
                        fclose($csvfile);
					$asm_esy_cpy_flag=true;
					break;
				}
				}
			}
		}fclose($newfile7);
	}
	
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$bms_flag==false&&$jcl_flag==false&&$cobol_flag==false&&$dclgen_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for COPYBOOK
	{   $newfile4 = fopen($file,"r");
		while(!feof($newfile4))
		{
			$lines = fgets($newfile4);
			if((substr($lines,6,1)=="*")&&(preg_match("/\bBMS\b/i", $lines)>0)){
				$BMS_CPY=true;
			}
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bPIC\b/i", $lines)>0)||(preg_match("/\bPICTURE\b/i", $lines)>0))
				{
					$copybook_flag=true;
				}
				if($copybook_flag==true && $BMS_CPY==true)
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\BMS_CPY\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"BMS_COPY",$file));
                        fclose($csvfile);
					break;
				}
				elseif($copybook_flag==true && $BMS_CPY==false){
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\COPYBOOK\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"COPYBOOK",$file));
                        fclose($csvfile);
					break;
				}
			}
			
		}fclose($newfile4);
	}
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for ESY
	{   $newfile6 = fopen($file,"r");
		while(!feof($newfile6))
		{
			$lines = fgets($newfile6);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				$linecheck=substr(trim($lines),0,3);
				if((preg_match("/\bNEWPAGE\b/i", $lines)>0)||(preg_match("/\bENDPAGE\b/i", $lines)>0)||((substr($lines,0,2)!=="//")&&((substr(preg_replace('/[\r\n]+/', "\n", $lines),0,3)=="JOB")&&(preg_match("/\bJOB\b/i", $linecheck)>0))))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\ESY\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"ESY",$file));
                        fclose($csvfile);
					$esy_flag=true;
					break;
				}
			}
		}fclose($newfile6);
	}
	if($DBD_flag==false&&$esy_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for DB2PARM
	{   $newfile6 = fopen($file,"r");
	
		while(!feof($newfile6))
		{
			$lines = fgets($newfile6);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if(((preg_match("/\bDSN\b/i", $lines)>0)&&stripos($lines,"SYSTEM(")!==false)||((preg_match("/\bRUN\b/i", $lines)>0)&&(preg_match("/\bPLAN\b/i", $lines)>0))||(preg_match("/\bPARM\b/i", $lines)>0))
				{
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\DB2PARM\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"DB2PARM",$file));
                        fclose($csvfile);
					$DB2_flag=true;
					break;
				}
			}
		}fclose($newfile6);
	}
	if($DB2_flag==false&&$esy_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for DBD
	{   $newfile6 = fopen($file,"r");
	$DBD=false;
		while(!feof($newfile6))
		{
			$lines = fgets($newfile6);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if(preg_match("/\bDBD\b/i", $lines)>0)
				{
					$DBD=true;
				}
				if($DBD==true){
					if(preg_match("/\bSEGM\b/i", $lines)>0){
						$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\DBD\\".$filename;
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"DBD",$file));
                        fclose($csvfile);
					$DBD_flag=true;
					break;
					}
				}
			}
		}fclose($newfile6);
	}
	if($DBD_flag==false&&$DB2_flag==false&&$esy_flag==false&&$assembler_flag==false&&$jcl_flag==false&&$copybook_flag==false&&$cobol_flag==false&&$bms_flag==false&&$dclgen_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for PSB
	{   $newfile6 = fopen($file,"r");
	$psb_flag=false;
		while(!feof($newfile6))
		{
			$lines = fgets($newfile6);
			if((substr(trim($lines),0,1) !== "*")&&(substr(t$lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bPSB\b/i", $lines)>0)||(preg_match("/\bPCB\b/i", $lines)>0))
				{
				$psb_flag=true;
				}
				if($psb_flag==true){
					if(preg_match("/\bSENSEG\b/i", $lines)>0){
					$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\PSB\\".$filename;//checking for PSB and PCB
					getFileContent($path,$file);
					$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"PSB",$file));
                        fclose($csvfile);
					$pcb_psb=true;
					break;
					}
				}
			}
		}fclose($newfile6);
	}
	if($DBD_flag==false&&$DB2_flag==false&&$pcb_psb==false&&$assembler_flag==false&&$bms_flag==false&&$jcl_flag==false&&$cobol_flag==false&&$dclgen_flag==false&&$copybook_flag==false&&$esy_flag==false&&$asm_esy_cpy_flag==false&&$rexx==false)//checking for CONTROL CARDS
	{
		$path="C:\\Users\\sbhumija\\Desktop\\UC_Bank\\pathfinder\\CONTROL_CARDS\\".$filename;
		getFileContent($path,$file);
		$csvfile = fopen("amaster_ISPF.csv","a");
                        fputcsv($csvfile,array($filename,"CONTROL_CARDS",$file));
                        fclose($csvfile);
		
	}
	
		
	
}	
		
		
function getFileContent($path,$file) //Get file contents
{

   $filenew = fopen($file,'r');
   while(!feof($filenew))
    {
        $line = fgets($filenew);
		$filecontent .= $line;
		
	}
	createFile($path, $filecontent);
	fclose($filenew);
}		
		
		
function createFile($path, $filecontent) //create file
{
	
    $directory = explode("\\", $path); $dir = "";   
    array_pop($directory);
    foreach ($directory as $d) {
        $dir .= $d."/"; 
        if(!is_dir($dir)){//create directory if not existing
            mkdir($dir, 0755, TRUE);
        }        
    }
	
    $output = fopen($path,"w");
    fwrite($output,$filecontent);
    fclose($output);
}