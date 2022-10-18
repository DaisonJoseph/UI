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
               height: 4000px;
          }

          #sankey_basic {
               /* width: 100%; */
          }
     </style>
     </head>

     <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
          <div class="page-wrapper" id="table">
               <?php
               $page == 'db2InterfaceSankey';
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
                                                                      <h2>DB2 Interface</h2>
                                                                 </div>
                                                                 <ul class="nav navbar-right panel_toolbox">
                                                                 </ul>
                                                                 <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                 <!--<div id="sankey_basic"> -->
                                                                 <div id="sankey_basic">
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


          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
               google.charts.load('current', {
                    'packages': ['sankey']
               });
               google.charts.setOnLoadCallback(drawChart);
               <?php
               $m = new MongoClient();
               $db = $m->cap360;
               $col  = $db->db2InterfaceChart;
               $db2Interfaces = $col->find();
               ?>

               function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'From');
                    data.addColumn('string', 'To');
                    data.addColumn('number', 'Weight');
                    data.addRows([
                         <?php
                         foreach ($db2Interfaces as $db2Interface) {
                              $table = trim(preg_replace('/\s\s+/', ' ', $db2Interface['TABLE_NAME']));
                              $tableApp = trim(preg_replace('/\s\s+/', ' ', $db2Interface['TABLE_APPLICATION']));
                              $app = trim(preg_replace('/\s\s+/', ' ', $db2Interface['APPLICATION']));
                         ?>["<?php echo "T-> " . $table; ?>", "<?php echo "TA-> " . $tableApp; ?>", 10],
                              ["<?php echo "TA-> " . $tableApp; ?>", "<?php echo "A-> " . $app; ?>", 10],
                         <?php
                         }
                         ?>
                    ]);

                    // Sets chart options.
                    var options = {
                         width: 1000,
                         height: 5500,
                    };

                    // var colors = ['#a6cee3', '#b2df8a', '#fb9a99', '#fdbf6f',
                    // '#cab2d6', '#ffff99', '#1f78b4', '#33a02c'];

                    // var options = {
                    // height: 400,
                    // sankey: {
                    // node: {
                    // colors: colors
                    // },
                    // link: {
                    // colorMode: 'gradient',
                    // colors: colors
                    // }
                    // }
                    // };
                    // Instantiates and draws our chart, passing in some options.
                    var chart = new google.visualization.Sankey(document.getElementById('sankey_basic'));
                    chart.draw(data, options);
               }
          </script>



          <script src="https://www.amcharts.com/lib/4/core.js"></script>
          <script src="https://www.amcharts.com/lib/4/charts.js"></script>
          <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

          <!-- Chart code -->
          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv2", am4charts.SankeyDiagram);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
                    <?php
                    $m = new MongoClient();
                    $db = $m->uc;
                    $db2  = $db->db2Interface;
                    $db2Interfaces = $db2->find();
                    ?>
                    chart.data = [
                         <?php
                         foreach ($db2Interfaces as $db2Interface) {
                         ?> {
                                   from: "<?php echo $db2Interface['table_name']; ?>",
                                   to: "<?php echo $db2Interface['table_system']; ?>",
                                   value: 5
                              },
                              {
                                   from: "<?php echo $db2Interface['table_system']; ?>",
                                   to: "<?php echo $db2Interface['system']; ?>",
                                   value: 5
                              },
                         <?php
                         }
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
                    nodeTemplate.wrap = false;
                    nodeTemplate.truncate = false;

                    // make nodes draggable
                    var nodeTemplate = chart.nodes.template;
                    nodeTemplate.readerTitle = "Click to show/hide or drag to rearrange";
                    nodeTemplate.showSystemTooltip = true;
                    nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer

               }); // end am4core.ready()
          </script>



          <!--		<script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
		<script src="../assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../assets1/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="../assets1/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
          <?php include 'scripts.php' ?>
     </body>

     </html>
<?php
} else {
     header("location:login.php");
}
?>