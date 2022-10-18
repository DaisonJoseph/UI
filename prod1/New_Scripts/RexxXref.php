<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	fputcsv(fopen("RexxXref_may13_v2.csv","a"),array("calling_component_name","calling_component_type","called_component_name","called_component_type","lines"));
	$dirPath = "C:/Users/sbhumija/Desktop/ISPF_SEGREGATED_MAY7_20 - Copy/REXX";
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
           RexxXref($file);
	    }
    }
	
}
global $calling_component_name;

function RexxXref($file)
{ 
global $calling_component_name;


    $explode_path=explode("/",$file);//exploding file path
    $explode_path_len=count($explode_path)-2;//second string of  last folder name
	$foldername=$explode_path[$explode_path_len];
	$foldername=str_replace("\\","",$foldername);
	$foldername=trim($foldername);
	$filename=basename($file);//filename
	$filename=mb_convert_encoding($filename, 'ISO-8859-1', 'UTF-8');
    $called_component_name = "";
	$newfile = fopen($file,"r");
	//echo $foldername ."<br>";
		while(!feof($newfile))
		{
			
			 $lines = fgets($newfile);
			
			 //for messages MSG(
			if(stripos($lines,"MSG(")!== false)
			{
		          $calling_component_name = $filename;
				  echo"yes";
				  $start=substr($lines,stripos($lines,"MSG("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,4,$end-4);
				  echo $called_component_name;
				  $called_component_type = "Message";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
			if(stripos($lines,"MSG (")!== false)
			{
		          $calling_component_name = $filename;
				  
				  $start=substr($lines,stripos($lines,"MSG ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,5,$end-5);
				 
				  $called_component_type = "Message";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
				//for panel PANEL(
			if(stripos($lines,"PANEL(")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"PANEL("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,6,$end-6);
				 
				  $called_component_type = "Panel";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
			if(stripos($lines,"PANEL (")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"PANEL ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,7,$end-7);
				 
				  $called_component_type = "Panel";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
				//clist and rexx  PGM(,CMD(,FI(,DDNAME(,CALL, DA(,MACRO(,F(,	//TO DO CALL
				
			if(stripos($lines,"PGM(")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"PGM("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,4,$end-4);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
			if(stripos($lines,"PGM (")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"PGM ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,5,$end-5);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					// if(stripos($lines,"PGM=")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"PGM="));
				 // $end=stripos($start," ");
				 // $called_component_name=substr($start,4,$end-4);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					
					//CMD(
			if(stripos($lines,"CMD(")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"CMD("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,4,$end-4);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
			if(stripos($lines,"CMD (")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"CMD ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,5,$end-5);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
			
			//DDNAME
			if(stripos($lines,"DDNAME(")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"DDNAME("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,7,$end-7);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2_may13.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
			if(stripos($lines,"DDNAME (")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"DDNAME ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,5,$end-5);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					//MACRO(
			if(stripos($lines,"MACRO(")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"MACRO("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,6,$end-6);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					
			if(stripos($lines,"MACRO (")!== false)
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"MACRO ("));
				  $end=stripos($start,")");
				  $called_component_name=substr($start,7,$end-7);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
					// //FI(
						// if(stripos($lines,"FI(")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"FI("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,3,$end-3);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					
					
					// if(stripos($lines,"FI (")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"FI ("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,4,$end-4);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					// //F(
					// if(stripos($lines,"F(")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"F("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,2,$end-2);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					
					
					// if(stripos($lines,"F (")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"F ("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,3,$end-3);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					// //DA(
		
						// if(stripos($lines,"DA(")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"DA("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,3,$end-3);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					
					
					// if(stripos($lines,"DA (")!== false){
		          // $calling_component_name = $filename;
				  // $start=substr($lines,stripos($lines,"DA ("));
				 // $end=stripos($start,")");
				 // $called_component_name=substr($start,4,$end-4);
				 
				  // $called_component_type = "Clist/REXX";
				  // $calling_component_type="REXX";
		          // fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  			// }
					//CALL
		
			if((preg_match("/\bCALL\b/i", $lines)>0))
			{
		          $calling_component_name = $filename;
				  $start=substr($lines,stripos($lines,"CALL ")+5);
				 $end=stripos($start," ");
				 $called_component_name=substr($start,0,$end);
				 
				  $called_component_type = "Clist/REXX";
				  $calling_component_type="REXX";
		          fputcsv(fopen("RexxXref_may13_v2.csv","a"),array($calling_component_name,$calling_component_type,$called_component_name,$called_component_type,$lines));
		  	}
					
				
					
					
		}fclose($newfile);
}	
		
