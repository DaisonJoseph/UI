<?php 
    require 'sessioncon.php'; 
	if (!isset($_SESSION['Uid'])) 
	{ header('Location:login.php'); }
	$cursor = $user->find();
	 $username = $_SESSION['Uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
     body{
            overflow-x: hidden;
        }
    </style>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description"/>
    <meta content="" name="author" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" /></head>
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
		<div class="page-wrapper">
			<?php include 'header.php'; ?>
			<div class="clearfix"> </div>
			<div class="page-container">
				<?php include 'sidebar.php'; ?>
				<div class="page-content-wrapper">
					<div class="page-content" style="background-color:#fff">
						<div class="container">	
						<form class="well form-horizontal" action="adduser.php" method="post" style="margin-top:-10px 100px -10px 10px"> 
								<fieldset>
									<legend><b>New User Creation</b></legend>
									<?php 
										/*if(isset($_SESSION['nameerror'])){
								          $nameerror = $_SESSION['nameerror'];
											echo "<div class='alert alert-danger'><strong>$nameerror</strong></div>";
										}*/
										if(isset($_SESSION['error'])){
											$error = $_SESSION['error'];
											echo "<div class='alert alert-danger'><strong>$error</strong></div>";
											unset($_SESSION["error"]);
										}
										if(isset($_SESSION['success'])){
											$success = $_SESSION['success'];
											echo "<div class='alert alert-success'><strong>$success</strong></div>";
											unset($_SESSION["success"]);
										}
										 else{
											 if(isset($_SESSION['unsuccess']))
										{
											$error = $_SESSION['unsuccess'];
											echo "<div class='alert alert-danger'><strong>$error</strong></div>";
											unset($_SESSION["unsuccess"]);
										}
										}	
									?>
									<div class="form-group">
										<label class="col-md-4 control-label">First Name<font color="red">*</font></label>  
										<div class="col-md-4 inputGroupContainer">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input name="firstname" placeholder="First Name" class="form-control"  type="text" required />
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label" >Last Name<font color="red">*</font></label> 
										<div class="col-md-4 inputGroupContainer">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input name="lastname" placeholder="Last Name" class="form-control"  type="text" required />
                                        </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Username<font color="red">*</font></label>  
										<div class="col-md-4 inputGroupContainer">
											<div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="Uid" placeholder="Username" class="form-control" type="text" required>
                                         </div>
										</div>
									</div>
									<div class="form-group">
                                    <label class="col-md-4 control-label">Portfolio<font color="red">*</font></label>
                                    <div class="col-md-4 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                            <select  required multiple name="portfolio[]">
												<option value=" " disabled selected value>Please select your Portfolio</option>
                                                <option>Loan</option><option>Cards</option><option>Retail Banking</option><option>Payments</option><option>Investment</option><option>Trade Finance</option><option>Cebil Scores</option><option>Wealth Management</option><option>Treasury</option>     
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Application<font color="red">*</font></label>
                                    <div class="col-md-4 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                            <select  multiple required name="application[]">
                                                  <option value=" " disabled selected value>Please select your Application</option>
                                                <option>PLIS</option><option>Right Price Web (RPW)</option><option>RoboFTP Scripts</option><option>Quality Center Scripts</option><option>Commissions</option><option>KBS (Billing System)</option><option>AMI</option><option>Advanced Claims</option><option>Download</option>    
                                            </select>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
									<label class="col-md-4 control-label">Password<font color="red">*</font></label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input name="password" placeholder="Password" class="form-control" type="password" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">Re-type Password<font color="red">*</font></label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input name="password1" placeholder="Re-type Password" class="form-control" type="password" required>
										</div>
									</div>
								</div>
								<div class="form-group"> 
									<label class="col-md-4 control-label">Role<font color="red">*</font></label>
									<div class="col-md-4 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
											<select name="role" class="form-control selectpicker" required>
												<option disabled selected value >Please select the Role</option>
												<option>Project Manager</option>
												<option>Developer</option>
												<option>Tester</option>
												<option>Admin</option>
												<option>Operation</option>
											</select>
										</div>
									</div>
								</div>
								<center>
									<div class="form-group">
										<label class="col-md-4 control-label"></label>
										<div class="col-md-4">
											<button onclick="myFunction()" type="submit" class="btn btn-success" name="create"	>Create User</button>&nbsp;&nbsp;
											<button type="submit" onClick="location.reload();" class="btn btn-warning" name="clear">Clear Fields</button>
										</div>
									</div>
								</center>
							</fieldset>
						</form>
					</div>
				</div>
		   </div>
		</div>
		<div class="page-footer">
			<div class="page-footer-inner"> 2017 &copy; DevOps Tool By
				<a  href="https://www.capgemini.com/">Capgemini</a>
				<div class="scroll-to-top">
					<i class="icon-arrow-up"></i>
				</div>
			</div>
		</div>
	</div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
		<script>
		/* function myFunction() {
       alert("Created Successfully!");
} */
		</script>
</body>
</html>