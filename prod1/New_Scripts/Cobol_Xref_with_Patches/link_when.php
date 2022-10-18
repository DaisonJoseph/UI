<?php
error_reporting(E_ALL);

ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Kolkata');
echo date('H:i:s') . " Start";

$expandFile = array();
$dirPath = "C:/xampp/htdocs/UCAB/Expanded2404/";
$filesList = array();	
$searchValues = array("(","'",'"',")",".");
$replaceValues = "";
$csvFile = fopen("C:/xampp/htdocs/UCAB/Reports/Version_8_1/link_8_1.csv","w");
fputcsv($csvFile,array("called_component_name","called_component_type","calling_component_name","calling_component_type","call_type"));
fclose($csvFile);
$filesList = searchFilesInDirectory($dirPath);
echo "<pre>";
readAllFiles($filesList);

function searchFilesInDirectory($dirPath) 
{
	$files1 = array();
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
		} else {
			array_push($files1, $filee);
		}
   }
   return $files1;
}	

function readAllFiles($filesList)
{
	foreach($filesList as $file)
	{
		global $searchValues;
		global $replaceValues;
		// $file = "C:/xampp/htdocs/UC-BANK/Overall_source/COBOL/GC6000";
		$folderName = basename(dirname($file));
		$extensionName = pathinfo($file,PATHINFO_EXTENSION);
		$dotExtension = "." . $extensionName;
		$programName = basename($file, $dotExtension);
		$readFile = fopen($file,"r");
		
		$fileArray = array();
		$transId = "";
		$write =false;
		$returnFlag = false;
		$linkflag = false;
		$lineNo = 0;
		echo $programName.PHP_EOL;
		$count = 0;
		while(!feof($readFile))
		{
			$lineNo += 1;
			$line = fgets($readFile);
			$fileArray[] = $line;
			// echo $line.PHP_EOL;
			// echo (substr($line,0,7)).PHP_EOL;
			if((substr($line,0,7) !== "      *") && substr($line,0,7) !== "      /")
			{
				$line = substr($line,7,65);
				$line = trim(preg_replace("/\s+/"," ",$line));
				$lineArray = explode(" ",$line);
				// echo $lineArray[0]."	".$lineArray[1]."	".$lineArray[2]."<br>";
				// echo $line.PHP_EOL;
				if((strpos($line,"EXEC") !== false) && (strpos($line,"RETURN") !== false))
				{
					// echo $lineNo.PHP_EOL;
					// echo $line.PHP_EOL;
					$returnFlag = true;
				}
				elseif((strpos($line,"EXEC") !== false) && ((strpos($line,"LINK") !== false)||(strpos($line,"XCTL") !== false)))
				{
					$linkflag =true;
				}
				elseif(strpos($line,"END-EXEC") !== false)
				{
					$returnFlag = false;
					$linkflag = false;
				}
				if(in_array("PROGRAM",$lineArray) && ($returnFlag == false) && ($linkflag == true) ) 
				{
					$i=0;
					$count += 1;
					print_r($lineArray);
					foreach($lineArray as $checkTrans)
					{	
						// echo $checkTrans;
						if($checkTrans == "PROGRAM")
						{break;}
						$i += 1;
					}
					echo $checkTrans;
					if($lineArray[0] == "PROGRAM")
					{
						$transId = $lineArray[1];
					}
					elseif($lineArray[3] == "PROGRAM")
					{
						$transId = $lineArray[4];
					}
					// echo $transId."<br>";
					$transId = str_replace($searchValues,$replaceValues,$transId);
					// echo $transId;
					// echo $transId."trans";
					if(strpos($transId,"-") === false)
					{
						$type = "STATIC";
						$write = true;
					}
					else{
						$type = "DYNAMIC";
						$transId = dynamicCall($fileArray,$transId);
						$write = true;
						echo $transId.PHP_EOL;
						// echo "<br>";
					}
					if($write !== false)
					{
						$write = false;
						$csvFile = fopen("C:/xampp/htdocs/UCAB/Reports/Version_8_1/link_8_1.csv","a");
						fputcsv($csvFile,array($programName,"COBOL",$transId,"COBOL",$type));
						fclose($csvFile);
					}
				}
			}
		}
		// break;
	}
}

function dynamicCall($fileArray,$transId)
{
	global $count;
	global $searchValues;
	global $replaceValues;
	$tempArray = $fileArray;
	// echo count($tempArray).PHP_EOL;
	echo $transId.PHP_EOL;
	$count2 = 0;
	for($i=count($tempArray)-1;$i >=0; $i--){
		$tempArray[$i] = substr($tempArray[$i],7,65);
		$tempArray[$i] = trim(preg_replace("/\s+/"," ",$tempArray[$i]));
		// echo $tempArray[$i].PHP_EOL;
		// if(stripos($tempArray[$i],$transId) !== false)
		// {
			if((stripos($tempArray[$i],"MOVE") !== false) && stripos($tempArray[$i],$transId) !== false)
			{
				// echo "Dynamic".PHP_EOL;
				$tempLineArray = explode(" ",$tempArray[$i]);
				$transId = $tempLineArray[1];
				$transId = str_replace($searchValues,$replaceValues,$transId);
				if(strpos($transId,"-") !== false)
				{
					$transId = dynamicCall($tempArray,$transId);
					// echo $transId.PHP_EOL;
				}
				return $transId;
				// break;
			}
			elseif((stripos($tempArray[$i],"VALUE") !== false) && stripos($tempArray[$i],$transId) !== false)
			{
				$tempLineArray = explode(" ",$tempArray[$i]);
				$j = 0;
				foreach($tempLineArray as $checkTrans)
				{	
					if($checkTrans == "VALUE")
					{break;}
					$j += 1;
				}
				// print_r($tempLineArray);
				$transId = $tempLineArray[$j+1];
				$transId = str_replace($searchValues,$replaceValues,$transId);
				// echo $transId;
				if(strpos($transId,"-") !== false)
				{
					$transId = dynamicCall($tempArray,$transId);
				}
				return $transId;
				// break;
			}
			elseif((stripos($tempArray[$i],"EVALUATE") !== false) && stripos($tempArray[$i],$transId) !== false)
			{	
				$tt = count($tempArray)-2;
				// echo $tempArray[$tt].PHP_EOL;
				if(stripos($tempArray[$tt],"WHEN") !== false){
					$tempLineArray = explode("WHEN",$tempArray[$tt]);
					// print_r($tempLineArray);
					$transId = $tempLineArray[1];
					$transId = str_replace($searchValues,$replaceValues,$transId);					
				}
				if(strpos($transId,"-") !== false)
				{
					$transId = dynamicCall($tempArray,$transId);
				}
				return $transId;
			}
			// echo $tempLineArray[1]."tempArray";
		// }
	}
}
	echo "Completed";
?>