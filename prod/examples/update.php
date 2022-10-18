<?php
ob_start();
session_start();
$email = $_POST['email'];
$username = $_POST['username'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$pcode = $_POST['pcode'];
$aboutme = $_POST['aboutme'];
echo $_SESSION['email'];
$m = new MongoClient();
$db = $m->bnpp;
$collection = $db->user;
$userDetails = array('$set'=>array('fname'=>$fname,'lname'=>$lname,'address'=>$address,'city'=>$city,'country'=>$country,'postal_code'=>$pcode,'about_me'=>$aboutme));

$collection->update(array("emailid"=>$_SESSION['email']),$userDetails);

//header("location:login.php","refresh:2");
?>