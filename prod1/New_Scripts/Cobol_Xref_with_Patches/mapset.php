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
// $dirPath = "C:/xampp/htdocs/UCAB/sample/";
$filesList = array();	
$searchValues = array("(","'",'"',")",".");
$replaceValues = "";
$csvFile = fopen("C:/xampp/htdocs/UCAB/Reports/Version_8_1/map_8_1.csv","w");
fputcsv($csvFile,array("called_component_name","called_component_type","calling_component_name","calling_component_type","call_type"));
fclose($csvFile);
$filesList = searchFilesInDirectory($dirPath);
// echo "<pre>";
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
				$line = str_replace(" ","",$line);
				// echo $line."<br>";
				$lineArray = explode("(",$line);
				// echo $lineArray[0]."	".$lineArray[1]."	".$lineArray[2]."<br>";
				// echo $line.PHP_EOL;
				if((strpos($line,"EXEC") !== false) && (strpos($line,"RETURN") !== false))
				{
					// echo $lineNo.PHP_EOL;
					// echo $line.PHP_EOL;
					$returnFlag = true;
				}
				elseif((strpos($line,"EXEC") !== false) && ((strpos($line,"CICS") !== false)))
				{
					$linkflag =true;
				}
				elseif(strpos($line,"END-EXEC") !== false)
				{
					$returnFlag = false;
					$linkflag = false;
				}
				// echo $lineArray[1]."<br>";
				if(((stripos($lineArray[0],"MAPSET") !== false)||(stripos($lineArray[0],"MAP") !== false))&& ($returnFlag == false) && ($linkflag == true) ) 
				{
					$i=0;
					print_r($lineArray)."<br>";
					foreach($lineArray as $checkTrans)
					{	
						// echo $checkTrans."<br>";
						if(($checkTrans == "MAPSET")||($checkTrans == "MAP"))
						{break;}
						$i += 1;
					}
					// echo $checkTrans;
					// echo $lineArray[0];
					if(($lineArray[0] == "MAPSET")||($lineArray[0] == "MAPSET (")||($lineArray[0] == "MAPSET(")||($lineArray[0] == "MAP(")||($lineArray[0] == "MAP (")||($lineArray[0] == "MAP"))
					{
						$transId = $lineArray[1];
					}
					// elseif($lineArray[3] == "PROGRAM")
					// {
						// $transId = $lineArray[4];
					// }
					echo $transId."<br>";
					$transId = str_replace($searchValues,$replaceValues,$transId);
					// echo "<br>".$transId."-----"."<br>";
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
						// echo $transId.PHP_EOL;
						// echo "<br>";
					}
					if($write !== false)
					{
						$write = false;
						$csvFile = fopen("C:/xampp/htdocs/UCAB/Reports/Version_8_1/map_8_1.csv","a");
						fputcsv($csvFile,array($programName,"COBOL",$transId,"MAPS",$type));
						// echo $transId."---called---";
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
	global $searchValues;
	global $replaceValues;
	$tempArray = $fileArray;
	echo count($tempArray).PHP_EOL;
	echo $transId.PHP_EOL;
	$count = 0;
	for($i=count($tempArray)-1;$i >=0; $i--){
		$count += 1;
		$tempArray[$i] = substr($tempArray[$i],7,65);
		$tempArray[$i] = trim(preg_replace("/\s+/"," ",$tempArray[$i]));
		// echo $tempArray[$i].PHP_EOL;
		// if(stripos($tempArray[$i],$transId) !== false)
		// {
			if((stripos($tempArray[$i],"MOVE") !== false) && stripos($tempArray[$i],$transId) !== false)
			{
				echo "Dynamic".PHP_EOL;
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
				print_r($tempLineArray);
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
			// echo $tempLineArray[1]."tempArray";
		// }
	}
}
	echo "Completed";
?>