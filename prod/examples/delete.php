<?php
ob_start();
session_start();
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir .$_SESSION['email'].".".$imageFileType."jpg";
if (!unlink($target_file))
  {
  echo ("Error deleting $target_file");
  }
else
  {
  header("location:profile.php");
  }
?>