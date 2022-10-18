<?php
session_start();
if (isset($_SESSION['name'])) {
	?>


	<!DOCTYPE html>
	<html lang="en">

	<meta charset="utf-8" />
	<title>CAP360 Code Analyzer</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
	<meta content="" name="author" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
	<link href="../assets1/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets1/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets1/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../assets1/global/css/scroll.css" type="text/css">
	<link rel="stylesheet" href="new 1.css" type="text/css">
	<link href="../assets1/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
	<link href="../assets1/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="../assets1/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets1/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets1/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="../assets1/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="../assets1/layouts/layout/img/cap.ico" type="image/x-icon" />

	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
	</script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			packages: ['sankey']
		});
	</script>
	<style>
#chartdiv2 {
  width: 100%;
  max-width: 100%;
  height:550px;
}

.button3 {border-radius: 8px;}
</style>
	</head>

	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
		<div class="page-wrapper" id="table">
			<?php
				$page == 'btobsankey';
				include 'header.php'; ?>
			<div class="page-container">
				<?php require 'sidebar1.php'; ?>
				<div class="page-content-wrapper">
					<div class="page-content">
						<div>
							<div class="clearfix"></div>
							<div class="row">
								<!--start here-->
								<div class="col-xs-12 col-sm-12">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel container drop-shadow" style="background-color: white;">
												<div class="x_title">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<h2>Upload File</h2>
													</div>
													<br>
													<br>
													<br>
													<br>
													<br>
													<div class="card-body">
														<div class="row">
															<div class="col-md-12">
																<!-- BEGIN FORM--> 
																<?php 
																if(isset($_SESSION["Message"])){
																	?>
																<div class="alert alert-danger text-center">
																	<span style="padding: 20px;"> <?php echo $_SESSION["Message"]; ?> </span>
																</div>
																	<?php
																	unset($_SESSION["Message"]);
																}
																?>
																<div class="row">
																	<div class="col-lg-4">
																		<h4  style="padding-left: 215px">Template File :</h4>
																	</div>
																	<div class="col-lg-4" style="padding-left: 0px" >
																		<a href="Componentization/template.csv"><h4>Click to Download</h4></a>
																	</div>
																</div>
																<hr>
																<form action="uploadParser.php" method="post" enctype="multipart/form-data">
																	<div class="row" style="padding-left: 100px">
																		<div class="col-lg-3">
																			<h4 style="margin-top: 0px;margin-bottom: 0px;padding-top: 6px;padding-bottom: 6px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select file to upload:</h4>
																		</div>
																		<div class="col-lg-3" style="padding-left: -250px">		
																			<input type="file" name="fileToUpload" id="fileToUpload" style="padding-top: 6px;padding-bottom: 6px;"><br><br>
																		</div>	
																		<div class="col-lg-3" style="padding-left: -250px">		
																			<input style="border-radius: 8%!important;" class="btn btn-primary" type="submit" value="Upload File" name="submit">
																		</div>	
																	</div>
																</form>
																<hr>
																<!-- END FORM-->
															</div>
														</div>
													</div>
													<ul class="nav navbar-right panel_toolbox">
													</ul>
													<div class="clearfix"></div>
												</div>
												<div class="x_content" >
													<!--<div id="sankey_basic"> -->
													<div id="chartdiv2">
													</div>
												</div>
											</div>
											<!--end here-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>
		<?php include 'scripts.php'?>
	</body>

	</html>
<?php
} else {
	header("location:login.php");
}
?>