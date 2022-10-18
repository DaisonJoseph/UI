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
	$path = 'C:/xampp/htdocs/UC/sysindex/sys_indexes.csv';
	$outfile = fopen($path,'w');
	//fputcsv($outfile,array("NAME","CREATOR","TBNAME","TBCREATOR","UNIQUERULE","COLCOUNT","CLUSTERING","CLUSTERED","DBID","OBID","ISOBID","DBNAME","INDEXSPACE","FIRSTKEYCARD","FULLKEYCARD","NLEAF","NLEVELS","BPOOL","PGSIZE","ERASERULE","DSETPASS","CLOSERULE","SPACE","IBMREQD","CLUSTERRATIO","CREATEDBY","IOFACTOR","PREFETCHFACTOR","STATSTIME","INDEXTYPE","FIRSTKEYCARDF","FULLKEYCARDF","CREATEDTS","ALTEREDTS","PIECESIZE","COPY","COPYLRSN","CLUSTERRATIOF","SPACEF","REMARKS","PADDED","VERSION","OLDEST_VERSION","CURRENT_VERSION","RELCREATED","AVGKEYLEN","KEYTARGET_COUNT","UNIQUE_COUNT","IX_EXTENSION_TYPE","COMPRESS","OWNER","OWNERTYPE","DATAREPEATFACTORF","ENVID","ROWID","HASH","SPARSE","PARSETREE","RTSECTION"));
fputcsv($outfile,array("NAME","CREATOR","TBNAME","TBCREATOR","UNIQUERULE"));    
$file = fopen("sysindexes.txt","r");
while(!feof($file))
{
  $data = fgets($file);
  echo "<pre>";
  $data = trim($data);
  //echo "<br> ---> $data";
  $colA1 = substr($data,0,128);
  echo "<br>1 ---> $colA1";
//--------------------------------------------
  $colB1 = substr($data,130,128);
  echo "<br>2 ---> $colB1";
//--------------------------------------------
  $colC1 = substr($data,260,128);
  echo "<br>3 ---> $colC1";
//--------------------------------------------  
   $colD1 = substr($data,390,128);
   echo "<br>4 ---> $colD1";
//--------------------------------------------  
	$colE1 = substr($data,519,1);
	echo "<br>5 ---> $colE1";
// //--------------------------------------------  
  // $colF1 = substr($data,523,1);
  // echo "<br> ---> $colF1";
// //--------------------------------------------  
  // $colG1 = substr($data,524,1);
  // echo "<br> ---> $colG1";
// //--------------------------------------------  
  // $colH1 = substr($data,525,1);
  // echo "<br> ---> $colH1";
// //--------------------------------------------  
  // $colI1 = substr($data,526,1);
  // echo "<br> ---> $colI1";
// //--------------------------------------------  
  // $colJ1 = substr($data,527,1);
  // echo "<br> ---> $colJ1";
// //--------------------------------------------  
  // $colK1 = substr($data,529,1);
  // echo "<br> ---> $colK1";
// //--------------------------------------------  
  // $colL1 = substr($data,530,1);
  // echo "<br> ---> $colL1";
// //--------------------------------------------  
  // $colM1 = substr($data,533,24);
  // echo "<br> ---> $colM1";
// //--------------------------------------------  
  // $colN1 = substr($data,559,24);
  // echo "<br> ---> $colN1";
// //--------------------------------------------  
  // $colO1 = substr($data,559,27);
  // echo "<br> ---> $colO1";	 
// if(strpos($colA1,"NNSYSTEM.") == false)
// {	
  fputcsv($outfile,array($colA1,$colB1,$colC1,$colD1,$colE1));
// }
}
?>