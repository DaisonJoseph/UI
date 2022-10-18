<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
$outpath = "C:\\xampp\\htdocs\\loc_full.csv";
$outputHandle = fopen($outpath, "w");
fputcsv($outputHandle, array("Program Name","Calling Paragraph Name", "LOC"));
fclose($outputHandle);
openDirectoryForFiles("C:/Users/thilab/Desktop/UC_Bank/Source/Expanded2404");
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
			$paracount=0;
    while(!feof($file))
	{
        $line =fgets($file);//reading file line by line
        $line=substr($line,6,66);//in cobol first six spaces are either left blank or used for line number
		
                
        if ((strpos($line,"PROCEDURE") != false) && (strpos($line,"DIVISION") != false))
			{
			$setProcedureDivision = true;
			} 
			if ($setProcedureDivision == true)
			{
				if(substr($line,0,1)!=="*"  && substr($line,0,3)!=="//*"  && substr($line,0,2)!=="/*")
				{
					
				if (substr($line,0,1) != "*"  &&  (substr($line,1,1) != " "||substr($line,2,1) != " "||substr($line,3,1) != " "||substr($line,4,1) != " ") )
					{
						$setparaflag=true;
						$paracount++;
						$callingpara=$line;
						echo "yes",$component_name."<br>";
					}
				if($setparaflag==true && $paracount==1 )
					{
					    $loc++;
						echo "loc". $loc."<br>";
						
					}
					echo "paracount".$paracount ."<br>";
						if($paracount>1){
							
							$outpath = "loc_full.csv";
						    $outputHandle = fopen($outpath, "a");
						    fputcsv($outputHandle,array($component_name,$callingpara,($loc-1)));
							$loc=1;
							$paracount=1;
						}
					
	}			
	}
	}	
    fclose($file);
    

}
	?>