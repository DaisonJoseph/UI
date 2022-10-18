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
echo "Started".PHP_EOL;
$outfile = fopen("C:/xampp/htdocs/UCAB/Source_May_07/Reports/Skeletonxref_withoutjclxref.csv","w");
				$writehead = "Calling Component" . "," . "Calling Type" . "," . "Called Component" . "," . "Called Type";
				fputcsv($outfile,explode(",",$writehead));
$dirPath = "C:/xampp/htdocs/UCAB/Source_May_07/ExpandedSkeleton0705";
$readutilities = fopen("C:/xampp/htdocs/UCAB/Scripts/utilities.csv","r");
	$utilities = array();
	while(!feof($readutilities))
	{
		$utli = fgetcsv($readutilities);
		$utilities[] = $utli[0];
	}
	fclose($readutilities);
$files1 = array();
 

searchFilesInDirectory($dirPath);
function searchFilesInDirectory($dirPath) 
{
   global $files1;
   if (! is_dir($dirPath)) {
       throw new InvalidArgumentException("$dirPath must be a directory");
   }
   if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
       $dirPath .= '/';
   }
   $files = glob($dirPath . '*', GLOB_MARK);
   foreach ($files as $filee) {
       if (is_dir($filee)) {
           searchFilesInDirectory ($filee);
       }
	   else 
	   {
            array_push($files1, $filee);
        }
   }
}
foreach($files1 as $file)
{
  $file_handle = fopen($file,"r");
  $calling_comp = basename($file,".txt");
  echo $calling_comp."<br>";
  $filename = "";
  $calling_type = "SKELETON";
  $called_comp = "";
  $called_type = "";
  $searchValues = array("PGM=",".","(",")",",");
  $replaceValues = "";
  
  while(!feof($file_handle))
  {   
		$line = fgets($file_handle);
		$line1 = trim(preg_replace('/\s+/'," ",$line));
		$ary = explode(" ",$line1);
	if ((substr($line1,0,3) != "//*") && (substr($line1,0,1) != "*"))
	{	
	// if(stripos($line1," EXEC ")!==false)
	// {
		// $called_type = "PROC";
		// // print_r($ary);
		
		// if(stripos($line1," PGM=")!==false)
		// {	
			// if(stripos($line1,",")!==false)
			// {
				// $called_type = "COBOL";
				// $explode = explode(",",$ary[2]);
				// $called_comp = $explode[0];
				// $called_comp = str_replace($searchValues,$replaceValues,$called_comp);
				// if(in_array($called_comp,$utilities)==true)
				// {
					// $called_type = "UTILITY";
				// }
			// }
		// }	
		// else
			// {
				// // $called_comp = $ary[2];
				// $called_comp = substr($ary[2],0,strpos($ary[2],","));	
				// $called_comp = str_replace($searchValues,$replaceValues,$called_comp);
			// }	
		  
	// }
	if(stripos($line1,"CLISTOR")!==false)
	{
		$called_type = "CLIST";
		$called_comp = $ary[1];			
		$called_comp = str_replace($searchValues,$replaceValues,$called_comp);
		
	}
	if(stripos($line1,"SELECT MEMBER")!==false)
	{
		$called_type = "CLIST";
		$explode = explode("=",$ary[1]);
		$nxtexplode = explode(",",$explode[1]);
		$called_comp = $nxtexplode[0];
		$called_comp = str_replace($searchValues,$replaceValues,$called_comp);
	}
	if(stripos($line1,"CMD(")!==false)
	{
		$called_type = "REXX";
		$explode = explode("(",$ary[1]);
		$called_comp = $explode[1];
		$called_comp = str_replace($searchValues,$replaceValues,$called_comp);
	}		

	// if((stripos($line1,"DSN")!==false))
	// {
		// $pos = (stripos($line1,"DSN="));
		// $name2 = substr($line1, $pos+4);
		// $called_type = "FILE";
		// if(substr($name2,0,1)!== ",")
		// {
			// // echo "line<br>";
			// $filename = strtok($name2,",");
			// $filename = preg_replace( "/\r|\n/", "", $filename );
			// $filename = strtok($filename," ");
			// $temp_File1 = $filename;
			// // echo $filename.PHP_EOL;
			// if(strpos(" ".$filename,"&") === 1)
			// {
				// // echo $filename.PHP_EOL;
				// $called_type = "FILE";
				// // echo $called_type.PHP_EOL;
			// }
			// else if(stripos($filename,"(") !== false)
			// {
				// $filename = substr($filename,stripos($filename,"(")+1);
				// $filename = strtok($filename,")");
				// // echo "sa    ".$filename.PHP_EOL;
				// $called_type = "CONTROL_CARD";
				// if(is_numeric($filename) || empty(trim($filename)) || (strpos($filename,"&") !== false) || (strpos($filename,"?") !== false))
				// {  
					// $filename = substr($temp_File1,0,stripos($temp_File1,"("));
					 // $called_type = "FILE";
				// }//$called_comp = $filename;
				// // echo "$line<br>";
				// // echo "$called_type<br>";
			// }
		// }
		// $called_comp = $filename;
		// // echo $called_comp."	".$called_type.PHP_EOL;
	// }
	
	 if(!empty($called_comp))
	  {        
		  $write = $calling_comp . "!" . $calling_type . "!" . $called_comp . "!" . $called_type;
		  fputcsv($outfile,explode("!",$write));
		  $called_type = "";
		  $called_comp = "";
	  }
	  unset($ary);
	}  
  }
	
}
echo date('H:i:s').PHP_EOL;
echo "Ended".PHP_EOL;
?>