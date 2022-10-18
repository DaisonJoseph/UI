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
														<h2>Application to Business Mapping</h2>
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
		<script src="https://www.amcharts.com/lib/4/core.js"></script>
		<script src="https://www.amcharts.com/lib/4/charts.js"></script>
		<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
	<!--	<script>
		am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		var chart = am4core.create("chartdiv1", am4charts.SankeyDiagram);
		chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

		<?php
			// $m = new MongoClient();
			// $db = $m->uc;
			// $btob  = $db->btobsankey;
			// $btobArray = $btob->find();
		?>
		chart.data = [
			<?php
				// foreach($btobArray as $val)
				// {
			?>
				{ from: "<?php echo $val['Application']; ?>", to: "<?php echo $val['Business']; ?>", value: 10 },
			<?php
				// }
			?>
		];

		let hoverState = chart.links.template.states.create("hover");
		hoverState.properties.fillOpacity = 0.6;

		chart.dataFields.fromName = "from";
		chart.dataFields.toName = "to";
		chart.dataFields.value = "value";

		// for right-most label to fit
		chart.paddingRight = 30;

		// make nodes draggable
		var nodeTemplate = chart.nodes.template;
		nodeTemplate.inert = true;
		nodeTemplate.readerTitle = "Drag me!";
		nodeTemplate.showSystemTooltip = true;
		nodeTemplate.width = 20;

		// make nodes draggable
		var nodeTemplate = chart.nodes.template;
		nodeTemplate.readerTitle = "Click to show/hide or drag to rearrange";
		nodeTemplate.showSystemTooltip = true;
		nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer

		}); // end am4core.ready()
</script>-->


<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.SankeyDiagram);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
		<?php
			$m = new MongoClient();
			$db = $m->uc;
			$btob  = $db->btobsankey;
			$btobArray = $btob->find();
		?>

chart.data = [
			<?php
			$i=0;
				foreach($btobArray as $val)
				{
					if($i<100)	{
						?>
						{ from: "<?php echo $val['Application']; ?>", to: "<?php echo $val['Business']; ?>", value: 1 },
						<?php
					}
					$i++;
				}
			?>
];

let hoverState = chart.links.template.states.create("hover");
hoverState.properties.fillOpacity = 0.6;

chart.dataFields.fromName = "from";
chart.dataFields.toName = "to";
chart.dataFields.value = "value";

chart.links.template.propertyFields.id = "id";
chart.links.template.colorMode = "solid";
chart.links.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
chart.links.template.fillOpacity = 0.1;
chart.links.template.tooltipText = "";

// highlight all links with the same id beginning
chart.links.template.events.on("over", function(event){
  let link = event.target;
  let id = link.id.split("-")[0];

  chart.links.each(function(link){
    if(link.id.indexOf(id) != -1){
      link.isHover = true;
    }
  })
})

chart.links.template.events.on("out", function(event){  
  chart.links.each(function(link){
    link.isHover = false;
  })
})

// for right-most label to fit
chart.paddingRight = 20;
chart.height = 900;

// make nodes draggable
var nodeTemplate = chart.nodes.template;
nodeTemplate.inert = true;
nodeTemplate.readerTitle = "Drag me!";
nodeTemplate.showSystemTooltip = true;
nodeTemplate.width = 20;

// make nodes draggable
var nodeTemplate = chart.nodes.template;
nodeTemplate.readerTitle = "Click to show/hide or drag to rearrange";
nodeTemplate.showSystemTooltip = true;
nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer

}); // end am4core.ready()
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['sankey']});
      google.charts.setOnLoadCallback(drawChart);

				<?php
			$m = new MongoClient();
			$db = $m->uc;
			$btob  = $db->btobsankey;
			$btobArray = $btob->find();
		?>

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'From');
        data.addColumn('string', 'To');
        data.addColumn('number', 'Weight');
		
        data.addRows([
			<?php
			$i=0;
				foreach($btobArray as $val)
				{
					$weight = $btob->find(array("Application"=>$val['Application'],"Business"=>$val['Business']))->count();
					
					// if($i<100)	{
						?>
						[ "<?php echo $val['Application']; ?>", "<?php echo $val['Business']; ?>", <?php echo $weight; ?> ],
						<?php
					// }
					// $i++;
				}
			?>
        ]);

        // Sets chart options.
        var options = {
          width: 1000,
		  height: 1500,
        };

        // Instantiates and draws our chart, passing in some options.
        var chart = new google.visualization.Sankey(document.getElementById('sankey_basic'));
        chart.draw(data, options);
      }
    </script>
	
	
	
	
	
	
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
			$btob  = $db->btobsankey;
			$btobBusinessArray = $btob->distinct("Business");
			sort($btobBusinessArray);
		?>

var chart = am4core.create("chartdiv2", am4plugins_forceDirected.ForceDirectedTree);
chart.legend = new am4charts.Legend();


var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

networkSeries.data = [
<?php
	foreach($btobBusinessArray as $btobBusiness)
	{
		$btobApplications = $btob->find(array("Business"=>$btobBusiness));
?>
		{
			name: '<?php echo $btobBusiness; ?>',
			// fixed : true,
			collapsed : true,
			children: [
		<?php
			foreach($btobApplications as $btobApplication)	
			{
		?>		  
			  {
				name: "<?php echo $btobApplication['Application']; ?>", value: 1
			  },
		<?php
			}
		?>		
		  ]
		},		
	<?php
	}
	?>
];

networkSeries.dataFields.linkWith = "linkWith";
networkSeries.dataFields.name = "name";
networkSeries.dataFields.id = "name";
networkSeries.dataFields.value = "value";
networkSeries.dataFields.children = "children";
networkSeries.dataFields.collapsed = "collapsed";
// networkSeries.dataFields.fixed = "fixed";

networkSeries.nodes.template.tooltipText = "{name}";
networkSeries.nodes.template.fillOpacity = 1;
networkSeries.links.template.distance = 1.5;
// networkSeries.links.template.strength = 1.5;
networkSeries.nodes.template.outerCircle.scale = 1;

networkSeries.nodes.template.label.text = "{name}"
// networkSeries.nodes.template.togglable = true;
networkSeries.fontSize = 8;
networkSeries.maxLevels = 2;
networkSeries.maxRadius = 60;
networkSeries.minRadius = 30;

networkSeries.manyBodyStrength = -16;
networkSeries.nodes.template.label.hideOversized = true;
networkSeries.nodes.template.label.truncate = true;

networkSeries.links.template.strokeWidth = 5;
networkSeries.links.template.strokeOpacity = 0.5;
networkSeries.centerStrength = 1.5;
// networkSeries.manyBodyStrength = -2.5;
// networkSeries.nodes.template.circle.disabled = true;
// networkSeries.nodes.template.outerCircle.disabled = true;
// networkSeries.links.template.disabled = true;
// networkSeries.events.on("inited", function() {
  // networkSeries.animate({
    // property: "velocityDecay",
    // to: 1
  // }, 3000);
// });


}); // end am4core.ready()
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