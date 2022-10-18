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
	$path = 'C:/xampp/htdocs/UC/fcrud/output/QUERYWOIX_w_database_MAY23.csv';
	$outfile = fopen($path,'w');
	//fputcsv($outfile,array("NAME","CREATOR","TBNAME","TBCREATOR","UNIQUERULE","COLCOUNT","CLUSTERING","CLUSTERED","DBID","OBID","ISOBID","DBNAME","INDEXSPACE","FIRSTKEYCARD","FULLKEYCARD","NLEAF","NLEVELS","BPOOL","PGSIZE","ERASERULE","DSETPASS","CLOSERULE","SPACE","IBMREQD","CLUSTERRATIO","CREATEDBY","IOFACTOR","PREFETCHFACTOR","STATSTIME","INDEXTYPE","FIRSTKEYCARDF","FULLKEYCARDF","CREATEDTS","ALTEREDTS","PIECESIZE","COPY","COPYLRSN","CLUSTERRATIOF","SPACEF","REMARKS","PADDED","VERSION","OLDEST_VERSION","CURRENT_VERSION","RELCREATED","AVGKEYLEN","KEYTARGET_COUNT","UNIQUE_COUNT","IX_EXTENSION_TYPE","COMPRESS","OWNER","OWNERTYPE","DATAREPEATFACTORF","ENVID","ROWID","HASH","SPARSE","PARSETREE","RTSECTION"));
fputcsv($outfile,array("QUERY","CONDITION","IXNAME","TBNAME","DATABASE","SYSTEM","COLUNM","COMPONENT NAME")); 

//$path1 = 'C:/xampp/htdocs/UC/fcrud/querywithout1.csv'; 
$path1 = 'C:/xampp/htdocs/check04.csv';
$file = fopen($path1,"r");
while(! feof($file))
{
	$data = fgetcsv($file);
    echo "<pre>";
	echo "<br> $data[0]";
	$path2 = 'tableinfo1.csv'; 
	$file1 = fopen($path2,"r");
	while(! feof($file1))
	{
	   $data1 = fgetcsv($file1);
	   $tbname = $data1[0]; 
	   $dbname = $data1[1];
	   $system = $data1[2];
	   if($data[3] == $tbname)
	   {
		 fputcsv($outfile,array($data[0],$data[1],$data[2],$data[3],$dbname,$system,$data[4],$data[5]));  
	   }
  
    }

}




 

?>