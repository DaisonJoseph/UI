<?php
	$m = new MongoClient();
	$db = $m->devops_db;
	$collection = $db->newapplication;
	if(isset($_GET['input']))
	{
		$input = $_GET['input'];
	}
	
	
	if(isset($_POST["submit"]) && $_FILES['fileToUpload']['name'] != "") {
		$target_dir = "/var/www/html/Devops/prod/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
		$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$file_tmp = $_FILES["fileToUpload"]["tmp_name"];
		$file_name = $_FILES["fileToUpload"]["name"];

        if($file_type == "csv"){
			rename($file_tmp,"/var/www/html/Devops/prod/".$file_name);
			copy("/var/www/html/Devops/prod/adduser.php","/var/www/html/Devops/prod/adduser1.php");
			
			switch($input){
				case "dep":
					$command = 'mongoimport --db devops_db --collection newapplication1 --file ' . $target_file . ' --type csv --headerline' ;
					break;
				case "app":
					$command = 'mongoimport --db devops_db --collection newapplication2 --file ' . $target_file . ' --type csv --headerline' ;
					break;
			}
			shell_exec($command);
			echo "Files Uploaded Successfully";
		}
		else{
			echo "Only csv files can be uploaded";
		}
			
	}

?>