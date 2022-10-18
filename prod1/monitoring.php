<?php require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            overflow: hidden;
        }
		#mass form input[type='file'] {
			  display: inline!important;
		}
		#mass form input[type='submit'] {
			  display: inline!important;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
      <?php include 'header.php' ?>
        <div class="clearfix"></div>
        <div class="page-container">
			<?php include 'sidebar.php'; ?>
            <div class="page-content-wrapper">
                <div class="page-content" style="background-color:#fff">
                    <div class="page-bar" style="background-color:#778899;height:21px;">
                        <ul class="page-breadcrumb" style="padding-top:1px;">
                            <li>
                                <span style="color:white">Mass Upload</span>
                            </li>
                        </ul>
                    </div><br/>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered" style="margin-top: -19px -22px 0 -20px;height:43px">
                                <div class="portlet-title" style="margin-bottom: 25px;">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold" style="color:black">Please Select Files and Upload respectively</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<col width="200">
											<thead>
												<tr>
													<th>Files</th>
													<th>Input Files</th>
													<th>Sample CSV Files</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Deployments</td>
                                                    <td><div id="mass"> <form action="uploadcsv.php?input=dep" method="post" enctype="multipart/form-data">
														<input type="file" name="fileToUpload" id="fileToUpload">
														<input type="submit" value="Upload" name="submit">
													</form></div></td>
                                                    <td><a href="deployments.csv" download="deployments.csv" target="_blank">Download Link</a></td>
												</tr>
												<tr>
													<td>Application</td>
                                                    <td><div id="mass"> <form action="uploadcsv.php?input=app" method="post" enctype="multipart/form-data">
														<input type="file" name="fileToUpload" id="fileToUpload">
														<input type="submit" value="Upload" name="submit">
													</form></div></td>
                                                    <td><a href="application.csv" download="application.csv" target="_blank">Download Link</a></td>
												</tr>
												<tr>
													<td>Run Coverage Report</td>
                                                    <td><div id="mass"> <form action="coveragereport/modify.php" target="_blank" method="post" enctype="multipart/form-data">
														
														<input type="submit" value="RUN" name="submit">
													</form></div></td>
                                                    
												</tr>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="page-footer">
			<div class="page-footer-inner"> 2018 &copy; DevOps Tool By
				<a href="https://www.capgemini.com/">Capgemini</a>
				<div class="scroll-to-top">
					<i class="icon-arrow-up"></i>
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
</body>
</html>