<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	$opencsv=fopen("C:/xampp/htdocs/UCAB/load_may7.csv","a");
	fputcsv($opencsv,array("component_name","component_type","table_name","operation","file","query"));
	$dirPath = "C:/Users/sbhumija/Desktop/ISPF_SEGREGATED_MAY13_20 - Copy";
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
           loadUnload($file);
	    }
    }
	
}
function loadUnload($file)
{ 
   global $opencsv;
	$component_name=basename($file);//filename
	$component_type="JCL";
   
//LOAD
     $Table_name="";
	 $load_flag=false;
	 $query="";
	 $operation="";
	 $file_name="";
	 $nextline=false;
	 $newfile = fopen($file,"r");
		while(!feof($newfile))
		{
			
			$lines = fgets($newfile);
			
			if($nextline==true){
						$Table_name=trim($lines);
						$query=$query.$Table_name;
						$nextline=false;
					}
			if((substr(trim($lines),0,1) !== "*")&&(substr($lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bLOAD\b/i", $lines)>0)&&((preg_match("/\bREPLACE\b/i", $lines)>0)||(preg_match("/\bRESUME\b/i", $lines)>0)))
				{
					$load_flag=true;
					$query=trim($lines);
					
					$Table_name =substr($lines, strpos(($lines), "TABLE") + 5); 
					$Table_name=trim($Table_name);
					if(empty(trim($Table_name))){
						
						$nextline=true;
					}
					
				}
				if($load_flag==true){
					
					if((preg_match("/\bDSN\b/i", $lines)>0)&& stripos($lines,"=")!==false){
						$file_name = substr($lines, strpos($lines, "DSN=") + 4);
						if(stripos($file_name,",")!==false){
							$file_name1=explode(",",$file_name);
							$file_name=trim($file_name1[0]);
						}
						
						$operation="LOAD";
						$opencsv=fopen("C:/xampp/htdocs/UCAB/load_may14_ispf.csv","a");
						fputcsv($opencsv,array($component_name,$component_type,$Table_name,$operation,$file_name,$query));
						fclose($opencsv);
						$load_flag=false;
					}
				}
			}
		}fclose($newfile);
	
	
	
	
}