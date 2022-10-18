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

$outpath	= "C:/xampp/htdocs/UCAB/Mapping_.csv";
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "Application" . "," . "Business";
				fputcsv($outputHandle,explode(",",$writehead));

$readcsv = fopen("C:/xampp/htdocs/UCAB/UI/mapping.csv","r");
	$csvdata = array();
	while(!feof($readcsv))
	{
		$csvdata[] = fgetcsv($readcsv);
	}
	array_pop($csvdata);
	$csvSize = sizeof($csvdata);
	fclose($readcsv);
	// print_r($csvdata);
	foreach($csvdata as $csv)
	{
		print_r($csv);
		$application = "";
		$system = "";
		$application = $csv[0];
		$systems = explode(" ",$csv[10]);
		foreach($systems as $system)
		{
			echo $application.$system;
			fputcsv($outputHandle,array($application,$system));
		}
	}
	
	
	
	
	
				

?>