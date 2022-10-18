	<?php
session_start();
if (isset($_SESSION['name'])) {
	$chain = $_GET['first_level'];
	$chain = $chain . ";";
	$chain_array = array();
	$chain_array = explode(";", $chain);
	array_pop($chain_array);
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
				<?php require 'sidebar1.php'; ?>
				<div class="page-content-wrapper">
					<div class="page-content">
						<div>
							<div class="clearfix"></div>
							<div class="row">
								<!--start here-->
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel container drop-shadow" style="background-color: white;">
										<div class="x_title">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<h2>Scheduler Call Chain </h2>
											</div>
											<ul class="nav navbar-right panel_toolbox">
											</ul>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<div id="chartdiv"></div>

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
		<?php include 'footer.php'; ?>

		<script src="https://www.amcharts.com/lib/4/core.js"></script>
		<script src="https://www.amcharts.com/lib/4/charts.js"></script>
		<script src="https://www.amcharts.com/lib/4/plugins/timeline.js"></script>
		<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
		<script>
			// Themes begin
			am4core.useTheme(am4themes_animated);
			// Themes end
			am4core.options.commercialLicense = true;
			var chart = am4core.create("chartdiv", am4plugins_timeline.CurveChart);
			chart.curveContainer.padding(0, 100, 0, 120);
			chart.maskBullets = false;

			var colorSet = new am4core.ColorSet();

			chart.data = [
				/* {
								"category": "",
								"year": "1990",
								"size": 13,
								"text": "Lorem ipsum dolor"
							  },  */
				<?php
					$year = 1990;
					foreach ($chain_array as $chain_comp) {
						$year++;
						?> {
						"category": "",
						"year": "<?php echo $year; ?>",
						"size": 13,
						"text": "<?php echo $chain_comp; ?>"
					},
				<?php
					}
					?>
			];

			chart.dateFormatter.inputDateFormat = "yyyy";

			chart.fontSize = 11;
			chart.tooltipContainer.fontSize = 11;

			var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "category";
			categoryAxis.renderer.grid.template.disabled = true;

			var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
			dateAxis.renderer.points = [{
				x: -400,
				y: 0
			}, {
				x: 0,
				y: 50
			}, {
				x: 400,
				y: 0
			}]
			dateAxis.renderer.polyspline.tensionX = 0.8;
			dateAxis.renderer.grid.template.disabled = true;
			dateAxis.renderer.line.strokeDasharray = "1,4";
			dateAxis.baseInterval = {
				period: "day",
				count: 1
			}; // otherwise initial animation will be not smooth

			dateAxis.renderer.labels.template.disabled = true;

			var series = chart.series.push(new am4plugins_timeline.CurveLineSeries());
			series.strokeOpacity = 0;
			series.dataFields.dateX = "year";
			series.dataFields.categoryY = "category";
			series.dataFields.value = "size";
			series.baseAxis = categoryAxis;

			var interfaceColors = new am4core.InterfaceColorSet();

			series.tooltip.pointerOrientation = "down";

			var distance = 100;
			var angle = 60;

			var bullet = series.bullets.push(new am4charts.Bullet());



			var circle = bullet.createChild(am4core.Circle);
			circle.radius = 30;
			circle.fillOpacity = 1;
			circle.strokeOpacity = 0;

			var circleHoverState = circle.states.create("hover");
			circleHoverState.properties.scale = 1.3;

			series.heatRules.push({
				target: circle,
				min: 20,
				max: 50,
				property: "radius"
			});
			circle.adapter.add("fill", function(fill, target) {
				if (target.dataItem) {
					return chart.colors.getIndex(target.dataItem.index)
				}
			});
			circle.tooltipText = "{text}";
			circle.adapter.add("tooltipY", function(tooltipY, target) {
				return -target.pixelRadius - 4;
			});

			var yearLabel = bullet.createChild(am4core.Label);
			yearLabel.text = "{text}";
			yearLabel.strokeOpacity = 0;
			yearLabel.fill = am4core.color("#fff");
			yearLabel.horizontalCenter = "middle";
			yearLabel.verticalCenter = "middle";
			yearLabel.interactionsEnabled = false;





			var hoverState = outerCircle.states.create("hover");
			hoverState.properties.strokeOpacity = 0.8;
			hoverState.properties.scale = 1.5;



			chart.scrollbarX = new am4core.Scrollbar();
			chart.scrollbarX.opacity = 0.5;
			chart.scrollbarX.width = am4core.percent(50);
			chart.scrollbarX.align = "center";
		</script>
		<?php include 'scripts.php' ?>
	</body>

	</html>
<?php
} else {
	header("location:login.php");
}
?>