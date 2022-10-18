<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<?php
session_start();
if (isset($_SESSION['name'])) {
?>
     <html lang="en">
     <!--<![endif]-->
     <style>
          .amcharts-chart-div .cur {
               cursor: pointer;
          }

          .amcharts-chart-div>a {
               display: none !important;
          }


          .chart-wrapper {
               position: relative;
               width: 180px;
               height: 200px;
          }

          #chartdiv2 {
               position: absolute;
               top: 2px;
               left: 6px;
               width: 480px;
               height: 400px;
               font-size: 12px;
          }


          /* .chart-wrapper1 {
            position: relative;
            width: 300px;
            height: 300px;
        }

        #chartdiv15 {
            position: absolute;
            top: 2px;
            left: 10px;
            width: 500px;
            height: 400px;
            font-size: 14px;
        } */
          #chartdiv15,
          #chartdiv16,
          #chartdiv17,
          #chartdiv4,
          #chartdiv5,
          #chartdiv6,
          #chartdiv8,
          #chartdiv9,
          #chartdiv13 {
               font-size: 12px;
          }

          /* #chartdiv4 {} */
          /* #chartdiv5 {} */
     </style>
     <meta charset="utf-8" />
     <title>CAP360 Code Analyzer</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta content="width=device-width, initial-scale=1" name="viewport" />
     <meta content="CAP360 Analyzer created by Legacy Modernization Team" name="description" />
     <meta content="" name="author" />
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
     <link href="static/animate.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets1/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
     <link href="../assets1/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
     <link rel="shortcut icon" href="../assets1/layouts/layout/img/cap.ico" type="image/x-icon" />
     <link rel="stylesheet" href="../assets1/custom/custom.css" type="text/css" />
     </head>

     <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
          <div class="page-wrapper">
               <?php include 'header.php'; ?>
               <div class="clearfix"> </div>
               <div class="page-container">
                    <?php include 'sidebar1.php'; ?>
                    <div class="page-content-wrapper">
                         <div class="page-content" style="background-color:#0A4567;">
                              <div>
                                   <div id="overlay" class="animated fadeIn scroll2">
                                        <div class="hidden" id="firstbutton">
                                             <i class="fa fa-times fa-lg" onclick="off()"></i>
                                        </div>
                                        <div class="hidden" id="secondbutton">
                                             <i class="fa fa-arrow-left" onclick="pie1goback()"></i>
                                        </div>
                                        <div id="chartpoo1" class="" style="display:inline-block;height:46%;width:40%;"></div>
                                        <div id="vendorpie2" onclick="pie1()" class="chart" style="display:inline-block;opacity:0;height:46%;width:23%;"></div>
                                        <div id="depduration" class="chart" style="display:inline-block;opacity:0;height:46%;width:36.5%;"></div>
                                        <div id="chartdive" onclick="component()" class="chart" style="display:inline-block;opacity:0;height:46%;width:40%;"></div>
                                        <div id="vendorpie3" onclick="pie2()" class="chart" style="display:inline-block;opacity:0;height:46%;width:23%;"></div>
                                        <div id="leadtime" class="chart" style="display:inline-block;opacity:0;height:46%;width:36%"></div>
                                        <!--deployment page-->
                                        <div id="deploybar2" class="chart" style="display:none;height:46%;width:45%"></div>
                                        <div id="deploybar" class="chart" style="display:none;height:46%;width:30%"></div>
                                        <div id="deployspeed" class="chart" style="display:none;height:46%;width:48%"></div>
                                        <div id="appspeed" class="chart" style="display:none;height:46%;width:50%"></div>
                                        <!--component page-->
                                        <div id="vendorpie" class="chart" style="display:none;height:46%;width:20%;"></div>
                                        <div id="techpie" class="chart" style="display:none;height:46%;width:20%;"></div>
                                        <div id="envpie" class="chart" style="display:none;height:46%;width:19%;"></div>
                                        <div id="envcomp" class="chart amcharts-chart-div cur" style="cursor:pointer;display:none;height:46%;width:40%;"></div>
                                        <div id="bubblecomp" class="chart" style="display:none;height:46%;width:59%;"></div>
                                        <!--failure page-->
                                        <div id="failure1" class="chart" style="display:none;height:46%;width:40%"></div>
                                        <div id="failure4" class="chart" style="display:none;height:46%;width:35%"></div>
                                        <div id="failure2" class="chart" style="display:none"></div>
                                        <div id="failure3" class="chart" style="display:none"></div>
                                        <div id="negativechart" class="chart" style="display:none"></div>
                                   </div>
                                   <script>
                                        function on() {
                                             $("body").css("overflow", "hidden");
                                             $('#firstbutton').removeClass('hidden');
                                             $('#secondbutton').addClass('hidden');
                                             document.getElementById("overlay").style.display = "block";
                                             $('#chartpoo1').addClass('animateChart_1');
                                             $('#vendorpie2').delay(2000).animate({
                                                  opacity: 1
                                             }, 500);
                                             $('#depduration').delay(2500).animate({
                                                  opacity: 1
                                             }, 500);
                                             $('#chartdive').delay(3000).animate({
                                                  opacity: 1
                                             }, 500);
                                             $('#vendorpie3').delay(3500).animate({
                                                  opacity: 1
                                             }, 500);
                                             $('#leadtime').delay(4000).animate({
                                                  opacity: 1
                                             }, 500);
                                             setTimeout(function() {
                                                  $('#chartpoo1').removeClass("animateChart_1");
                                             }, 2000);
                                        }

                                        function off() {
                                             $('body').css('overflow', "scroll");
                                             document.getElementById("overlay").style.display = "none";
                                             $('#chartpoo1').removeClass('animateChart_1');
                                             $('#chartpoo1').removeClass('animateChart_1');
                                             $('#vendorpie2').animate({
                                                  opacity: 0
                                             }, 500);
                                             $('#depduration').animate({
                                                  opacity: 0
                                             }, 500);
                                             $('#chartdive').animate({
                                                  opacity: 0
                                             }, 500);
                                             $('#vendorpie3').animate({
                                                  opacity: 0
                                             }, 500);
                                             $('#leadtime').animate({
                                                  opacity: 0
                                             }, 500);
                                             $('#failure1').hide();
                                             $('#failure2').hide();
                                             $('#failure3').hide();
                                             $('#failure4').hide();
                                             $('#negativechart').hide();
                                             $('#deploybar2').hide();
                                             $('#deploybar').hide();
                                             $('#deployspeed').hide();
                                             $('#techpie').hide();
                                             $('#vendorpie').hide();
                                             $('#envpie').hide();
                                             $('#bubblecomp').hide();
                                             $('#envcomp').hide();
                                             $('#appspeed').hide();
                                        }
                                   </script>
                                   <script>
                                        function pie1() {
                                             $('#firstbutton').addClass('hidden');
                                             $('#secondbutton').removeClass('hidden');
                                             $('#deploybar2').show();
                                             $('#deploybar').show();
                                             $('#deployspeed').show();
                                             $('#appspeed').show();
                                             $('#techpie').hide();
                                             $('#vendorpie').hide();
                                             $('#envpie').hide();
                                             $('#bubblecomp').hide();
                                             $('#envcomp').hide();
                                             $('#chartpoo1').hide();
                                             $('#depduration').hide();
                                             $('#chartdive').hide();
                                             $('#vendorpie3').hide();
                                             $('#leadtime').hide();
                                             $('#failure1').hide();
                                             $('#failure2').hide();
                                             $('#failure3').hide();
                                             $('#failure4').hide();
                                             $('#negativechart').hide();
                                        }

                                        function pie2() {
                                             $('#firstbutton').addClass('hidden');
                                             $('#secondbutton').removeClass('hidden');
                                             $('#failure1').show();
                                             $('#failure2').show();
                                             $('#failure3').show();
                                             $('#failure4').show();
                                             $('#negativechart').show();
                                             $('#deploybar2').hide();
                                             $('#deploybar').hide();
                                             $('#deployspeed').hide();
                                             $('#techpie').hide();
                                             $('#vendorpie').hide();
                                             $('#envpie').hide();
                                             $('#bubblecomp').hide();
                                             $('#envcomp').hide();
                                             $('#appspeed').hide();
                                             $('#chartpoo1').hide();
                                             $('#depduration').hide();
                                             $('#chartdive').hide();
                                             $('#vendorpie2').hide();
                                             $('#leadtime').hide();
                                        }

                                        function component() {
                                             $('#firstbutton').addClass('hidden');
                                             $('#secondbutton').removeClass('hidden');
                                             $('#vendorpie').show();
                                             $('#techpie').show();
                                             $('#envpie').show();
                                             $('#envcomp').show();
                                             $('#bubblecomp').show();
                                             $('#chartpoo1').hide();
                                             $('#depduration').hide();
                                             $('#vendorpie2').hide();
                                             $('#vendorpie3').hide();
                                             $('#leadtime').hide();
                                             $('#failure1').hide();
                                             $('#failure2').hide();
                                             $('#failure3').hide();
                                             $('#deployspeed').hide();
                                             $('#appspeed').hide();
                                             $('#negativechart').hide();
                                             $('#deploybar').hide();
                                             $('#deploybar2').hide();
                                        }

                                        function pie1goback() {
                                             $('#firstbutton').removeClass('hidden');
                                             $('#secondbutton').addClass('hidden');
                                             $('#deploybar2').hide();
                                             $('#deploybar').hide();
                                             $('#deployspeed').hide();
                                             $('#appspeed').hide();
                                             $('#techpie').hide();
                                             $('#vendorpie').hide();
                                             $('#envpie').hide();
                                             $('#envcomp').hide();
                                             $('#bubblecomp').hide();
                                             $('#failure1').hide();
                                             $('#failure2').hide();
                                             $('#failure3').hide();
                                             $('#failure4').hide();
                                             $('#negativechart').hide();
                                             $('#deploybar2').hide();
                                             $('#deploybar').hide();
                                             $('#deployspeed').hide();
                                             $('#appspeed').hide();
                                             $('#techpie').hide();
                                             $('#vendorpie').hide();
                                             $('#envpie').hide();
                                             $('#envcomp').hide();
                                             $('#bubblecomp').hide();
                                             $('#failure1').hide();
                                             $('#failure2').hide();
                                             $('#failure3').hide();
                                             $('#failure4').hide();
                                             $('#negativechart').hide();
                                             $('#chartpoo1').show();
                                             $('#depduration').show();
                                             $('#vendorpie2').show();
                                             $('#vendorpie3').show();
                                             $('#chartdive').show();
                                             $('#leadtime').show();
                                        }
                                   </script>
                                   <?php include 'tiles_data.php'; ?>

                                   <div id="submenu1sub1">
                                        <div class="row" style="margin-top:-5px" id="row1">
                                             <!-- <div class="col-lg-3 col-sm-6 col-xs-12"> -->
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 blue" style="background-image: url('../assets/img/back.jpg');background-size: cover;" data-toggle="tooltip" data-placement="bottom" title="Total number of components used in the application.">
                                                       <div class="visual">
                                                            <!-- <i class="fa fa-usd"></i> -->
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($components_count); ?>">0</span><span></span>
                                                            </div>
                                                            <!-- <div class="desc"><b> Total no. of Components </b><br> <small> <B> -13% </B> QoQ </small> </div> -->
                                                            <div class="desc"><b> Total No. of Components </b> </div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 red" style="background-image: url('../assets/img/back2.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total lines of code.">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span data-counter="counterup" data-value="<?php echo number_format($loc_count_dump); ?>">0</span>
                                                            </div>
                                                            <!-- <div class="desc"> <b> Total Loc </b> <br> <small> Increased From <B> 160 </B> QoQ </small> </div> -->
                                                            <div class="desc"> <b> Total LOC </b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 green" style="background-image: url('../assets/img/back3.jpg');background-size: cover;" data-toggle="tooltip" data-placement="bottom" title="Inscope Components" href="#thirdscroll">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">

                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($inscopecomponents_count); ?>">0</span>
                                                            </div>
                                                            <!-- <div class="desc"> <b> Cost of Quality </b> <br> <small> <b> -20% </B> QoQ </small> </div> -->
                                                            <div class="desc"> <b>Inscope Components </b> </div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Inscope LOC">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($scope_loc_count); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b> Inscope LOC</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                        </div>
                                        <div class="row animated ease-in-out" id="showDiv1">
                                             <div class="row">
                                                  <div class="col-sm-12 col-md-12 col-lg-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv1" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Inscope Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div class="chart-wrapper">
                                                                           <div id="chartdiv2" class="" style="height:200px;"> </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-lg-12 col-sm-12 col-md-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Batch vs Online</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <!-- <div class="chart-wrapper1"> -->
                                                                      <div id="chartdiv15" class="" style="height:200px;"> </div>
                                                                      <!-- </div> -->
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Business LOC</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv4" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <!-- </div> -->
                                        <div class="row" style="margin-top:-5px" id="row2">
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of Dead Components">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($dead_count); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b>Total Dead Components</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 green-turquoise" style="background-image: url('../assets/img/circlebackdark.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of Orphan Components">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span data-counter="counterup" data-value="<?php echo number_format($orphan_count); ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b> Total Orphan Components</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 red-flamingo" style="background-image: url('../assets/img/tribackdark.jpg');background-size: cover;" data-toggle="tooltip" data-placement="bottom" title="No.  of Drop Impact Components" href="#thirdscroll">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span data-counter="counterup" data-value="<?php echo number_format($drop_impact_count); ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b> Total Drop Impact Components</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3  col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Overall Technical Debt of Application">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo $total_percentage; ?>%">0</span>
                                                            </div>
                                                            <div class="desc"> <b>Overall Technical Debt %</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                        </div>
                                        <div class="row animated ease-in-out" id="showDiv2">
                                             <div class="row">
                                                  <div class="col-sm-12 col-md-12 col-lg-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total Dead Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv5" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total Orphan Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv6" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-lg-12 col-sm-12 col-md-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total Drop Impact Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv7" class="" style="height:250px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Technical Debt %</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv8" class="" style="height:250px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="row" style="margin-top:-5px" id="row3">
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total CRUD Operations">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format ("6441"); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b>Total CRUD Operations</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 red-flamingo" style="background-image: url('../assets/img/tribackdark.jpg');background-size: cover;" data-toggle="tooltip" data-placement="bottom" title="Total Tables Count" href="#thirdscroll">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($db2TablesCount); ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b>Total Tables Count</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 green-turquoise" style="background-image: url('../assets/img/circlebackdark.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Singleton Operating Tables">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span data-counter="counterup" data-value="<?php echo '119'; ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b>Singleton Queries</b></div>
                                                       </div>
                                                  </a>
                                             </div>


                                             <div class="col-lg-3  col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total File CRUD">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                            <div class="number">
                                                                 <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format('3376'); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b>Total File CRUD</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                        </div>
                                        <div class="row animated ease-in-out" id="showDiv3">
                                             <div class="row">
                                                  <div class="col-sm-12 col-md-12 col-lg-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">CRUD Operations</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv10" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">File CRUD Operations</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv18" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                  </div>
                                             </div>
                                             <!-- <div class="row">
                                                  <div class="col-lg-12 col-sm-12 col-md-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total IMS Segments Vs Orphan Segments</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv12" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total DB2 Tables Vs Orphan Tables</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv19" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div> -->
                                        </div>

                                        <!-- <div class="row" style="margin-top:-5px" id="row4">
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Total Missing Components">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($missing_count); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b>Total Missing Components</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 green-turquoise" style="background-image: url('../assets/img/circlebackdark.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Number of TDQ and TSQ Used">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span data-counter="counterup" data-value="<?php echo ($tdqDistictCount . " | " . $tsqDistictCount); ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b>TDQ &nbsp; | &nbsp; TSQ</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                             <div class="col-lg-3 col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 red-flamingo" style="background-image: url('../assets/img/tribackdark.jpg');background-size: cover;" data-toggle="tooltip" data-placement="bottom" title="Number of Files" href="#thirdscroll">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($filesInvColCount); ?>">0</span>
                                                            </div>
                                                            <div class="desc"> <b>Total Files</b></div>
                                                       </div>
                                                  </a>
                                             </div>

                                             <div class="col-lg-3  col-sm-6 col-xs-12">
                                                  <a class="dashboard-stat dashboard-stat-v2 yellow" style="background-image: url('../assets/img/back5.jpg');background-size: cover;" href="#" data-toggle="tooltip" data-placement="bottom" title="Number of files created but not used">
                                                       <div class="visual">
                                                       </div>
                                                       <div class="details">
                                                            <div class="number">
                                                                 <span></span><span data-counter="counterup" data-value="<?php echo number_format($filesCreatedNotUsedCount); ?>">0</span><span></span>
                                                            </div>
                                                            <div class="desc"><b>Files created but not used</b></div>
                                                       </div>
                                                  </a>
                                             </div>
                                        </div> -->
                                        <div class="row animated ease-in-out" id="showDiv4">
                                             <div class="row">
                                                  <div class="col-sm-12 col-md-12 col-lg-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Total Missing Components</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv13" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">TDQ Vs TSQ</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv20" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-lg-12 col-sm-12 col-md-12">
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">DB2 Tables with Single Operation</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv17" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                           <i class="icon-equalizer font-dark hide"></i>
                                                                           <span class="caption-subject font-dark bold">Files created but not used</span>
                                                                           <span class="caption-helper"></span>
                                                                      </div>
                                                                      <div class="tools">
                                                                           <a href="" class="collapse"> </a>
                                                                      </div>
                                                                 </div>
                                                                 <div class="portlet-body">
                                                                      <div id="chartdiv16" class="" style="height:200px;"> </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                   </div>
                                   <script>
                                        $(function() {
                                             $("#Portfolio").click(function() {
                                                  $("#high1").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Portfolio1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Applications").click(function() {
                                                  $("#high2").toggleClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Application1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#People").click(function() {
                                                  $("#high3").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#People1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#Application1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Tools").click(function() {
                                                  $("#high4").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Tools1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Vendors").click(function() {
                                                  $("#high5").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");

                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Vendors1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#ROI").click(function() {
                                                  $("#high6").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#ROI1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#Application1").hide(300);
                                             });

                                             function animate(element, animation) {
                                                  $(element).addClass('animated ' + animation);
                                                  var wait = setTimeout(function() {
                                                       $(element).removeClass('animated ' + animation);
                                                  }, 1000);
                                             }
                                        })
                                   </script>

                                   <script>
                                        $(function() {
                                             $("#Portfolio").click(function() {
                                                  $("#high1").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Portfolio1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Applications").click(function() {
                                                  $("#high2").toggleClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Application1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#People").click(function() {
                                                  $("#high3").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#People1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#Application1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Tools").click(function() {
                                                  $("#high4").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Tools1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#Vendors").click(function() {
                                                  $("#high5").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $("#high6").removeClass("highlight");

                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#Vendors1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Application1").hide(300);
                                                  $("#ROI1").hide(300);
                                             });
                                             $("#ROI").click(function() {
                                                  $("#high6").toggleClass("highlight");
                                                  $("#high2").removeClass("highlight");
                                                  $("#high3").removeClass("highlight");
                                                  $("#high4").removeClass("highlight");
                                                  $("#high5").removeClass("highlight");
                                                  $("#high1").removeClass("highlight");
                                                  $(".boxx").removeClass("boxxanim");
                                                  $("#ROI1").toggle(300);
                                                  $(".boxx").toggleClass("boxxanim");
                                                  $("#People1").hide(300);
                                                  $("#Portfolio1").hide(300);
                                                  $("#Tools1").hide(300);
                                                  $("#Vendors1").hide(300);
                                                  $("#Application1").hide(300);
                                             });

                                             function animate(element, animation) {
                                                  $(element).addClass('animated ' + animation);
                                                  var wait = setTimeout(function() {
                                                       $(element).removeClass('animated ' + animation);
                                                  }, 1000);
                                             }
                                        })
                                   </script>


                                   <div class="row widget-row">
                                        <?php
                                        $m = new MongoClient();
                                        $db = $m->aflac;
                                        $Xref = $db->cobol_crossreference;
                                        $staticCount = $Xref->find(array("call_type" => "STATIC"))->count();
                                        $dynamicCount = $Xref->find(array("call_type" => "DYNAMIC"))->count();
                                        $email_col = $db->emailReport;
                                        $emailsCount = $email_col->find(array("email_status" => "In-active"));

                                        // $array = array();
                                        // foreach ($emailsCount as $email) {
                                        //      if (!in_array($email['email'], $array))
                                        //           $array[] = $email['email'];
                                        // }
                                        // $emailCount = count($array);
                                        // $ftp_col = $db->ftpReport;
                                        // $ftpCount = $ftp_col->count();
                                        // $mq_col = $db->mqreport;
                                        // $mqCount = $mq_col->count();
                                        $queryWithoutIndex = $db->queryWithoutIndex;
                                        $queryWithoutIndexCount = $queryWithoutIndex->find(array("condition" => "NO MATCH"))->count();
                                        $loadunload = $db->loadUnloadReport;
                                        // $loadCount = $loadunload->find(array("operation" => "LOAD"))->count();
                                        // $unloadCount = $loadunload->find(array("operation" => "UNLOAD"))->count();

                                        ?>
                                        <a data-toggle="modal" href="#" id="Portfolio">
                                             <!--responsive-->
                                             <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                                  <!-- BEGIN WIDGET THUMB -->
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high1" title="Email Interface">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">Email Interface</h4>
                                                       </center>
                                                       <div class="widget-thumb-wrap">
                                                            <!-- <i class="widget-thumb-icon fa fa-briefcase"></i> -->
                                                            <div class="widget-thumb-body">
                                                                 <span class="widget-thumb-subtitle"></span>
                                                                 <center><span class="widget-thumb-body-stat" style="color:white;font-size:20px" data-counter="counterup" data-value="<?php echo '78'; ?>">0</span></center>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <!-- END WIDGET THUMB -->
                                             </div>
                                        </a>
                                        <a data-toggle="modal" href="#" id="Portfolio">
                                             <!--responsive-->
                                             <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                                  <!-- BEGIN WIDGET THUMB -->
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high1" title="FTP Interface">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">FTP Interface</h4>
                                                       </center>
                                                       <div class="widget-thumb-wrap">
                                                            <!-- <i class="widget-thumb-icon fa fa-briefcase"></i> -->
                                                            <div class="widget-thumb-body">
                                                                 <span class="widget-thumb-subtitle"></span>
                                                                 <center><span class="widget-thumb-body-stat" style="color:white;font-size:20px" data-counter="counterup" data-value="<?php echo $ftpCount; ?>">0</span></center>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <!-- END WIDGET THUMB -->
                                             </div>
                                        </a>
                                        <a data-toggle="modal" href="#" id="Tools">
                                             <!--responsive-->
                                             <div class="col-lg-2 col-sm-6 col-xs-12">
                                                  <!-- BEGIN WIDGET THUMB -->
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high4" title="MQ Interface">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">MQ Interface</h4>
                                                       </center>
                                                       <div class="widget-thumb-wrap">
                                                            <!-- <i class="widget-thumb-icon fa fa-wrench"></i> -->
                                                            <div class="widget-thumb-body">
                                                                 <span class="widget-thumb-subtitle"></span>
                                                                 <center><span class="widget-thumb-body-stat" data-counter="counterup" style="color:white;font-size:20px" data-value="<?php echo '61'; ?>">0</span></center>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <!-- END WIDGET THUMB -->
                                             </div>
                                        </a>
                                        <a data-toggle="modal" href="#" id="Portfolio">
                                             <!--responsive-->
                                             <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                                  <!-- BEGIN WIDGET THUMB -->
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high1" title="Static">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">Static</h4>
                                                       </center>
                                                       <div class="widget-thumb-wrap">
                                                            <!-- <i class="widget-thumb-icon fa fa-briefcase"></i> -->
                                                            <div class="widget-thumb-body">
                                                                 <span class="widget-thumb-subtitle"></span>
                                                                 <center><span class="widget-thumb-body-stat" style="color:white;font-size:20px" data-counter="counterup" data-value="<?php echo number_format($staticCount); ?>">0</span></center>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <!-- END WIDGET THUMB -->
                                             </div>
                                        </a>
                                        <a data-toggle="modal" href="#" id="Applications">
                                             <!--responsive-->
                                             <div class="col-lg-2 col-sm-6 col-xs-12">
                                                  <!-- BEGIN WIDGET THUMB -->
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high2" title="Dynamic">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">Dynamic</h4>
                                                            <center>
                                                                 <div class="widget-thumb-wrap">
                                                                      <!-- <i class="widget-thumb-icon fa fa-desktop"></i> -->
                                                                      <div class="widget-thumb-body">
                                                                           <span class="widget-thumb-subtitle"> </span>
                                                                           <center> <span class="widget-thumb-body-stat" style="color:white;font-size:20px" data-counter="counterup" data-value="<?php echo number_format($dynamicCount); ?>">0</span></center>
                                                                      </div>
                                                                 </div>
                                                  </div>
                                             </div>
                                        </a>

                                        <a data-toggle="modal" href="#" id="Portfolio">
                                             <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                                  <div class="widget-thumb widget-bg-color-white text-uppercase" style="height: 110px; background-image:url('../assets/img/smally.jpg'); background-size:cover" id="high1" title="Total Applications">
                                                       <br>
                                                       <center>
                                                            <h4 class="widget-thumb-heading">Total Applications</h4>
                                                       </center>
                                                       <div class="widget-thumb-wrap">
                                                            <div class="widget-thumb-body">
                                                                 <span class="widget-thumb-subtitle"></span>
                                                                 <center><span class="widget-thumb-body-stat" style="color:white;font-size:20px" data-counter="counterup" data-value="<?php echo "18" ?>">0</span></center>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </a>

                                   </div>


                                   <script>
                                        $(function() {
                                             $('#animateBtn').click(function() {
                                                  animate('#batchchart', 'slideOutUp');
                                                  setTimeout(function() {
                                                       $('#batchchart').css('visibility', 'hidden');
                                                  }, 1000);
                                             });

                                             function animate(element, animation) {
                                                  $(element).addClass('animated ' + animation);
                                                  var wait = setTimeout(function() {
                                                       $(element).removeClass('animated ' + animation);
                                                  }, 1000);
                                             }
                                             $('#animateBtn2').click(function() {
                                                  animate('header', 'slideOutUp');
                                                  setTimeout(function() {
                                                       $('header').css('visibility', 'hidden');
                                                  }, 1000);
                                                  return false;
                                             });

                                             $("#cf_onclick").click(function() {

                                                  animate('.bottom', 'fadeIn');
                                                  animate('.top', 'fadeIn');
                                                  $("#cf2 div.top").toggleClass("hidden");
                                                  $("#cf2 div.bottom").toggleClass("hidden");
                                             });
                                        })
                                   </script>
                                   <div class="clearfix"></div>
                                   <!-- END DASHBOARD STATS 1-->

                                   <!-- .events-content -->
                              </div>
                         </div>
                    </div>

                    <!-- END CONTENT BODY-->
               </div>
          </div>
          <?php include 'footer.php' ?>
          </div>
          <script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
          <script src="static/loader.js" type="text/javascript"></script>
          <script src="static/fusioncharts.js" type="text/javascript"></script>
          <script src="static/fusioncharts.theme.fint.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata1.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata2.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata3.js" type="text/javascript"></script>
          <script src="../assets1/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata4.js" type="text/javascript"></script>
          <script src="../assets1/global/scripts/app.min.js" type="text/javascript"></script>
          <script src="../assets1/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
          <script src="../assets1/layouts/layout/scripts/jquery1.js" type="text/javascript"></script>
          <script src="../assets1/layouts/layout/scripts/jquery3.js" type="text/javascript"></script>
          <script src="../assets1/layouts/layout/scripts/jquery5.js" type="text/javascript"></script>
          <script src="../assets1/custom/custom.js" type="text/javascript"></script>
          <!--!!!!!!!!DISPLAYED!!!!!!!!-->
          <!-- amcharts -->
          <script src="static/lib/3/amcharts.js"></script>
          <script src="static/lib/3/serial.js"></script>
          <script src="static/lib/3/light.js"></script>
          <script src="static/lib/4/core.js"></script>
          <script src="static/lib/4/charts.js"></script>
          <script src="static/lib/4/animated.js"></script>
          <script src="static/lib/3/amcharts.js"></script>
          <script src="static/lib/3/funnel.js"></script>
          <script src="static/lib/3/export.min.js"></script>
          <link href="static/lib/3/export.css" rel="stylesheet" type="text/css" media="all" />
          <script src="static/lib/4/moonrisekingdom.js"></script>
          <script src="static/lib/4/material.js"></script>

          <script src="static/lib/3/light.js"></script>
          <script src="static/lib/4/core.js"></script>
          <script src="static/lib/4/charts.js"></script>
          <script src="static/lib/4/frozen.js"></script>
          <script src="static/lib/4/animated.js"></script>
          <script src="static/lib/4/sunburst.js"></script>
          <!--<script src="static/lib/4/themes/dataviz.js"></script>-->
          <?php

          $m = new MongoClient();
          $db = $m->aflac;
          $MI_col  = $db->masterinventory;
          $missing_comp_col  = $db->missing;
          $xref_col  = $db->crossreference;

          $file_notused_col = $db->filesCreatedNotUsed;
          $ftp_col = $db->ftpReport;
          $mq_col = $db->mqReport;
          $email_col = $db->emailReport;

          ?>


          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv11dfs", am4charts.PieChart);

                    // Add data
                    chart.data = [{
                         "country": "Lithuania",
                         "litres": <?php echo $db2TablesCount; ?>
                    }, {
                         "country": "Czech Republic",
                         "litres": <?php echo $db2TablesCount; ?>
                    }];

                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.innerRadius = am4core.percent(50);
                    pieSeries.ticks.template.disabled = true;
                    pieSeries.labels.template.disabled = true;

                    var rgm = new am4core.RadialGradientModifier();
                    rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
                    pieSeries.slices.template.fillModifier = rgm;
                    pieSeries.slices.template.strokeModifier = rgm;
                    pieSeries.slices.template.strokeOpacity = 0.4;
                    pieSeries.slices.template.strokeWidth = 0;

                    chart.legend = new am4charts.Legend();
                    chart.legend.position = "right";

               }); // end am4core.ready()
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end




                    var chart = am4core.create('chartdiv9', am4charts.XYChart)
                    chart.colors.step = 2;

                    chart.legend = new am4charts.Legend()
                    chart.legend.position = 'top'
                    chart.legend.paddingBottom = 20
                    chart.legend.labels.template.maxWidth = 95

                    var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                    xAxis.dataFields.category = 'category'
                    xAxis.renderer.cellStartLocation = 0.1
                    xAxis.renderer.cellEndLocation = 0.9
                    xAxis.renderer.grid.template.location = 0;

                    var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    yAxis.min = 0;

                    function createSeries(value, name) {
                         var series = chart.series.push(new am4charts.ColumnSeries())
                         series.dataFields.valueY = value
                         series.dataFields.categoryX = 'category'
                         series.name = name
                         series.columns.template.tooltipText = "{valueY}[/]";


                         series.events.on("hidden", arrangeColumns);
                         series.events.on("shown", arrangeColumns);

                         var bullet = series.bullets.push(new am4charts.LabelBullet())
                         bullet.interactionsEnabled = false
                         bullet.dy = 30;
                         bullet.label.fill = am4core.color('#ffffff')

                         return series;
                    }

                    chart.data = [

                         {
                              category: '',
                              first: <?php echo $imsComponentscount; ?>,
                              second: <?php echo $imsOrphanCount; ?>
                         }
                    ]


                    createSeries('first', 'Total Segments');
                    createSeries('second', 'Orphan Segments');

                    function arrangeColumns() {

                         var series = chart.series.getIndex(0);

                         var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                         if (series.dataItems.length > 1) {
                              var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                              var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                              var delta = ((x1 - x0) / chart.series.length) * w;
                              if (am4core.isNumber(delta)) {
                                   var middle = chart.series.length / 2;

                                   var newIndex = 0;
                                   chart.series.each(function(series) {
                                        if (!series.isHidden && !series.isHiding) {
                                             series.dummyData = newIndex;
                                             newIndex++;
                                        } else {
                                             series.dummyData = chart.series.indexOf(series);
                                        }
                                   })
                                   var visibleCount = newIndex;
                                   var newMiddle = visibleCount / 2;

                                   chart.series.each(function(series) {
                                        var trueIndex = chart.series.indexOf(series);
                                        var newIndex = series.dummyData;

                                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                        series.animate({
                                             property: "dx",
                                             to: dx
                                        }, series.interpolationDuration, series.interpolationEasing);
                                        series.bulletsContainer.animate({
                                             property: "dx",
                                             to: dx
                                        }, series.interpolationDuration, series.interpolationEasing);
                                   })
                              }
                         }
                    }

               }); // end am4core.ready()
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv11", am4charts.XYChart3D);

                    // Add data
                    chart.data = [{
                         "year": "Used DB2 Tables",
                         "income": <?php echo $db2TablesCount; ?>,
                         "color": chart.colors.next()
                    }, {
                         "year": "Orphan Tables",
                         "income": <?php echo $db2OrphanCount; ?>,
                         "color": chart.colors.next()
                    }];

                    // Create axes
                    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "year";
                    categoryAxis.numberFormatter.numberFormat = "#";
                    categoryAxis.renderer.inversed = true;

                    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries3D());
                    series.dataFields.valueX = "income";
                    series.dataFields.categoryY = "year";
                    series.name = "Income";
                    series.columns.template.propertyFields.fill = "color";
                    series.columns.template.tooltipText = "{valueX}";
                    series.columns.template.column3D.stroke = am4core.color("#fff");
                    series.columns.template.column3D.strokeOpacity = 0.2;

               }); // end am4core.ready()
          </script>

          <script>
               // Themes begin
               am4core.useTheme(am4themes_animated);
               am4core.options.commercialLicense = true;
               // Themes end
               var chart = am4core.create("chartdiv1", am4charts.PieChart3D);
               chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;


               //chart.legend = new am4charts.Legend();
               <?php
               $distinct_components = $MI_col->distinct("component_type");
               $component_arr = array();
               foreach ($distinct_components as $distinct_component) {
                    $count = $MI_col->find(array("component_type" => $distinct_component))->count();
                    $component_arr[$distinct_component] = $count;
               }
               ?>
               chart.data = [
                    <?php
                    foreach ($component_arr as $key => $value) {
                    ?> {
                              country: "<?php echo $key; ?>",
                              litres: <?php echo $value; ?>
                         },
                    <?php
                    }
                    ?>
               ];
               var series = chart.series.push(new am4charts.PieSeries3D());
               series.dataFields.value = "litres";
               series.dataFields.category = "country";
               series.labels.template.paddingTop = 0;
               series.labels.template.paddingBottom = 0;
               series.labels.template.disabled = true;
               series.slices.template.events.on("hit", function(ev) {
                    // window.location = "http://3.6.243.16/cap360/cap360-material_ryder/prod1/masterReports.php";
               });
          </script>
          <script>
               // Themes begin
               am4core.useTheme(am4themes_animated);
               am4core.options.commercialLicense = true;
               // Themes end
               var chart = am4core.create("chartdiv2", am4charts.PieChart3D);
               chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;


               //chart.legend = new am4charts.Legend();
               <?php
               $distinct_components = $MI_col->distinct("component_type");
               $component_arr = array();
               foreach ($distinct_components as $distinct_component) {
                    $count = $MI_col->find(array("component_type" => $distinct_component, "app_owner_name" => "Hutto, Amy"))->count();
                    $component_arr[$distinct_component] = $count;
               }
               ?>
               chart.data = [
                    <?php
                    foreach ($component_arr as $key => $value) {
                    ?> {
                              country: "<?php echo $key; ?>",
                              litres: <?php echo $value; ?>
                         },
                    <?php
                    }
                    ?>
               ];
               var series = chart.series.push(new am4charts.PieSeries3D());
               series.dataFields.value = "litres";
               series.dataFields.category = "country";
               series.labels.template.paddingTop = 0;
               series.labels.template.paddingBottom = 0;
               series.labels.template.disabled = true;
               series.slices.template.events.on("hit", function(ev) {
                    // window.location = "http://3.6.243.16/cap360/cap360-material_ryder/prod1/masterReports.php";
               });
          </script>

          <script>
               // chart 2 
               am4core.useTheme(am4themes_animated);
               // Set data
               <?php

               $total_loc = $MI_col->aggregate(array('$group' => array('_id' => 'null', "TotalLLoc" => array('$sum' => '$tloc'))));
               $distinct_components = $MI_col->distinct("component_type");
               $lloc_array = array();
               $cloc_array = array();
               $uloc_array = array();
               foreach ($total_loc as $t) {
                    foreach ($t as $t1) {
                         //print_r($t1);
                         $total_Lines = $t1['TotalLLoc'];
                    }
               }

               foreach ($distinct_components as  $distinct_component) {
                    $comp_total_loc = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$tloc'))));
                    foreach ($comp_total_loc as $c) {
                         foreach ($c as $c1) {
                              $lloc_array[$distinct_component] = $c1['TotalLLoc'];
                         }
                    }
               }
               foreach ($distinct_components as  $distinct_component) {
                    $comp_total_cloc = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$cloc'))));

                    foreach ($comp_total_cloc as $c) {

                         foreach ($c as $c1) {
                              $cloc_array[$distinct_component] = $c1['TotalLLoc'];
                         }
                    }
               }
               foreach ($distinct_components as  $distinct_component) {
                    $comp_total_uloc = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$uloc'))));

                    foreach ($comp_total_uloc as $c) {

                         foreach ($c as $c1) {
                              $uloc_array[$distinct_component] = $c1['TotalLLoc'];
                         }
                    }
               }

               ?>

               var chart = am4core.create("chartdiv2loc", am4charts.PieChart);
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;
               var selected;

               var types = [
                    <?php
                    $i = 0;
                    foreach ($distinct_components as $distinct_component) {

                         if ($distinct_component != "UNFOUND") {

                              $type = $distinct_component;
                              $percentage = number_format((($lloc_array[$distinct_component] / $total_Lines) * 100), 2);
                              $cloc_per = number_format((($cloc_array[$distinct_component] / $lloc_array[$distinct_component]) * 100), 2);
                              $uloc_per = number_format((($uloc_array[$distinct_component] / $lloc_array[$distinct_component]) * 100), 2);
                              $lloc_per = number_format((100 - ($cloc_per + $uloc_per)), 2);

                    ?> {
                                   type: "<?php echo $type; ?>",
                                   percent: <?php echo $percentage; ?>,
                                   color: chart.colors.getIndex(<?php echo $i; ?>),
                                   subs: [{
                                        type: "CLOC",
                                        percent: <?php echo $cloc_per; ?>
                                   }, {
                                        type: "ULOC",
                                        percent: <?php echo $uloc_per; ?>
                                   }, {
                                        type: "LLOC",
                                        percent: <?php echo $lloc_per; ?>
                                   }]
                              },

                    <?php
                         }
                         $i++;
                    }

                    ?>
               ];

               // Add data
               chart.data = generateChartData();

               // Add and configure Series
               var pieSeries = chart.series.push(new am4charts.PieSeries());
               pieSeries.dataFields.value = "percent";
               pieSeries.dataFields.category = "type";
               pieSeries.slices.template.propertyFields.fill = "color";
               pieSeries.slices.template.propertyFields.isActive = "pulled";
               pieSeries.slices.template.strokeWidth = 0;
               pieSeries.labels.template.paddingTop = 0;
               pieSeries.labels.template.paddingBottom = 0;
               pieSeries.labels.template.disabled = true;

               function generateChartData() {
                    var chartData = [];
                    for (var i = 0; i < types.length; i++) {
                         if (i == selected) {
                              for (var x = 0; x < types[i].subs.length; x++) {
                                   chartData.push({
                                        type: types[i].subs[x].type,
                                        percent: types[i].subs[x].percent,
                                        color: types[i].color,
                                        pulled: true
                                   });
                              }
                         } else {
                              chartData.push({
                                   type: types[i].type,
                                   percent: types[i].percent,
                                   color: types[i].color,
                                   id: i
                              });
                         }
                    }
                    return chartData;
               }

               pieSeries.slices.template.events.on("hit", function(event) {
                    if (event.target.dataItem.dataContext.id != undefined) {
                         selected = event.target.dataItem.dataContext.id;
                    } else {
                         selected = undefined;
                    }
                    chart.data = generateChartData();

                    chart.legend = new am4charts.Legend();
               });
               chart.innerRadius = 0;
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv15", am4charts.XYChart3D);
                    <?php
                    $batchJobs = $totalJclCount;
                    $onlineCicsJobs = $totalCicsTransactionCount;
                    $onlineImsJobs = $totalImsTransactionCount;
                    ?>

                    // Add data
                    chart.data = [{
                         "country": "JCL",
                         "year2017": <?php echo $totalScopeJclCount; ?>,
                         "year2018": <?php echo $batchJobs; ?>
                    }, {
                         "country": "Transaction",
                         "year2017": <?php echo $totalScopeTransCount; ?>,
                         "year2018": <?php echo $totalTransCount; ?>
                    }];

                    // Create axes
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 30;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.title.text = "GDP growth rate";
                    valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                         return text ;
                    });

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries3D());
                    series.dataFields.valueY = "year2017";
                    series.dataFields.categoryX = "country";
                    series.name = "Year 2017";
                    series.clustered = false;
                    series.columns.template.tooltipText = "In Scope Components: [bold]{valueY}[/]";
                    series.columns.template.fillOpacity = 0.9;

                    var series2 = chart.series.push(new am4charts.ColumnSeries3D());
                    series2.dataFields.valueY = "year2018";
                    series2.dataFields.categoryX = "country";
                    series2.name = "Year 2018";
                    series2.clustered = false;
                    series2.columns.template.tooltipText = "Total Components: [bold]{valueY}[/]";

               }); // end am4core.ready()
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv20", am4charts.XYChart3D);
                    <?php
                    $batchJobs = $totalJclCount;
                    $onlineCicsJobs = $totalCicsTransactionCount;
                    $onlineImsJobs = $totalImsTransactionCount;
                    ?>

                    // Add data
                    // chart.data = [{
                    // "country": "TDQ",
                    // "year2017": <?php echo $tdqScopeCount; ?>,
                    // "year2018": <?php echo $tdqDistictCount; ?>
                    // }, {
                    // "country": "TSQ",
                    // "year2017": <?php echo $tsqScopeCount; ?>,
                    // "year2018": <?php echo $tsqDistictCount; ?>
                    // }];
                    chart.data = [{
                         "country": "TDQ Vs TSQ",
                         "year2017": <?php echo $tsqDistictCount; ?>,
                         "year2018": <?php echo $tdqDistictCount; ?>
                    }];

                    // Create axes
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 30;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.title.text = "GDP growth rate";
                    valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                         return text + "%";
                    });

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries3D());
                    series.dataFields.valueY = "year2017";
                    series.dataFields.categoryX = "country";
                    series.name = "Year 2017";
                    series.clustered = false;
                    series.columns.template.tooltipText = "TSQ: [bold]{valueY}[/]";
                    series.columns.template.fillOpacity = 0.9;

                    var series2 = chart.series.push(new am4charts.ColumnSeries3D());
                    series2.dataFields.valueY = "year2018";
                    series2.dataFields.categoryX = "country";
                    series2.name = "Year 2018";
                    series2.clustered = false;
                    series2.columns.template.tooltipText = "TDQ: [bold]{valueY}[/]";

               }); // end am4core.ready()
          </script>

          <script>
               // Themes begin
               am4core.useTheme(am4themes_animated);
               am4core.options.commercialLicense = true;
               // Themes end
               var chart = am4core.create("chartdiv4", am4charts.PieChart3D);
               chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;
               chart.legend.labels.template.truncate = false;
               chart.legend.labels.template.wrap = true;


               //chart.legend = new am4charts.Legend();
               <?php
               $distinct_components = $MI_col->distinct("app_name");
               ?>
               chart.data = [
                    <?php
                    foreach ($distinct_components as $distinct_component) {

                         $Business_loc_agg =  $MI_col->aggregate(array('$match' => array("app_name" => $distinct_component)), array('$group' => array('_id' => 'null', 'Business_Loc' => array('$sum' => '$tloc'))));
                         $Business_loc_count = $Business_loc_agg['result'][0]['Business_Loc'];

                         // $count = $MI_col->find(array("application_name" => $distinct_component))->count();
                         // echo $string . "/n";
                         // echo $Business_loc_count;
                         $string = $distinct_component;
                         $string = str_replace("\n", " ", $string);
                         if (($string !== "NOT APPLICABLE") && ($string !== "To be decided") && ($string !== "To be Decided") && ($string !== "to be decided") && ($string !== "")) {
                    ?> {
                                   "country": "<?php echo $string; ?>",
                                   "litres": <?php echo $Business_loc_count; ?>
                              },
                    <?php
                         }
                    }
                    ?>
               ];
               var series = chart.series.push(new am4charts.PieSeries3D());
               series.dataFields.value = "litres";
               series.dataFields.category = "country";
               series.labels.template.paddingTop = 0;
               series.labels.template.paddingBottom = 0;
               series.labels.template.disabled = true;
               series.slices.template.events.on("hit", function(ev) {
                    // window.location = "http://3.6.243.16/cap360/cap360-material_ryder/prod1/masterReports.php";
               });
          </script>
          <script>
               // Themes begin
               am4core.useTheme(am4themes_animated);
               am4core.options.commercialLicense = true;
               // Themes end
               var chart = am4core.create("chartdiv17", am4charts.PieChart3D);
               chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;
               // chart.legend.labels.template.maxWidth = 150;
               // chart.legend.labels.template.truncate = false;
               // chart.legend.labels.template.wrap = true;


               //chart.legend = new am4charts.Legend();
               <?php
               $distinct_components = $filesInvCol->distinct("called_component_type");
               $component_arr = array();
               foreach ($distinct_components as $distinct_component) {
                    $count = $filesInvCol->find(array("called_component_type" => $distinct_component))->count();
                    $component_arr[$distinct_component] = $count;
               }
               ?>

               chart.data = [
                    <?php
                    foreach ($component_arr as $key => $value) {
                    ?> {
                              country: "<?php echo $key; ?>",
                              litres: <?php echo $value; ?>
                         },
                    <?php
                    }
                    ?>
               ];
               var series = chart.series.push(new am4charts.PieSeries3D());
               series.dataFields.value = "litres";
               series.dataFields.category = "country";
               series.labels.template.paddingTop = 0;
               series.labels.template.paddingBottom = 0;
               series.labels.template.disabled = true;
               series.slices.template.events.on("hit", function(ev) {
                    // window.location = "http://3.6.243.16/cap360/cap360-material_ryder/prod1/masterReports.php";
               });
          </script>
          <script>
               am4core.useTheme(am4themes_animated);
               var chart2 = am4core.create("chartdiv4g", am4charts.XYChart3D);
               <?php
               $distinct_components = $MI_col->distinct("application_name");
               ?>
               chart2.data = [
                    // <?php
                         // foreach ($distinct_components as $distinct_component) {
                         // $count = $MI_col->find(array("application_name"=>$distinct_component))->count();
                         // $string = $distinct_component;
                         // if(($count > 1000)&&($string !== "Unknown")){
                         // 
                         ?>
                    {
                         "country": "heeee",
                         "visits": 45
                    },
                    // <?php
                         // }
                         // }
                         // 
                         ?>
               ];

               // Create axes
               let categoryAxis = chart2.xAxes.push(new am4charts.CategoryAxis());
               categoryAxis.dataFields.category = "country";
               categoryAxis.renderer.labels.template.rotation = 0;
               categoryAxis.renderer.labels.template.hideOversized = false;
               categoryAxis.renderer.minGridDistance = 20;
               categoryAxis.renderer.labels.template.horizontalCenter = "right";
               categoryAxis.renderer.labels.template.verticalCenter = "middle";
               categoryAxis.tooltip.label.rotation = 0;
               categoryAxis.tooltip.label.horizontalCenter = "right";
               categoryAxis.tooltip.label.verticalCenter = "middle";

               let valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
               valueAxis.title.fontWeight = "bold";

               // Create series
               var series = chart2.series.push(new am4charts.ColumnSeries3D());
               series.dataFields.valueY = "visits";
               series.dataFields.categoryX = "country";
               series.name = "Visits";
               series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
               series.columns.template.fillOpacity = .8;

               var columnTemplate = series.columns.template;
               columnTemplate.strokeWidth = 2;
               columnTemplate.strokeOpacity = 1;
               columnTemplate.stroke = am4core.color("#FFFFFF");

               columnTemplate.adapter.add("fill", function(fill, target) {
                    return chart2.colors.getIndex(target.dataItem.index);
               })

               columnTemplate.adapter.add("stroke", function(stroke, target) {
                    return chart2.colors.getIndex(target.dataItem.index);
               })

               chart2.cursor = new am4charts.XYCursor();
               chart2.cursor.lineX.strokeOpacity = 0;
               chart2.cursor.lineY.strokeOpacity = 0;
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_frozen);
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    let chart = am4core.create("chartdiv4g", am4charts.SlicedChart);
                    <?php
                    $distinct_components = $MI_col->distinct("application_name");
                    ?>
                    chart.data = [
                         <?php
                         foreach ($distinct_components as $distinct_component) {
                              $count = $MI_col->find(array("application_name" => $distinct_component))->count();
                              $string = $distinct_component;
                              if (($count > 500) && ($string !== "Unknown")) {
                         ?> {
                                        "name": "<?php echo $string; ?>",
                                        "value": <?php echo $count; ?>
                                   },
                         <?php
                              }
                         }
                         ?>
                    ];

                    let series = chart.series.push(new am4charts.FunnelSeries());
                    series.dataFields.value = "value";
                    series.dataFields.category = "name";
                    //series.lables.template.paddingTop = 0;
                    series.lables.template.paddingBottom = 0;

                    var fillModifier = new am4core.LinearGradientModifier();
                    fillModifier.brightnesses = [-0.5, 1, -0.5];
                    fillModifier.offsets = [0, 0.5, 1];
                    series.slices.template.fillModifier = fillModifier;
                    series.alignLabels = true;

                    series.labels.template.text = "{category} : [bold]{value}[/]";

               }); // end am4core.ready()
          </script>

          <script>
               // **********************************************************************
               // chart 6
               // **********************************************************************
               am4core.useTheme(am4themes_animated);
               // Create chart instance
               //var chart = am4core.create("chartdiv4", am4charts.XYChart3D);
               var container = am4core.create("chartdiv6", am4core.Container);
               container.legend = new am4charts.Legend();
               container.legend.position = "right";
               container.legend.scrollable = true;

               container.width = am4core.percent(100);
               container.height = am4core.percent(100);
               container.layout = "horizontal";


               var chart = container.createChild(am4charts.PieChart);
               <?php
               $distinct_components = $MI_col->distinct("component_type");
               ?>
               chart.data = [
                    <?php

                    foreach ($distinct_components as $distinct_component) {
                         if ((($MI_col->find(array("component_type" => $distinct_component, "orphan" => "Yes"))->count()) > 0)) {
                              //echo "@@@$distinct_component";
                              $lloc_agg = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component, "orphan" => "Yes")), array('$group' => array('_id' => '$component_type', "LLOC" => array('$sum' => '$tloc'))));
                              $uloc_agg = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component, "orphan" => "Yes")), array('$group' => array('_id' => '$component_type', "ULOC" => array('$sum' => '$uloc'))));
                              $cloc_agg = $MI_col->aggregate(array('$match' => array("component_type" => $distinct_component, "orphan" => "Yes")), array('$group' => array('_id' => '$component_type', "CLOC" => array('$sum' => '$cloc'))));
                              foreach ($lloc_agg as $lloc_obj) {
                                   foreach ($lloc_obj as $lloc_obj1)
                                        $orp_lloc = $lloc_obj1['LLOC'];
                              }
                              foreach ($uloc_agg as $uloc_obj) {
                                   foreach ($uloc_obj as $uloc_obj1)
                                        $orp_uloc = $uloc_obj1['ULOC'];
                              }
                              foreach ($cloc_agg as $cloc_obj) {
                                   foreach ($cloc_obj as $cloc_obj1)
                                        $orp_cloc = $cloc_obj1['CLOC'];
                              }
                    ?> {
                                   "type": "<?php echo $distinct_component; ?>",
                                   "value": <?php echo $orp_lloc; ?>,
                                   "subData": [{
                                        name: "ULOC",
                                        value: <?php echo $orp_uloc ?>
                                   }, {
                                        name: "CLOC",
                                        value: <?php echo $orp_cloc ?>
                                   }]
                              },
                    <?php


                         }
                    }
                    ?>

               ];

               // Add and configure Series
               var pieSeries = chart.series.push(new am4charts.PieSeries());
               pieSeries.dataFields.value = "value";
               pieSeries.dataFields.category = "type";
               pieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;
               pieSeries.labels.template.text = "{category}";
               pieSeries.labels.template.paddingTop = 0;
               pieSeries.labels.template.paddingBottom = 0;
               pieSeries.labels.template.disabled = true;
               //pieSeries.labels.template.text = "{category}\n{value.percent.formatNumber('#.#')}%";

               pieSeries.slices.template.events.on("hit", function(event) {
                    selectSlice(event.target.dataItem);
               })

               var chart2 = container.createChild(am4charts.PieChart);
               chart2.width = am4core.percent(30);
               chart2.radius = am4core.percent(80);

               // Add and configure Series
               var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
               pieSeries2.dataFields.value = "value";
               pieSeries2.dataFields.category = "name";
               pieSeries2.slices.template.states.getKey("active").properties.shiftRadius = 0;
               //pieSeries2.labels.template.radius = am4core.percent(50);
               //pieSeries2.labels.template.inside = true;
               //pieSeries2.labels.template.fill = am4core.color("#ffffff");
               pieSeries2.labels.template.disabled = true;
               pieSeries2.ticks.template.disabled = true;
               pieSeries2.alignLabels = true;
               pieSeries2.events.on("positionchanged", updateLines);

               var interfaceColors = new am4core.InterfaceColorSet();

               var line1 = container.createChild(am4core.Line);
               line1.strokeDasharray = "2,2";
               line1.strokeOpacity = 0.5;
               line1.stroke = interfaceColors.getFor("alternativeBackground");
               line1.isMeasured = false;

               var line2 = container.createChild(am4core.Line);
               line2.strokeDasharray = "2,2";
               line2.strokeOpacity = 0.5;
               line2.stroke = interfaceColors.getFor("alternativeBackground");
               line2.isMeasured = false;

               var selectedSlice;

               function selectSlice(dataItem) {

                    selectedSlice = dataItem.slice;

                    var fill = selectedSlice.fill;

                    var count = dataItem.dataContext.subData.length;
                    pieSeries2.colors.list = [];
                    for (var i = 0; i < count; i++) {
                         pieSeries2.colors.list.push(fill.brighten(i * 2 / count));
                    }

                    chart2.data = dataItem.dataContext.subData;
                    pieSeries2.appear();

                    var middleAngle = selectedSlice.middleAngle;
                    var firstAngle = pieSeries.slices.getIndex(0).startAngle;
                    var animation = pieSeries.animate([{
                         property: "startAngle",
                         to: firstAngle - middleAngle
                    }, {
                         property: "endAngle",
                         to: firstAngle - middleAngle + 360
                    }], 600, am4core.ease.sinOut);
                    animation.events.on("animationprogress", updateLines);

                    selectedSlice.events.on("transformed", updateLines);

                    //  var animation = chart2.animate({property:"dx", from:-container.pixelWidth / 2, to:0}, 2000, am4core.ease.elasticOut)
                    //  animation.events.on("animationprogress", updateLines)
               }


               function updateLines() {
                    if (selectedSlice) {
                         var p11 = {
                              x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle),
                              y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle)
                         };
                         var p12 = {
                              x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle + selectedSlice.arc),
                              y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle + selectedSlice.arc)
                         };

                         p11 = am4core.utils.spritePointToSvg(p11, selectedSlice);
                         p12 = am4core.utils.spritePointToSvg(p12, selectedSlice);

                         var p21 = {
                              x: 0,
                              y: -pieSeries2.pixelRadius
                         };
                         var p22 = {
                              x: 0,
                              y: pieSeries2.pixelRadius
                         };

                         p21 = am4core.utils.spritePointToSvg(p21, pieSeries2);
                         p22 = am4core.utils.spritePointToSvg(p22, pieSeries2);

                         line1.x1 = p11.x;
                         line1.x2 = p21.x;
                         line1.y1 = p11.y;
                         line1.y2 = p21.y;

                         line2.x1 = p12.x;
                         line2.x2 = p22.x;
                         line2.y1 = p12.y;
                         line2.y2 = p22.y;
                    }
               }

               chart.events.on("datavalidated", function() {
                    setTimeout(function() {
                         selectSlice(pieSeries.dataItems.getIndex(0));
                    }, 1000);
               });
          </script>


          <script>
               var chart = AmCharts.makeChart("chartdiv5", {
                    "type": "funnel",
                    "theme": "light",
                    "dataProvider": [
                         <?php
                         // $distinct_components = $MI_col->distinct("component_type");
                         // foreach ($distinct_components as $distinct_component) {
                         // if ((($MI_col->find(array("component_type" => $distinct_component, "dead" => "Yes"))->count()) > 0)) {
                         // $count= $MI_col->find(array("component_type" => $distinct_component, "dead" => "Yes"))->count();
                         ?> {
                              "title": "Active JCL",
                              "value": <?php echo $active_jcl; ?>
                         },
                         {
                              "title": "Dead JCL",
                              "value": <?php echo $inactive_jcl; ?>
                         },
                         <?php
                         // }
                         // }
                         ?>
                    ],
                    "balloon": {
                         "fixedPosition": true
                    },

                    "valueField": "value",
                    "titleField": "title",
                    "marginRight": 240,
                    "marginLeft": 50,
                    "startX": -500,
                    "depth3D": 100,
                    "angle": 40,
                    "outlineAlpha": 1,
                    "outlineColor": "#FFFFFF",
                    "outlineThickness": 2,
                    "labelPosition": "right",
                    "balloonText": "[[title]]: [[value]][[description]]",
                    "export": {
                         "enabled": false
                    }
               });
          </script>

          <script>
               // *************************************************************************************
               // chart 7
               // *************************************************************************************

               //am4core.useTheme(am4themes_dataviz);
               am4core.useTheme(am4themes_animated);
               var chart = am4core.create("chartdiv7", am4charts.PieChart);
               chart.legend = new am4charts.Legend();
               chart.legend.position = "right";
               chart.legend.scrollable = true;
               <?php
               $distinct_components = $MI_col->distinct("component_type");
               $component_arr = array();
               foreach ($distinct_components as $distinct_component) {
                    $count = $MI_col->find(array("component_type" => $distinct_component, "drop_impact" => "Yes"))->count();
                    if ($count != "0") {
                         // echo $distinct_component."->".$count;
                         $component_arr[$distinct_component] = $count;
                    }
               }
               ?>


               // Add data
               chart.data = [
                    <?php
                    // print_r ($component_arr);
                    foreach ($component_arr as $key => $value) {
                    ?> {
                              components: "<?php echo $key; ?>",
                              values: <?php echo $value; ?>
                         },
                    <?php
                    }
                    ?>
               ];

               chart.innerRadius = 40;

               var series = chart.series.push(new am4charts.PieSeries3D());
               series.labels.template.paddingTop = 0;
               series.labels.template.paddingBottom = 0;
               series.dataFields.value = "values";
               series.dataFields.category = "components";
               series.labels.template.disabled = true;
          </script>

          <script>
               // *************************************************************************************
               // chart 8
               // *************************************************************************************

               var chart = AmCharts.makeChart("chartdiv8", {
                    "type": "serial",
                    "theme": "light",
                    "depth3D": 20,
                    "angle": 30,
                    //"legend": {
                    //	"horizontalGap": 10,
                    //	"useGraphSettings": true,
                    //	"markerSize": 10
                    //},
                    <?php
                    $orphan_loc_agg =  $MI_col->aggregate(array('$match' => array("orphan" => "Yes")), array('$group' => array('_id' => 'null', 'Orphan_Loc' => array('$sum' => '$tloc'))));
                    $orphan_loc_count = $orphan_loc_agg['result'][0]['Orphan_Loc'];

                    $loc_count_agg =  $MI_col->aggregate(array('$group' => array('_id' => 'null', 'Total_Loc' => array('$sum' => '$tloc'))));
                    $loc_count = $loc_count_agg['result'][0]['Total_Loc'];

                    $loc_count_jcl =  $MI_col->aggregate(array('$match' => array("component_type" => "JCL")), array('$group' => array('_id' => 'null', 'Total_Loc' => array('$sum' => '$tloc'))));
                    $loc_count_jcl = $loc_count_jcl['result'][0]['Total_Loc'];

                    $dead_loc_agg =  $MI_col->aggregate(array('$match' => array("dead" => "Yes")), array('$group' => array('_id' => 'null', 'Dead_Loc' => array('$sum' => '$tloc'))));
                    $dead_loc_count = $dead_loc_agg['result'][0]['Dead_Loc'];

                    $dropImpact_loc_agg =  $MI_col->aggregate(array('$match' => array("drop_impact" => "Yes")), array('$group' => array('_id' => 'null', 'Drop_Impact' => array('$sum' => '$tloc'))));
                    $dropImpact_loc_count = $dropImpact_loc_agg['result'][0]['Drop_Impact'];

                    $orphan_percentage = number_format((($orphan_loc_count / $loc_count) * 100), 2);
                    $dead_percentage = number_format((($dead_loc_count / $loc_count) * 100), 2);
                    $drop_impact_percentage = number_format((($dropImpact_loc_count / $loc_count) * 100), 2);

                    ?> "dataProvider": [{
                         "year": "Orphan",
                         "Orphan Components percentage": <?php echo $orphan_percentage; ?>,
                         //"Components": 100 - <?php echo $dead_percentage; ?>,
                    }, {
                         "year": "Drop Impact",
                         "Drop Impact Percentage": <?php echo $drop_impact_percentage; ?>,
                         //"Components": 100 - <?php echo $drop_impact_percentage; ?>,
                    }, {
                         "year": "Dead Jobs",
                         "Dead Components Percentage": <?php echo $dead_percentage; ?>,
                         //"Components": 100 - <?php echo $drop_impact_percentage; ?>,
                    }],
                    "valueAxes": [{
                         "stackType": "regular",
                         "axisAlpha": 0,
                         "gridAlpha": 0
                    }],
                    "graphs": [{
                              "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                              "fillAlphas": 0.8,
                              //"labelText": "[[value]]",
                              "lineAlpha": 0.3,
                              "title": "Orphan Components",
                              "type": "column",
                              "color": "#000000",
                              "valueField": "Orphan Components percentage"
                         },
                         //{
                         //	"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                         //	"fillAlphas": 0.8,
                         //	"labelText": "[[value]]",
                         //	"lineAlpha": 0.3,
                         //	"title": "Components",
                         //	"type": "column",
                         //	"color": "#000000",
                         //	"valueField": "Components"
                         //},
                         {
                              "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                              "fillAlphas": 0.8,
                              //"labelText": "[[value]]",
                              "lineAlpha": 0.3,
                              "title": "Dead Components",
                              "type": "column",
                              "color": "#000000",
                              "valueField": "Dead Components Percentage"
                         }, {
                              "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                              "fillAlphas": 0.8,
                              //"labelText": "[[value]]",
                              "lineAlpha": 0.3,
                              "title": "Drop Impact Components",
                              "type": "column",
                              "color": "#000000",
                              "valueField": "Drop Impact Percentage"
                         }
                    ],
                    "categoryField": "year",
                    "categoryAxis": {
                         "gridPosition": "start",
                         "axisAlpha": 0,
                         "gridAlpha": 0,
                         "position": "left"
                    },
                    "export": {
                         "enabled": false
                    }

               });
          </script>

          <script>
               // *************************************************************************************
               // chart 13
               // *************************************************************************************
               // Create chart instance
               var chart4 = am4core.create("chartdiv13", am4charts.PieChart3D);
               chart4.hiddenState.properties.opacity = 0; // this creates initial fade-in
               chart4.legend = new am4charts.Legend();
               chart4.legend.position = "right";
               chart4.legend.scrollable = true;
               <?php

               $missing_components_array = array();
               $distinct_components = $missing_comp_col->distinct("missing_component_type");
               foreach ($distinct_components as $distinct_component) {

                    $type = $distinct_component;
                    //echo "~$distinct_component";
                    $value = $missing_comp_col->find(array("missing_component_type" => $distinct_component))->count();
                    $missing_components_array[$type] = $value;
               }

               //print_r($missing_components_array);
               ?>
               chart4.data = [
                    <?php
                    foreach ($missing_components_array as $key => $value) {
                         if ($value !== 0) {
                    ?> {
                                   country: "<?php echo $key; ?>",
                                   litres: <?php echo $value; ?>
                              },

                    <?php
                         }
                    }
                    ?>
               ];

               chart4.innerRadius = am4core.percent(40);
               chart4.depth = 20;

               //chart.legend = new am4charts.Legend();

               var series4 = chart4.series.push(new am4charts.PieSeries3D());
               series4.dataFields.value = "litres";
               series4.dataFields.depthValue = "litres";
               series4.dataFields.category = "country";
               series4.slices.template.cornerRadius = 5;
               series4.colors.step = 3;
               series4.labels.template.disabled = true;
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var data = [{
                         "country": "Dummy",
                         "disabled": true,
                         "litres": 1000,
                         "color": am4core.color("#dadada"),
                         "opacity": 0.3,
                         "strokeDasharray": "4,4"
                    }, {
                         "country": "Insert",
                         "litres": <?php echo '604'; ?>,
                         "color": "#7fdbda"
                    }, {
                         "country": "Read",
                         "litres": <?php echo '4661'; ?>,
                         "color": "#fe91ca"
                    }, {
                         "country": "Update",
                         "litres": <?php echo '780'; ?>,
                         "color": "#fbfd8a"
                    }, {
                         "country": "Delete",
                         "litres": <?php echo '396'; ?>,
                         "color": "#ffb367"
                    }];


                    // cointainer to hold both charts
                    var container = am4core.create("chartdiv10", am4core.Container);
                    container.width = am4core.percent(100);
                    container.height = am4core.percent(100);
                    container.layout = "horizontal";

                    container.events.on("maxsizechanged", function() {
                         chart1.zIndex = 0;
                         separatorLine.zIndex = 1;
                         dragText.zIndex = 2;
                         chart2.zIndex = 3;
                    })

                    var chart1 = container.createChild(am4charts.PieChart);
                    chart1.fontSize = 11;
                    chart1.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                    chart1.data = data;
                    chart1.radius = am4core.percent(70);
                    chart1.innerRadius = am4core.percent(40);
                    chart1.zIndex = 1;

                    var series1 = chart1.series.push(new am4charts.PieSeries());
                    series1.dataFields.value = "litres";
                    series1.dataFields.category = "country";
                    series1.colors.step = 1;
                    series1.alignLabels = false;
                    // series1.labels.template.bent = true;
                    series1.labels.template.disabled = true;
                    series1.labels.template.radius = 3;
                    series1.labels.template.padding(0, 0, 0, 0);

                    var sliceTemplate1 = series1.slices.template;
                    sliceTemplate1.cornerRadius = 5;
                    sliceTemplate1.draggable = true;
                    sliceTemplate1.inert = true;
                    sliceTemplate1.propertyFields.fill = "color";
                    sliceTemplate1.propertyFields.fillOpacity = "opacity";
                    sliceTemplate1.propertyFields.stroke = "color";
                    sliceTemplate1.propertyFields.strokeDasharray = "strokeDasharray";
                    sliceTemplate1.strokeWidth = 1;
                    sliceTemplate1.strokeOpacity = 1;

                    var zIndex = 5;

                    sliceTemplate1.events.on("down", function(event) {
                         event.target.toFront();
                         // also put chart to front
                         var series = event.target.dataItem.component;
                         series.chart.zIndex = zIndex++;
                    })

                    series1.ticks.template.disabled = true;

                    sliceTemplate1.states.getKey("active").properties.shiftRadius = 0;

                    sliceTemplate1.events.on("dragstop", function(event) {
                         handleDragStop(event);
                    })

                    // separator line and text
                    var separatorLine = container.createChild(am4core.Line);
                    separatorLine.x1 = 0;
                    separatorLine.y2 = 300;
                    separatorLine.strokeWidth = 3;
                    separatorLine.stroke = am4core.color("#dadada");
                    separatorLine.valign = "middle";
                    separatorLine.strokeDasharray = "5,5";


                    var dragText = container.createChild(am4core.Label);
                    dragText.text = "Drag slices over the line";
                    dragText.rotation = 90;
                    dragText.valign = "middle";
                    dragText.align = "center";
                    dragText.paddingBottom = 5;

                    // second chart
                    var chart2 = container.createChild(am4charts.PieChart);
                    chart2.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                    chart2.fontSize = 11;
                    chart2.radius = am4core.percent(70);
                    chart2.data = data;
                    chart2.innerRadius = am4core.percent(40);
                    chart2.zIndex = 1;

                    var series2 = chart2.series.push(new am4charts.PieSeries());
                    series2.dataFields.value = "litres";
                    series2.dataFields.category = "country";
                    series2.colors.step = 2;

                    series2.alignLabels = false;
                    series2.labels.template.bent = true;
                    series2.labels.template.radius = 3;
                    series2.labels.template.padding(0, 0, 0, 0);
                    series2.labels.template.propertyFields.disabled = "disabled";

                    var sliceTemplate2 = series2.slices.template;
                    sliceTemplate2.copyFrom(sliceTemplate1);

                    series2.ticks.template.disabled = true;

                    function handleDragStop(event) {
                         var targetSlice = event.target;
                         var dataItem1;
                         var dataItem2;
                         var slice1;
                         var slice2;

                         if (series1.slices.indexOf(targetSlice) != -1) {
                              slice1 = targetSlice;
                              slice2 = series2.dataItems.getIndex(targetSlice.dataItem.index).slice;
                         } else if (series2.slices.indexOf(targetSlice) != -1) {
                              slice1 = series1.dataItems.getIndex(targetSlice.dataItem.index).slice;
                              slice2 = targetSlice;
                         }


                         dataItem1 = slice1.dataItem;
                         dataItem2 = slice2.dataItem;

                         var series1Center = am4core.utils.spritePointToSvg({
                              x: 0,
                              y: 0
                         }, series1.slicesContainer);
                         var series2Center = am4core.utils.spritePointToSvg({
                              x: 0,
                              y: 0
                         }, series2.slicesContainer);

                         var series1CenterConverted = am4core.utils.svgPointToSprite(series1Center, series2.slicesContainer);
                         var series2CenterConverted = am4core.utils.svgPointToSprite(series2Center, series1.slicesContainer);

                         // tooltipY and tooltipY are in the middle of the slice, so we use them to avoid extra calculations
                         var targetSlicePoint = am4core.utils.spritePointToSvg({
                              x: targetSlice.tooltipX,
                              y: targetSlice.tooltipY
                         }, targetSlice);

                         if (targetSlice == slice1) {
                              if (targetSlicePoint.x > container.pixelWidth / 2) {
                                   var value = dataItem1.value;

                                   dataItem1.hide();

                                   var animation = slice1.animate([{
                                        property: "x",
                                        to: series2CenterConverted.x
                                   }, {
                                        property: "y",
                                        to: series2CenterConverted.y
                                   }], 400);
                                   animation.events.on("animationprogress", function(event) {
                                        slice1.hideTooltip();
                                   })

                                   slice2.x = 0;
                                   slice2.y = 0;

                                   dataItem2.show();
                              } else {
                                   slice1.animate([{
                                        property: "x",
                                        to: 0
                                   }, {
                                        property: "y",
                                        to: 0
                                   }], 400);
                              }
                         }
                         if (targetSlice == slice2) {
                              if (targetSlicePoint.x < container.pixelWidth / 2) {

                                   var value = dataItem2.value;

                                   dataItem2.hide();

                                   var animation = slice2.animate([{
                                        property: "x",
                                        to: series1CenterConverted.x
                                   }, {
                                        property: "y",
                                        to: series1CenterConverted.y
                                   }], 400);
                                   animation.events.on("animationprogress", function(event) {
                                        slice2.hideTooltip();
                                   })

                                   slice1.x = 0;
                                   slice1.y = 0;
                                   dataItem1.show();
                              } else {
                                   slice2.animate([{
                                        property: "x",
                                        to: 0
                                   }, {
                                        property: "y",
                                        to: 0
                                   }], 400);
                              }
                         }

                         toggleDummySlice(series1);
                         toggleDummySlice(series2);

                         series1.hideTooltip();
                         series2.hideTooltip();
                    }

                    function toggleDummySlice(series) {
                         var show = true;
                         for (var i = 1; i < series.dataItems.length; i++) {
                              var dataItem = series.dataItems.getIndex(i);
                              if (dataItem.slice.visible && !dataItem.slice.isHiding) {
                                   show = false;
                              }
                         }

                         var dummySlice = series.dataItems.getIndex(0);
                         if (show) {
                              dummySlice.show();
                         } else {
                              dummySlice.hide();
                         }
                    }

                    series2.events.on("datavalidated", function() {

                         var dummyDataItem = series2.dataItems.getIndex(0);
                         dummyDataItem.show(0);
                         dummyDataItem.slice.draggable = false;
                         dummyDataItem.slice.tooltipText = undefined;

                         for (var i = 1; i < series2.dataItems.length; i++) {
                              series2.dataItems.getIndex(i).hide(0);
                         }
                    })

                    series1.events.on("datavalidated", function() {
                         var dummyDataItem = series1.dataItems.getIndex(0);
                         dummyDataItem.hide(0);
                         dummyDataItem.slice.draggable = false;
                         dummyDataItem.slice.tooltipText = undefined;
                    })

               }); // end am4core.ready()
          </script>

          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var data = [{
                         "country": "Dummy",
                         "disabled": true,
                         "litres": 1000,
                         "color": am4core.color("#dadada"),
                         "opacity": 0.3,
                         "strokeDasharray": "4,4"
                    }, {
                         "country": "Insert",
                         "litres": <?php echo '2035'; ?>,
                         "color": "#7fdbda"
                    }, {
                         "country": "Read",
                         "litres": <?php echo '1310'; ?>,
                         "color": "#fe91ca"
                    }, {
                         "country": "Update",
                         "litres": <?php echo '25'; ?>,
                         "color": "#fbfd8a"
                    }, {
                         "country": "Delete",
                         "litres": <?php echo '6'; ?>,
                         "color": "#ffb367"
                    }];


                    // cointainer to hold both charts
                    var container = am4core.create("chartdiv18", am4core.Container);
                    container.width = am4core.percent(100);
                    container.height = am4core.percent(100);
                    container.layout = "horizontal";

                    container.events.on("maxsizechanged", function() {
                         chart1.zIndex = 0;
                         separatorLine.zIndex = 1;
                         dragText.zIndex = 2;
                         chart2.zIndex = 3;
                    })

                    var chart1 = container.createChild(am4charts.PieChart);
                    chart1.fontSize = 11;
                    chart1.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                    chart1.data = data;
                    chart1.radius = am4core.percent(70);
                    chart1.innerRadius = am4core.percent(40);
                    chart1.zIndex = 1;

                    var series1 = chart1.series.push(new am4charts.PieSeries());
                    series1.dataFields.value = "litres";
                    series1.dataFields.category = "country";
                    series1.colors.step = 1;
                    series1.alignLabels = false;
                    // series1.labels.template.bent = true;
                    series1.labels.template.disabled = true;
                    series1.labels.template.radius = 3;
                    series1.labels.template.padding(0, 0, 0, 0);

                    var sliceTemplate1 = series1.slices.template;
                    sliceTemplate1.cornerRadius = 5;
                    sliceTemplate1.draggable = true;
                    sliceTemplate1.inert = true;
                    sliceTemplate1.propertyFields.fill = "color";
                    sliceTemplate1.propertyFields.fillOpacity = "opacity";
                    sliceTemplate1.propertyFields.stroke = "color";
                    sliceTemplate1.propertyFields.strokeDasharray = "strokeDasharray";
                    sliceTemplate1.strokeWidth = 1;
                    sliceTemplate1.strokeOpacity = 1;

                    var zIndex = 5;

                    sliceTemplate1.events.on("down", function(event) {
                         event.target.toFront();
                         // also put chart to front
                         var series = event.target.dataItem.component;
                         series.chart.zIndex = zIndex++;
                    })

                    series1.ticks.template.disabled = true;

                    sliceTemplate1.states.getKey("active").properties.shiftRadius = 0;

                    sliceTemplate1.events.on("dragstop", function(event) {
                         handleDragStop(event);
                    })

                    // separator line and text
                    var separatorLine = container.createChild(am4core.Line);
                    separatorLine.x1 = 0;
                    separatorLine.y2 = 300;
                    separatorLine.strokeWidth = 3;
                    separatorLine.stroke = am4core.color("#dadada");
                    separatorLine.valign = "middle";
                    separatorLine.strokeDasharray = "5,5";


                    var dragText = container.createChild(am4core.Label);
                    dragText.text = "Drag slices over the line";
                    dragText.rotation = 90;
                    dragText.valign = "middle";
                    dragText.align = "center";
                    dragText.paddingBottom = 5;

                    // second chart
                    var chart2 = container.createChild(am4charts.PieChart);
                    chart2.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                    chart2.fontSize = 11;
                    chart2.radius = am4core.percent(70);
                    chart2.data = data;
                    chart2.innerRadius = am4core.percent(40);
                    chart2.zIndex = 1;

                    var series2 = chart2.series.push(new am4charts.PieSeries());
                    series2.dataFields.value = "litres";
                    series2.dataFields.category = "country";
                    series2.colors.step = 2;

                    series2.alignLabels = false;
                    series2.labels.template.bent = true;
                    series2.labels.template.radius = 3;
                    series2.labels.template.padding(0, 0, 0, 0);
                    series2.labels.template.propertyFields.disabled = "disabled";

                    var sliceTemplate2 = series2.slices.template;
                    sliceTemplate2.copyFrom(sliceTemplate1);

                    series2.ticks.template.disabled = true;

                    function handleDragStop(event) {
                         var targetSlice = event.target;
                         var dataItem1;
                         var dataItem2;
                         var slice1;
                         var slice2;

                         if (series1.slices.indexOf(targetSlice) != -1) {
                              slice1 = targetSlice;
                              slice2 = series2.dataItems.getIndex(targetSlice.dataItem.index).slice;
                         } else if (series2.slices.indexOf(targetSlice) != -1) {
                              slice1 = series1.dataItems.getIndex(targetSlice.dataItem.index).slice;
                              slice2 = targetSlice;
                         }


                         dataItem1 = slice1.dataItem;
                         dataItem2 = slice2.dataItem;

                         var series1Center = am4core.utils.spritePointToSvg({
                              x: 0,
                              y: 0
                         }, series1.slicesContainer);
                         var series2Center = am4core.utils.spritePointToSvg({
                              x: 0,
                              y: 0
                         }, series2.slicesContainer);

                         var series1CenterConverted = am4core.utils.svgPointToSprite(series1Center, series2.slicesContainer);
                         var series2CenterConverted = am4core.utils.svgPointToSprite(series2Center, series1.slicesContainer);

                         // tooltipY and tooltipY are in the middle of the slice, so we use them to avoid extra calculations
                         var targetSlicePoint = am4core.utils.spritePointToSvg({
                              x: targetSlice.tooltipX,
                              y: targetSlice.tooltipY
                         }, targetSlice);

                         if (targetSlice == slice1) {
                              if (targetSlicePoint.x > container.pixelWidth / 2) {
                                   var value = dataItem1.value;

                                   dataItem1.hide();

                                   var animation = slice1.animate([{
                                        property: "x",
                                        to: series2CenterConverted.x
                                   }, {
                                        property: "y",
                                        to: series2CenterConverted.y
                                   }], 400);
                                   animation.events.on("animationprogress", function(event) {
                                        slice1.hideTooltip();
                                   })

                                   slice2.x = 0;
                                   slice2.y = 0;

                                   dataItem2.show();
                              } else {
                                   slice1.animate([{
                                        property: "x",
                                        to: 0
                                   }, {
                                        property: "y",
                                        to: 0
                                   }], 400);
                              }
                         }
                         if (targetSlice == slice2) {
                              if (targetSlicePoint.x < container.pixelWidth / 2) {

                                   var value = dataItem2.value;

                                   dataItem2.hide();

                                   var animation = slice2.animate([{
                                        property: "x",
                                        to: series1CenterConverted.x
                                   }, {
                                        property: "y",
                                        to: series1CenterConverted.y
                                   }], 400);
                                   animation.events.on("animationprogress", function(event) {
                                        slice2.hideTooltip();
                                   })

                                   slice1.x = 0;
                                   slice1.y = 0;
                                   dataItem1.show();
                              } else {
                                   slice2.animate([{
                                        property: "x",
                                        to: 0
                                   }, {
                                        property: "y",
                                        to: 0
                                   }], 400);
                              }
                         }

                         toggleDummySlice(series1);
                         toggleDummySlice(series2);

                         series1.hideTooltip();
                         series2.hideTooltip();
                    }

                    function toggleDummySlice(series) {
                         var show = true;
                         for (var i = 1; i < series.dataItems.length; i++) {
                              var dataItem = series.dataItems.getIndex(i);
                              if (dataItem.slice.visible && !dataItem.slice.isHiding) {
                                   show = false;
                              }
                         }

                         var dummySlice = series.dataItems.getIndex(0);
                         if (show) {
                              dummySlice.show();
                         } else {
                              dummySlice.hide();
                         }
                    }

                    series2.events.on("datavalidated", function() {

                         var dummyDataItem = series2.dataItems.getIndex(0);
                         dummyDataItem.show(0);
                         dummyDataItem.slice.draggable = false;
                         dummyDataItem.slice.tooltipText = undefined;

                         for (var i = 1; i < series2.dataItems.length; i++) {
                              series2.dataItems.getIndex(i).hide(0);
                         }
                    })

                    series1.events.on("datavalidated", function() {
                         var dummyDataItem = series1.dataItems.getIndex(0);
                         dummyDataItem.hide(0);
                         dummyDataItem.slice.draggable = false;
                         dummyDataItem.slice.tooltipText = undefined;
                    })

               }); // end am4core.ready()
          </script>


          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdivsingle", am4charts.XYChart3D);


                    chart.data = [{
                         "country": "CRUD ONLY",
                         "year2017": <?php echo $singleDeleteCount; ?>,
                         "year2018": <?php echo $singleUpdateCount; ?>,
                         "year2019": <?php echo $singleInsertCount; ?>,
                         "year2020": <?php echo $singleReadCount; ?>
                    }];

                    // Create axes
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 30;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.title.text = "CRUD Operation";
                    valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                         return text;
                    });

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries3D());
                    series.dataFields.valueY = "year2017";
                    series.dataFields.categoryX = "country";
                    series.name = "Year 2017";
                    series.clustered = false;
                    series.columns.template.tooltipText = "DELETE ONLY: [bold]{valueY}[/]";
                    series.columns.template.fill = am4core.color("#97D3FD");
                    series.columns.template.fillOpacity = 0.9;

                    var series2 = chart.series.push(new am4charts.ColumnSeries3D());
                    series2.dataFields.valueY = "year2018";
                    series2.dataFields.categoryX = "country";
                    series2.name = "Year 2018";
                    series2.clustered = false;
                    series2.columns.template.tooltipText = "UPDATE ONLY: [bold]{valueY}[/]";
                    series2.columns.template.fill = am4core.color("#E56B99");

                    var series2 = chart.series.push(new am4charts.ColumnSeries3D());
                    series2.dataFields.valueY = "year2019";
                    series2.dataFields.categoryX = "country";
                    series2.name = "Year 2018";
                    series2.clustered = false;
                    series2.columns.template.tooltipText = "INSERT ONLY: [bold]{valueY}[/]";
                    series2.columns.template.fill = am4core.color("#6886c5");

                    var series2 = chart.series.push(new am4charts.ColumnSeries3D());
                    series2.dataFields.valueY = "year2020";
                    series2.dataFields.categoryX = "country";
                    series2.name = "Year 2018";
                    series2.clustered = false;
                    series2.columns.template.tooltipText = "READ ONLY: [bold]{valueY}[/]";
                    series2.columns.template.fill = am4core.color("#eef9bf");

               }); // end am4core.ready()
          </script>


          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv16", am4charts.PieChart);

                    // Add data
                    chart.data = [{
                         "country": "Files Created Not Used",
                         "litres": <?php echo $filesCreatedNotUsedCount; ?>
                    }, {
                         "country": "Files Used",
                         "litres": <?php echo $filesCount; ?>
                    }];

                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.innerRadius = am4core.percent(50);
                    pieSeries.ticks.template.disabled = true;
                    pieSeries.labels.template.disabled = true;
                    pieSeries.colors.step = 1;

                    var rgm = new am4core.RadialGradientModifier();
                    rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
                    pieSeries.slices.template.fillModifier = rgm;
                    pieSeries.slices.template.strokeModifier = rgm;
                    pieSeries.slices.template.strokeOpacity = 0.4;
                    pieSeries.slices.template.strokeWidth = 0;


                    chart.legend = new am4charts.Legend();
                    chart.legend.position = "right";

                    pieSeries.colors.list = [
                         am4core.color("#845EC2"),
                         am4core.color("#D65DB1"),
                         am4core.color("#FF6F91"),
                         am4core.color("#FF9671"),
                         am4core.color("#FFC75F"),
                         am4core.color("#F9F871"),
                    ];

               }); // end am4core.ready()
          </script>
          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv12", am4charts.XYChart);
                    chart.scrollbarX = new am4core.Scrollbar();

                    // Add data
                    chart.data = [{
                         "country": "Total Segments",
                         "visits": <?php echo $imsSegmentcount; ?>,
                         "color": chart.colors.next()
                    }, {
                         "country": "Orphan Segments",
                         "visits": <?php echo $imsOrphanCount; ?>,
                         "color": chart.colors.next()
                    }];

                    // Create axes
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 30;
                    categoryAxis.renderer.labels.template.horizontalCenter = "right";
                    categoryAxis.renderer.labels.template.verticalCenter = "middle";
                    categoryAxis.renderer.labels.template.rotation = 0;
                    categoryAxis.tooltip.disabled = true;
                    // categoryAxis.renderer.minHeight = 110;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.renderer.minWidth = 50;

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.sequencedInterpolation = true;
                    series.dataFields.valueY = "visits";
                    series.dataFields.categoryX = "country";
                    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
                    series.columns.template.strokeWidth = 0;

                    series.tooltip.pointerOrientation = "vertical";

                    series.columns.template.column.cornerRadiusTopLeft = 10;
                    series.columns.template.column.cornerRadiusTopRight = 10;
                    series.columns.template.column.fillOpacity = 0.8;

                    // on hover, make corner radiuses bigger
                    var hoverState = series.columns.template.column.states.create("hover");
                    hoverState.properties.cornerRadiusTopLeft = 0;
                    hoverState.properties.cornerRadiusTopRight = 0;
                    hoverState.properties.fillOpacity = 1;

                    series.columns.template.adapter.add("fill", function(fill, target) {
                         return chart.colors.getIndex(target.dataItem.index);
                    });

                    // Cursor
                    chart.cursor = new am4charts.XYCursor();

               }); // end am4core.ready()
          </script>
          <script>
               am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv19", am4charts.XYChart);
                    chart.scrollbarX = new am4core.Scrollbar();

                    // Add data
                    chart.data = [{
                         "country": "Total Tables",
                         "visits": <?php echo $db2TablesCount; ?>,
                         "color": chart.colors.next()
                    }, {
                         "country": "Orphan Tables",
                         "visits": <?php echo $db2OrphanCount; ?>,
                         "color": chart.colors.next()
                    }];

                    // Create axes
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 30;
                    categoryAxis.renderer.labels.template.horizontalCenter = "right";
                    categoryAxis.renderer.labels.template.verticalCenter = "middle";
                    categoryAxis.renderer.labels.template.rotation = 0;
                    categoryAxis.tooltip.disabled = true;
                    // categoryAxis.renderer.minHeight = 110;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.renderer.minWidth = 50;

                    // Create series
                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.sequencedInterpolation = true;
                    series.dataFields.valueY = "visits";
                    series.dataFields.categoryX = "country";
                    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
                    series.columns.template.strokeWidth = 0;

                    series.tooltip.pointerOrientation = "vertical";

                    series.columns.template.column.cornerRadiusTopLeft = 10;
                    series.columns.template.column.cornerRadiusTopRight = 10;
                    series.columns.template.column.fillOpacity = 0.8;

                    // on hover, make corner radiuses bigger
                    var hoverState = series.columns.template.column.states.create("hover");
                    hoverState.properties.cornerRadiusTopLeft = 0;
                    hoverState.properties.cornerRadiusTopRight = 0;
                    hoverState.properties.fillOpacity = 1;

                    series.columns.template.adapter.add("fill", function(fill, target) {
                         return chart.colors.getIndex(target.dataItem.index);
                    });

                    // Cursor
                    chart.cursor = new am4charts.XYCursor();

               }); // end am4core.ready()
          </script>

     </body>

     </html>
<?php
} else {
     header("location:login.php");
}
?>