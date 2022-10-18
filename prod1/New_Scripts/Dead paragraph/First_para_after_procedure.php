<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
$outpath = "C:\\Users\\thilab\\Desktop\\Paraxref_may26_1.csv";
$outputHandle = fopen($outpath, "w");
fputcsv($outputHandle, array("Program Name", "Called Paragraph Name"));
fclose($outputHandle);
openDirectoryForFiles("C:\\Users\\thilab\\Desktop\\UC_Bank\\Source\\Expanded2404");
function openDirectoryForFiles($dirPath)
 {
    if (! is_dir($dirPath)) 
	{
        throw new InvalidArgumentException($dirPath." must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '\\') 
	{
        $dirPath .= '\\';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) 
	{
        if (is_dir($file)) 
		{
            openDirectoryForFiles($file);
        } else 
		{
             
            readOldFile($file);
        }
    }
}
function readOldFile($filePath)
{
		    $file = fopen($filePath,'r');
			$setparaflag=false;//true if a paragraph condition is met
			$setProcedureDivision = false;//true if procedure division is reached
			$component_type = "COBOL";
			$seperatefilepath=explode("\\",$filePath);//extracting file name from last addrs of filepath
			$last_addrsof_filepath=count($seperatefilepath)-1;
			$component_name= $seperatefilepath[$last_addrsof_filepath];//component name
			$loc=0;
			$firstpara_is_section = false;
			$firstpara_is_not_section = false;
			$section = " ";
    while(!feof($file))
	{
        $line =fgets($file);//reading file line by line
        $line=substr($line,6,66);//in cobol first six spaces are either left blank or used for line number
		
                
        if ((strpos($line,"PROCEDURE") != false) && (strpos($line,"DIVISION") != false))
			{
			$setProcedureDivision = true;
			echo "PROCEDURE DIVISION<br>";
			} 
			if ($setProcedureDivision == true)
			{
			
				if (substr($line,0,1) != "*"  && substr($line,1,1) != "*"  && (substr($line,1,1) != " "||substr($line,2,1) != " "||substr($line,3,1) != " "||substr($line,4,1) != " ") &&strpos($line,"."))
					{
						echo "PARA".$line."<br>";
						//$setparaflag=true;
						$line_withoutmspace= preg_replace('/\s+/', ' ',$line);
						if(stripos($line_withoutmspace,"DECLARATIVES")== false)
						{  
	                       if(stripos($line_withoutmspace,"SECTION") !== false)
						   {
							   $firstpara_is_section = true;
							   echo "firstpara_is_section<br>";
						   }
                        if(stripos($line_withoutmspace,"SECTION") == false && $firstpara_is_section == false && (stripos($line_withoutmspace,"PROCEDURE")== false && stripos($line_withoutmspace,"DIVISION") == false))
						{
							$firstpara_is_not_section = true;
							echo "firstpara_is_not_section<br>";
						}	
                        if($firstpara_is_not_section == true && (stripos($line_withoutmspace,"PROCEDURE")== false && stripos($line_withoutmspace,"DIVISION") == false))
						{
							
							$calledpara = $line_withoutmspace;
							
							echo "firstpara_is_not_section".$calledpara."<br>";
							$outpath = "C:\\Users\\thilab\\Desktop\\Paraxref_may26_1.csv";
						    $outputHandle = fopen($outpath, "a");
						    $w=array($component_name,$calledpara);
						    fputcsv($outputHandle, $w);
						    fclose($outputHandle);
							break;
						}
                        if(stripos($line_withoutmspace,"SECTION") !== false && stripos($line_withoutmspace,$section) == false && $loc >=1)
						{
							break;
							//echo $count;
						}						
						if($firstpara_is_section == true)
						{
							$section = $line_withoutmspace;
							$loc++;
							echo "Stupid loc pls come";
							//echo "hi";
					        $calledpara = $line_withoutmspace;
							echo "firstpara_is_section".$calledpara."<br>";
							$outpath = "C:\\Users\\thilab\\Desktop\\Paraxref_may26_1.csv";
						    $outputHandle = fopen($outpath, "a");
						    $w=array($component_name,$calledpara);
						    fputcsv($outputHandle, $w);
						    fclose($outputHandle);
							
							
						
						
						//echo $line."<br>";
						//$callingpara=$line;
					}
						}
							
			
				
	            }
			}	
	}			
    fclose($file);
    

}
	?>