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
$final= array();
$count = 0;
$mon = "24-02-20";
$date = $time = 0;
$outpath	= "C:xampp/htdocs/UCAB/SAR/output.csv";
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "System" . "," . "Application" . "," . "Date" . "," . "Start Time" . "," . "End Time";
				fputcsv($outputHandle,explode(",",$writehead));
				
$readcsv = fopen("C:xampp/htdocs/UCAB/SAR/sar_input.csv","r");
	$csvdata = array();
	while(!feof($readcsv))
	{
		$csvdata[] = fgetcsv($readcsv);
	}
	array_pop($csvdata);
	$csvSize = sizeof($csvdata);
	fclose($readcsv);
	
$readsf = fopen("C:xampp/htdocs/UCAB/SAR/samplesf.csv","r");
	$sfdatas = array();
	while(!feof($readsf))
	{
		$sfdatas[] = fgetcsv($readsf);
	}
	array_pop($sfdatas);
	$sfSize = sizeof($sfdatas);
	fclose($readsf);
	
	// print_r($sfdatas);
	
foreach($sfdatas as $sfdata)
{
	$count++;
	echo $count."\n";
	// print_r($sfdata);
	foreach($sfdata as $sf)
	{
		for($i=0;$i<$csvSize;$i++)
		{
			if(((in_array($sf,$csvdata[$i]))!=false)&&((in_array($mon,$csvdata[$i]))!=false))
			{
				$written = true;
				$application = $csvdata[$i][1];
				$date = $csvdata[$i][2];
				$starttime = $csvdata[$i][4];
				$endtime = $csvdata[$i][6];
					// echo $sf.$date.$time;
					fputcsv($outputHandle,array($sf,$application,$date,$starttime,$endtime));
			}
				
		}
	}
		fputcsv($outputHandle,array("For the Next Schedule"));
	// print_r($final);
	// fputcsv($outputHandle,$final);
	$final = array();
	// fclose($outputHandle);
}
echo date('H:i:s').PHP_EOL;
echo "end".PHP_EOL;

?>