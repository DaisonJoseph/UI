	<?php
	 error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	$opencsv=fopen("C:/xampp/htdocs/UCAB/unload_Apr30.csv","a");
	fputcsv($opencsv,array("component_name","component_type","table_name","operation","file","query"));
	fclose($opencsv);
	$dirPath = "C:/Users/sbhumija/Desktop/Expanded2404";
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

function loadUnload($file){
	//UNLOAD
	 $unload_flag=false;
	 $syspunch=false;
	 $sysrec=false;
	 $queryflag=false;
	 $Table_name_unload=array();
	 $query_unload=array();
	 $component_name=basename($file);
	 $component_type="JCL";
	 $file_name="";
	 $newfile1 = fopen($file,"r");
		while(!feof($newfile1))
		{
			$lines = fgets($newfile1);
			if((substr(trim($lines),0,1) !== "*")&&(substr($lines,6,1)!="*")&&(substr(trim($lines),0,3)!="//*"))
			{
				if((preg_match("/\bDSNUPROC\b/i", $lines)>0)||(preg_match("/\IKJEFT01\b/i", $lines)>0)||(preg_match("/\bDSNUPROC\b/i", $lines)>0)||(preg_match("/\UNLOAD DATA\b/i", $lines)>0)||(preg_match("/\DSNTIAUL\b/i", $lines)>0)||(preg_match("/\UNLOAD\b/i", $lines)>0))
				{
					$unload_flag=true;
				}
				if(stripos($lines,"SYSREC")!==false ){
					$sysrec=true;
				}
				if((preg_match("/\bSYSPUNCH\b/i", $lines)>0)){
					$syspunch=true;
				}
				if($unload_flag==true){
					if($sysrec==true){
						if(stripos($lines,"DSN=")!==false){
							$file_name = substr($lines, stripos($lines, "DSN=") + 4);
						}
					}
					$line1=substr(trim($lines),0,6);
					if((preg_match("/\bSELECT\b/i", $line1)>0)||(preg_match("/\bINSERT\b/i", $line1)>0)){
						$queryflag=true;
					}
					if($queryflag==true){
						if(stripos($lines,";")!==false){
							$queryflag=false;
						}
						if($queryflag==false){
							$operation="UNLOAD";
					     $q=implode(" ",$query_unload);
						 $t=implode(" ",$Table_name_unload);
						 $opencsv=fopen("C:/xampp/htdocs/UCAB/unload_Apr30.csv","a");
						fputcsv($opencsv,array($component_name,$component_type,$t,$operation,$file_name));
						fclose($opencsv);
					 //$unload_flag=false;
					 unset($query_unload);
					 unset($Table_name_unload);
					 $sysrec=false;
					 $syspunch=false;
					
				}
							
						
						$query_unload[]=$lines;
						if(stripos($lines,"FROM")!==false){
							$Table_name_unload[]=substr($lines, strpos($lines, "FROM") + 4);
							
						}
					}
					
					
					
					
				}
				
				// if($sysrec==true && $syspunch==true&& $unload_flag==false){
					// $line1=substr(trim($lines),0,6);
					// if((preg_match("/\bSELECT\b/i", $line1)>0)||(preg_match("/\bINSERT\b/i", $line1)>0)||(preg_match("/\bUPDATE\b/i", $line1)>0)||(preg_match("/\bDELETE\b/i", $line1)>0)){
						// $queryflag=true;
					// }
					// if($queryflag==true){
						// if(stripos($lines,";")!==false){
							// $queryflag=false;
						// }
						// if($queryflag==false){
							// $operation="UNLOAD";
					     // $q=implode(" ",$query_unload);
						 // $t=implode(" ",$Table_name_unload);
						 // $opencsv=fopen("unloadV3_Apr8.csv","a");
						// fputcsv($opencsv,array($component_name,$component_type,$t,$operation,$file_name1,$q));
						// fclose($opencsv);
					 // $unload_flag=false;
					 // unset($query_unload);
					 // unset($Table_name_unload);
					 // $sysrec=false;
					 // $syspunch=false;
						// }
						
						// $query_unload[]=$lines;
						// if(stripos($lines,"FROM")!==false){
							// $Table_name_unload[]=substr($lines, strpos($lines, "FROM") + 4);
				         // }
				
	
            // }
				// }
				
		}
		}fclose($newfile1);
}

















