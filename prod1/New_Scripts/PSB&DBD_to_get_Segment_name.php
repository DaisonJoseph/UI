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
$dirPath = 	  "C:/xampp/htdocs/UCAB/Source_May_07/Combined/PSB";
$outpath 	= "C:/xampp/htdocs/UCAB/Source_May_07/Reports/PSB.csv";
$files1 = array();
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "PSB Name" . "," ."DBD Name". "," ."Segment Name";
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
  echo $calling_comp."<br>";
  $filename = "";
  $dbd_name = "";
  $seg_name = "";
  $searchValues = array("PGM=",".","(",")",",");
  $replaceValues = "";
  
  while(!feof($file_handle))
    {   
		$line = fgets($file_handle);
		$line1 = trim(preg_replace('/\s+/'," ",$line));
		$ary = explode(" ",$line1);
		
		if(stripos($line1,"DBDNAME")!==false)
		{		
			$dbd_name = substr($line1,strpos($line1,"DBDNAME=")+8,strlen($line1));
			$dbd_name = substr($dbd_name,0,strpos($dbd_name,","));
		
		}
		if(empty($dbd_name))
		{
			if(stripos($line1,"DBDNAME")!==false)
		{		
			$dbd_name = substr($line1,strpos($line1,"DBDNAME=")+8,strlen($line1));
			// $dbd_name = substr($dbd_name,0,strpos($dbd_name," "));
		
		}
		}
		if(stripos($line1,"SENSEG")!==false)
		{		
			// echo $line1;
			$seg_name = substr($line1,strpos($line1,"SENSEG NAME=")+12,strlen($line1));
			$seg_name = substr($seg_name,0,strpos($seg_name,","));
		
		}
		if(!empty($seg_name))
		{
			$writehead = $calling_comp . "," .$dbd_name. "," .$seg_name;
			fputcsv($outputHandle,explode(",",$writehead));		
		}
		// $dbd_name = "";
  $seg_name = "";
	}
}	
?>
