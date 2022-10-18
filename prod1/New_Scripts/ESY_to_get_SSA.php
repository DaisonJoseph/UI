<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);  
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
date_default_timezone_set('Asia/Kolkata');
echo "<pre>";
echo date('H:i:s').PHP_EOL;
echo "start1".PHP_EOL;
$dirPath = 	  "C:/xampp/htdocs/UCAB/xxx/New Folder";
$outpath 	= "C:/xampp/htdocs/UCAB/xxx/ESY_Statement.csv";
$files1 = array();
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "Component Name" . "," ."File Name". "," ."Segment Name". "," ."Operation". "," ."SSA Name". "," ."Statement";
				fputcsv($outputHandle,explode(",",$writehead));
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
            array_push($files1, $filee);
       }
   }
}

foreach($files1 as $file)
{
  $file_handle = fopen($file,"r");
  $calling_comp = basename($file,".txt");
  echo "<br>".$calling_comp;
  $filename = "";
  $dbd_name = "";
  $seg_name = "";
  $searchValues = array("'","+");
  $replaceValues = "";
  
  while(!feof($file_handle))
    {   
		$line = fgets($file_handle);
		$line1 = trim(preg_replace('/\s+/'," ",$line));
		$ary = explode(" ",$line1);
		$tempLine = "";
		if(substr($line1,0,1)!=="*")
		{
		if((stripos($line1,"DLI ")!==false)&&(stripos($line1,"'")!==false))
		{		
			if(endsWith($line1,"+"))
			{
				// echo "func";
				$tempLine = $line1; 
				$line = fgets($file_handle);
				$line1 = trim(preg_replace('/\s+/'," ",$line));
				$tempLine = $tempLine." ".$line1;
				// echo $tempLine;
				$dliLine = explode(" ",$tempLine);
				// print_r ($dliLine);
				$filename = $dliLine[1];
				$segname = $dliLine[2];
				$operation = $dliLine[3];
				$operation = str_replace($searchValues,$replaceValues,$operation);
				if(stripos($tempLine,"SSA"))
				{	
					$ssaname = substr($tempLine,strpos($tempLine,"SSA ")+4,strlen($tempLine));
					$ssaname = str_replace($searchValues,$replaceValues,$ssaname);
				}
				else{$ssaname="";}
				$statement = str_replace($searchValues,$replaceValues,$tempLine);
				// echo "<br>".$ssaname."<br>";
			}
			else
			{	
			$dliLine = explode(" ",$line1);
			// print_r ($dliLine);
			$filename = $dliLine[1];
			$segname = $dliLine[2];
			$operation = $dliLine[3];
			$operation = str_replace($searchValues,$replaceValues,$operation);
			if(stripos($line1,"SSA"))
			{	
				$ssaname = substr($line1,strpos($line1,"SSA ")+4,strlen($line1));
			}else{$ssaname="";}
			$statement = $line1;
			}
			$read = array("GU","GNP","GHU","GHU-FUNC","GU-FUNC","GN-FUNC","K-GETHOLD-UNIK","K-GETUNIK","K-GETNEXT","GN","GHN","GHNP","K-GETHOLD-NEXT","K-GETNEXT-W-P","K-GETHOLD-NEXT-W-P","GNP-FUNC","GHNP-FUNC");
			$update = array("K-REPLACE","REPL","REPL-FUNC");
			$delete = array("K-DELETE","DLET");
			$insert = array("K-INSERT","ISRT","ISRT-FUNC");
			if(in_array($operation,$read))
			{
				$operation= "READ";
			}
			if(in_array($operation,$update))
			{
				$operation= "UPDATE";
			}
			if(in_array($operation,$delete))
			{
				$operation= "DELETE";
			}
			if(in_array($operation,$insert))
			{
				$operation= "INSERT";
			}
			$writehead = $calling_comp . "!" .$filename. "!" .$segname. "!" .$operation. "!" .$ssaname. "!" .$statement;
			// echo "<br>".$writehead;
			fputcsv($outputHandle,explode("!",$writehead));		
		
		}
		}
	
	}
}	

function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
} 

?>