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
   <script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
   </head>

   <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
      <div class="page-wrapper" id="table">
         <?php
            $page == 'sankeyEuroclearNew';
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
                                       <div id="chartdiv" style="height: 2000px;">
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
	  // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

<?php
$m = new MongoClient();
$db = $m->ryder;
$collection = $db->appInterface;
$results = $collection->find();
?>
var chart = am4core.create("chartdiv", am4charts.SankeyDiagram);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = [
	  
	<?php
		foreach($results as $result){
			?>
			 { from: "<?php echo $result["interface1Application"]; ?>", to: "<?php echo $result["Interface2Application"]; ?>", value:7 },
			
			 <?php 
		}
	?>
	];

 chart.links.template.tooltipText = "{fromName} → {toName} \n Application Size : [bold]{value}";
 
var hoverState = chart.links.template.states.create("hover");
hoverState.properties.fillOpacity = 4.6;

chart.dataFields.fromName = "from";
chart.dataFields.toName = "to";
chart.dataFields.value = "value";


// for right-most label to fit
chart.paddingRight = 140;

chart.nodes.template.nameLabel.label.truncate = false;
chart.nodes.template.nameLabel.label.wrap = true;


// Exporting
//chart.exporting.menu = new am4core.ExportMenu();
//chart.exporting.filePrefix = "poa";



var nodeLink = chart.links.template;
var bullet = nodeLink.bullets.push(new am4charts.CircleBullet());

bullet.fillOpacity = 1;
bullet.circle.radius = 5;
bullet.locationX = 0.5;


// var bullet1 = nodeLink.bullets.push(new am4charts.CircleBullet());

// bullet1.fillOpacity = 1;
// bullet1.circle.radius = 5;
// bullet1.locationX = 0.5;

// create animations
chart.events.on("ready", function() {
    for (var i = 0; i < chart.links.length; i++) {
        var link = chart.links.getIndex(i);
        var bullet = link.bullets.getIndex(0);
        animateBullet(bullet);
	
		// var bullet1 = link1.bullets.getIndex(1);
		// animateBullet(bullet1);
    }
})

function animateBullet(bullet) {
    var duration = 3000 * Math.random() + 2000;
    var animation = bullet.animate([{ property: "locationX" , from: 0, to: 1}], duration)
    animation.events.on("animationended", function(event) {
        animateBullet(event.target.object);
    })
}
// function animateBullet(bullet1) {
    // var duration = 3000 * Math.random() + 2000;
    // var animation = bullet1.animate([{ property: "locationX", from: 0, to: 1 }], duration)
    // animation.events.on("animationended", function(event) {
        // animateBullet(event.target.object);
    // })
// }

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