<?php
$name=$_POST['name'];
$emailid=$_POST['email'];
$password=$_POST['password'];
$m = new MongoClient();
$db = $m->bnpp;
$collection = $db->user;
$userDetails = array('name'=>$name,'emailid'=>$emailid,'password'=>$password,'fname'=>"",'lname'=>"",'address'=>"",'city'=>"",'country'=>"",'postal_code'=>"",'about_me'=>"");
$collection->insert($userDetails);
header("location:login.php","refresh:2");
?>