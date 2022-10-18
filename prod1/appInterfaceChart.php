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
          #sankey_basic {
               width: 100%;
               height: 400px;
               margin-top: 10px;
          }
     </style>
     </head>

     <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
          <div class="page-wrapper" id="table">
               <?php
               $page == 'systemSankey';
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
                                                                      <h2>Application Interface</h2>
                                                                 </div>
                                                                 <ul class="nav navbar-right panel_toolbox">
                                                                 </ul>
                                                                 <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                 <!--<div id="sankey_basic"> -->
                                                                 <div class="row">
                                                                      <div class="col-md-6">
                                                                           <div class="form-group">
                                                                                <!-- <label for="sel1">Select Application:</label> -->
                                                                                <?php
                                                                                $m = new MongoClient();
                                                                                $db = $m->aflac;
                                                                                $col  = $db->app_interface_chart;
                                                                                $distinctCallingApps = $col->distinct('calling_application_name');
                                                                                sort($distinctCallingApps);
                                                                                // echo "<pre>";
                                                                                // print_r($distinctCallingApps);
                                                                                ?>
                                                                                <select class="form-control" name="app" id="selApp">
                                                                                     <option selected disabled>Choose Application</option>
                                                                                     <?php
                                                                                     foreach ($distinctCallingApps as $distinctCallingApp) {
                                                                                          echo "<option>" . $distinctCallingApp . "</option>";
                                                                                     }
                                                                                     ?>
                                                                                </select>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-12" id="sankey_basic"></div>
                                                                 </div>
                                                                 <!-- <div id="sankey_basic"> -->
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




          <!-- Resources -->
          <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
          <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
          <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

          <!-- Chart code -->
          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    am4core.options.commercialLicense = true;
                    // Themes end

                    var chart = am4core.create("sankey_basic", am4charts.SankeyDiagram);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                    <?php
                    $appSet = array();
                    $docSet = array();

                    foreach ($distinctCallingApps as $distinctCallingApp) {
                         $documents = $col->find(array('calling_application_name' => $distinctCallingApp));
                         foreach ($documents as $doc) {
                              // print_r($doc);
                              $doc["calling_application_name"] = trim(preg_replace('/\s\s+/', ' ', $doc["calling_application_name"]));
                              $doc["called_application_name"] = trim(preg_replace('/\s\s+/', ' ', $doc["called_application_name"]));

                              $doc["calling_application_name"] = str_replace("\n", " ", $doc["calling_application_name"]);
                              $doc["called_application_name"] = str_replace("\n", " ", $doc["called_application_name"]);

                              $doc["calling_application_name"] = str_replace("'", "", $doc["calling_application_name"]);
                              $doc["called_application_name"] = str_replace("'", "", $doc["called_application_name"]);

                              $doc["calling_application_name"] = str_replace("(", "", $doc["calling_application_name"]);
                              $doc["calling_application_name"] = str_replace(")", "", $doc["calling_application_name"]);

                              $doc["called_application_name"] = str_replace("(", "", $doc["called_application_name"]);
                              $doc["called_application_name"] = str_replace(")", "", $doc["called_application_name"]);

                              // echo "Calling App Name : ------ " . $doc['calling_application_name'] . "\n";
                              // echo "Called App Name : ------ " . $doc['called_application_name'] . "\n";

                    ?>

                    <?php

                              // $calling = str_replace('\n', ' ', $doc['calling_application_name']);
                              // $called = str_replace('\n', ' ', $doc['called_application_name']);

                              // $calling = str_replace('<br>', ' ', $doc['calling_application_name']);
                              // $called = str_replace('<br>', ' ', $doc['called_application_name']);


                              $docSet[] = array(
                                   "from" => $doc['calling_application_name'],
                                   "to" => $doc['called_application_name'],
                                   "value" => 5
                              );
                         }
                         $distinctCallingApp = trim(preg_replace('/\s\s+/', ' ', $distinctCallingApp));
                         $distinctCallingApp = str_replace("\n", ' ', $distinctCallingApp);
                         $appSet[] = array($distinctCallingApp => $docSet);
                         $docSet = array();
                    }
                    ?>

                    var appData = '<?php echo json_encode($appSet); ?>';
                    appData = JSON.parse(appData);
                    console.log(appData);

                    var lob = $("#selApp").prop("selectedIndex", 0).val();
                    $('#selApp').change(function() {
                         app = $("#selApp").val();
                         // console.log(app);
                         $.each(appData, function() {
                              $.each(this, function(k, v) {
                                   if (k == app) {
                                        chart.data = v;
                                        // initializeChart();
                                        chart.validateData();
                                        $('#sankey_basic').height(chart.data.length * 70);
                                        console.log(chart.data);
                                        return;
                                   }

                              });
                         });
                    });


                    let hoverState = chart.links.template.states.create("hover");
                    hoverState.properties.fillOpacity = 0.6;

                    chart.dataFields.fromName = "from";
                    chart.dataFields.toName = "to";
                    chart.dataFields.value = "value";

                    // for right-most label to fit
                    chart.paddingRight = 200;

                    chart.nodes.template.nameLabel.label.truncate = false;
                    chart.nodes.template.nameLabel.label.wrap = true;
                    // label.maxWidth = 120;

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
          <?php include 'scripts.php' ?>

     </body>

     </html>
<?php
} else {
     header("location:login.php");
}
?>