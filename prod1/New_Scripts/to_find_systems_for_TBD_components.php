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
$system = array();
$subsystem = array();
$outpath1	= "C:/xampp/htdocs/UCAB/Scripts/System/TBD_Sys_1905.csv";
$outputHandle1 = fopen($outpath1, "w") or die("Unable to open file!");
				$writehead = "Name" . "," ."Type". "," ."System". "," ."Sub System";
				fputcsv($outputHandle1,explode(",",$writehead));
// $outpath2 	= "C:/xampp/htdocs/UCAB/Scripts/System/TBD_Xref.csv";
// $outputHandle2 = fopen($outpath2, "w") or die("Unable to open file!");
				// $writehead = "Calling Component" . "," ."Calling Type". "," ."System". "," ."Called Comp". "," ."Called Type";
				// fputcsv($outputHandle2,explode(",",$writehead));

$readmaster = fopen("C:/xampp/htdocs/UCAB/Scripts/System/input.csv","r");
	$masters = array();
	while(!feof($readmaster))
	{
		$inputarray = fgetcsv($readmaster);
		$masters[] = $inputarray;
	}
	$mas = sizeof($masters);
	fclose($readmaster);
	array_pop($masters);
	// print_r ($masters);
$readxref = fopen("C:/xampp/htdocs/UCAB/Source_May_07/Reports/consolidate_xref_may19.csv","r");
	$xref = array();
	while(!feof($readxref))
	{
		$xrefarray = fgetcsv($readxref);
		$xref[] = $xrefarray;
	}
	fclose($readxref);
	$num = sizeof($xref);
	// echo "Size".$num;
	// print_r ($xref);
	for($j=1; $j<$mas; $j++)
	{
		// foreach($masters as $master)
		// {
			$master = $masters[$j][0];
			$type = $masters[$j][1];
			echo $j.$master."\n";
			for($i=1 ; $i<$num ; $i++)
			{
				// print_r ($xref[3][3]);
				// if($master == $xref[$i][3])
				if($master == $xref[$i][4])
				{
					// echo "present"."<br>";
					$calling_comp = $xref[$i][0];
					$calling_type = $xref[$i][1];
					$calling_system = $xref[$i][2];
					// fputcsv($outputHandle2,array($calling_comp,$calling_type,$calling_system,$master,$type));				
					if(!in_array($xref[$i][2],$system))
					{
					array_push ($system,$xref[$i][2]);			
					array_push ($subsystem,$xref[$i][3]);			
					}
				}
				
					
			}
			
					// print_r ($system);
			if(sizeof($system)>1)
			{
				fputcsv($outputHandle1,array($master,$type,"Common","Common"));
				// fputcsv($outputHandle2,array($calling_comp,$calling_type,$calling_system,$master,"Used In Many Applications"));				
			}
			elseif(sizeof($system)==0)
			{
				fputcsv($outputHandle1,array($master,$type,"Orphan","Orphan"));
				// fputcsv($outputHandle2,array($calling_comp,$calling_type,$calling_system,$master,"orphan"));				
			}
			else
			{
				fputcsv($outputHandle1,array($master,$type,$system[0],$subsystem[0]));
				// fputcsv($outputHandle2,array($calling_comp,$calling_type,$calling_system,$master,"Used In Single Applications"));				
			}
			$system = array();
			$subsystem = array();

		// }
	}	
	fclose($outputHandle1);
	fclose($outputHandle2);
	echo date('H:i:s').PHP_EOL;
?>