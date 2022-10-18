<?php require 'sessioncon.php';
 if(isset($_SESSION['Uid'])){
	 header('Location:https://troom.capgemini.com/sites/LM-KM-Portal/SiteAssets/CAP360%20UI/production/index1.html');}
	 if (isset($_POST[ 'submit'])){
		 $username=$_POST['username'];
		 $password=$_POST['password'];
		 if ($username=='' || $password=='' ){
			 $error="Username and Password should not be blank" ;}
			 else{$data=array('Uid'=>$username,'Password'=>$password);
			 $cursor=$user->find($data); if($cursor->count()==1){
				 $_SESSION['Uid']=$username; header("location:https://troom.capgemini.com/sites/LM-KM-Portal/SiteAssets/CAP360%20UI/production/index1.html");}
				 else{$error="Username or Password is wrong";}}}?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8" /><title>DevOps Analyzer</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
		<meta content="" name="author" />
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
		<link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" type="image/x-icon" />
		</head><body class=" login"><div class="logo"> <a href="index.php"> 
		<img src="../assets/layouts/layout/img/aaa.png" alt="" style="width:250px;height:110px;margin:0px 0px -45px 0px " /> </a></div>
		<div class="content"><form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h3 class="form-title">
		Login to your account</h3> <?php if(isset($error)){echo "<div class='alert alert-danger'><strong>$error</strong></div>";}?>
		<div class="form-group"> 
		<label class="control-label visible-ie8 visible-ie9">Username</label><div class="input-icon"> <i class="fa fa-user"></i>
		<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /></div></div>
		<div class="form-group"> <label class="control-label visible-ie8 visible-ie9">Password</label><div class="input-icon"> 
		<i class="fa fa-lock"></i> 
		<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
		</div>
		</div>
		<div class="form-actions"> 
		<button type="submit" name="submit" class="btn green pull-right"> Login </button>
		</div>
		<div class="forget-password">
			<h4><a href="javascript:;" id="forget-password" style="color:white">Forgot your password?</a></h4>
			<!--<p> Click <a href="javascript:;" id="forget-password"> here </a> to reset your password.</p>-->
		</div>
		
		</form><form class="forget-form" action="index.php" method="post"><h4>Forget Password?</h4><p> Enter your e-mail address below to reset your password.</p><div class="form-group"><div class="input-icon"> <i class="fa fa-envelope"></i> <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /></div></div><div class="form-actions"> <button type="button" id="back-btn" class="btn red btn-outline">Back</button> <button type="submit1" class="btn green pull-right">Submit</button></div></form></div><div class="copyright"> All rights reserved by Capgemini. <br>Copyright &copy 2017</div> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js" type="text/javascript"></script> <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script> <script src="../assets/pages/scripts/login-4.min.js" type="text/javascript"></script> </body></html>