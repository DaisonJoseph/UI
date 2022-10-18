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
   <script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/plugins/forceDirected.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {
         packages: ['sankey']
      });
   </script>
   </head>

   <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
      <div class="page-wrapper" id="table">
         <?php
            $page == 'sankeyEuroclear';
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
                                          <h2>Application Interface Mapping</h2>
                                       </div>
                                       <ul class="nav navbar-right panel_toolbox">
                                       </ul>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                       <div id="chartdiv" style="height: 550px;width:100%;">
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
      <script>
	  am4core.ready(function() {

	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
	
	var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())
	networkSeries.dataFields.linkWith = "linkWith";
	networkSeries.dataFields.name = "name";
	networkSeries.dataFields.id = "name";
	networkSeries.dataFields.value = "value";
	networkSeries.dataFields.children = "children";
	networkSeries.maxLevels = 1;
	networkSeries.maxRadius = 40;
	
	
	networkSeries.nodes.template.label.text = "{name}"
	networkSeries.fontSize = 12
	networkSeries.linkWithStrength = 0;
	networkSeries.nodes.template.expandAll = false;
	
	var nodeTemplate = networkSeries.nodes.template;
	nodeTemplate.tooltipText = "{name}";
	nodeTemplate.fillOpacity = 1;
	nodeTemplate.label.hideOversized = true;
	nodeTemplate.label.truncate = true;
	
	var linkTemplate = networkSeries.links.template;
	linkTemplate.strokeWidth = 1;
	var linkHoverState = linkTemplate.states.create("hover");
	linkHoverState.properties.strokeOpacity = 1;
	linkHoverState.properties.strokeWidth = 2;
	
	nodeTemplate.events.on("over", function (event) {
		var dataItem = event.target.dataItem;
		dataItem.childLinks.each(function (link) {
			link.isHover = true;
		})
	})
	
	nodeTemplate.events.on("out", function (event) {
		var dataItem = event.target.dataItem;
		dataItem.childLinks.each(function (link) {
			link.isHover = false;
		})
	})
	
	<?php
	$m = New MongoClient();
	$db = $m->ryder;
	$xref = $db->appInterface;
	$distinct_applications = $xref->distinct("interface1Application");
	$called_components = $xref->distinct("Interface2Application");
	$out = $xref->find()->sort(array('interface1Application'=>-1));
	?>
	// Add data
	
	networkSeries.data = [  
						<?php
						foreach ($distinct_applications as $distinct_application) {
						if($distinct_application != null){
						?> {
						"name": "<?php echo $distinct_application; ?>",
						"value": 1,
						
							
						"linkWith": [ 
						
						<?php
						//echo "check";
						$called_application_name = array();
						$called_endvr_code = array();
						$calling_endvr_code = array();
						$link_merge1 = array();
						$link_merge2 = array();
						$counter =0;
						$count = 0;
								
						foreach ($out as $out1){
						if($out1['Interface2Application'] != null and  $distinct_application != $out1['Interface2Application'] and $distinct_application == $out1['interface1Application'] ){
		
							$called_application_name[$counter] = $out1['Interface2Application'];
							
							$counter++;
						}
						}
						$called_application_name = array_unique($called_application_name);
						foreach($called_application_name as $word)
						{
							echo '"' . $word . '",';
						}
						?>
						],
						"children": [ 
								]
								},
						<?php
						} 
						}
						?>
	
	];
	}); // end am4core.ready()

	  </script>
<!--      <script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
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