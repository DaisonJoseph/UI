<?php
$m = new MongoClient();
$db = $m->cap360;
$collection = $db->imsInterfaceChart;
$total = $collection->find()->count();

if (isset($_GET["from"])) {
     $from = intval($_GET["from"]);
     $to = intval($_GET["to"]);
} else {
     $from = 0;
     $to = 500;
}

if ($from >= 500) {
     $previousFrom = $from - 500;
     $previousTo = $to - 500;
}

if ($to < $total) {
     $nextFrom = $from + 500;
     $nextTo = $to + 500;
}
?>
<?php
session_start();
if (isset($_SESSION['name'])) {
     $business = $_GET['business'];
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
     <link href="../assets1/custom/main.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets1/custom/custom.css" type="text/css" />


     <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
     <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" type="text/css" /> -->
     <?php
     // if($tableName == "INDATA")
     // {
     // echo '<style>';
     // echo '#chartdiv{';
     // echo 'height:1000px';
     // echo '}';
     // echo '</style>';
     // }
     ?>

     </head>

     <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
          <div class="page-wrapper" id="table">
               <?php
               $page = 'db2FieldCrud';
               include 'header.php'; ?>
               <div class="clearfix"> </div>
               <div class="page-container">
                    <?php include 'sidebar1.php'; ?>
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
                                                                      <h2>IMS Interface</h2>

                                                                 </div>
                                                                 <ul class="nav navbar-right panel_toolbox">
                                                                 </ul>
                                                                 <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">

                                                                 <div class="table-responsive">
                                                                      <table style="background-color:#ADD8E6;" id="example" class="table table-bordered drop-shadow" style="width:100%">
                                                                           <?php
                                                                           $i = 0;
                                                                           $results = $collection->distinct("business");
                                                                           // print_r($results);
                                                                           // sort($results);
                                                                           echo '<tbody>';

                                                                           echo '<tr>';
                                                                           foreach ($results as $result) {
                                                                                $i++;
                                                                                $tablesystem = $result;

                                                                                //   $tloc = $cloc + $uloc + $lloc;
                                                                                echo '<td class="text-center" style="vertical-align: middle;"><a href="imstablesystem.php?business=' . $tablesystem . '">' . $tablesystem . '</td>';
                                                                                if ($i == round((sizeof($results) / 2))) {
                                                                                     echo '<tr>';
                                                                                }
                                                                                if ($i == sizeof($results)) {
                                                                                     echo '</tr>';
                                                                                }
                                                                           }
                                                                           echo '</tr>';
                                                                           echo '</tbody>';
                                                                           ?>
                                                                      </table>

                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <div class="x_panel container drop-shadow" style="background-color: white;">
                                                            <div class="x_title">
                                                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                                                      <h2><?php echo $tableName; ?></h2>
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
                         am4core.options.commercialLicense = true;
                         // Themes end

                         <?php
                         $m = new MongoClient();
                         $db = $m->cap360;
                         $collection = $db->imsInterfaceChart;

                         $systemsArray = $collection->find(array("business" => $business));
                         // $sys = array_unique($systemsArray);

                         ?>

                         var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);

                         // chart.legend = new am4charts.Legend();

                         var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

                         networkSeries.data = [
                              <?php
                              $prev = "";
                              foreach ($systemsArray as $system) {
                                   $sys = preg_replace("/\s+/", " ", $system['application']);
                                   if (!in_array($sys, $prev)) {
                                        $systemSegments = $collection->find(array("business" => $business, "application" => $system['application']));
                              ?> {
                                             name: '<?php echo $system["application"];  ?>',
                                             children: [
                                                  <?php
                                                  foreach ($systemSegments as $segment) {
                                                  ?> {
                                                            name: '<?php echo $segment["dbd"]; ?>',
                                                            value: 1
                                                       },
                                                  <?php
                                                  }
                                                  ?>
                                             ]
                                        },
                              <?php
                                   }
                                   $prev[] = $sys;
                              }
                              ?>
                         ];

                         networkSeries.dataFields.linkWith = "linkWith";
                         networkSeries.dataFields.name = "name";
                         networkSeries.dataFields.id = "name";
                         networkSeries.dataFields.value = "value";
                         networkSeries.dataFields.children = "children";
                         networkSeries.dataFields.collapsed = "children";


                         networkSeries.links.template.distance = 1.5;
                         networkSeries.nodes.template.tooltipText = "{name}";
                         networkSeries.nodes.template.fillOpacity = 1;
                         networkSeries.nodes.template.outerCircle.scale = 1;

                         networkSeries.nodes.template.label.text = "{name}"
                         networkSeries.fontSize = 8;
                         networkSeries.nodes.template.label.hideOversized = true;
                         networkSeries.nodes.template.label.truncate = true;
                         networkSeries.manyBodyStrength = -16;
                         networkSeries.maxLevels = 2;
                         networkSeries.maxRadius = 60;
                         networkSeries.minRadius = 30;
                         networkSeries.links.template.strokeWidth = 5;
                         networkSeries.links.template.strokeOpacity = 0.5;
                         networkSeries.centerStrength = 1.5;

                         // networkSeries.maxRadius = am4core.percent(6);
                         // networkSeries.minRadius = am4core.percent(2);
                         // networkSeries.manyBodyStrength = -5;
                         // networkSeries.links.template.strokeOpacity = 0;



                    }); // end am4core.ready()
               </script>

               <script>
                    $(document).ready(function() {
                         $(window).scroll(function() {
                              if ($(this).scrollTop() > 50) {
                                   $('#back-to-top').fadeIn();
                              } else {
                                   $('#back-to-top').fadeOut();
                              }
                         });
                         // scroll body to 0px on click
                         $('#back-to-top').click(function() {
                              $('#back-to-top').tooltip('hide');
                              $('body,html').animate({
                                   scrollTop: 0
                              }, 800);
                              return false;
                         });

                         //$('#back-to-top').tooltip('show');

                    });
               </script>
               <!--     <script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
      <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
      <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
      
      <script src="../assets1/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="../assets1/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	  
	  <script src="../assets1/global/scripts/app.min.js" type="text/javascript"></script>
	  <script src="../assets1/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	  <script src="../assets1/layouts/layout/scripts/jquery1.js" type="text/javascript"></script>
	  <script src="../assets1/layouts/layout/scripts/jquery3.js" type="text/javascript"></script>
	  <script src="../assets1/layouts/layout/scripts/jquery5.js" type="text/javascript"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	  <script src="../assets1/custom/custom.js" type="text/javascript"></script> 
	  <script src="../assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
               <?php include 'scripts.php' ?>
               <!-- starts here -->
               <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script> -->
               <!-- end here -->
               <script>
                    $(document).ready(function() {
                         $('#example').DataTable();
                    });

                    $('#example').dataTable({
                         "searching": false
                    });
               </script>

     </body>

     </html>
<?php
} else {
     header("location:login.php");
}
?>