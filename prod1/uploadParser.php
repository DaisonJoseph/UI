<?php
$target_dir = "/var/www/html/AFLAC_dummy/prod1/Componentization/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
move_uploaded_file($fileTmpPath, $target_file);
if(stripos(basename($_FILES["fileToUpload"]["name"]),"Map")!==false)
{
	header('Location: uploadFile.php');
	exec("php /var/www/html/AFLAC_dummy/prod1/componentization.php");
}
else
{
	header('Location: neglectComponent.php');
}	


?>