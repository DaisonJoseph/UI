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
$count = 0;

$files1 = array();

$dirPath = "C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/EXPJCL_2";
// $dirPath = "C:/xampp/htdocs/UC-BANK/old source/Overall_Source_Apr_6_old/Overall_Source_Apr_6/ISPF LIBRARIES/ISPF_Segrigated/Expanded Skeleton";

// $dirPath = "C:/xampp/htdocs/UC-BANK/sample";

$outputArray = array();
$files1 = array();
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

foreach ($files1 as $file) 
{
	echo "<pre>";
	$fileArray = array();
	// $file = "C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/EXPJCL/FBPM1FÖR";
	$readFile = fopen($file,"r");
	$programName = pathinfo($file,PATHINFO_BASENAME);
	while(!feof($readFile))
	{
		$line = fgets($readFile);
		$fileArray[] = $line;
	}
	$lineCount = 0;
	$outputArray = array();
	foreach($fileArray as $fileline)
	{
		$Filename = "";
		$lineCount += 1;
		$outputArray[] = $fileline;
		$db2parm = false;
		if(substr($fileline,0,3)!=="//*")
		{
			if((strpos($fileline," DSN=") !== false) && (strpos($fileline,"(") !== false) && (strpos($fileline,"&") ==false))
			{
				if((strpos($fileline,"DB2PARM(") !== false) || (strpos($fileline,"DB2PARM1(") !== false) || (strpos($fileline,"DB2PARM2(") !== false)){
					$db2parm = true;
				}
				if(strpos($fileArray[$lineCount],"EXPANSION") === false)
				{
					// echo $fileline.PHP_EOL;
					$Filename = substr($fileline,strpos($fileline,"(")+1);
					$Filename = substr($Filename,0,strpos($Filename,")"));
					// echo $Filename.PHP_EOL;
					if(!empty(trim($Filename)))
					{
						expand($Filename,$db2parm);
					}
				}
			}
		}		
	}
	writeFile($outputArray,$programName);
	fclose($readFile);
	// break;
}

function expand($Filename,$db2parm)
{
	global $outputArray;
	if($db2parm !== false)
	{
		$procFile = "C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/DB2PARM/".$Filename;
	}
	else{
		$procFile = "C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/CONTROL_CARDS/".$Filename;
	}
	// echo $procFile.PHP_EOL;
	if(file_exists($procFile))
	{
		$readProc = fopen($procFile,"r");
		$outputArray[] = "//********************EXPANSION " .$Filename. " START**********************"."\n";
		while(!feof($readProc))
		{
			$procLine = fgets($readProc);
			// echo $procLine.PHP_EOL;
			if(!empty(trim($procLine)))
			{
				$outputArray[] = $procLine;
			}
		}
		$outputArray[] = "//********************EXPANSION " .$Filename. " END**********************"."\n";
		fclose($readProc);
	}
	else{
	}	
}

function writeFile($outputArray,$programName)
{
	$writeFile = fopen("C:/xampp/htdocs/UC-BANK/Overall_Source_Apr_24_20/Overall_Source_Apr_24_20/EXPJCL3/".$programName,"w");
	// $writeFile = fopen("C:/xampp/htdocs/UC-BANK/old source/Overall_Source_Apr_6_old/Overall_Source_Apr_6/ISPF LIBRARIES/ISPF_Segrigated/Expanded Skeleton2/".$programName,"w");
	foreach($outputArray as $line)
	{
		fwrite($writeFile,$line);
	}
	fclose($writeFile);
}
// print_r($outputArray);
echo "</br> Expanding JCL completed";

?>
