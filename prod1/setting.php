<?php 
	  require 'sessioncon.php';
	  if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } 
	  $cursor = $user->find();
	  $username = $_SESSION['Uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            overflow: hidden;
        }
    </style>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper"><?php include 'header.php'; ?>
        <div class="clearfix"></div>
        <div class="page-container"><?php include 'sidebar.php'; ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <form class="well form-horizontal" action="changepassword.php" method="post" id="contact_form" style="margin-right:100px;margin-left:10px;margin-top:-10px;margin-bottom:-10px">
                            <fieldset>
                                <legend>Settings</legend>
								<?php if(isset($_SESSION['passnomatch'])){ echo '<div class="alert alert-danger"><strong>Current Password is unmatched!</strong></div>'; }?> 
								<?php if(isset($_SESSION['passmatch'])){ echo '<div class="alert alert-success"><strong>Password Changed!</strong></div>'; }?> 
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">User Name</label>
                                    <div class="col-md-4 col-sm-12 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="user_name" value="<?php if(isset($_SESSION['Uid'])){echo $username; } ?>" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">First Name</label>
                                    <div class="col-md-4 col-sm-12 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="first_name" value="<?php  if(isset($_SESSION['firstname'])){echo $_SESSION['firstname']; }  ?>"  class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">Last Name</label>
                                    <div class="col-md-4 col-sm-12 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="last_name" value="<?php if(isset($_SESSION['lastname'])){echo $_SESSION['lastname']; } ?>" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">Portfolio</label>
                                    <div class="col-md-4 col-sm-12 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                            <select name="portfolio" multiple readonly disabled selected value>
                                                  <option value=" " disabled selected value>Please select your Portfolio</option>
                                                <option>Loan</option><option>Cards</option><option>Retail Banking</option><option>Payments</option><option>Investment</option><option>Trade Finance</option><option>Cebil Scores</option><option>Wealth Management</option><option>Treasury</option>     
                                            </select>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">Application</label>
                                    <div class="col-md-4 col-sm-12 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                            <select name="state" readonly multiple disabled selected value>
                                                  <option value=" " disabled selected value>Please select your Application</option>
                                                <option>PLIS</option><option>Right Price Web (RPW)</option><option>RoboFTP Scripts</option><option>Quality Center Scripts</option><option>Commissions</option><option>KBS (Billing System)</option><option>AMI</option><option>Advanced Claims</option><option>Download</option>        
                                            </select>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label">Change Password</label>
                                    <div class="col-md-4 col-sm-12 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key "></i></span>
                                            <input readonly name="currentpassword" placeholder="Current Password" class="form-control" type="password">
                                        </div>
                                    </div>
                                </div> 					
								<div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label"></label>
                                    <div class="col-md-4 col-sm-12 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key "></i></span>
                                            <input readonly name="newpassword" placeholder="New Password" class="form-control" type="password">
                                        </div>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-12 control-label"></label>
                                    <div class="col-md-4 col-sm-12"><center>
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button></center>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; DevOps Tool By
                <a href="https://www.capgemini.com/">Capgemini</a>
                <div class="scroll-to-top">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </div>
        </div>
	</div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('.multiselect-ui').multiselect({
                    includeSelectAllOption: true
                });
            });
        </script>
</body>
</html>