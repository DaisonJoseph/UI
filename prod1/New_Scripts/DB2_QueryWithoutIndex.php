<?php
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	date_default_timezone_set('Asia/Kolkata');
	// date_default_timezone_set('Asia/Kolkata');
	echo "Generating Masterinventory at = " .time();
	//global $outputfile;
	// $file = fopen("next000.csv","r");
	// print_r(fgetcsv($file));
	// fclose($file);
	$path = 'C:/xampp/htdocs/UC/sysindex/uc/output/query_without_index1_May2205.csv';
	$outfile = fopen($path,'w');
	//fputcsv($outfile,array("NAME","CREATOR","TBNAME","TBCREATOR","UNIQUERULE","COLCOUNT","CLUSTERING","CLUSTERED","DBID","OBID","ISOBID","DBNAME","INDEXSPACE","FIRSTKEYCARD","FULLKEYCARD","NLEAF","NLEVELS","BPOOL","PGSIZE","ERASERULE","DSETPASS","CLOSERULE","SPACE","IBMREQD","CLUSTERRATIO","CREATEDBY","IOFACTOR","PREFETCHFACTOR","STATSTIME","INDEXTYPE","FIRSTKEYCARDF","FULLKEYCARDF","CREATEDTS","ALTEREDTS","PIECESIZE","COPY","COPYLRSN","CLUSTERRATIOF","SPACEF","REMARKS","PADDED","VERSION","OLDEST_VERSION","CURRENT_VERSION","RELCREATED","AVGKEYLEN","KEYTARGET_COUNT","UNIQUE_COUNT","IX_EXTENSION_TYPE","COMPRESS","OWNER","OWNERTYPE","DATAREPEATFACTORF","ENVID","ROWID","HASH","SPARSE","PARSETREE","RTSECTION"));
fputcsv($outfile,array("QUERY","CONDITION","IXNAME","TBNAME","COLUNM","component name"));   

//$path1 = 'C:/xampp/htdocs/UC/fcrud/querywithout1.csv'; 
$path1 = 'C:/xampp/htdocs/UC/sysindex/uc/input/wherequeries1.csv';
$file = fopen($path1,"r");
while(! feof($file))
{
	$data = fgetcsv($file);
    echo "<pre>";
//	echo "<br> $data[3]";
	$path2 = 'Book1.csv'; 
	$file1 = fopen($path2,"r");
	while(! feof($file1))
	{
	   $data1 = fgetcsv($file1);
	   $tbname = $data1[0]; 
	   $ixname = $data1[1];
	   $column = $data1[2];
       $col = explode(",",$column);
//     print_r($col);
	   $count = count($col);
//	   $count = count($col);
//	   echo "<br>total count  $count";
	   $inc = 0;
	   $inc1 = 0;
	   $inc2 = 0;
	   
		while($inc < $count)
		{
//			 echo "<br>$tbname $data[1] $col[$inc] $data[2]";
		   if(($tbname == $data[1]))
		   {
			   if(strpos($data[2],$col[$inc]) !== false)
				{
				 echo "<br> $tbname $col[$inc] yesss $data[3]"; 
				 $inc1++;
					
				}

			}
			else
			{
				$inc2++;
			}
			
		$inc++;
		}
		echo "<br>file count $inc1";
		if(($inc1 == $count) && ($data[3] !== ""))
		{
			$cond = "TOTAL MATCH";
			fputcsv($outfile,array($data[3],$cond,$ixname,$tbname,$data[2],$data[0]));
			
		}
		elseif(($inc1 < $count) && ($inc1 !== 0) && ($data[3] !== ""))
		{
			$cond = "PARTIAL MATCH";
			fputcsv($outfile,array($data[3],$cond,$ixname,$tbname,$data[2],$data[0]));
			
		}
		// elseif(($inc2 == $count) && ($data[3] !== ""))
		// {
			// $cond = "NO MATCH";
			// fputcsv($outfile,array($data[3],$cond,$ixname,$tbname));
		// }
	
    }
	// if(($inc2 == true) && ($data[3] !== "") && ($inc11 !== true))
		// {
			// $cond = "NO MATCH";
			// fputcsv($outfile,array($data[3],$cond,$ixname,$tbname,$data[2]));
			// $inc2 = false;
		// }

}




 

?>