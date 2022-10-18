<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	$write=fopen("C:/xampp/htdocs/UCAB/imagecopy_may12.csv","a");
    fputcsv($write,array("component_name","component_type","database","tablespace","image_copy_file"));
    fclose($write);
	$dirPath = "C:/Users/sbhumija/Desktop/EXPJCL2May7";
	
    openDirectoryForFiles($dirPath);

function openDirectoryForFiles($dirPath) //function to get files and pass it to find path according to file types
{
    if (! is_dir($dirPath)) 
	{
      throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
	{
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);//file names stored as array in $files
    foreach ($files as $file)
	{
        if (is_dir($file))//is_dir() to check if file name is directory or not
		{
          openDirectoryForFiles ($file);
		}
		else 
		{
           Image($file);
	    }
    }
	
}
function Image($file)
{ 
$write=fopen("C:/xampp/htdocs/UCAB/imagecopy_may12.csv","a");
$Tablespace_flag=false;
$database="";
$tablespace="";
$image_file="";
$component_type="JCL";
$filename=basename($file);//filename
$newfile = fopen($file,"r");
		while(!feof($newfile))
		{
			$lines = fgets($newfile);
			if(((preg_match("/\bCOPY\b/i", $lines)>0)&&(preg_match("/\TABLESPACE\b/i", $lines)>0))||((preg_match("/\bMERGECOPY\b/i", $lines)>0)&&(preg_match("/\TABLESPACE\b/i", $lines)>0))||((preg_match("/\bCOPY\b/i", $lines)>0)&&(preg_match("/\INDEXSPACE\b/i", $lines)>0)))
			{
				$Tablespace_flag=true;
				$line_image=preg_split('/\s+/', $lines);
				for($i=0;$i<count($line_image);$i++)
				{
					if(stripos($line_image[$i],".")!==false)
					{
						$explode_line_image=explode(".",$line_image[$i]);
						$database=$explode_line_image[0];
						$tablespace=$explode_line_image[1];
						break;
					}
				}
			}
				if($Tablespace_flag==true)
				{
					  if((preg_match("/\bDSN\b/i", $lines)>0))
					{
						$image_file = substr(trim($lines), strpos($lines, "=") + 1);  
						$Tablespace_flag=false;	
						$output=array($filename,$component_type,$database,$tablespace,$image_file);
						fputcsv($write,$output);					
				    }
				}
				
			
			
		}
			fclose($newfile);
}