<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
$outpath = "C:\\Users\\thilab\\Desktop\\UC_Bank\\Paraxref_0905.csv";
$outputHandle = fopen($outpath, "w");
fputcsv($outputHandle, array("Program Name","Calling Paragraph Name", "Called Paragraph Name"));
fclose($outputHandle);
openDirectoryForFiles("C:\\Users\\thilab\\Desktop\\UC_Bank\\Expanded2404");
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
				if (substr($line,0,1) != "*"  && substr($line,1,1) != "*"  && (substr($line,1,1) != " "||substr($line,2,1) != " "||substr($line,3,1) != " "||substr($line,4,1) != " ") &&strpos($line,"."))
					{
						$setparaflag=true;
						//echo $line."<br>";
						$callingpara=$line;
					}
				if($setparaflag==true )
					{
					$line_withoutmspace= preg_replace('/\s+/', ' ',$line);	
					if(substr($line_withoutmspace,1,7)=="PERFORM"||substr($line_withoutmspace,1,7)=="perform")
					    {
						if(stripos($line_withoutmspace,"THRU")!== false)
						{
							$t = substr($line_withoutmspace,stripos($line_withoutmspace,"THRU")+4);
							$t1 = trim($t);
							$t2 = explode(" ",$t1);
							$calledpara = $t2[0]."_";
							$outpath = "C:\\Users\\thilab\\Desktop\\UC_Bank\\Paraxref_0905.csv";
						    $outputHandle = fopen($outpath, "a");
						    $w=array($component_name,$callingpara,$calledpara);
						    fputcsv($outputHandle, $w);
						    fclose($outputHandle);
						}							
						$a = substr($line,stripos($line,"PERFORM")+7);
						$b = trim($a);
                        $c = explode(" ",$b);
                        $calledpara = $c[0];						
						//$calledpara=str_replace("THRU"," ",$calledpara);
					    $outpath = "C:\\Users\\thilab\\Desktop\\UC_Bank\\Paraxref_0905.csv";
						$outputHandle = fopen($outpath, "a");
						$w=array($component_name,$callingpara,$calledpara);
						fputcsv($outputHandle, $w);
						fclose($outputHandle);	
						
					    }
					 
					 if(substr($line_withoutmspace,1,5)=="GO TO"||substr($line_withoutmspace,1,5)=="go to")
					    {
							
						$d = substr($line_withoutmspace,stripos($line_withoutmspace,"GO TO")+5);
						$e = trim($d);
                        $f = explode(" ",$e);
						$calledpara = $f[0];
						//echo $line;
						//$calledpara=str_replace("THRU"," ",$calledpara);
						$outpath = "C:\\Users\\thilab\\Desktop\\UC_Bank\\Paraxref_0905.csv";
						$outputHandle = fopen($outpath, "a");
						$w=array($component_name,$callingpara,$calledpara);
						fputcsv($outputHandle, $w);
						fclose($outputHandle);	
						
					    }
						if(substr($line_withoutmspace,1,5)=="MAPFAIL"||substr($line_withoutmspace,1,5)=="mapfail")
					    {
							
						$g = substr($line,stripos($line,"MAPFAIL")+7);
						$h = trim($g);
                        $i = explode(" ",$h);
						$calledpara = $i[0];
						//echo $line;
						//$calledpara=str_replace("THRU"," ",$calledpara);
						$calledpara=str_replace("("," ",$calledpara);
						$calledpara=str_replace(")"," ",$calledpara);
						$outpath = "C:\\Users\\thilab\\Desktop\\UC_Bank\\Paraxref_0905.csv";
						$outputHandle = fopen($outpath, "a");
						$w=array($component_name,$callingpara,$calledpara);
						fputcsv($outputHandle, $w);
						fclose($outputHandle);	
						
					    }
					}
			     //if programmers would have followed rules correctly then i would have used this logic,since now every para may or maynot have "exit"
				// if(substr($line,0,1) != "*"  &&  substr($line,1,1) != " " && (strpos($line,"EXIT")||strpos($line,"END")))
					// {
					  // $para=false;
					// }

			}			
			
				
	}			
				
    fclose($file);
    

}
	?>