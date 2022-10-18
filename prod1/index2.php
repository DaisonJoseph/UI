<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<style>
    .amcharts-chart-div .cur {
        cursor: pointer;
    }

    @media (min-width: 992px) {
        .page-content-wrapper .page-content {
            padding: 25px 20px 0px !important;
            margin-bottom: 0px;
        }
    }
</style>
<meta charset="utf-8" />
<title>DevOps Analyzer</title>
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
<link rel="stylesheet" href="../assets1/custom/custom.css" type="text/css" />
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
    <div class="page-wrapper">

        <?php
        $page = 'index';
        include 'header.php'; ?>
        <div class="clearfix"> </div>
        <div class="page-container">
            <?php include 'sidebar.php'; ?>
            <div class="page-content-wrapper">
                <div class="page-content" style="background-color:#DCDCDC;">
                    <!--<div class="page-bar" style="background-color:#778899;height:21px;">
                        <ul class="page-breadcrumb" style="padding-top:1px;">
                            <li>
                                <span style="color:white">Dashboard</span>
                            </li>
                        </ul>
                    </div><br />-->
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
                        <div id="submenu1sub1">
                            <div class="row" style="margin-top:-5px" id="row1">
                                <!-- <div class="col-lg-3 col-sm-6 col-xs-12"> -->
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" data-toggle="tooltip" data-placement="bottom" title="Total number of components used in the system.">
                                        <div class="visual">
                                            <!-- <i class="fa fa-usd"></i> -->
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span></span><span data-counter="counterup" data-value="31258">0</span><span></span>
                                            </div>
                                            <!-- <div class="desc"><b> Total no. of Components </b><br> <small> <B> -13% </B> QoQ </small> </div> -->
                                            <div class="desc"><b> Total no. of Components </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="#" data-toggle="tooltip" data-placement="bottom" title="Total lines of code.">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="14357114">0</span>
                                            </div>
                                            <!-- <div class="desc"> <b> Total Loc </b> <br> <small> Increased From <B> 160 </B> QoQ </small> </div> -->
                                            <div class="desc"> <b> Total Loc </b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" data-toggle="tooltip" data-placement="bottom" title="Total number of tables used in the system." href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span></span><span data-counter="counterup" data-value="1267">0</span>
                                            </div>
                                            <!-- <div class="desc"> <b> Cost of Quality </b> <br> <small> <b> -20% </B> QoQ </small> </div> -->
                                            <div class="desc"> <b>Total no. of DB2 Tables </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Mean Time to Deploy is an average time taken for a deployment once the components are developed and tested and are ready for deployment.">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="6481"></span> </div>
                                            <div class="desc">
                                                <!-- <B> MTTD </B> <br> <small> Improved <b> 20% </B> QoQ </small> </div> -->
                                                <B> VSAM and Flat Files </B></div>
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
                                                        <span class="caption-subject font-dark bold">Master Inventory</span>
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
                                                        <span class="caption-subject font-dark bold">Master Inventory</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv2" class="" style="height:200px;"> </div>
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
                                                        <span class="caption-subject font-dark bold"></span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv3" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold"></span>
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
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#" data-toggle="tooltip" data-placement="bottom" title="TCO is an financial estimate of direct and indirect cost of owning an IT application that includes hardware and software acquisition, management and support, communications, end-user expenses and the opportunity cost of downtime, training and other productivity losses.">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span></span><span data-counter="counterup" data-value="3385">0</span><span></span>
                                            </div>
                                            <div class="desc"><b> Total Orphan Components</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="#" data-toggle="tooltip" data-placement="bottom" title="Number of deploys across enterprise last quarter.">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="2415">0</span> </div>
                                            <div class="desc"> <b> Total Dead Components</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" data-toggle="tooltip" data-placement="bottom" title="Cost of quality is a methodology that allows an organization to determine the extent to which its resources are used for activities that prevent poor quality." href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span></span><span data-counter="counterup" data-value="12"></span><span>%</span>
                                            </div>
                                            <div class="desc"> <b>Overall Dead Component (%)</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Mean Time to Deploy is an average time taken for a deployment once the components are developed and tested and are ready for deployment.">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="713"></span></div>
                                            <div class="desc"><b>Total missing components </b></div>
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
                                                        <span class="caption-subject font-dark bold">Total Orphan</span>
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
                                                        <span class="caption-subject font-dark bold">Total Dead Components</span>
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
                                                        <span class="caption-subject font-dark bold">Internal/External</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv7" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <div id="chartdiv8" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:-5px" id="row3">
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#" data-toggle="tooltip" data-placement="bottom" title="TCO is an financial estimate of direct and indirect cost of owning an IT application that includes hardware and software acquisition, management and support, communications, end-user expenses and the opportunity cost of downtime, training and other productivity losses.">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span data-counter="counterup" data-value="204">0</span>
                                            </div>
                                            <div class="desc"><b> Total no. of Transaction </b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="#" data-toggle="tooltip" data-placement="bottom" title="Number of deploys across enterprise last quarter.">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1234">0</span> | <span data-counter="counterup" data-value="808">0</span> </div>
                                            <div class="desc"> <b> Total no. of Active | Inactive transaction</b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" data-toggle="tooltip" data-placement="bottom" title="Cost of quality is a methodology that allows an organization to determine the extent to which its resources are used for activities that prevent poor quality." href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="119855">0</span><span>K</span>
                                            </div>
                                            <div class="desc"> <b> Total transaction hits </b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Mean Time to Deploy is an average time taken for a deployment once the components are developed and tested and are ready for deployment.">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span><small style="font-size: 16px;">AZCU -</small></span><span data-counter="counterup" data-value="3906836"></span></div>
                                            <div class="desc">
                                                <B> Highest transaction hits </B> </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row animated ease-in-out">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div id="showDiv3">
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 1</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 2</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 3</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 4</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:-5px" id="row4">
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#" data-toggle="tooltip" data-placement="bottom" title="TCO is an financial estimate of direct and indirect cost of owning an IT application that includes hardware and software acquisition, management and support, communications, end-user expenses and the opportunity cost of downtime, training and other productivity losses.">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="29739">0</span>
                                            </div>
                                            <div class="desc"><b>CRUD operations counts</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="#" data-toggle="tooltip" data-placement="bottom" title="Number of deploys across enterprise last quarter.">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="110">0</span> </div>
                                            <div class="desc"> <b> CRUD single operations count </b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" data-toggle="tooltip" data-placement="bottom" title="Cost of quality is a methodology that allows an organization to determine the extent to which its resources are used for activities that prevent poor quality." href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="26">0</span>
                                            </div>
                                            <div class="desc"> <b>Total missing tables</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Mean Time to Deploy is an average time taken for a deployment once the components are developed and tested and are ready for deployment.">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="137"></span> </div>
                                            <div class="desc">
                                                <B> Tables without index </B></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row animated ease-in-out">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div id="showDiv4">
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 1</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 2</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 3</p>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <p>Chart 4</p>
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

                        <div class="row widget-row">
                            <a data-toggle="modal" href="#" id="Applications">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high2">
                                        <h4 class="widget-thumb-heading">Applications</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red fa fa-desktop"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"> </span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="106">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a data-toggle="modal" href="#" id="Portfolio">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high1">
                                        <h4 class="widget-thumb-heading">Rehosting cost</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-blue fa fa-briefcase"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="XX">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>

                            <a data-toggle="modal" href="#" id="People">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase" id="high3">
                                        <h4 class="widget-thumb-heading">Technical debt</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-users" style="background-color:#98b4bb"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="XX">0</span>
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
                                    <div class="widget-thumb widget-bg-color-white text-uppercase" id="high4">
                                        <h4 class="widget-thumb-heading">Reverse engg </h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-wrench" style="background-color:#738989"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="XX">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
                            <a data-toggle="modal" href="#" id="Vendors">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high5">
                                        <h4 class="widget-thumb-heading">Migration cost</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon  bg-green fa fa-user-plus"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="XX">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
                            <a data-toggle="modal" href="#" id="ROI">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high6">
                                        <h4 class="widget-thumb-heading">ROI</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple fa fa-line-chart"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="XX">0</span>
                                                <span style="font-size:28px;color:#3E4F5E"><b>%</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
                        </div>
                        <div class="row boxx" id="Portfolio1">
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">No. of Apps</span>
                                            <span class="caption-helper">..in portfolio</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="port1" style="height:200px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">IT Cost</span>
                                            <span class="caption-helper">..apportion</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="port6" class="" style="height:200px"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Spending vs Revenue</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="port5" class="" style="height:200px;width:auto;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Applications</span>
                                            <span class="caption-helper">..by criticality</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="port2" class="" style="width:100%;height:200px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row boxx" id="Application1">
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Criticality</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="criticalchart" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">SDLC Methodology</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="techchart" class="" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Technology Platform</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="applicationbarchart" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Batch/Online</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="batchchart" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row boxx" id="People1">
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Skills</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="skillsbarchart" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Internal/External</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="donut_chart1" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Functional Area</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="peoplebarchart" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold"> Location</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="expdonut" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row boxx" id="Tools1">
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">ALM Application</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="almpiechart" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Vendor</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="toolsvendor" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Tools</span>
                                            <span class="caption-helper"> ..top 5 by licence cost (in $MM per Year)</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="toolsbarchart" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row boxx" id="Vendors1">
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Application by Service Line</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="vendorschart1" class="" style="height:220px;"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">People by Service Line</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="vendorschart2" class="" style="height:220px;"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row boxx" id="ROI1">
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Dev & Test Offload</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="myChart1" style="height:200px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold"> Test Automation</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="myChart2" class="" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">CI CD</span>
                                            <span class="caption-helper"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="cicdroi" class="" style="height:200px;"> </div>
                                    </div>
                                </div>
                            </div>

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
            <!-- </div>
                 </div> -->
            <!-- </div>
                </div> -->
            <!-- END CONTENT BODY-->
        </div>
    </div>
    <div class="page-footer">
        <div class="page-footer-inner"> 2019 &copy; DevOps Tool By
            <a href="https://www.capgemini.com/">Capgemini</a>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
    </div>
    </div>
    <script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
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
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawSeriesChart);

        function drawSeriesChart() {

            var data = google.visualization.arrayToDataTable([
                ['ID', 'Incidents', 'Revenue', 'Portfolio', 'Cost in $'],
                ['Q1', 70.3, 20.54, 'Trade Finance', 65000],
                ['Q2', 45.5, 17.43, 'Trade Finance', 58000],
                ['Q3', 30.4, 15.56, 'Trade Finance', 52000],
                ['Q4', 20.7, 12.43, 'Trade Finance', 25000],
                ['Q1', 32.2, 15.44, 'Investments', 62000],
                ['Q2', 31.0, 20.45, 'Investments', 57000],
                ['Q3', 59.1, 25.56, 'Investments', 53000],
                ['Q4', 40.3, 20.77, 'Investments', 47000],
                ['Q1', 45.4, 15.43, 'Cards', 42000],
                ['Q2', 36.3, 12.14, 'Cards', 45000],
                ['Q3', 66.3, 10.35, 'Cards', 25000],
                ['Q4', 21.2, 08.36, 'Cards', 33000],
                ['Q1', 15.7, 15.57, 'Retail Banking', 44000],
                ['Q2', 40.3, 12.23, 'Retail Banking', 45000],
                ['Q3', 55.2, 10.34, 'Retail Banking', 53000],
                ['Q4', 31.8, 08.12, 'Retail Banking', 24500],
                ['Q1', 55.4, 15.23, 'Loan', 65000],
                ['Q2', 60.7, 12.34, 'Loan', 43000],
                ['Q3', 52.3, 10.54, 'Loan', 20000],
                ['Q4', 51.6, 08.54, 'Loan', 38000],
            ]);

            var options = {
                // title: 'Correlation between incidents, defects on costs for Portfolio',
                hAxis: {
                    title: 'Incidents'
                },
                vAxis: {
                    title: 'Revenue'
                },
                colors: ['#52D0E6', '#1981A4', '#65909A', '2F4F4F', '98F5FF'],
                bubble: {
                    textStyle: {
                        auraColor: 'none',
                        fontSize: 11
                    }
                }
            };

            var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
            chart.draw(data, options);
        }
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        FusionCharts.ready(function() {
            var cpuGauge = new FusionCharts({
                    type: 'hlineargauge',
                    renderAt: 'chart-container',
                    id: 'cpu-linear-gauge',
                    width: '320',
                    height: '80',
                    dataSource: {
                        "chart": {
                            "theme": "fint",
                            "caption": "",
                            "lowerLimit": "0",
                            "upperLimit": "100",
                            "numberSuffix": "",
                            "chartBottomMargin": "20",
                            "toolTipBgColor": "#fff",
                            "valueFontSize": "0",
                            "showTickMarks": "0",
                            "showTickValues": "0",
                            "valueFontBold": "0",
                            "placeValuesInside": "0",
                            "gaugeFillMix": "{light-33},{light-33},{dark-33}",
                            "gaugeFillRatio": "40,20,40"
                        },
                        "colorRange": {
                            "color": [{
                                    "minValue": "0",
                                    "maxValue": "20",
                                    "label": "L0",
                                    "code": " #98f5ff"
                                }, {
                                    "minValue": "20",
                                    "maxValue": "40",
                                    "label": "L1",
                                    "code": " #39b7cd "
                                }, {
                                    "minValue": "40",
                                    "maxValue": "60",
                                    "label": "L2",
                                    "code": "#00688b"
                                },
                                {
                                    "minValue": "60",
                                    "maxValue": "80",
                                    "label": "L3",
                                    "code": "#65909a"
                                },
                                {
                                    "minValue": "80",
                                    "maxValue": "100",
                                    "label": "L4",
                                    "code": "#2f4f4f"
                                }
                            ]
                        },
                        "pointers": {
                            "pointer": [{
                                "toolText": " ",

                                "value": "30"
                            }]
                        }
                    }
                })
                .render();
        });
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <!-- amcharts -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://www.amcharts.com/lib/4/plugins/sunburst.js"></script>
    <script>
        <?php
        $m = new MongoClient();
        $db = $m->euroclear;
        $MI_col = $db->MasterInventory;
        $missing_components_col = $db->MissingComponents;
        $xref_col = $db->Crossreference;
        $stat_col = $db->staticDynamic;
        $load_col = $db->loadSource;
        $file_notused_col = $db->files_notUsed;
        $ftp_col = $db->ftp;
        $crudcol = $db->CRUD;
        $crudops = $db->CRUD_Ops;
        ?>
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        var chart = am4core.create("chartdiv1", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();
        <?php
        $total_cloc = $MI_col->aggregate(array('$group' => array('_id' => 'null', "TotalLLoc" => array('$sum' => '$CLOC'))));
        $total_uloc = $MI_col->aggregate(array('$group' => array('_id' => 'null', "TotalLLoc" => array('$sum' => '$ULOC'))));
        foreach ($total_cloc as $total) {
            foreach ($total as $tc) {
                $total_commented_loc = $tc['TotalLLoc'];
            }
        }
        foreach ($total_uloc as $total) {
            foreach ($total as $tc) {
                $total_uncommented_loc = $tc['TotalLLoc'];
            }
        }
        //echo "!!!$total_uncommented_loc";
        ?>
        chart.data = [{
                country: "CLOC",
                litres: <?php echo $total_commented_loc ?>
            },
            {
                country: "ULOC",
                litres: <?php echo $total_uncommented_loc ?>
            }
        ];
        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";
        series.slices.template.events.on("hit", function(ev) {
            window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
        });


        // chart 2 

        // Set data
        <?php

        $total_loc = $MI_col->aggregate(array('$group' => array('_id' => 'null', "TotalLLoc" => array('$sum' => '$LLOC'))));
        $distinct_components = $MI_col->distinct("Component_Type");
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
            $comp_total_loc = $MI_col->aggregate(array('$match' => array("Component_Type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$LLOC'))));
            foreach ($comp_total_loc as $c) {
                foreach ($c as $c1) {
                    $lloc_array[$distinct_component] = $c1['TotalLLoc'];
                }
            }
        }
        foreach ($distinct_components as  $distinct_component) {
            $comp_total_cloc = $MI_col->aggregate(array('$match' => array("Component_Type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$CLOC'))));

            foreach ($comp_total_cloc as $c) {

                foreach ($c as $c1) {
                    $cloc_array[$distinct_component] = $c1['TotalLLoc'];
                }
            }
        }
        foreach ($distinct_components as  $distinct_component) {
            $comp_total_uloc = $MI_col->aggregate(array('$match' => array("Component_Type" => $distinct_component)), array('$group' => array('_id' => 'null', 'TotalLLoc' => array('$sum' => '$ULOC'))));

            foreach ($comp_total_uloc as $c) {

                foreach ($c as $c1) {
                    $uloc_array[$distinct_component] = $c1['TotalLLoc'];
                }
            }
        }

        ?>
        var chart = am4core.create("chartdiv2", am4charts.PieChart);
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
                            type: "ULOC",
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
        });

        // ***************************************************************************
        // chart 3 
        // *********************************************************************

        // Create chart instance
        var chart = am4core.create("chartdiv3", am4charts.XYChart);

        // Add data
        chart.data = [{
            "category": "Table",
            "withIndex": 137,
            "withoutIndex": 1130
        }];

        // Create axes
        var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.numberFormatter.numberFormat = "#";
        categoryAxis.renderer.inversed = true;
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.cellStartLocation = 0.1;
        categoryAxis.renderer.cellEndLocation = 0.9;

        var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.opposite = true;

        // Create series
        function createSeries(field, name) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "category";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueX}[/]";
            series.columns.template.height = am4core.percent(100);
            series.sequencedInterpolation = true;

            var valueLabel = series.bullets.push(new am4charts.LabelBullet());
            valueLabel.label.text = "{valueX}";
            valueLabel.label.horizontalCenter = "left";
            valueLabel.label.dx = 10;
            valueLabel.label.hideOversized = false;
            valueLabel.label.truncate = false;

            var categoryLabel = series.bullets.push(new am4charts.LabelBullet());
            categoryLabel.label.text = "{name}";
            categoryLabel.label.horizontalCenter = "right";
            categoryLabel.label.dx = -10;
            categoryLabel.label.fill = am4core.color("#fff");
            categoryLabel.label.hideOversized = false;
            categoryLabel.label.truncate = false;
        }

        createSeries("withIndex", "With Index");
        createSeries("withoutIndex", "Without Index");


        // *********************************************************************
        //  chart 4
        // *********************************************************************

        // Create chart instance
        var chart = am4core.create("chartdiv4", am4charts.XYChart3D);
        chart.paddingBottom = 30;
        chart.angle = 35;

        // Add data
        chart.data = [{
            "files": "VSAM files",
            "count": 47
        }, {
            "files": "Flat files",
            "count": 6434
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "files";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.inside = true;
        categoryAxis.renderer.grid.template.disabled = true;

        let labelTemplate = categoryAxis.renderer.labels.template;
        labelTemplate.rotation = -90;
        labelTemplate.horizontalCenter = "left";
        labelTemplate.verticalCenter = "middle";
        labelTemplate.dy = 10; // moves it a bit down;
        labelTemplate.inside = false; // this is done to avoid settings which are not suitable when label is rotated

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.grid.template.disabled = true;

        // Create series
        var series = chart.series.push(new am4charts.ConeSeries());
        series.dataFields.valueY = "count";
        series.dataFields.categoryX = "files";

        var columnTemplate = series.columns.template;
        columnTemplate.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        })

        columnTemplate.adapter.add("stroke", function(stroke, target) {
            return chart.colors.getIndex(target.dataItem.index);
        })



        // **********************************************************************
        // chart 5
        // **********************************************************************


        var data = [{
            "component": "COBOL",
            "totalComponent": 500,
            "pie": [{
                "value": 150,
                "title": "CLOC"
            }, {
                "value": 100,
                "title": "ULOC"
            }]
        }, {
            "component": "COPYBOOK",
            "totalComponent": 300,
            "pie": [{
                "value": 130,
                "title": "CLOC"
            }, {
                "value": 90,
                "title": "Cat #3"
            }]
        }];


        // Create chart instance
        var chart = am4core.create("chartdiv5", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        // Add data
        chart.data = data;

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "component";
        categoryAxis.renderer.grid.template.disabled = true;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Total Component";
        valueAxis.min = 0;
        valueAxis.renderer.baseGrid.disabled = true;
        valueAxis.renderer.grid.template.strokeOpacity = 0.07;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "totalComponent";
        series.dataFields.categoryX = "component";
        series.tooltip.pointerOrientation = "vertical";


        var columnTemplate = series.columns.template;
        // add tooltip on column, not template, so that slices could also have tooltip
        columnTemplate.column.tooltipText = "Component: {categoryX}\nTotal: {valueY}";
        columnTemplate.column.tooltipY = 0;
        columnTemplate.column.cornerRadiusTopLeft = 20;
        columnTemplate.column.cornerRadiusTopRight = 20;
        columnTemplate.strokeOpacity = 0;


        // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
        columnTemplate.adapter.add("fill", function(fill, target) {
            var color = chart.colors.getIndex(target.dataItem.index * 3);
            return color;
        });

        // create pie chart as a column child
        var pieChart = series.columns.template.createChild(am4charts.PieChart);
        pieChart.width = am4core.percent(80);
        pieChart.height = am4core.percent(80);
        pieChart.align = "center";
        pieChart.valign = "middle";
        pieChart.dataFields.data = "pie";

        var pieSeries = pieChart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "value";
        pieSeries.dataFields.category = "title";
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;
        pieSeries.slices.template.stroke = am4core.color("#ffffff");
        pieSeries.slices.template.strokeWidth = 1;
        pieSeries.slices.template.strokeOpacity = 0;

        pieSeries.slices.template.adapter.add("fill", function(fill, target) {
            return am4core.color("#ffffff")
        });

        pieSeries.slices.template.adapter.add("fillOpacity", function(fillOpacity, target) {
            return (target.dataItem.index + 1) * 0.2;
        });

        pieSeries.hiddenState.properties.startAngle = -90;
        pieSeries.hiddenState.properties.endAngle = 270;

        // *************************************************************************************
        // chart 6
        // *************************************************************************************



        // *************************************************************************************
        // chart 7
        // *************************************************************************************

        // Create chart instance
        var chart = am4core.create("chartdiv7", am4charts.XYChart);

        // Add percent sign to all numbers
        // chart.numberFormatter.numberFormat = "#.#'%'";

        // Add data
        chart.data = [{
            "transaction": "Transaction",
            "active": 1325,
            "inactive": 485
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "transaction";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Value";
        valueAxis.title.fontWeight = 800;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "active";
        series.dataFields.categoryX = "transaction";
        series.clustered = false;
        series.tooltipText = "Active Transaction: [bold]{valueY}[/]";

        var series2 = chart.series.push(new am4charts.ColumnSeries());
        series2.dataFields.valueY = "inactive";
        series2.dataFields.categoryX = "transaction";
        series2.clustered = false;
        series2.columns.template.width = am4core.percent(50);
        series2.tooltipText = "Inactive Transaction: [bold]{valueY}[/]";

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.disabled = true;
        chart.cursor.lineY.disabled = true;
    </script>
</body>

</html>