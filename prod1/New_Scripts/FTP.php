<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);

openDirectoryForFiles("C:\\Users\\thilab\\Desktop\\UC_Bank\\Exp_Cobol_IMS_MAR19");


function openDirectoryForFiles($dirpath) {
    $csvdir = fopen("FTP_cobol_tdy.csv","w");
    //$header[0] = "File path";
    $header[0] = "Component Name";
	$header[1] = "Action";
	$header[2] = "Server";
	$header[3] = "Username";
	$header[4] = "Password";
    //$header[1] = "Impacted";
    //$header[3] = "Content";
    //$header[4] = "Input";
    //$header[5] = "Output";
	//$header[2] = "Expansion";
	$header[5] = "Mainframe";
	$header[6] = "Target File";
	//$header[5] = "Type";
    fputcsv($csvdir, $header);
    $c=0;
    $input_line = "";
	$output_line = "";
    $impact = "";
    $content = "";
    $input = "";
    $output = "";
	$expansion = "";
	$expansion_type = "";
	//$member = array();
	 // if (! is_dir($dirpath)) {
		 // throw new invalidargumentexception($dirpath." must be a directory");
	 // }
	 // if (substr($dirpath, strlen($dirpath) - 1, 1) != '\\') {
		 // $dirpath .= '\\';
	 // }
    $files = glob($dirpath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            openDirectoryForFiles($file);
        } 
        else {
			
			$filenamext=getFileName($file);
			$directory = explode(".", $filenamext);
            $filename = $directory[sizeof($directory)-1];
			echo $filename."<br>";
			$file1 = fopen("$file",'r');
			$type = "";
			$content = "";
			$ftp = false;
			$sftp = false;
			$input = "";
			$start = false;
			$stop = false;
			$output = "";
			$start1 = false;
			$stop1 = false;
			$write = false;
		    $expansion = "";
			$flag = false;
			$c = 0;
			//$member = array();
            
            while (!feof($file1))
			{
				
                $line = trim(fgets($file1));					
                {
					if (stripos($line,"USER=") != false)
					{
						$name = $line."\n";
						$name1 = preg_replace('/\s+/', ' ', $name);
						$name2 = explode(",",$name1);
						$username = substr($name2[0],8);
						$password = substr($name2[1],9);
					}
					if (stripos($line,"@") != false)
					{
						$s = $line."\n";
						$new = explode("@",$s);
						$new1 = explode(" ",$new[1]);
						echo $new1."\n";
						$server = $new1[0];
						echo $server."\n";
					}
					if (stripos($line,"PGM=FTP") != false)
					{
						// $write = true;
						$type = "FTP";
						$ftp = true;
						//$member[] = fgets($line);
						$content = $content." , ".$line."\n";
						
					}
					if (stripos($line,"PGM=COZBATCH") != false)
					{
						$write = true;
						$type = "COZBATCH";
						$ftp = true;
						//$member[] = fgets($line);
						$content = $content." , ".$line."\n";
						
					}
					
					if (($ftp == true) &&  ((substr(trim($line),0,7)  == "//INPUT") || (substr(trim($line),0,3)  == "// ")))
					{
						if(stripos($line,"DD ") > 0){
							// echo $line."<br>";
							//echo "input<br>";
							$start = true;
							$flag = true;	
							$stop = false;
						}
					}
					if (($start == true) &&  ((substr(trim($line),0,3)  == "//*") || substr(trim($line),0,8)  == "//OUTPUT"))
					{
							//echo "stop<br>";
							$stop = true;
							$start = false;
					}
					
					if(($start == true) && ($stop == false))
					{
						//echo "inside<br>";
						//$member[] = fgets($line);
						$input = $input." , ".$line."\n";
						$c = $c + 1;
						//echo $line."<br>";
					}
					if (($ftp == true) &&  (substr(trim($line),0,8)  == "//OUTPUT"))
					{
						//echo "output something <br>";
						//$member[] = fgets($line);
						$output =$output." , ".$line."\n";
						//echo $line;
							// $start1 = true;
					}
					if (($flag == true) && ((substr(trim($line),0,3) == "GET") || substr(trim($line),0,3) == "PUT"))
					{
						$write = true;
						//echo "check<br>";
						//$member[] = fgets($line);
						$expansion = $expansion." , ".$line."\n";
						$b = preg_replace('/\s+/', ' ', $expansion);
						$ans = substr($b,9);
						$a = explode(" ",$ans);
						echo $a;
						$in = $a[0];
						$out = $a[1];
						//echo $line."<br>";
						if(($flag == true) && (substr(trim($line),0,3) == "GET"))
						{
							$expansion_type = "GET";
						}
						if(($flag == true) && (substr(trim($line),0,3) == "PUT"))
						{
							$expansion_type = "PUT";
						}
					
					}
					
					// if (($start1 == true) &&  ((substr(trim($line),0,3)  == "//*") || substr(trim($line),0,3) == "// "))
					// {
						// echo "condition check output <br>";
							// $stop1 = true;
							// $start1 = false;
					// }
					
					// if(($start1 == true) && ($stop1 == false))
					// {
						// echo "outside<br>";
						// echo "$line<br>";
						
						// $output = $output.",".$line;
						// //echo $output."<br>";
					// }
                 }
				// if($write == true){
				// echo "<br> Input   ".$input."<br>";
				// echo "<br> Output  ".$output."<br>";
				// }
            }
			//echo "===========================================================================================================================================<br>";
			
			if($write == true){
				$data = array($filename, $expansion_type, $server, $username, $password, $in, $out);	
				fputcsv($csvdir, $data); 
				$write = false;
			}
			//echo $input."<br>";
			//echo "1". $output."<br>";
			fclose($file1);
        }
    }

    fclose($csvdir);
}

function getFileName($filePath){
    $directory = explode("\\", $filePath);
    return $directory[sizeof($directory)-1];
}

?> 