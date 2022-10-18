<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	$count_new=0;
	$dirPath = "C:/Users/sbhumija/Desktop/EXPJCL1305";
	
    openDirectoryForFiles($dirPath);

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
           Image($file);
	    }
    }
	
}
function Image($file)
{
//$file_in_array=array();
$file_read=fopen($file,"r");
$utility_flag=false;
$utility="";
$DSN="";
$DSN_flag=false;
$ddname_flag=false;
$DBD_name_flag=false;
$DBD="";
$count=0;
global $count_new;
     while(!feof($file_read))
    {
		$line=fgets($file_read);
		$file_name=basename($file);
		//$file_in_array[]=$line;
		if((preg_match("/\bDFSUDMP0\b/i", $line)>0))
		{
			$utility_flag=true;
			echo $count_new."<br>";
			//$utility=$line;
		}
		if($utility_flag==true && (preg_match("/\bDSN\b/i", $line)>0))
		{
			//$DSN=$line;
			$DSN = substr(trim($line), strpos($line, "=")+1); 
			$DSN_flag=true;
		}
		if(($DSN_flag==true && (preg_match("/\bDISP\b/i", $line)>0)&& (preg_match("/\bNEW\b/i", $line)>0) && stripos($line,"(")!== false)||(($DSN_flag==true && (preg_match("/\bDISP\b/i", $line)>0)&& stripos($line,"(,CATLG,DELETE)")!== false)))
		{
			$ddname_flag=true;
			$count_new++;
		}
		if($ddname_flag==true && (preg_match("/\bSYSIN\b/i", $line)>0))
		{
			$DBD_name_flag=true;
		}
		if($DBD_name_flag==true){
			$count++;
			if($count==2){
			 $DBD_line=explode(" ",$line);
			 $DBD=$DBD_line[1];
			 $filetype="JCL";
			 fputcsv(fopen("IMS_ImagecopyMay6_may19_v2.csv","a"),array($file_name,$filetype,$DSN,$DBD));
			
			 
			 $DSN_flag=false;
			 $ddname_flag=false;
			 $DBD_name_flag=false; 
			 $count=0;
			}
		}
	
		
	}

}



