<?php
$m = new MongoClient();
$db = $m->euroclear;
$col = $db->User;
$username = $_POST['userid'];
$pass = $_POST['password'];
//echo "$username|$pass<br>";
$res_count = $col->find(array("Username"=>$username,"Password"=>$pass))->count();
//echo $res_count;
if($res_count > 0)
{
	header("Location: examples/dashboard.html");
}
else
{
	header("Location: login.php?message=auth-error");
}
?>