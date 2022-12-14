<?php
    error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time',0);  
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	
	global $csvfile;
	$csvfile = fopen("C:/xampp/htdocs/UCAB/Masterinvnetory_May18.csv","a");
	fputcsv($csvfile, array("component_name", "component_type","sub_type", "uloc", "cloc", "tloc","system","subsystem", "path"));
   
	$dirPath = "C:/Users/sbhumija/Desktop/CBL";

    openDirectoryForFiles($dirPath);

function openDirectoryForFiles($dirPath) //function to get files and pass it to GenerateMasterInventory
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
           GenerateMasterInventory($file);
		  
	    }
    }
	
}

function GenerateMasterInventory($file)
{  
	$cicsflag=false;
	$uncommented_loc = 0;
	$commented_loc = 0;
	$total_loc = 0;
	$Component_type = "";
	$Component_sub_type = "";
	$system="";
	$subSystem="";
	global $csvfile;
    $Component_file = fopen($file,"r");
	$Component_file1 = fopen($file,"r");
    $extensionName = pathinfo($file, PATHINFO_EXTENSION);
	$dotExtension = "." .$extensionName;
    $Component_Name = basename($file,$dotExtension);
	$Component_Name =mb_convert_encoding($Component_Name, 'ISO-8859-1', 'UTF-8');
	$explode_path=explode("\\",$file);//exploding file path
    $explode_path_len=count($explode_path)-2;//second string of  last folder name
	$foldername=$explode_path[$explode_path_len];
	$foldername=trim($foldername);
	//echo $foldername."<br>";
	$array_prefix=array("AE",
"AR",
"BB",
"BG",
"BI",
"BK",
"BL",
"BO",
"BR",
"BS",
"BT",
"BU",
"BV",
"CD",
"CF",
"CG",
"CH",
"CL",
"CM",
"CO",
"CW",
"DA",
"DB",
"DD",
"DE",
"DW",
"EB",
"EF",
"EN",
"EU",
"FB",
"FC",
"FD",
"FE",
"FI",
"FL",
"FO",
"FR",
"FS",
"FT",
"FX",
"GB",
"GC",
"GE",
"GF",
"GG",
"HA",
"HK",
"HR",
"HY",
"IA",
"IB",
"IC",
"ID",
"IE",
"IF",
"IL",
"IM",
"IN",
"IP",
"IT",
"JO",
"KA",
"KB",
"KB1",
"KC",
"KD",
"KE",
"KF",
"KG",
"KH",
"KI",
"KJ",
"KK",
"KL",
"KM",
"KN",
"KO",
"KP",
"KR",
"KS",
"KU",
"KV",
"KW",
"KX",
"KY",
"KZ",
"LB",
"LC",
"LE",
"LF",
"LG",
"LH",
"LI",
"LK",
"LM",
"LMB",
"LN",
"LP",
"LR",
"LS",
"MA",
"MB",
"MM",
"MP",
"MT",
"NB",
"NE",
"NH",
"NR",
"NU",
"OC",
"OF",
"OJ",
"OM",
"OP",
"OS",
"PA",
"PS",
"PU",
"QB",
"QP",
"QS",
"RB",
"RD",
"RI",
"RO",
"RR",
"RU",
"RV",
"SA",
"SB",
"SC",
"SE",
"SI",
"SN",
"SO",
"SP",
"SR",
"SS",
"ST",
"SU",
"TB",
"TE",
"TI",
"TK",
"TM",
"TU",
"UA",
"UB",
"UC",
"UD",
"UF",
"UG",
"UJ",
"UM",
"UN",
"US",
"UT",
"UV",
"UX",
"VA",
"WB",
"VE",
"WM",
"WS",
"YB",
"YV");
	$array_system=array("System",
"Arbetsst??lle",
"Kreditbevakning",
"Bankgirouppgifter",
"Id-nummers??kning ",
"Betalklass",
"Betalklass",
"Bibo ??? batch in/out",
"Registerv??rd",
"Selekteringar",
"Bitstring",
"System",
"Kreditbevakning",
"Registerv??rd",
"Kreditfakta",
"Year 2000 ",
"Checksum",
"Indata ??? Clistor",
"Container milj??",
"System",
"CICSWEB",
"Fakturering",
"Fakturering",
"System",
"System",
"Data Warehouse",
"Direkt rapport",
"Enskilda n??ringsidkare",
"Engagemangsregister",
"EU Bokslut",
"Fr??ge/svars-systemet",
"Fr??ge/svars-systemet",
"Bibo ??? batch in/out cics",
"F/S Externa leveranser",
"F/S  Id-nummers??kning",
"F/S  Gr??nssnitt - Layout",
"System",
"F/S utredningsbilder; mall  mm",
"F/S  huvudmeny mm",
"Parameterregistret",
"F-skatt ",
"Generella program",
"Generella program",
"Ans??k",
"Generella program",
"Generella program",
"H??llkoll",
"Del??gare och HKB",
"Del??gare och HKB",
"System",
"Internat. system f??ret.uppl.",
"Internat. system f??ret.uppl.",
"Internat. system f??ret.uppl.",
"Internat. system f??ret.uppl.",
"Beda databas",
"Interna funktioner",
"System",
"system",
"system",
"Fakturering",
"Betalningsanm??rkningar",
"System",
"??rendehant. kreditbed??mn.",
"Betalningsanm??rkningar",
"Diverse",
"Koncernregistret",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"Ans??k",
"Ans??k",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"System",
"??rendehant. kreditbed??mn.",
"Riskbed??mning",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn",
"??rendehant. kreditbed??mn",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"??rendehant. kreditbed??mn.",
"F/S  Layout",
"F/S  Layout",
"Lasses Fixprogram",
"F/S  Layout",
"F/S  Layout",
"system",
"Kreditlimit",
"F/S  Layout",
"F/S  Layout",
"F/S Layout",
"system",
"F/S  Layout",
"Kreditbevakning",
"F/S Layout",
"Mallsystemet",
"Leverant??rsregister",
"Massmedia statistik",
"Massmedia statistik",
"system",
"Nummerp??f??ring",
"Riskbed??mning",
"Riskbed??mning",
"Riskbed??mning",
"System",
"Registerv??rd     (submodul) ",
"Registerv??rd",
"Registerv??rd",
"System",
"UC  Select",
"Registerv??rd",
"System",
"Uttag omfr??gade",
"Ekonomipublikationer",
"Gen. indatasystem  (parm-styrt)",
"Gen. indatasystem  (parm-styrt)",
"Gen. indatasystem  (parm-styrt)",
"Bokslut",
"Fixprogram Roland",
"Riskbed??mning",
"Bokslut",
"Faktarapporter - jur. utland",
"Abonnentregister",
"Registerv??rd",
"Kundreskontra",
"Statistik",
"S??kerhetssystem",
"Selekteringar",
"Interna funktioner",
"Convert SNI code 1992",
"Styrelse",
"Fixprogram Roland",
"Systemtekn. interna progr.",
"Skuldsaldosystemet",
"Styrelse",
"Betalningsanm??rkningar",
"SNI-koder / LKF-koder",
"Textregistret",
"System",
"System",
"System",
"Systemtekn. interna progr.",
"??ktenskapsregister",
"Betalningsanm??rkningar",
"Fix-program",
"??rendehantering AB",
"Personuppgifter uppdat.",
"Selekteringar mm",
"F??retagsinfo. uppdat.",
"Mantalsf??rh??llande",
"System",
"System",
"Taxeringar",
"Fastigheter",
"Fastigheter",
"Besl??ktade f??retag",
"Webservice",
"System",
"System",
"Webservice",
"Abonnentregister",
"??rendehant");
	$array_subsystem=array("Reorg",
"SCB",
"Batch",
"Uppdatering ??? batch",
"Uppdatering - batch",
"Batch",
"Online",
"Batch",
"Branschstatistik",
"Eng??ngsrapp; mm",
"use together with maps",
"Backup  ",
"Online",
"Besl??ktade f??retag",
"Info. till Kreditfakta",
"still used",
"to be checked",
"Indata",
"div t??mningar",
"Copy ",
"H??llkoll ..",
"Online",
"Batch",
"System",
"Demo pgm",
"Batch",
"not used any more",
"Indata fr??n SCB",
"Batch",
"Subrutin",
"Batch + asynkr. Cics",
"Batch + asynkr. Cics",
"not used any more",
"not used any more",
"Online",
"Online",
"Idnummer - fonet",
"Online",
"Online",
"Registerv??rd  online",
"Indata fr??n SKV",
"Batch            (ett finns)",
"Online",
"System",
"Subprogram  (tv?? finns)",
"Diverse",
"Aff??rsfakta",
"HB eller KB avg??rs",
"Indata ",
"System",
"Allm??nt",
"Leverant??r",
"Fr??gest??llare",
"Generellt",
"Databas till sekv.fil",
"Online",
"System",
"System",
"System",
"Registerv??rd",
"Supro; Intrum",
"System",
"Arbetsgivarkontroll",
"Konkursborgen??rer(KB0400; KB0500)",
"Ans??k; statistik;  mm",
"Indata (manuell inreg.)",
"Sparbanken Finans; Detaljandel (SDC)",
"GE Kapital",
"Ans??k ",
"Ans??k; statistik;  mm",
"Ans??k; statistik;  mm",
"Beslutsdata",
"Beslutsdata",
"SE-banken  autom.mall",
"Sparbanken",
"Master Card",
"NORSOK",
"Check file existence and Copy",
"Business Card priv. bus",
"(n??gra skall utg??)",
"Sparbankskort",
"Q8",
"Sparbanken",
"Sparbanken",
"Ikano-banken",
"Kryptering",
"PREEM",
"Best??llningsskiktet ",
"Serviceprogram",
"System",
"not used any more",
"diverse",
"not used any more",
"Uppdatering av AB",
"Kommunikation",
"Mediaskiktet",
"Mediaskiktet",
"System",
"Produktionsskiktet",
"Reg.v??rd online BEVK",
"Selekteringar ??? externa system",
"Mall",
"Enga - Missbruk",
"Juridiker",
"Fysiker",
"System",
"(betanm; kredb; intrum)",
"Riskklass Enskild firma",
"Riskklass HKB",
"Riskklass AB",
"not used any more",
"Byter stora/sm?? bokst.",
"Rensning  FYS-basen",
"Rensning  JUR-basen",
"System",
"Selektion till Optisys",
"Rensning  Sek. nycklar",
"System",
"Arkfrapp; DW",
"Batch",
"Layin - batch",
"Layin - online",
"Layin - service",
"Batch",
"System",
"System",
"Registerv??rd",
"Edifact-format (SCOA)",
"Batch",
"T??mmer bevakn.trans.",
"not used any more",
"System",
"Online",
"Utdrag f??retag",
"System",
"System",
"Registerv??rd",
"System",
"Bibliotekshantering",
"Uppdatering batch",
"Uppdatering batch",
"not used any more",
"Registerv??rd",
"System",
"System",
"System",
"System",
"UTB/TEST-databaser",
"Uppdat. SCB-info.",
"Indata fr??n RSV",
"System",
"Indata fr??n PRV",
"Indata fr??n SPAR",
"Utlistning mm",
"Indata fr??n PRV",
"Indata",
"Unload-Reorg",
"System",
"Indata fr??n RSV",
"Indata fr??n LMV",
"not used any more",
"Indata; UC skapad",
"Aff??rsfakta",
"System",
"System",
"Aff??rsfakta",
"Avst??mning",
"System");
	

	if(stripos($foldername,"COBOL") !== false)//checking COBOL files
	{   
	   
        while(!feof($Component_file))
	    {
		    $line = fgets($Component_file);
	        if((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bCICS\b/i", $line)>0))//checking for cics cobol
	        {
               $Component_type = "COBOL";
	           $Component_sub_type = "CICS_COBOL";
		       $cicsflag=true;
	        }
	    }
	    if($cicsflag==false)//if not cics cobol then batch cobol
	    {
		  $Component_type = "COBOL";
	      $Component_sub_type = "BATCH_COBOL"; 
	    }
	}
	if(stripos($foldername,"COBOL") !== false)//checking  LOC of COBOL files
	{  
        while(!feof($Component_file1))
	    {	
	         
	        $line = fgets($Component_file1);
			$line_trim=trim($line);
		    $content = strlen(trim($line)); 
	        if($content > 0)
	        {		  
	             if((substr($line_trim,0,1) !== "*")&&(substr($line,6,1)!="*")&&(substr($line_trim,0,3)!="//*"))
	            {
					if(!empty(trim($line))){
		            $uncommented_loc++;
				    if(((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bSQLCA\b/i", $line)>0))||((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bSQL\b/i", $line)>0)))
		            {   
			            if($Component_sub_type == "CICS_COBOL")  
			            {
			              $Component_sub_type = "DB2_CICS_COBOL";
			            }
			            if($Component_sub_type == "BATCH_COBOL")
			            {
				           $Component_sub_type = "DB2_COBOL";
			            }
		            }
					}
	            }		   
	            else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	             
	        }
		}
	}
	elseif((stripos($foldername,"ESY_MACRO") !== false))
	{
		$Component_type = "ESY_MACRO";
		$Component_sub_type = "ESY_MACRO";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		   $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        { if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
	            
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif(stripos($foldername,"DCLGEN") !== false)//checking for DCLGEN
	{
		$Component_type = "DCLGEN";
		$Component_sub_type = "DCLGEN";
		
	    while(!feof($Component_file))
	    {
		  $line = fgets($Component_file);
		  $line=trim($line);
		  $content = strlen(trim($line)); 
	        if($content > 0)
	        {		  
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }		
	}
	elseif(stripos($foldername,"COPYBOOK") !== false)//Checking for COBOL COPYBOOK
	{
		$Component_type = "COPYBOOK";
		$Component_sub_type = "COPYBOOK";
		
	    while(!feof($Component_file))
	    {
		  $line = fgets($Component_file);
		  $line_trim=trim($line);
		  $content = strlen(trim($line));
	        if($content > 0)
	        {
	             if((substr($line_trim,0,1) !== "*")&&(substr($line,6,1)!=="*")&&(substr($line_trim,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }		
	}
	
	elseif((stripos($foldername,"JCL") !== false) || (stripos($foldername,"PROC") !== false))//checking for JCL and PROC
	{
		if(stripos($foldername,"JCL") !== false) 
		{
		    $Component_type = "JCL";
		    $Component_sub_type = "JCL";
		}
		elseif(stripos($foldername,"PROC") !== false)
		{
			$Component_type = "PROC";
		    $Component_sub_type = "PROC";
		}
		
		
	    while(!feof($Component_file))
	    {  
	     $line = fgets($Component_file);
		 $line=trim($line);
		 $content = strlen(trim($line));
	        if($content > 0)//to avoid empty line
	        {		   
	             if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }	
	}
	
	elseif((stripos($foldername,"CONTROL_CARDS") !== false))//Checking for CONTROL CARDS
	{
		$Component_type = "CONTROL_CARD";
		$Component_sub_type = "CONTROL_CARD";
	    while(!feof($Component_file))
	    {
		  $line = fgets($Component_file);
		   $line=trim($line);
		  $content = strlen(trim($line));
	        if($content > 0)
	        {
	             if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	
	elseif((stripos($foldername,"ASM_COPY") !== false))
	{
		$Component_type = "ASM_COPYBOOK";
		$Component_sub_type = "ASM_COPYBOOK";
	    while(!feof($Component_file))
	    {
			$line = fgets($Component_file);
			 $line=trim($line);
			$content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"ASSEMBLER") !== false))
	{
		$Component_type = "ASSEMBLER";
		$Component_sub_type = "ASSEMBLER";
	    while(!feof($Component_file))
	   {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"BMS_SCREENS") !== false))
	{
		$Component_type = "MAPS";
		$Component_sub_type = "BMS_SCREENS";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"ESY") !== false))
	{
		$Component_type = "ESY";
		$Component_sub_type = "ESY";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
elseif((stripos($foldername,"BMS_CPY") !== false))
	{
		$Component_type = "COPYBOOK";
		$Component_sub_type = "BMS_COPY";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"IMS") !== false))
	{
		 while(!feof($Component_file))
	    {
		    $line = fgets($Component_file);
	        if((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bCICS\b/i", $line)>0))//checking for cics cobol
	        {
               $Component_type = "COBOL";
	           $Component_sub_type = "IMS_CICS_COBOL";
		       $cicsflag=true;
	        }
	    }
	    if($cicsflag==false)//if not cics cobol then batch cobol
	    {
		  $Component_type = "COBOL";
	      $Component_sub_type = "IMS_BATCH_COBOL"; 
	    }
	}
	if(stripos($foldername,"IMS") !== false)//checking  LOC of COBOL files
	{  
        while(!feof($Component_file1))
	    {	
	         
	        $line = fgets($Component_file1);
			 $line_trim=trim($line);
		    $content = strlen(trim($line)); 
	        if($content > 0)
	        {		  
	            if((substr($line_trim,0,1) !== "*")&&(substr($line,6,1)!="*")&&(substr($line_trim,0,3)!="//*"))
	            {
					if(!empty(trim($line))){
		            $uncommented_loc++;
				    if(((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bSQLCA\b/i", $line)>0))||((preg_match("/\bEXEC\b/i", $line)>0) && (preg_match("/\bSQL\b/i", $line)>0)))
		            {   
			            if($Component_sub_type == "IMS_CICS_COBOL")  
			            {
			              $Component_sub_type = "IMS_DB2_CICS_COBOL";
			            }
			            if($Component_sub_type == "IMS_BATCH_COBOL")
			            {
				           $Component_sub_type = "IMS_DB2_COBOL";
			            }
		            }
					}
	            }		   
	            else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	             
	        }
		}
	}

	elseif((stripos($foldername,"REXX") !== false))
	{
		$Component_type = "REXX";
		$Component_sub_type = "REXX";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		   $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,2) !== "/*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"PSB") !== false))
	{
		$Component_type = "PSB";
		$Component_sub_type = "IMS_PSB";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"DB2PARM") !== false))
	{
		$Component_type = "CONTROL_CARD";
		$Component_sub_type = "DB2PARM";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        { if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	elseif((stripos($foldername,"DBD") !== false))
	{
		$Component_type = "DBD";
		$Component_sub_type = "DBD";
	    while(!feof($Component_file))
	    {
		   $line = fgets($Component_file);
		    $line=trim($line);
		   $content = strlen(trim($line));
	        if($content > 0)
	        {
	            if((substr($line,0,1) !== "*")&&(substr($line,0,3)!=="//*"))
	            {
				if((!empty(trim($line)))){	
		         $uncommented_loc++;
				}
	            }		   
	           else
			    {
					if(!empty(trim($line)))
					{
				   $commented_loc++;
					}
			    }
				if(!empty(trim($line)))
					{
				   $total_loc++;
					}
	        }
	    }
	}
	for($i=0;$i<count($array_prefix);$i++)
	{
		
		if(substr($Component_Name,0,2)==$array_prefix[$i]&& substr($Component_Name,0,3)!=="KB1"&&substr($Component_Name,0,3)!=="LMB")
		{   
	        
			$system=mb_convert_encoding($array_system[$i], 'ISO-8859-1', 'UTF-8');
		
			$subSystem=mb_convert_encoding($array_subsystem[$i], 'ISO-8859-1', 'UTF-8');
			
		}
		elseif(substr($Component_Name,0,3)=="LMB")
		{
			$system=mb_convert_encoding("F/S Layout", 'ISO-8859-1', 'UTF-8');
			$subSystem=mb_convert_encoding("Mediaskiktet", 'ISO-8859-1', 'UTF-8');
			}
		
			elseif(substr($Component_Name,0,3)=="KB1")
		{
			$system="Diverse";
			$subSystem=mb_convert_encoding("Ans??k statistik mm", 'ISO-8859-1', 'UTF-8');
			}
		
	}
	if(empty($system)&& empty($subsystem)){
	  $system="TBD";
	  $subSystem="TBD";
	}
	
	$out = $Component_Name . "," . $Component_type . "," . $Component_sub_type . "," . $uncommented_loc . "," . $commented_loc . "," . $total_loc . "," .$system. "," .$subSystem . "," .$file ;
	$write = fputcsv($csvfile,(explode(",",$out)));
	fclose($Component_file);
}
AddTransaction();
function AddTransaction()
{
	global $csvfile;
	$opencsv=fopen("transaction_inventory.csv","r");
	while(! feof($opencsv))
     {
		
      $contnt=(fgetcsv($opencsv));
	  $Component_Name=$contnt[0];//remove the first transaction
	  $Component_type="TRANSACTION";
	  $Component_sub_type="TRANSACTION";
	  $uncommented_loc="0";
	  $commented_loc="0";
	  $total_loc="0";
	  $system="TBD";
	  $subSystem="TBD";
	  $file="Transaction_Inventory CSV file";
	  $out = $Component_Name . "," . $Component_type . "," . $Component_sub_type . "," . $uncommented_loc . "," . $commented_loc . "," . $total_loc . "," .$system. "," .$subSystem . "," .$file ;
	  $write = fputcsv($csvfile,(explode(",",$out)));
     }
   fclose($opencsv);
   fclose($csvfile);
  }
  
  

	  