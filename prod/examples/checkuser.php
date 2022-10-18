<?php
ob_start();
session_start();
if(isset($_POST['email']))
{
	$con = new MongoClient();
	$collection = $con->euroclear->user;
	$result = $collection->findOne(array("emailid" => $_POST['email'],"password" => $_POST['password']));
	if($result){
		$_SESSION['email'] = $result['emailid'];
		$_SESSION['name'] = $result['name'];
		header("location:../index.php");
	}else{
		header("location:login.php");
	}
}
?>