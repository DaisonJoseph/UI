	<?php
session_start();
if (isset($_SESSION['name'])) {
	$tableName = $_GET['dbdname'];
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
												<center><h2>IMS Interface Chart </h2></center>
											</div>
											<ul class="nav navbar-right panel_toolbox">
											</ul>
											<div class="clearfix">
											
											</div>
										</div>
										<div class="x_content">
											<h2><small>Segment Application :</small> <?php echo $tableName; ?></h2>
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
<script src="https://www.amcharts.com/lib/4/plugins/forceDirected.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

<?php
	$m = new MongoClient();
	$db = $m->uc;
	$collection = $db->imsInterface;
	
	$systemsArray = $collection->find(array("dbdsystem"=>$tableName));
	print_r($systemArray);
	// $sys = array_unique($systemsArray);
	
?>

var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
chart.legend = new am4charts.Legend();

var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

	networkSeries.data = [
	<?php
		$prev = "";
		foreach($systemsArray as $system)
		{
			$sys = preg_replace("/\s+/"," ",$system['system']);
			if($prev !== $sys)
			{
				$systemSegments = $collection->find(array("dbdsystem"=>$tableName,"system"=>$system['system']));
				?>
				{
				  name: '<?php echo $system["system"];  ?>',
				  children: [
				  <?php
					foreach($systemSegments as $segment)
					{
				  ?>
					  {
						name: '<?php echo $segment["dbdname"]; ?>', value: 1
					  },
				  <?php
					}
				  ?>
				  ]
				},
	<?php	
			}
			$prev = preg_replace("/\s+/"," ",$system['system']);;
		}
	?>
	];

	networkSeries.dataFields.linkWith = "linkWith";
	networkSeries.dataFields.name = "name";
	networkSeries.dataFields.id = "name";
	networkSeries.dataFields.value = "value";
	networkSeries.dataFields.children = "children";
	networkSeries.links.template.distance = 1;
	networkSeries.nodes.template.tooltipText = "{name}";
	networkSeries.nodes.template.fillOpacity = 1;
	networkSeries.nodes.template.outerCircle.scale = 1;

	networkSeries.nodes.template.label.text = "{name}"
	networkSeries.fontSize = 8;
	networkSeries.nodes.template.label.hideOversized = true;
	networkSeries.nodes.template.label.truncate = true;
	networkSeries.minRadius = am4core.percent(2);
	networkSeries.manyBodyStrength = -5;
	networkSeries.links.template.strokeOpacity = 0;
	
	
	networkSeries.maxLevels = 2;
	networkSeries.maxRadius = am4core.percent(6);
	networkSeries.manyBodyStrength = -16;
	// networkSeries.nodes.template.label.hideOversized = true;
	// networkSeries.nodes.template.label.truncate = true;

	}); // end am4core.ready()
</script>
	
		<?php include 'scripts.php' ?>
	</body>

	</html>
<?php
} else {
	header("location:login.php");
}
?>