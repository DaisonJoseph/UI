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
	</head>

	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
		<div class="page-wrapper" id="table">
			<?php
				$page == 'sankeyBusinessFunc';
				include 'header.php'; ?>
			<div class="page-container">
				<?php require 'sidebar.php'; ?>
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
														<h2>Business to Application Mapping</h2>
													</div>
													<ul class="nav navbar-right panel_toolbox">
													</ul>
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<div id="container" style="width: 550px;  margin: 0 auto">
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
		<script language="JavaScript">
			function drawChart() {
				// Define the chart to be drawn.
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'From');
				data.addColumn('string', 'To');
				data.addColumn('number', 'Weight');

				data.addRows([
					<?php

						$m = new MongoClient();
						$db = $m->euroclear;
						$collection = $db->sankeybusiness;

						$LOB  = array("IF", "VP", "Others");
						$result_array = array();
						$data_array = array();

						foreach ($LOB as $temp) {
							$rows = $collection->find();
							foreach ($rows as $row) {
								if ($temp == $row['App_Code']) {
									$result_array[] = $row;
								}
							}
						}


						foreach ($result_array as $row) {
							//if ((strpos($row['AppName'],"#APP") === false) && ($row['LOB'] != $row['Interface_LOB']))
							{
								if ($row['App_Code'] == "IF") {
									echo '[ "' . "Owner's Information" . '", "' . $row['Interface_App_Code'] . ' ", ' . '10' . ' ],';
								} else if ($row['App_Code'] == "VP") {
									echo '[ "' . "Securities Maintenance" . '", "' . $row['Interface_App_Code'] . ' ", ' . '10' . ' ],';
								} else {
									echo '[ "' . $row['App_Code'] . '", "' . $row['Interface_App_Code'] . ' ", ' . '10' . ' ],';
								}
								$data_array[] = $row['App_Code'];
							}
						}

						?>
				]);

				// Set chart options
				var options = {
					width: 550,
					height: 5000,
					sankey: {
						iterations: 0,
					}
				};

				// Instantiate and draw the chart.
				var chart = new google.visualization.Sankey(document.getElementById('container'));
				chart.draw(data, options);

				google.visualization.events.addListener(chart, 'onmouseover', selectHandler);
			}
			google.charts.setOnLoadCallback(drawChart);

			var dataarrayphp = <?php echo json_encode($data_array); ?>;

			var rowvalue;

			function selectHandler(properties) {

				document.ondblclick = docOnMousedown;
				rowvalue = JSON.stringify(properties.row);
			}

			function docOnMousedown() {
				var rownumber = rowvalue;
				var lob = dataarrayphp[rownumber];
				// window.location.href = "sankeycomponents.php?lob=" + lob;
			}
		</script>
<!--		<script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
		<script src="../assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../assets1/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="../assets1/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
		<?php include 'scripts.php'?>
	</body>

	</html>
<?php
} else {
	header("location:login.php");
}
?>