<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);  
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
date_default_timezone_set('Asia/Kolkata');
echo "<pre>";
echo date('H:i:s').PHP_EOL;
echo "start1".PHP_EOL;

$outpath	= "C:/xampp/htdocs/UCAB/Cluster/AppsCLuster.csv";
$outputHandle = fopen($outpath, "w") or die("Unable to open file!");
				$writehead = "S.No" . "," ."System". "," ."Count". "," ."TLOC". "," ."ULOC". "," ."CLOC". "," ."ASSEMBLER". "," ."COPYBOOK". "," ."MAPS".
				"," ."COBOL". "," ."CONTROL CARD". "," ."DBD". "," ."DCLGEN". "," ."ESY". "," ."ESY_MACRO". "," ."JCL". "," ."PROC". "," ."PSB". "," .
				"REXX". "," ."SKELETON". "," ."PANEL". "," ."CLIST". "," ."MESSAGE". "," ."TRANSACTION". "," ."ASSEMBLER LOC". "," ."COPYBOOK LOC". "," .
				"MAPS LOC". "," ."COBOL LOC". "," ."CONTROL_CARD LOC". "," ."DBD LOC". "," ."DCLGEN LOC". "," ."ESY LOC". "," ."ESY_MACRO LOC". "," .
				"JCL LOC". "," ."PROC LOC". "," ."PSB LOC". "," ."REXX LOC". "," ."SKELETON LOC". "," ."PANEL LOC". "," ."CLIST LOC". "," ."MESSAGE LOC". "," .
				"TRANSACTION LOC". "," ."Dead JCL". "," ."Orphan". "," ."Drop Impact". "," ."Dead Paragraph". "," ."DB2 Insert". "," ."DB2 Read". "," .
				"DB2 Update". "," ."DB2 Delete". "," ."DB2 Single Operation". "," ."DB2 Query without Index". "," ."DB2 Fields Not Used". "," ."DB2 Orphan". "," ."IMS Insert". "," ."IMS Read". "," ."IMS Update". "," ."IMS Delete". "," ."IMS Single Operation". "," ."IMS Orphan"."," ."FTP". "," ."EMAIL". "," ."MQ".
				"," ."TSQ". "," ."Channel Containner". "," ."DB2 Image Copy". "," ."IMS Image Copy". "," ."Load". "," ."Unload". "," ."Files Created Not Used". "," ."Component Interface". "," ."File Interface". "," ."DB2 Interface". "," ."IMS Interface". "," ."JCL MIPS". "," ."TRANSACTION MIPS";
				fputcsv($outputHandle,explode(",",$writehead));

$readsystem = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/system.csv","r");
	$system = array();
	$systems = array();
	while(!feof($readsystem))
	{
		$system[] = fgetcsv($readsystem);
	}
	array_pop($system);
	$systemSize = sizeof($system);
	fclose($readsystem);
	for($i=0;$i<$systemSize;$i++)
	{
		$name = $system[$i][0] ;
		array_push($systems,$system[$i][0]);
	}
	// echo $systemSize;
	// print_r ($systems);

$readmaster = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/master_over2805.csv","r");
	$master = array();
	while(!feof($readmaster))
	{
		$master[] = fgetcsv($readmaster);
	}
	array_pop($master);
	$masterSize = sizeof($master);
	fclose($readmaster);
	
$readcrud = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/db2_Crud_May28.csv","r");
	$crud = array();
	while(!feof($readcrud))
	{
		$crud[] = fgetcsv($readcrud);
	}
	array_pop($crud);
	$crudSize = sizeof($crud);
	fclose($readcrud);
	
$readimscrud = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/IMS_CRUD_ReportMay28.csv","r");
	$imscrud = array();
	while(!feof($readimscrud))
	{
		$imscrud[] = fgetcsv($readimscrud);
	}
	array_pop($imscrud);
	$imscrudSize = sizeof($imscrud);
	fclose($readimscrud);
	
$readftp = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/FTP_Report_May28.csv","r");
	$ftp = array();
	while(!feof($readftp))
	{
		$ftp[] = fgetcsv($readftp);
	}
	array_pop($ftp);
	$ftpSize = sizeof($ftp);
	fclose($readftp);

$reademail = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Email_Report_May28.csv","r");
	$email = array();
	while(!feof($reademail))
	{
		$email[] = fgetcsv($reademail);
	}
	array_pop($email);
	$emailSize = sizeof($email);
	fclose($reademail);	
	
$readmq = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/MQ_Report_May28.csv","r");
	$mq = array();
	while(!feof($readmq))
	{
		$mq[] = fgetcsv($readmq);
	}
	array_pop($mq);
	$mqSize = sizeof($mq);
	fclose($readmq);

$readdeadpara = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Dead_Paragraph_Report_May28.csv","r");
	$deadpara = array();
	while(!feof($readdeadpara))
	{
		$deadpara[] = fgetcsv($readdeadpara);
	}
	array_pop($deadpara);
	$deadparaSize = sizeof($deadpara);
	fclose($readdeadpara);

$readtsqreport = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/TSQ_report_May28.csv","r");
	$tssq = array();
	while(!feof($readtsqreport))
	{
		$tsq[] = fgetcsv($readtsqreport);
	}
	array_pop($tsq);
	$tsqSize = sizeof($tsq);
	fclose($readtsqreport	);	
	
$readchannel = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Channel_and_Container_Report _May28.csv","r");
	$channel = array();
	while(!feof($readchannel))
	{
		$channel[] = fgetcsv($readchannel);
	}
	array_pop($channel);
	$channelSize = sizeof($channel);
	fclose($readchannel);	
	
$readdb2image = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/DB2_ImageCopyMay28.csv","r");
	$db2image = array();
	while(!feof($readdb2image))
	{
		$db2image[] = fgetcsv($readdb2image);
	}
	array_pop($db2image);
	$db2imageSize = sizeof($db2image);
	fclose($readdb2image);
	
$readimsimage = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/IMS_ImageCopyMay28.csv","r");
	$imsimage = array();
	while(!feof($readimsimage))
	{
		$imsimage[] = fgetcsv($readimsimage);
	}
	array_pop($imsimage);
	$imsimageSize = sizeof($imsimage);
	fclose($readimsimage);	
	
$readloadunload = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Load_unload_DB2May28.csv","r");
	$loadunload = array();
	while(!feof($readloadunload))
	{
		$loadunload[] = fgetcsv($readloadunload);
	}
	array_pop($loadunload);
	$loadunloadSize = sizeof($loadunload);
	fclose($readloadunload);	
	
$readfilescreated = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Files_created_but_not_used_Report_May28.csv","r");
	$filescreated = array();
	while(!feof($readfilescreated))
	{
		$filescreated[] = fgetcsv($readfilescreated);
	}
	array_pop($filescreated);
	$filescreatedSize = sizeof($filescreated);
	fclose($readfilescreated);
	
$readdb2singleoperation = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/db2_Single_Operation_May28.csv","r");
	$singleoperation = array();
	while(!feof($readdb2singleoperation))
	{
		$singleoperation[] = fgetcsv($readdb2singleoperation);
	}
	array_pop($singleoperation);
	$db2singleoperationSize = sizeof($singleoperation);
	fclose($readdb2singleoperation);
	
$readimssingleoperation = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/IMS_single_may28.csv","r");
	$imssingleoperation = array();
	while(!feof($readimssingleoperation))
	{
		$imssingleoperation[] = fgetcsv($readimssingleoperation);
	}
	array_pop($imssingleoperation);
	$imssingleoperationSize = sizeof($imssingleoperation);
	fclose($readimssingleoperation);
	
$readdb2query = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/Query_without_index_May28.csv","r");
	$db2query = array();
	while(!feof($readdb2query))
	{
		$db2query[] = fgetcsv($readdb2query);
	}
	array_pop($db2query);
	$db2querySize = sizeof($db2query);
	fclose($readdb2query);
	
$readdb2field = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/db2_Fields_Not_Used_May28.csv","r");
	$db2field = array();
	while(!feof($readdb2field))
	{
		$db2field[] = fgetcsv($readdb2field);
	}
	array_pop($db2field);
	$db2fieldSize = sizeof($db2field);
	fclose($readdb2field);
	
$readdb2orphan = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/db2_Orphan_Tables_May28.csv","r");
	$db2orphan = array();
	while(!feof($readdb2orphan))
	{
		$db2orphan[] = fgetcsv($readdb2orphan);
	}
	array_pop($db2orphan);
	$db2orphanSize = sizeof($db2orphan);
	fclose($readdb2orphan);
	
$readimsorphan = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/IMS_orphan_may28.csv","r");
	$imsorphan = array();
	while(!feof($readimsorphan))
	{
		$imsorphan[] = fgetcsv($readimsorphan);
	}
	array_pop($imsorphan);
	$imsorphanSize = sizeof($imsorphan);
	fclose($readimsorphan);
	
$readxrefinterface = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/xrefinterface2805.csv","r");
	$xrefinterface = array();
	while(!feof($readxrefinterface))
	{
		$xrefinterface[] = fgetcsv($readxrefinterface);
	}
	array_pop($xrefinterface);
	$xrefSize = sizeof($xrefinterface);
	fclose($readxrefinterface);
	
$readfileinterface = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/fileinterface2805.csv","r");
	$fileinterface = array();
	while(!feof($readfileinterface))
	{
		$fileinterface[] = fgetcsv($readfileinterface);
	}
	array_pop($fileinterface);
	$fileSize = sizeof($fileinterface);
	fclose($readfileinterface);
	
$readdb2interface = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/db2interface2805.csv","r");
	$db2interface = array();
	while(!feof($readdb2interface))
	{
		$db2interface[] = fgetcsv($readdb2interface);
	}
	array_pop($db2interface);
	$db2Size = sizeof($db2interface);
	fclose($readdb2interface);
	
$readimsinterface = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/imsinterface2805.csv","r");
	$imsinterface = array();
	while(!feof($readimsinterface))
	{
		$imsinterface[] = fgetcsv($readimsinterface);
	}
	array_pop($imsinterface);
	$imsSize = sizeof($imsinterface);
	fclose($readimsinterface);
	
$readjclmips = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/jclmips.csv","r");
	$jclmips = array();
	while(!feof($readjclmips))
	{
		$jclmips[] = fgetcsv($readjclmips);
	}
	array_pop($jclmips);
	$jclmipsSize = sizeof($jclmips);
	fclose($readjclmips);
	
$readtransmips = fopen("C:/xampp/htdocs/UCAB/Cluster/Reports/2805/transactions_mips.csv","r");
	$transmips = array();
	while(!feof($readtransmips))
	{
		$transmips[] = fgetcsv($readtransmips);
	}
	array_pop($transmips);
	$transmipsSize = sizeof($transmips);
	fclose($readtransmips);
	
	$syscount = 0;
	foreach($systems as $sys)
	{
		$tloc = 0;
		$ucloc = 0;
		$cloc = 0;
		$count = 0;
		$deadJcl=0;
		$orphan=0;
		$drop=0;
		$deadparacount = 0; 
		$ftpcount = 0;
		$emailcount = 0;
		$mqcount = 0;
		$tsqcount = 0;
		$channelcount = 0;
		$db2imagecount = 0;
		$imsimagecount = 0;
		$loadcount = 0;
		$unloadcount = 0;
		$filescreatedcount = 0;
		$db2singleoperationcount = 0;
		$db2querycount = 0;
		$fieldcount = 0;
		$db2orphancount = 0;
		$db2missingcount = 0;
		$xrefcount = 0;
		$filecount = 0;
		$db2count = 0;
		$imscount = 0;
		$imssingleoperationcount = 0;
		$imsorphancount = 0;
		$jclmipscount = 0;
		$transmipscount = 0;
		/*Assigning for the count variables for the type of file*/
		$asscount=$copycount=$mapcount=$cobolcount=$controlcount=$dbdcount=$dclcount=$esycount=$macrocount=$jclcount=$proccount=$psbcount=$rexxcount=$sklcount
		=$panelcount=$clistcount=$msgcount=$transcount = 0;
		/*Assigning for the count variables for the loc for each type of file*/
		$asstloc=$copytloc=$maptloc=$coboltloc=$controltloc=$dbdtloc=$dcltloc=$esytloc=$macrotloc=$jcltloc=$proctloc=$psbtloc=$rexxtloc=$skltloc
		=$paneltloc=$clisttloc=$msgtloc=$transtloc = 0;	
		/*Assigning for the count variables for the crud report*/
		$insertcount=$readcount=$updatecount=$deletecount=0;
		/*Assigning for the count variables for the ims crud report*/
		$imsinsertcount=$imsreadcount=$imsupdatecount=$imsdeletecount=0;

		$syscount++;
	echo $syscount.")".$sys."<br>";
		for($mas=1;$mas<$masterSize;$mas++)
		{
			if($sys == $master[$mas][6])
			{
				$count++;
				$total = $master[$mas][5];
				$tloc = $tloc + $total;
				$uctotal = $master[$mas][3];
				$ucloc = $ucloc + $uctotal;
				$ctotal = $master[$mas][4];
				$cloc = $cloc + $ctotal;
				if($master[$mas][8] == "Yes")
				{
					$deadJcl++;
				}
				if($master[$mas][9] == "Yes")
				{
					$orphan++;
				}
				if($master[$mas][10] == "Yes")
				{
					$drop++;
				}
				switch($master[$mas][1])
				{
					case "ASSEMBLER":
					{
						$asscount++;
						$asstotal = $master[$mas][5];
						$asstloc = $asstloc + $asstotal;
						break;
					}
					case "COPYBOOK":
					{
						$copycount++;
						$copytotal = $master[$mas][5];
						$copytloc = $copytloc + $copytotal;
						break;
					}
					case "MAPS":
					{
						$mapcount++;
						$maptotal = $master[$mas][5];
						$maptloc = $maptloc + $maptotal;
						break;
					}
					case "COBOL":
					{
						$cobolcount++;
						$coboltotal = $master[$mas][5];
						$coboltloc = $coboltloc + $coboltotal;
						break;
					}
					case "CONTROL_CARD":
					{
						$controlcount++;
						$controltotal = $master[$mas][5];
						$controltloc = $controltloc + $controltotal;
						break;
					}
					case "DBD":
					{
						$dbdcount++;
						$dbdtotal = $master[$mas][5];
						$dbdtloc = $dbdtloc + $dbdtotal;
						break;
					}
					case "DCLGEN":
					{
						$dclcount++;
						$dcltotal = $master[$mas][5];
						$dcltloc = $dcltloc + $dcltotal;
						break;
					}
					case "ESY":
					{
						$esycount++;
						$esytotal = $master[$mas][5];
						$esytloc = $esytloc + $esytotal;
						break;
					}
					case "ESY_MACRO":
					{
						$macrocount++;
						$macrototal = $master[$mas][5];
						$macrotloc = $macrotloc + $macrototal;
						break;
					}
					case "JCL":
					{
						$jclcount++;
						$jcltotal = $master[$mas][5];
						$jcltloc = $jcltloc + $jcltotal;
						break;
					}
					case "PROC":
					{
						$proccount++;
						$proctotal = $master[$mas][5];
						$proctloc = $proctloc + $proctotal;
						break;
					}
					case "REXX":
					{
						$rexxcount++;
						$rexxtotal = $master[$mas][5];
						$rexxtloc = $rexxtloc + $rexxtotal;
						break;
					}
					case "SKELETON":
					{
						$sklcount++;
						$skltotal = $master[$mas][5];
						$skltloc = $skltloc + $skltotal;
						break;
					}
					case "PANEL":
					{
						$panelcount++;
						$paneltotal = $master[$mas][5];
						$paneltloc = $paneltloc + $paneltotal;
						break;
					}
					case "CLIST":
					{
						$clistcount++;
						$clisttotal = $master[$mas][5];
						$clisttloc = $clisttloc + $clisttotal;
						break;
					}
					case "MESSAGE":
					{
						$msgcount++;
						$msgtotal = $master[$mas][5];
						$msgtloc = $msgtloc + $msgtotal;
						break;
					}
					case "TRANSACTION":
					{
						$transcount++;
						$transtotal = $master[$mas][5];
						$transtloc = $transtloc + $transtotal;
						break;
					}
					case "PSB":
					{
						$psbcount++;
						$psbtotal = $master[$mas][5];
						$psbtloc = $psbtloc + $psbtotal;
						break;
					}
				}
			}
		
		}
		for($c=1;$c<$crudSize;$c++)
		{
			if($sys == $crud[$c][5])
			{
				switch($crud[$c][3])
				{
					case "INSERT":
					{
						$insertcount++;
						break;
					}
					case "READ":
					{
						$readcount++;
						break;
					}
					case "UPDATE":
					{
						$updatecount++;
						break;
					}
					case "DELETE":
					{
						$deletecount++;
						break;
					}
				}	
			}
		}
		for($ic=1;$ic<$imscrudSize;$ic++)
		{
			if($sys == $imscrud[$ic][1])
			{
				switch($imscrud[$ic][7])
				{
					case "INSERT":
					{
						$imsinsertcount++;
						break;
					}
					case "READ":
					{
						$imsreadcount++;
						break;
					}
					case "UPDATE":
					{
						$imsupdatecount++;
						break;
					}
					case "DELETE":
					{
						$imsdeletecount++;
						break;
					}
				}	
			}
		}
		for($f=0;$f<$ftpSize;$f++)
		{
			if($sys == $ftp[$f][2])
			{
				$ftpcount++;
			}
		}
		for($e=0;$e<$emailSize;$e++)
		{
			if($sys == $email[$e][2])
			{
				$emailcount++;
			}
		}
		for($m=0;$m<$mqSize;$m++)
		{
			if($sys == $mq[$m][2])
			{
				$mqcount++;
			}
		}
		for($para=0;$para<$deadparaSize;$para++)
		{
			if($sys == $deadpara[$para][2])
			{
				$deadtotal = $deadpara[$para][5];
				$deadparacount = $deadparacount + $deadtotal;
			}
		}
		for($t=0;$t<$tsqSize;$t++)
		{
			if($sys == $tsq[$t][2])
			{
				$tsqcount++;
			}
		}
		for($cc=0;$cc<$channelSize;$cc++)
		{
			if($sys == $channel[$cc][2])
			{
				$channelcount++;
			}
		}
		for($ii=0;$ii<$imsimageSize;$ii++)
		{
			if($sys == $imsimage[$ii][2])
			{
				$imsimagecount++;
			}
		}
		for($di=0;$di<$db2imageSize;$di++)
		{
			if($sys == $db2image[$di][2])
			{
				$db2imagecount++;
			}
		}
		for($fcnu=0;$fcnu<$filescreatedSize;$fcnu++)
		{
			if($sys == $filescreated[$fcnu][1])
			{
				$filescreatedcount++;
			}
		}
		for($db2s=0;$db2s<$db2singleoperationSize;$db2s++)
		{
			if($sys == $singleoperation[$db2s][5])
			{
				$db2singleoperationcount++;
			}
		}
		for($imss=0;$imss<$imssingleoperationSize;$imss++)
		{
			if($sys == $imssingleoperation[$imss][2])
			{
				$imssingleoperationcount++;
			}
		}
		for($db2q=0;$db2q<$db2querySize;$db2q++)
		{
			if($sys == $db2query[$db2q][1])
			{
				$db2querycount++;
			}
		}
		for($field=0;$field<$db2fieldSize;$field++)
		{
			if($sys == $db2field[$field][2])
			{
				$fieldcount++;
			}
		}
		for($db2or=0;$db2or<$db2orphanSize;$db2or++)
		{
			if($sys == $db2orphan[$db2or][2])
			{
				$db2orphancount++;
			}
		}
		for($imsor=0;$imsor<$imsorphanSize;$imsor++)
		{
			if($sys == $imsorphan[$imsor][2])
			{
				$imsorphancount++;
			}
		}
		for($jm=0;$jm<$jclmipsSize;$jm++)
		{
			if($sys == $jclmips[$jm][7])
			{
				$jclmipsused = $jclmips[$jm][6];
				$jclmipscount = $jclmipscount + $jclmipsused;
			}
		}
		for($tm=0;$tm<$transmipsSize;$tm++)
		{
			if($sys == $transmips[$tm][7])
			{
				$transmipsused = $transmips[$tm][6];
				$transmipscount = $transmipscount + $transmipsused;
			}
		}
		for($xref=0;$xref<$xrefSize;$xref++)
		{
			if($sys == $xrefinterface[$xref][0])
			{
				if($sys !== $xrefinterface[$xref][1])
				{
				$xrefcount++;
				}
			}
		}
		for($file=0;$file<$fileSize;$file++)
		{
			if($sys == $fileinterface[$file][0])
			{
				if($sys !== $fileinterface[$file][1])
				{
				$filecount++;
				}
			}
		}
		for($db2=0;$db2<$db2Size;$db2++)
		{
			if($sys == $db2interface[$db2][0])
			{
				if($sys !== $db2interface[$db2][1])
				{
				$db2count++;
				}
			}
		}
		for($ims=0;$ims<$imsSize;$ims++)
		{
			if($sys == $imsinterface[$ims][0])
			{
				if($sys !== $imsinterface[$ims][1])
				{
				$imscount++;
				}
			}
		}
		for($lul=0;$lul<$loadunloadSize;$lul++)
		{
			if($sys == $loadunload[$lul][2])
			{
				if($loadunload[$lul][6] == "LOAD")
				{
				$loadcount++;
				}
				if($loadunload[$lul][6] == "UNLOAD")
				{
				$unloadcount++;
				}
			}
		}
			
						// echo $transmipscount."<br>";
			// echo $syscount."	".$sys."	".$imsinsertcount."	".$imsreadcount."	".$imsupdatecount."	".$imsdeletecount."\n";
			fputcsv($outputHandle,array($syscount,$sys,$count,$tloc,$ucloc,$cloc,$asscount,$copycount,$mapcount,$cobolcount,$controlcount,$dbdcount,
			$dclcount,$esycount,$macrocount,$jclcount,$proccount,$psbcount,$rexxcount,$sklcount,$panelcount,$clistcount,$msgcount,$transcount,
			$asstloc,$copytloc,$maptloc,$coboltloc,$controltloc,$dbdtloc,$dcltloc,$esytloc,$macrotloc,$jcltloc,$proctloc,$psbtloc,$rexxtloc,$skltloc,
			$paneltloc,$clisttloc,$msgtloc,$transtloc,$deadJcl,$orphan,$drop,$deadparacount,$insertcount,$readcount,$updatecount,$deletecount,$db2singleoperationcount,
			$db2querycount,$fieldcount,$db2orphancount,$imsinsertcount,$imsreadcount,$imsupdatecount,$imsdeletecount,$imssingleoperationcount,$imsorphancount,$ftpcount,$emailcount,$mqcount,$tsqcount,$channelcount,$db2imagecount,$imsimagecount,$loadcount,$unloadcount,
			$filescreatedcount,$xrefcount,$filecount,$db2count,$imscount,$jclmipscount,$transmipscount));
	}
	fclose($outputHandle);
	// echo '<h5><a href="C:/xampp/htdocs/UCAB/Cluster/AppsCLuster.csv"> Download Excel Report </a></h5>';


?>
