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
// $dirPath = 	  "C:/xampp/htdocs/DotNet/Database Projects";
// $dirPath = 	  "C:/xampp/htdocs/DotNet/DotNet_6thDump";
$dirPath = 	  "C:/xampp/htdocs/UCAB/Source_May_07/Combined";
$inputfile 	= "C:/xampp/htdocs/UCAB/Scripts/search.txt";
$outpath 	= "C:/xampp/htdocs/UCAB/Reports/psb_2105.csv";
$files1 = array();
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "Program Name" . "," ."Triggered Line". "," ."Keyword". "," ."Path";
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

$inputtbname = array();
// echo "start";
$myfile = fopen($inputfile, "r") or die("Unable to open file!");
while(!feof($myfile)) 
{
	$count =- 0;
	$tbname =  trim(fgets($myfile));
	if(!empty(trim($tbname)))
	{
		// $tbname =  $tbname."(";
		$inputtbname[$tbname] = $count;
	}
   // echo $tbname." ".strlen($tbname).PHP_EOL;
}
fclose($myfile);
// print_r($inputtbname);
foreach	($files1 as $filee)
{
	// echo "</br> Reading File ".$filee ." ".gmdate('Y-m-d h:i:s /G/M/T', time()).PHP_EOL;
	$file_handle = fopen($filee, "r");
	$folderName = basename(dirname($filee));	
	// echo $filee;
	$extensionName = pathinfo($filee, PATHINFO_EXTENSION);
	// $dotExtension = "." .$extensionName;
	$programName = basename($filee);
	echo $folderName."--->".$programName."<br>";
	$count = 0;
	// $searchValues = array("(",".");
  // $replaceValues = "";	 
	while (!feof($file_handle)) 
	{
		$line = "";
		$line = fgets($file_handle);	
		$line = chop($line);
		foreach ($inputtbname as $tbnamee => $count)	
		{
			$tablename = " " .$tbnamee ." ";
			$srchTbname = true;
			$srchTbname = strpos($line,$tbnamee);
			if ($srchTbname != false)
			{
				// if(substr($line,0,3)!=="//*")	//JCL
				// if(substr($line,6,1)!=="*")		//Cobol
				{
					$inputtbname[$tbnamee] += 1;
					// $tbnamee = str_replace($searchValues,$replaceValues,$tbnamee);
					$inputData = $programName. "^". $line. "^". $tbnamee. "^". $folderName;
					$inputData2 = explode("^",$inputData);
					// print_r($inputData2);
					writeData($inputData2);
				}
			}
			
		}
	} 	
	// break;
}	
function writeData($inputData2)
{
	global $outputHandle;
	fputcsv($outputHandle, $inputData2);
}	
fclose($outputHandle);

// print_r($inputtbname);
echo date('H:i:s').PHP_EOL;
echo "Completed".PHP_EOL;
?>