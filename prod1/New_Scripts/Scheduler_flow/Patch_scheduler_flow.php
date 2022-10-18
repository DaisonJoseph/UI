<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	
	$dirPath = "C:/Users/thilab/Documents/callchain_new";
    openDirectoryForFiles($dirPath);
//ORDER: cobol,assembler,bms,dclgen,jcl,proc,copybook,control cards
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
           FindPath($file);
	    }
    }
	
}
function FindPath($file){
	$newfile=fopen($file,"r");
	while(!feof($newfile))
	{
		$line=fgets($newfile);
		$explode=explode(",",$line);
		$opencsv=fopen("callchain_scheduler_new.csv","a");
		fputcsv($opencsv,$explode);
		fclose($opencsv);
	}
	fclose($newfile);
}