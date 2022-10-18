<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);  
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
date_default_timezone_set('Asia/Kolkata');

echo "start1"."<br>";
$dir 		= "C:/Users/thilab/Desktop/UC_Bank/Source/Overall_Source_May13_20/ESY_MACRO/*";
$inputfile 	= "C:/xampp/htdocs/search.txt";
$outpath 	= "C:/Users/thilab/Desktop/dli_1.csv";
$outputHandle = fopen($outpath, "w");
fputcsv($outputHandle, array("Program Name","Line","Search"));
fclose($outputHandle);
$inputtbname = array();
// echo "start";
$myfile = fopen($inputfile, "r") or die("Unable to open file!");
while(!feof($myfile)) 
{
   $inputline =  fgets($myfile);
   $tbname = chop($inputline);
   array_push($inputtbname,$tbname);
   //echo $tbname;
}
fclose($myfile);
foreach	(glob($dir) as $file)
{
	// echo "hiiiii";
	// echo "</br> Reading File" .gmdate('Y-m-d h:i:s /G/M/T', time());
	$file_handle = fopen($file, "r");
	$folderName = basename(dirname($file));	
	$extensionName = pathinfo($file, PATHINFO_EXTENSION);
	// $dotExtension = "." .$extensionName;
	$programName = basename($file);
	//echo $programName;
	while (!feof($file_handle)) 
	{
		$line = "";
		$line = fgets($file_handle);
								
		$line = chop($line);
		if(strpos($line,'*') == 2)
		{
			continue;
		}
		for($k=0;$k<count($inputtbname);$k++)
		{
				
			$tablename = " " .$inputtbname[$k] ." ";
		 
			$srchTbname = true;
			
				if ($inputtbname[$k] > "")
				{
					$srchTbname = strpos($line,$inputtbname[$k]);
				}
				if ($srchTbname != false)
				{
					if	(strcmp($programName,$inputtbname[$k]) !== 0)
					{
						//if(strpos($line,"//*") == false )
						if((substr($line,6,1)!="*")&&(substr($line,0,3)!="//*"))
						{
						
							//echo $inputtbname[$k];
							//$line = substr($line,2);
							$inputData = $programName ."^".$line. "^". $inputtbname[$k];
							// echo $inputData."<br>";
							$inputData2 = explode("^",$inputData);
							//echo '<pre>'; 
							//print_r($inputData2); 
							//echo '</pre>';
							$outfilename = $outpath. ".csv";
							$outputHandle = fopen($outpath, "a") or die("Unable to open file!");
							fputcsv($outputHandle, $inputData2);
							fclose($outputHandle);
						}	
					}
				}
			
		}
	   
	}
 		
}				
echo "Search completed == at = " .time();

?>