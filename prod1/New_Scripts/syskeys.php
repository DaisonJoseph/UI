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
	$path = 'C:/xampp/htdocs/UC/sysindex/querywithoutindex111.csv';
	$outfile = fopen($path,'w');
	//fputcsv($outfile,array("NAME","CREATOR","TBNAME","TBCREATOR","UNIQUERULE","COLCOUNT","CLUSTERING","CLUSTERED","DBID","OBID","ISOBID","DBNAME","INDEXSPACE","FIRSTKEYCARD","FULLKEYCARD","NLEAF","NLEVELS","BPOOL","PGSIZE","ERASERULE","DSETPASS","CLOSERULE","SPACE","IBMREQD","CLUSTERRATIO","CREATEDBY","IOFACTOR","PREFETCHFACTOR","STATSTIME","INDEXTYPE","FIRSTKEYCARDF","FULLKEYCARDF","CREATEDTS","ALTEREDTS","PIECESIZE","COPY","COPYLRSN","CLUSTERRATIOF","SPACEF","REMARKS","PADDED","VERSION","OLDEST_VERSION","CURRENT_VERSION","RELCREATED","AVGKEYLEN","KEYTARGET_COUNT","UNIQUE_COUNT","IX_EXTENSION_TYPE","COMPRESS","OWNER","OWNERTYPE","DATAREPEATFACTORF","ENVID","ROWID","HASH","SPARSE","PARSETREE","RTSECTION"));
fputcsv($outfile,array("TBNAME","IXNAME","COLUMN"));    
$file = fopen("sysindex123.csv","r");
while(! feof($file))
{
  $data = fgetcsv($file);
  echo "<pre>";
  $file1 = fopen("syskeys123.csv","r");		//table details
  while(!feof($file1))
	{
	$data1 = fgetcsv($file1);
	if(($data[0] == $data1[0]))
	{
		echo"<br>\n dottttttttttttttt $data[2],$data[0],$data1[2] ";
		fputcsv($outfile,array($data[2],$data[0],$data1[2]));				
	}
	}
	$csvflag = false;
	fclose($file1);
}