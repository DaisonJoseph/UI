<?php
error_reporting(E_ALL);
ini_set('display_errors',TRUE);
ini_set('display_startup_errors',TRUE);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);
// define('EOL'(PHP_SAPI == 'cli') ?PHP_EOL : '<br/>');
date_default_timezone_set('Asia/Kolkata');

echo date('H:i:s') . 'PARA INVENTORY - Start' ."<br>";

$dir = "C:/Users/thilab/Desktop/UC_Bank/Source/Expanded2404/*";
$count_firstpara = 0;
$outfile = fopen('para_24.csv', 'w');
$title = array("program_name","paragraph_name","section_name","loc");
fputcsv($outfile,$title);
$filecount = 0;

foreach (glob($dir) as $file) 
{
	$paracount = 0;
	$sectioname  = "";
	$prevpara  = "";
	$prevsection  = "";
	$paraname  = "";
	$lwpara = "Dummy";
	$mainflag = false;
	$filecount = $filecount+1;	
	echo date('H:i:s') ." ". $filecount. " ' " . $file ."<br>";
	$file_handle = fopen($file, "r");
	$pos4 = strrpos($file,"/");
	$path = substr ($file, $pos4+1);
	$foldername = substr($file,0,$pos4);
	$pos3 = strrpos($foldername , "/");
	$foldername = substr($foldername , $pos3+1);
	echo $foldername. " ". $path."<br>";
	while(! feof($file_handle))
	{
		$line = fgets($file_handle);
    	$eightpos = trim(substr($line,7,1));
		$nightpos = trim(substr($line,8,1));
		if (substr($line,6,1) != "*")
		{
			if($mainflag == true)
			{
    			if(substr($line,6,1) != "*" && ($eightpos != "" || $nightpos != ""))
				{
					$paraflag = true;
					
					$pos = strpos($line,"SECTION");
					if ($pos > 0)
					{
						$pos = $pos-7;
    		     		$sectioname = substr($line,7,$pos);
	    				$paraname = $sectioname;
						echo "<br>SECTION<br>";
					}
					else
					{
						$paraname1 = substr($line,7);
						$paraname = strtok($paraname1, ".");
						echo "<br>PARA<br>";
					}
					
					$paraname = trim($paraname);
					
				}
				// echo $prevpara."--->".$paraname."<br>";
				if($paraname == $prevpara && $prevpara != "")
				{
					$paracount = $paracount + 1;
					echo "<br>SAME PARA<br>";
				}
				else if($prevpara != $paraname && $prevpara != "")
				{
					// if (strstr($prevpara, $lwpara))
                    // { 
                      // echo "<br> skip para " .$prevpara ." LW " .$lwpara;
                    // }
                    // else
                    // {						
					echo $foldername."---->".$path."---->".$prevpara."---->".$paraname."---->".$paracount."<br>";
					if($count_firstpara == 0)
					{
						$data = array($path, $prevpara, $sectioname, $paracount);
						$count_firstpara++;
						echo $paracount."*********<br>";
						fputcsv($outfile, $data);
					}
					$data = array($path, $paraname, $sectioname, $paracount);
					fputcsv($outfile, $data);
					
					$lwpara = $prevpara;
					$paracount = 0;
					//}
				}
				$prevpara = $paraname;
				$prevsection = $sectioname;
			}
			if(strpos($line,"PROCEDURE") > 0 && strpos($line,"DIVISION") > 0)
			{
				$mainflag = true;
				echo "<br>PROCEDURE DIVISION<br>";
			}
		}
	}
}
echo date('H:i:s'). "PARA INVENTORY - End"."<br>" ;
?>