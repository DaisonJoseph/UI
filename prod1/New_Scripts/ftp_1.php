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
	$path = 'C:/xampp/htdocs/UC/cobol/ftp.csv';
	$outfile = fopen($path,'w');

	//$outputfile = fopen("C:/xampp/htdocs/sample1.csv","w");
	fputcsv($outfile,array("Component name","rmtlu","loclu","username","password","source file","receiver file"));
	$directorypath = "C:/xampp/htdocs/UC/search1/EXPJCL3";
	searchdirectory($directorypath);
function searchdirectory($dirPath) 
{
	if (is_dir($dirPath)== false) 
	{
		echo "Not a valid directory";
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) !== '/') 
	{
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) 
	{
		if (is_dir($file))
		{
			//searchdirectory ($file);
			read_file($file);
		} 
		else
		{
		   read_file($file); 
		}
	}   
}

function read_file($file)
{

	 global $outfile;
	  echo "<PRE>";
	 $a = explode("/",$file);
	  print_r($a);
	 $componentname = $a[6];
	 
	  $file1 = fopen($file,'r');
	  $ftpflag = false;
	  $s1 = array();
	    $r1 = array();
		$source = "";
		$receive = "";
	  while(!feof($file1))
      {
		  $line = fgets($file1);
		  $line = trim(preg_replace('/\s+/'," ",$line));
		  $line = str_replace("'","",TRIM($line));
		  if((stripos($line,"DVGIFBI") !== false))
		  {
			  $ftpflag = true;
			  echo "<br> $line";
		  }
		  if($ftpflag == true)
		  {
			  
			  if((stripos($line,"RMTLU") !== false))
			  {
				  $rm1 = explode("RMTLU=",$line);
				  $rmtlu = $rm1[1];
			  }
			  if((stripos($line,"LOCLU") !== false))
			  {
				  $lo1 = explode("LOCLU=",$line);
				  $loclu = $lo1[1];
			  }
			   if((stripos($line,"RSECURP") !== false))
			  {
				  $line = str_replace(array("(",")"),"",TRIM($line));
				  $rs1 = explode("RSECURP=",$line);
				  $rsecurp = explode(",",$rs1[1]);  
				  $username = $rsecurp[0];
				  $password = $rsecurp[1];
			  }
			  
			  if((stripos($line,"SFILEID") !== false))
			  {
				  $s1 = explode("SFILEID=",$line);
				  $source = $s1[1];
				  
			  }
			  if((stripos($line,"RFILEID") !== false))
			  {
				  $r1 = explode("RFILEID=",$line);
				  $receive = $r1[1];
				  echo "<br> $componentname,$rmtlu,$loclu,$username,$password,$source,$receive";
			  if(!empty($source) && !empty($receive) )
			  {
			  fputcsv($outfile,array($componentname,$rmtlu,$loclu,$username,$password,$source,$receive));
			  
			  }
			  }
			  
			 
		  }
		  
		  
		  
		  
	  }

}
?>