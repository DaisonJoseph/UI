<?php
$m = new MongoClient();
$db = $m->aflac;
$collection = $db->mq_report;
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
?>
     <!DOCTYPE html>
     <html lang="en">

     <meta charset="utf-8" />
     <title>CAP360 Code Analyzer</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta content="width=device-width, initial-scale=1" name="viewport" />
     <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
     <meta content="" name="author" />
     <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>-->
     <script src="static/jquery.min.js" type="text/javascript"></script>
     <link href="../assets1/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="../assets1/global/css/scroll.css" type="text/css">
     <link rel="stylesheet" href="new 1.css" type="text/css">
     <link href="../assets1/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
     <link href="../assets1/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
     <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />-->
     <link href="static/animate.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
     <link href="../assets1/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
     <link rel="shortcut icon" href="../assets1/layouts/layout/img/cap.ico" type="image/x-icon" />

     <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />-->
     <link rel="stylesheet" href="static/export.css" type="text/css" media="all" />
     <!--<link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">-->
     <link href="static/dohyeon.css" rel="stylesheet">
     <!--<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">-->
     <link href="static/dataTables.bootstrap4.min.css" rel="stylesheet">
     <link href="../assets1/custom/main.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets1/custom/custom.css" type="text/css" />


     <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
     <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" type="text/css" /> -->


     </head>

     <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
          <div class="page-wrapper" id="table">
               <?php
               $page = 'mqReport';
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
                                                                      <h2>MQ Report</h2>
                                                                      <?php
                                                                      if (isset($_GET['input'])) {
                                                                           $business = $_GET['input'];
                                                                           $business = str_replace(" ", "+", $business);
                                                                           echo '<h5><a href="mqReportdownload.php?input=' . $business . '"> Download Excel Report </a></h5>';
                                                                      } else {
                                                                           echo '<h5><a href="mqReportdownload.php"> Download Excel Report </a></h5>';
                                                                      }
                                                                      ?>
                                                                      <form action="mqReport.php" class="searchform">
                                                                           <input type="text" placeholder="Search.." name="input">
                                                                           <button type="submit">Search</button>
                                                                      </form>
                                                                 </div>
                                                                 <ul class="nav navbar-right panel_toolbox">
                                                                 </ul>
                                                                 <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                 <div class="table-responsive">
                                                                      <table id="example" class="table table-bordered drop-shadow" style="width:100%">
                                                                           <thead>
                                                                                <tr>
                                                                                     <th><strong>Component Name</strong></th>
                                                                                     <th><strong>Component Type</strong></th>
                                                                                     <th><strong>Application Name</strong></th>
                                                                                     <th><strong>Application Owner</strong></th>
                                                                                     <th><strong>MQ Type</strong></th>
                                                                                     <th><strong>MQ Name</strong></th>
                                                                                     <th><strong>Instance</strong></th>

                                                                                </tr>
                                                                           </thead>
                                                                           <?php
                                                                           if (isset($_GET['input']) || isset($_GET['search'])) {
                                                                                if (isset($_GET['input'])) {
                                                                                     $input = trim($_GET['input']);
                                                                                } else {
                                                                                     $input = trim($_GET['search']);
                                                                                }
                                                                                $input =  str_replace(" ", "-", $input);
                                                                                $input = str_replace("-", " ", $input);
                                                                                $inputcase = $input;
                                                                                $input = strtoupper($input);
                                                                                #echo $inputapp;
                                                                                #$inputs = array('$text' => array('$search' => $input));
                                                                                $inputs =  array('$or' => array(
                                                                                     array('component_name' => new MongoRegex("/$input/i")),
                                                                                     array('component_type' => new MongoRegex("/$input/i")),
                                                                                     array('app_name' => new MongoRegex("/$inputcase/i")),
                                                                                     array('app_owner' => new MongoRegex("/$inputcase/i")),
                                                                                     array('mq_type' => new MongoRegex("/$inputcase/i")),
                                                                                     array('mq_name' => new MongoRegex("/$inputcase/i")),
                                                                                     array('instance' => new MongoRegex("/$inputcase/i"))
                                                                                ));
                                                                                $results = $collection->find($inputs);
                                                                                $numdocs = 0;
                                                                                foreach ($results as $result) {
                                                                                     $numdocs = 1;
                                                                                }
                                                                                if ($numdocs == 0) {
                                                                                     $input = str_replace(" ", "-", $input);
                                                                                     $results = $collection->find($inputs)->sort(array("_id" => 1))->limit(500)->skip($from);
                                                                                }
                                                                           } else {
                                                                                $results = $collection->find()->sort(array("component_name" => 1))->limit(500)->skip($from);
                                                                           }
                                                                           echo '<tbody>';

                                                                           foreach ($results as $result) {
                                                                                $component_name = $result['component_name'];
                                                                                $component_type = $result['component_type'];
                                                                                $app_name = $result['app_name'];
                                                                                $app_owner = $result['app_owner'];
                                                                                $mq_type = $result['mq_type'];
                                                                                $mq_name = $result['mq_name'];
                                                                                $instance = $result['instance'];


                                                                                //   $tloc = $cloc + $uloc + $lloc;


                                                                                echo '<tr>';
                                                                                echo '<td>' . $component_name . '</td>';
                                                                                echo '<td>' . $component_type . '</td>';
                                                                                echo '<td>' . $app_name . '</td>';
                                                                                echo '<td>' . $app_owner . '</td>';
                                                                                echo '<td>' . $mq_type . '</td>';
                                                                                echo '<td>' . $mq_name . '</td>';
                                                                                echo '<td>' . $instance . '</td>';


                                                                                echo '</tr>';
                                                                           }
                                                                           echo '</tbody>';
                                                                           ?>
                                                                      </table>
                                                                      <div class="row">
                                                                           <div class="col-sm-6">
                                                                                <?php
                                                                                if (isset($previousFrom)) {
                                                                                ?>
                                                                                     <a href="mqReport.php?from=<?php echo $previousFrom; ?>&to=<?php echo $previousTo; ?>" class="btn btn-primary"><?php echo $previousFrom . " - " . $previousTo; ?></a>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                                <?php
                                                                                if (isset($nextFrom)) {
                                                                                ?>
                                                                                     <a href="mqReport.php?from=<?php echo $nextFrom; ?>&to=<?php echo $nextTo; ?>" class="btn btn-primary pull-right"><?php echo $nextFrom . " - " . $nextTo; ?></a>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                           </div>
                                                                      </div>

                                                                      <a id="back-to-top" href="#table" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

                                                                 </div>
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