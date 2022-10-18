<?php
error_reporting(E_ALL);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);
	date_default_timezone_set('Asia/Kolkata'); 
	echo "Generating Masterinventory at = " .time();
	
$count = 0;
//$dir = "C:/Apache24/htdocs/SourceCode/PAVE/Cobol/*.CBL";
$dir = "C:/xampp/htdocs/UCAB/Source2404/ims/*";
$proc_name = "";
$line1 = "";
// $csvfile = fopen("expanded_Missed_components.csv","w");
// $insert = ("Program Name" . "," . "Missed file name");
// fputcsv($csvfile, explode(",",$insert));
// fclose($csvfile);
// echo "Expanding";
foreach (glob($dir) as $file) 
{
	//echo "<br>ReadingFile" . $file;
	
	$folderName = basename(dirname($file));
	$extensionName = pathinfo($file,PATHINFO_EXTENSION);
	$dotExtension = "." . $extensionName;
	$programName = basename($file, $dotExtension);
	$i = 0;
	unset($outputLine);
	// echo "--------------------";
	echo $programName."<br>";
	$outputLine = array();
	$filecheck = "C:/xampp/htdocs/UCAB/Expanded2404_IMS/".$programName;
 if(!file_exists($filecheck))
 {	
	$write_file=fopen("C:/xampp/htdocs/UCAB/Expanded2404_IMS/".$programName,"w");
	$file_handle = fopen($file, "r");
	while(! feof($file_handle))
	{
		$line = strtoupper(fgets($file_handle));				
		$line1 = substr($line,7,72-7);
		$lineuniSpaces = trim(preg_replace("/\s+/"," ",$line1)); //trim(preg_replace('/[\t\n\r\s]+/','',$line1));
		$linearray = array();
		$linearray = explode(" ",$lineuniSpaces);
		$outputLine[$i] = $line;
		$i = $i +1;
		findProc($line,$linearray);
	
	}
	WriteLine($outputLine);
	fclose($file_handle);
 }	
}

function findProc($findline,$findlinearray)
{    
	global $proc_name, $write_file;
	$replaceName = "";
	if(count($findlinearray) > 1)
	{   
		if (substr($findline,6,1) != "*")
		{   
			if(($findlinearray[0] == "COPY") or ($findlinearray[0] == "INCLUDE"))
			{   
					
				// echo "<pre>";
				// echo $findline."<br>";
				if(count($findlinearray) > 2)
				{
					if($findlinearray[2] == "REPLACING")
					{
						$replaceName = $findlinearray[5];
						$replaceName = str_replace(".","",$replaceName);
					}
				}
				$proc_name = $findlinearray[1];
				$proc_name = str_replace("." ,"",$proc_name);
				$proc_name = trim($proc_name);
				// echo "<br> procname" .$proc_name . "<br>";
				expandProc($write_file,$replaceName);
				// echo $write_file;
			}
		}	
	}		
}			
			
function expandProc($write_file,$replaceName)
{   global $programName;
	global $proc_name;
	global $outputLine;
	global $line1;
	global $i;
	
	$procfile1 = "C:/xampp/htdocs/UCAB/Folder/". $proc_name;
   	if(!file_exists($procfile1))
    {   
        $procfile1 = "C:/xampp/htdocs/UCAB/Source2404/Overall_Source_Apr_24_20/DCLGEN/". $proc_name;
	}
	if(!file_exists($procfile1))
	{    $procfile1 = "C:/xampp/htdocs/UCAB/Source2404/Overall_Source_Apr_24_20/BMS_CPY". $proc_name;
	}
foreach (glob($procfile1) as $procfile) 
{  

	if(file_exists($procfile))
	{   $outputLine[$i] = "***********************Expanding ".$proc_name." starts*************\n";
        $i = $i + 1;
		$proc_file_handle = fopen($procfile, "r");
		while(! feof($proc_file_handle))
		{
			$proc_line = strtoupper(fgets($proc_file_handle));
			if(strpos($proc_line,"&&&") !== false)
			{
				$proc_line = str_replace("&&&",$replaceName,$proc_line);
			}
			//echo "<br> Proc Line".$proc_line;			
			$proc_line1 = substr($proc_line,7,72-7);
			//echo "what is in line" . $proc_line1 . "<br>";
			$proc_lineuniSpaces = trim(preg_replace("/\s+/"," ",$proc_line1));
			$proc_linearray = array();
			$proc_linearray = explode(" ",$proc_lineuniSpaces);
			$outputLine[$i] = $proc_line;
			$i = $i +1;
			//print_r($proc_linearray)."hello<br>";
			findProc($proc_line,$proc_linearray);
			$proc_line = "";	
		}	
        $outputLine[$i] = "************************Expanding ".$proc_name." ends*************\n";
        $i = $i + 1; 
		fclose($proc_file_handle);
	}
	else
	{ $csvfile1 = fopen("expanded_Missed_components.csv","a");
      $insert1 = ($programName . "," . $proc_name);
      fputcsv($csvfile1, explode(",",$insert1));
      fclose($csvfile1);
	}
	break;
}
}
function WriteLine($outputLine)
{   global $write_file;
	global $outputLine;
    $join = " ";
		
	foreach($outputLine as $word)
    {
	  // if(stripos($word,"*")!=6)
       {		 
        	/*    if(strpos($word,".")==false)
	    	    {	
	  		        $word = trim($word);
	    	    	$join = $join . " " . $word ;
	    	    }	
	    	    else
	    	    {
	    	    	$join = $join . " " . $word;
	  		        $join = preg_replace("/\s+/"," ",$join);
	  		        echo "new concat" . $join . "<br>";
	    	    	fwrite($write_file, $join . "\n");
	    	    	$join = " ";
	    	    }*/
				fwrite($write_file, $word);
	   }	
	}
	unset($outputLine);
	$outputLine = array();
	fclose($write_file);
}
echo "</br> Expanding cobol completed";
?>
