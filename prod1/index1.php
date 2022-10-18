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
	.amcharts-chart-div > a {
    display: none !important;
}

    /* #chartdiv {
        width: 100%;
        height: 500px;
    } */
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
        <?php include 'header.php'; ?>
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
						<?php include('tiles_data.php'); ?>						
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
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($components_count); ?>">0</span><span></span>
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
                                                <span data-counter="counterup" data-value="<?php echo number_format($loc_count); ?>">0</span>
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
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($table_withIndex_count); ?>">0</span>
                                            </div>
                                            <!-- <div class="desc"> <b> Cost of Quality </b> <br> <small> <b> -20% </B> QoQ </small> </div> -->
                                            <div class="desc"> <b>Total no. of DB2 Tables </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Total number of PS/flat files and VSAM files used in the application">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="6,481"></span> </div>
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
                                                        <span class="caption-subject font-dark bold">Total DB2 Tables</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv15" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold">VSAM and Flat Files</span>
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
                                    <a class="dashboard-stat dashboard-stat-v2 yellow" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of Orphan components that are in the application, but no longer being actively invoked or used by other components">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($orphan_count); ?>">0</span><span></span>
                                            </div>
                                            <div class="desc"><b> Total Orphan Components</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green-turquoise" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of Dead transaction or JCLs that are in the application, but have not being executed in the last six months">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1,607">0</span> </div>
                                            <div class="desc"> <b> Total Dead Components</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red-flamingo" data-toggle="tooltip" data-placement="bottom" title="Overall technical debt found in the entire application" href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span></span><span data-counter="counterup" data-value="<?php echo $total_percentage ?>%"></span>
                                            </div>
                                            <div class="desc"> <b>Overall Dead Component %</b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue-madison" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Total number of components that are actively being invoked, but source code is not available">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo number_format($missing_count); ?>"></span></div>
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
                                                        <span class="caption-subject font-dark bold">Dead Component %</span>
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
                                                        <span class="caption-subject font-dark bold">Total Missing Components</span>
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
                                    <a class="dashboard-stat dashboard-stat-v2 green-jungle" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of online transactions that are in the application">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span></span><span data-counter="counterup" data-value="2,085">0</span><span></span>
                                            </div>
                                            <div class="desc"><b> Total No of Transactions </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red-thunderbird" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of online transactions that are being actively triggered in the last six months">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo number_format($activeTrans_count); ?>">0</span> </div>
                                            <div class="desc"> <b> Total No of Active Transactions</b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple-studio" data-toggle="tooltip" data-placement="bottom" title="Total number of batch jobs that are in the application" href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($static_call + $dynamic_call); ?>">0</span>
                                            </div>
                                            <div class="desc"> <b> Total no. of JCL's </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 yellow-saffron" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Total number of batch jobs that are being actively triggered in the last six months">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo number_format($active_jcl);?>"></span> </div>
                                            <div class="desc">
                                                <B> Total no. of Active JCL's </B> </div>
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
                                                        <span class="caption-subject font-dark bold">No of Transactions</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv9" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold">Active & Inactive Transactions</span>
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold">Total no. of JCL's</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv11" class="" style="height:200px;"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold">Active JCL's </span>
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
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:-5px" id="row4">
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple-plum" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of Db2 tables that are being actively used in the application">
                                        <div class="visual">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                        <div class="details">
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                            <div class="number">
                                                <!--style="padding-left:160px;font-size:20px;color:white"-->
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($totalCrud); ?>">0</span><span></span>
                                            </div>
                                            <div class="desc"><b> CRUD operations count </b></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green-sharp" href="#" data-toggle="tooltip" data-placement="bottom" title="Total number of DB2 operations performed in the application">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo number_format($total_Crud); ?>">0</span> </div>
                                            <div class="desc"> <b> CRUD Single Tables count </b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 yellow-casablanca" data-toggle="tooltip" data-placement="bottom" title="Total number of tables that has only single type of operations performed over it, and most likely a technical debt" href="#thirdscroll">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span></span><span data-counter="counterup" data-value="<?php echo number_format($table_withIndex_count);?>">0</span>
                                            </div>
                                            <div class="desc"> <b> Tables Without Index</b> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3  col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay" style="cursor:default" data-toggle="tooltip" data-placement="bottom" href="#" title="Total number of tables that has operations being performed over it, but not found in system catalog">
                                        <div class="visual">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="6,956"></span> </div>
                                            <div class="desc">
                                                <B> Total Occurace of Cloned Queries</B> </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row animated ease-in-out" id="showDiv4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-equalizer font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold">Crud Operation</span>
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
                                                        <span class="caption-subject font-dark bold">CRUD Single operations</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="chartdiv14" class="" style="height:200px;"> </div>
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
                                                        <span class="caption-subject font-dark bold">Tables without Index</span>
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
                                                        <span class="caption-subject font-dark bold">Total Occurace of Cloned Queries</span>
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
                            <a data-toggle="modal" href="#" id="Portfolio">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12" id="mydiv">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high1">
                                        <h4 class="widget-thumb-heading">Missing Tables</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-blue fa fa-briefcase"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="26">0</span>
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
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high2">
                                        <h4 class="widget-thumb-heading">Fields not used in Table</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red fa fa-desktop"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"> </span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="76">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a data-toggle="modal" href="#" id="People">
                                <!--responsive-->
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase" id="high3">
                                        <h4 class="widget-thumb-heading">Static COBOL Count</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-users" style="background-color:#98b4bb"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($static_call); ?>">0</span>
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
                                        <h4 class="widget-thumb-heading">Dynamic COBOL Count</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-wrench" style="background-color:#738989"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($dynamic_call); ?>">0</span>
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
                                        <h4 class="widget-thumb-heading">Source Module Without Load</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon  bg-green fa fa-user-plus"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($sourceNA);?>">0</span>
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
                                        <h4 class="widget-thumb-heading">Load Module Without Source</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple fa fa-line-chart"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($loadNA);?>">0</span>
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
        <div class="page-footer-inner"> 2017 &copy; DevOps Tool By
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
        // google.charts.load('current', {
            // 'packages': ['corechart']
        // });
        // google.charts.setOnLoadCallback(drawSeriesChart);

        // function drawSeriesChart() {

            // var data = google.visualization.arrayToDataTable([
                // ['ID', 'Incidents', 'Revenue', 'Portfolio', 'Cost in $'],
                // ['Q1', 70.3, 20.54, 'Trade Finance', 65000],
                // ['Q2', 45.5, 17.43, 'Trade Finance', 58000],
                // ['Q3', 30.4, 15.56, 'Trade Finance', 52000],
                // ['Q4', 20.7, 12.43, 'Trade Finance', 25000],
                // ['Q1', 32.2, 15.44, 'Investments', 62000],
                // ['Q2', 31.0, 20.45, 'Investments', 57000],
                // ['Q3', 59.1, 25.56, 'Investments', 53000],
                // ['Q4', 40.3, 20.77, 'Investments', 47000],
                // ['Q1', 45.4, 15.43, 'Cards', 42000],
                // ['Q2', 36.3, 12.14, 'Cards', 45000],
                // ['Q3', 66.3, 10.35, 'Cards', 25000],
                // ['Q4', 21.2, 08.36, 'Cards', 33000],
                // ['Q1', 15.7, 15.57, 'Retail Banking', 44000],
                // ['Q2', 40.3, 12.23, 'Retail Banking', 45000],
                // ['Q3', 55.2, 10.34, 'Retail Banking', 53000],
                // ['Q4', 31.8, 08.12, 'Retail Banking', 24500],
                // ['Q1', 55.4, 15.23, 'Loan', 65000],
                // ['Q2', 60.7, 12.34, 'Loan', 43000],
                // ['Q3', 52.3, 10.54, 'Loan', 20000],
                // ['Q4', 51.6, 08.54, 'Loan', 38000],
            // ]);

            // var options = {
                // // title: 'Correlation between incidents, defects on costs for Portfolio',
                // hAxis: {
                    // title: 'Incidents'
                // },
                // vAxis: {
                    // title: 'Revenue'
                // },
                // colors: ['#52D0E6', '#1981A4', '#65909A', '2F4F4F', '98F5FF'],
                // bubble: {
                    // textStyle: {
                        // auraColor: 'none',
                        // fontSize: 11
                    // }
                // }
            // };

            // var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
            // chart.draw(data, options);
        // }
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        // var slideIndex = 1;
        // showDivs(slideIndex);

        // function plusDivs(n) {
            // showDivs(slideIndex += n);
        // }

        // function showDivs(n) {
            // var i;
            // var x = document.getElementsByClassName("mySlides");
            // if (n > x.length) {
                // slideIndex = 1
            // }
            // if (n < 1) {
                // slideIndex = x.length
            // }
            // for (i = 0; i < x.length; i++) {
                // x[i].style.display = "none";
            // }
            // x[slideIndex - 1].style.display = "block";
        // }
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        // FusionCharts.ready(function() {
            // var cpuGauge = new FusionCharts({
                    // type: 'hlineargauge',
                    // renderAt: 'chart-container',
                    // id: 'cpu-linear-gauge',
                    // width: '320',
                    // height: '80',
                    // dataSource: {
                        // "chart": {
                            // "theme": "fint",
                            // "caption": "",
                            // "lowerLimit": "0",
                            // "upperLimit": "100",
                            // "numberSuffix": "",
                            // "chartBottomMargin": "20",
                            // "toolTipBgColor": "#fff",
                            // "valueFontSize": "0",
                            // "showTickMarks": "0",
                            // "showTickValues": "0",
                            // "valueFontBold": "0",
                            // "placeValuesInside": "0",
                            // "gaugeFillMix": "{light-33},{light-33},{dark-33}",
                            // "gaugeFillRatio": "40,20,40"
                        // },
                        // "colorRange": {
                            // "color": [{
                                    // "minValue": "0",
                                    // "maxValue": "20",
                                    // "label": "L0",
                                    // "code": " #98f5ff"
                                // }, {
                                    // "minValue": "20",
                                    // "maxValue": "40",
                                    // "label": "L1",
                                    // "code": " #39b7cd "
                                // }, {
                                    // "minValue": "40",
                                    // "maxValue": "60",
                                    // "label": "L2",
                                    // "code": "#00688b"
                                // },
                                // {
                                    // "minValue": "60",
                                    // "maxValue": "80",
                                    // "label": "L3",
                                    // "code": "#65909a"
                                // },
                                // {
                                    // "minValue": "80",
                                    // "maxValue": "100",
                                    // "label": "L4",
                                    // "code": "#2f4f4f"
                                // }
                            // ]
                        // },
                        // "pointers": {
                            // "pointer": [{
                                // "toolText": " ",

                                // "value": "30"
                            // }]
                        // }
                    // }
                // })
                // .render();
        // });
    </script>
    <!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <!-- amcharts -->
	<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="//www.amcharts.com/lib/3/serial.js"></script>
	<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
	
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://www.amcharts.com/lib/4/plugins/sunburst.js"></script>
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
		$VSAM_col = $db->VSAM;
		$QueryWindex_col = $db->QueriesWindex;
		$TableWindex_col = $db->tableWindex;
		$Transaction_col = $db->Online_trans;
		$total_transaction = $db->total_transaction;
        ?>
		
		<script>
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        var chart = am4core.create("chartdiv1", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        //chart.legend = new am4charts.Legend();
        <?php
		$distinct_components = $MI_col->distinct("Component_Type");
		$component_arr = array();
		foreach($distinct_components as $distinct_component){
			$count = $MI_col->find(array("Component_Type"=>$distinct_component))->count();
			$component_arr[$distinct_component] = $count;
		}
        ?>
        chart.data = [
			<?php
			foreach($component_arr as $key=>$value){
			?>
			{
                country: "<?php echo $key;?>",
                litres: <?php echo $value; ?>
            },
			
			<?php
			}
			?>
        ];
        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";
        series.slices.template.events.on("hit", function(ev) {
            window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
        });
		
    </script>
	<script>
        // chart 2 
		am4core.useTheme(am4themes_animated);
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
			
			chart.legend = new am4charts.Legend();
        });
		</script>
		
		<script>
		
        // ***************************************************************************
        // chart 3 
        // *********************************************************************
		am4core.useTheme(am4themes_animated);
        // Create chart instance
        var chart = am4core.create("chartdiv3", am4charts.XYChart);
		<?php 
			$table_withIndex_count = $TableWindex_col->find(array("Table wth Index"=>"Yes"))->count();
			$table_withNoIndex_count = $TableWindex_col->find(array("Table wth Index"=>"No"))->count();
		?>
        // Add data
        chart.data = [{
            "category": "Table",
            "withIndex": <?php echo $table_withIndex_count ?>,
            "withoutIndex": <?php echo $table_withNoIndex_count ?>
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

		</script>
		<script>
        // *********************************************************************
        //  chart 4
        // *********************************************************************
        // Create chart instance
		am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv4", am4charts.XYChart3D);
        chart.paddingBottom = 30;
        chart.angle = 35;

        // Add data
        chart.data = [{
            "year": "VSAM files",
            "income": 47,
			"color": chart.colors.next()
        }, {
            "year": "Flat files",
            "income": 6434,
			"color": chart.colors.next()
        }];

       // Create axes
		var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "year";
		//categoryAxis.numberFormatter.numberFormat = "#";
		categoryAxis.renderer.inversed = true;
		
		var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 
		
		// Create series
		var series = chart.series.push(new am4charts.ColumnSeries3D());
		series.dataFields.valueX = "income";
		series.dataFields.categoryY = "year";
		series.name = "Income";
		series.columns.template.propertyFields.fill = "color";
		series.columns.template.tooltipText = "{valueX}";
		series.columns.template.column3D.stroke = am4core.color("#fff");
		series.columns.template.column3D.strokeOpacity = 0.2;
		</script>
        
		<script>
		// **********************************************************************
        // chart 5
        // **********************************************************************
		am4core.useTheme(am4themes_animated);
		// Create chart instance
        //var chart = am4core.create("chartdiv4", am4charts.XYChart3D);
		var container = am4core.create("chartdiv5", am4core.Container);
		
		container.width = am4core.percent(100);
		container.height = am4core.percent(100);
		container.layout = "horizontal";


		var chart = container.createChild(am4charts.PieChart);
		<?php
			$distinct_components = $MI_col->distinct("Component_Type");
			?>
		chart.data = [
			<?php
		
				foreach($distinct_components as $distinct_component)
				{
					if($dstinct_component != "UNFOUND" &&(($MI_col->find(array("Component_Type"=>$distinct_component,"Orphan"=>"Yes"))->count())>0))
					{
					//echo "@@@$distinct_component";
					$lloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"LLOC"=>array('$sum'=>'$LLOC'))));
					$uloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"ULOC"=>array('$sum'=>'$ULOC'))));
					$cloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"CLOC"=>array('$sum'=>'$CLOC'))));
						foreach($lloc_agg as $lloc_obj)
						{
								foreach($lloc_obj as $lloc_obj1)
									$orp_lloc = $lloc_obj1['LLOC'];
								
						}
						foreach($uloc_agg as $uloc_obj)
						{
								foreach($uloc_obj as $uloc_obj1)
									$orp_uloc = $uloc_obj1['ULOC'];
								
						}
						foreach($cloc_agg as $cloc_obj)
						{
								foreach($cloc_obj as $uloc_obj1)
									$orp_cloc = $uloc_obj1['CLOC'];
								
						}
						
					
							
			?>
							{
							"type": "<?php echo $distinct_component; ?>",
							"litres":<?php echo $orp_lloc;?>,
							"subData": [ { name: "ULOC", value: <?php echo $orp_uloc ?> }, { name: "CLOC", value: <?php echo $orp_cloc ?> }]
						},
		<?php
								
						
					}
				}
		?>
		
		];

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "litres";
		pieSeries.dataFields.category = "type";
		pieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;
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
		pieSeries2.alignLabels = false;
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
		var animation = pieSeries.animate([{ property: "startAngle", to: firstAngle - middleAngle }, { property: "endAngle", to: firstAngle - middleAngle + 360 }], 600, am4core.ease.sinOut);
		animation.events.on("animationprogress", updateLines);
		
		selectedSlice.events.on("transformed", updateLines);
		
		//  var animation = chart2.animate({property:"dx", from:-container.pixelWidth / 2, to:0}, 2000, am4core.ease.elasticOut)
		//  animation.events.on("animationprogress", updateLines)
		}
		
		
		function updateLines() {
		if (selectedSlice) {
			var p11 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle) };
			var p12 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle + selectedSlice.arc), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle + selectedSlice.arc) };
		
			p11 = am4core.utils.spritePointToSvg(p11, selectedSlice);
			p12 = am4core.utils.spritePointToSvg(p12, selectedSlice);
		
			var p21 = { x: 0, y: -pieSeries2.pixelRadius };
			var p22 = { x: 0, y: pieSeries2.pixelRadius };
		
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
		// *************************************************************************************
        // chart 6
        // *************************************************************************************
		
			//am4core.useTheme(am4themes_dataviz);
			am4core.useTheme(am4themes_animated);
			var chart = am4core.create("chartdiv6", am4charts.RadarChart);
			<?php
				$jcl_count = $MI_col->find(array("Component_Type"=>"JCL","Dead_Jobs"=>"Yes"))->count();
				$trans_count = $MI_col->find(array("Component_Type"=>"TRANSACTION","Dead_Jobs"=>"Yes"))->count();
			?>
			
			
			// Add data
			chart.data = [{
			"category": "JCL",
			"value": <?php echo $jcl_count;?>,
			//"full": 2000
			}, {
			"category": "TRANSACTION",
			"value": <?php echo $trans_count; ?>,
			//"full": 1000
			}];
			
			// Make chart not full circle
			chart.startAngle = -90;
			chart.endAngle = 180;
			chart.innerRadius = am4core.percent(20);
			
			// Set number format
			//chart.numberFormatter.numberFormat = "#.#'%'";
			
			// Create axes
			var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "category";
			categoryAxis.renderer.grid.template.location = 0;
			categoryAxis.renderer.grid.template.strokeOpacity = 0;
			categoryAxis.renderer.labels.template.horizontalCenter = "right";
			categoryAxis.renderer.labels.template.fontWeight = 500;
			categoryAxis.renderer.labels.template.adapter.add("fill", function(fill, target) {
			return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
			});
			categoryAxis.renderer.minGridDistance = 10;
			
			var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
			valueAxis.renderer.grid.template.strokeOpacity = 0;
			valueAxis.min = 0;
			valueAxis.max = 100;
			valueAxis.strictMinMax = true;
			
			// Create series
			var series1 = chart.series.push(new am4charts.RadarColumnSeries());
			series1.dataFields.valueX = "full";
			series1.dataFields.categoryY = "category";
			series1.clustered = false;
			series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
			series1.columns.template.fillOpacity = 0.08;
			series1.columns.template.cornerRadiusTopLeft = 20;
			series1.columns.template.strokeWidth = 0;
			series1.columns.template.radarColumn.cornerRadius = 20;
			
			var series2 = chart.series.push(new am4charts.RadarColumnSeries());
			series2.dataFields.valueX = "value";
			series2.dataFields.categoryY = "category";
			series2.clustered = false;
			series2.columns.template.strokeWidth = 0;
			series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
			series2.columns.template.radarColumn.cornerRadius = 20;
			
			series2.columns.template.adapter.add("fill", function(fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
			});
			
			// Add cursor
			chart.cursor = new am4charts.RadarCursor();
		</script>

        
		<script>
		// *************************************************************************************
        // chart 7
        // *************************************************************************************
		
		var chart = AmCharts.makeChart( "chartdiv7", {
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
		$orphan_loc_agg =  $MI_col->aggregate(array('$match'=>array("Orphan"=>"Yes")),array('$group'=>array('_id'=>'null','Orphan_Loc'=>array('$sum'=>'$LLOC'))));
		$orphan_loc_count = $orphan_loc_agg['result'][0]['Orphan_Loc'] ;
		
		$loc_count_agg =  $MI_col->aggregate(array('$group'=>array('_id'=>'null','Total_Loc'=>array('$sum'=>'$LLOC'))));
		$loc_count = $loc_count_agg['result'][0]['Total_Loc'] ;
		
		$loc_count_jcl =  $MI_col->aggregate(array('$match'=>array("Component_Type"=>"JCL")),array('$group'=>array('_id'=>'null','Total_Loc'=>array('$sum'=>'$LLOC'))));
		$loc_count_jcl = $loc_count_jcl['result'][0]['Total_Loc'] ;
		
		$dead_loc_agg =  $MI_col->aggregate(array('$match'=>array("Dead_Jobs"=>"Yes")),array('$group'=>array('_id'=>'null','Dead_Loc'=>array('$sum'=>'$LLOC'))));
		$dead_loc_count = $dead_loc_agg['result'][0]['Dead_Loc'] ;
		
		$dropImpact_loc_agg =  $MI_col->aggregate(array('$match'=>array("Drop_Impact"=>"Yes")),array('$group'=>array('_id'=>'null','Drop_Impact'=>array('$sum'=>'$LLOC'))));
		$dropImpact_loc_count = $dropImpact_loc_agg['result'][0]['Drop_Impact'] ;
		
		$orphan_percentage = number_format((($orphan_loc_count/$loc_count)*100),2);
		$dead_percentage = number_format((($dead_loc_count/$loc_count)*100),2);
		$drop_impact_percentage = number_format((($dropImpact_loc_count/$loc_count)*100),2);
		
		?>
		"dataProvider": [  {
			"year": "Orphan",
			"Orphan Components percentage": <?php echo $orphan_percentage; ?>,
			//"Components": 100 - <?php echo $dead_percentage; ?>,
		},{
			"year": "Drop Impact",
			"Drop Impact Percentage": <?php echo $drop_impact_percentage; ?>,
			//"Components": 100 - <?php echo $drop_impact_percentage; ?>,
		},{
			"year": "Dead Jobs",
			"Dead Components Percentage": <?php echo $dead_percentage; ?>,
			//"Components": 100 - <?php echo $drop_impact_percentage; ?>,
		}],
		"valueAxes": [ {
			"stackType": "regular",
			"axisAlpha": 0,
			"gridAlpha": 0
		} ],
		"graphs": [ {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
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
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "Dead Components",
			"type": "column",
			"color": "#000000",
			"valueField": "Dead Components Percentage"
		}, {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "Drop Impact Components",
			"type": "column",
			"color": "#000000",
			"valueField": "Drop Impact Percentage"
		}  ],
		"categoryField": "year",
		"categoryAxis": {
			"gridPosition": "start",
			"axisAlpha": 0,
			"gridAlpha": 0,
			"position": "left"
		},
		"export": {
			"enabled": true
		}
		
		} );
		</script>
		
		<script>
		// *************************************************************************************
        // chart 8
        // *************************************************************************************
        // Create chart instance
        var chart = am4core.create("chartdiv8", am4charts.PieChart);
		chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
        <?php

		$missing_components_array = array();
		
		foreach($distinct_components as $distinct_component)
		{
		
		$type = $distinct_component;
		//echo "~$distinct_component";
		$value = $missing_components_col->find(array("Type"=>$distinct_component))->count();
		$missing_components_array[$type] = $value;
		}
		
		//print_r($missing_components_array);
		?>
		chart.data = [
		<?php
		foreach($missing_components_array as $key => $value)
		{
		if($key != "UNFOUND")
		
		{
		?>
			{
			type: "<?php echo $key;?>",
			value: <?php echo $value;?>
			},
			
			<?php
			}
			}
			?>
		];
		var series = chart.series.push(new am4charts.PieSeries());
		series.dataFields.value = "value";
		series.dataFields.radiusValue = "value";
		series.dataFields.category = "type";
		series.slices.template.cornerRadius = 6;
		series.colors.step = 3;
		
		series.hiddenState.properties.endAngle = -90;
		
		//chart.legend = new am4charts.Legend();
		</script>
		
		<script>
		// *************************************************************************************
        // chart 9
        // *************************************************************************************
		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end
		
		var chart = am4core.create("chartdiv9", am4charts.XYChart3D);
		
		<?php
		$transactions = $total_transaction->find()->sort(array("Count"=>-1))->limit(10);
		$trans_arr = array();
		foreach($transactions as $transaction){
			$name = $transaction['TRANSACTION Name'];
			$count = $transaction['Count'];
			$trans_arr[$name] = $count;
		}
		?>
			chart.data = [
				<?php
				foreach($trans_arr as $key=>$value){
					?>
				{
				"country": "<?php echo $key; ?>",
				"visits": <?php echo $value;?>,
				},
			<?php
		}
			?>
				];
		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "country";
		categoryAxis.renderer.labels.template.rotation = 270;
		categoryAxis.renderer.labels.template.hideOversized = false;
		categoryAxis.renderer.minGridDistance = 20;
		categoryAxis.renderer.labels.template.horizontalCenter = "right";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.tooltip.label.rotation = 270;
		categoryAxis.tooltip.label.horizontalCenter = "right";
		categoryAxis.tooltip.label.verticalCenter = "middle";
		
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		//valueAxis.title.text = "Countries";
		//valueAxis.title.fontWeight = "bold";
		
		// Create series
		var series = chart.series.push(new am4charts.ColumnSeries3D());
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
		return chart.colors.getIndex(target.dataItem.index);
		})
		
		columnTemplate.adapter.add("stroke", function(stroke, target) {
		return chart.colors.getIndex(target.dataItem.index);
		})
		
		chart.cursor = new am4charts.XYCursor();
		chart.cursor.lineX.strokeOpacity = 0;
		chart.cursor.lineY.strokeOpacity = 0;
		</script>
		
		
		<script>
		// *************************************************************************************
        // chart 10
        // *************************************************************************************
		am4core.useTheme(am4themes_animated);
        // Create chart instance
        var chart = am4core.create("chartdiv10", am4charts.XYChart);

        // Add percent sign to all numbers
        // chart.numberFormatter.numberFormat = "#.#'%'";
		<?php
		$activeTrans_count = $Transaction_col->find(array("Status"=>"Active"))->count();
		$InactiveTrans_count = $Transaction_col->find(array("Status"=>"Inactive"))->count();
		?>
        // Add data
        chart.data = [{
            "transaction": "Transaction",
            "active": <?php echo $activeTrans_count;?>,
            "inactive": <?php echo $InactiveTrans_count;?>
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
		
		<script>
		// *************************************************************************************
        // chart 11
        // *************************************************************************************
		am4core.useTheme(am4themes_animated);
        // Create chart instance
        //var chart = am4core.create("chartdiv11", am4charts.XYChart3D);
		
		</script>
		
		<script>
		
		// *************************************************************************************
        // chart 12
        // *************************************************************************************
		
		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end
		var chart = am4core.create("chartdiv12", am4charts.XYChart);
		<?php
		$active_jcl = $MI_col->find(array("Component_Type"=>"JCL","Dead_Jobs"=>"No"))->count();
		$Inactive_jcl = $MI_col->find(array("Component_Type"=>"JCL","Dead_Jobs"=>"Yes"))->count();
		?>
	
		chart.data = [
		{
		"country": "Active JCL",
		"visits": <?php echo $active_jcl; ?>
		}, {
		"country": "Inactive",
		"visits": <?php echo $Inactive_jcl; ?>
		}];
		// Create axes

		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "country";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 30;
		
		categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
		if (target.dataItem && target.dataItem.index & 2 == 2) {
			return dy + 25;
		}
		return dy;
		});
		
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		
		// Create series
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.dataFields.valueY = "visits";
		series.dataFields.categoryX = "country";
		series.name = "Visits";
		series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
		series.columns.template.fillOpacity = .8;
		
		var columnTemplate = series.columns.template;
		columnTemplate.strokeWidth = 2;
		columnTemplate.strokeOpacity = 1;
		</script>
		
		
		<script>
		// *************************************************************************************
        // chart 13
        // *************************************************************************************
        // Create chart instance
		am4core.useTheme(am4themes_animated);
		<?php
		$total_crud_count = $crudcol->count();
		$create = $crudcol->find(array("Operation"=>"CREATE"))->count();
		$read = $crudcol->find(array("Operation"=>"READ"))->count();
		$update = $crudcol->find(array("Operation"=>"UPDATE"))->count();
		$delete = $crudcol->find(array("Operation"=>"DELETE"))->count();
		$insert = $crudcol->find(array("Operation"=>"INSERT"))->count();
		
		?>
		 var data = [{
			"type": "Dummy",
			"disabled": true,
			"value": 0,
			"color": am4core.color("#dadada"),
			"opacity": 0.3,
			"strokeDasharray": "4,4"
		}, {
			"type": "Insert",
			"value": <?php echo $insert; ?>
		}, {
			"type": "Read",
			"value": <?php echo $read; ?>
		}, {
			"type": "Update",
			"value": <?php echo $update; ?>
		}, {
			"type": "Delete",
			"value": <?php echo $delete; ?>
		}];

         // cointainer to hold both charts
		var container = am4core.create("chartdiv13", am4core.Container);
		container.width = am4core.percent(100);
		container.height = am4core.percent(100);
		container.layout = "horizontal";
		
		container.events.on("maxsizechanged", function () {
			chart1.zIndex = 0;
			separatorLine.zIndex = 1;
			dragText.zIndex = 2;
			chart2.zIndex = 3;
		})
		
		var chart1 = container.createChild(am4charts.PieChart);
		chart1 .fontSize = 11;
		chart1.hiddenState.properties.opacity = 0; // this makes initial fade in effect
		chart1.data = data;
		chart1.radius = am4core.percent(70);
		chart1.innerRadius = am4core.percent(40);
		chart1.zIndex = 1;
		
		var series1 = chart1.series.push(new am4charts.PieSeries());
		series1.dataFields.value = "value";
		series1.dataFields.category = "type";
		series1.colors.step = 2;
		series1.alignLabels = false;
		series1.labels.template.bent = true;
		series1.labels.template.radius = 3;
		series1.labels.template.padding(0,0,0,0);
		
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
		
		sliceTemplate1.events.on("down", function (event) {
			event.target.toFront();
			// also put chart to front
			var series = event.target.dataItem.component;
			series.chart.zIndex = zIndex++;
		})
		
		series1.ticks.template.disabled = true;
		
		sliceTemplate1.states.getKey("active").properties.shiftRadius = 0;
		
		sliceTemplate1.events.on("dragstop", function (event) {
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
		var chart3 = container.createChild(am4charts.PieChart);
		chart3.hiddenState.properties.opacity = 0; // this makes initial fade in effect
		chart3 .fontSize = 11;
		chart3.radius = am4core.percent(70);
		chart3.data = data;
		chart3.innerRadius = am4core.percent(40);
		chart3.zIndex = 1;
		
		var series2 = chart3.series.push(new am4charts.PieSeries());
		series2.dataFields.value = "value";
		series2.dataFields.category = "type";
		series2.colors.step = 2;
		
		series2.alignLabels = false;
		series2.labels.template.bent = true;
		series2.labels.template.radius = 3;
		series2.labels.template.padding(0,0,0,0);
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
			}
			else if (series2.slices.indexOf(targetSlice) != -1) {
				slice1 = series1.dataItems.getIndex(targetSlice.dataItem.index).slice;
				slice2 = targetSlice;
			}
		
		
			dataItem1 = slice1.dataItem;
			dataItem2 = slice2.dataItem;
		
			var series1Center = am4core.utils.spritePointToSvg({ x: 0, y: 0 }, series1.slicesContainer);
			var series2Center = am4core.utils.spritePointToSvg({ x: 0, y: 0 }, series2.slicesContainer);
		
			var series1CenterConverted = am4core.utils.svgPointToSprite(series1Center, series2.slicesContainer);
			var series2CenterConverted = am4core.utils.svgPointToSprite(series2Center, series1.slicesContainer);
		
			// tooltipY and tooltipY are in the middle of the slice, so we use them to avoid extra calculations
			var targetSlicePoint = am4core.utils.spritePointToSvg({ x: targetSlice.tooltipX, y: targetSlice.tooltipY }, targetSlice);
		
			if (targetSlice == slice1) {
				if (targetSlicePoint.x > container.pixelWidth / 2) {
					var value = dataItem1.value;
		
					dataItem1.hide();
		
					var animation = slice1.animate([{ property: "x", to: series2CenterConverted.x }, { property: "y", to: series2CenterConverted.y }], 400);
					animation.events.on("animationprogress", function (event) {
						slice1.hideTooltip();
					})
		
					slice2.x = 0;
					slice2.y = 0;
		
					dataItem2.show();
				}
				else {
					slice1.animate([{ property: "x", to: 0 }, { property: "y", to: 0 }], 400);
				}
			}
			if (targetSlice == slice2) {
				if (targetSlicePoint.x < container.pixelWidth / 2) {
		
					var value = dataItem2.value;
		
					dataItem2.hide();
		
					var animation = slice2.animate([{ property: "x", to: series1CenterConverted.x }, { property: "y", to: series1CenterConverted.y }], 400);
					animation.events.on("animationprogress", function (event) {
						slice2.hideTooltip();
					})
		
					slice1.x = 0;
					slice1.y = 0;
					dataItem1.show();
				}
				else {
					slice2.animate([{ property: "x", to: 0 }, { property: "y", to: 0 }], 400);
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
			}
			else {
				dummySlice.hide();
			}
		}
		
		series2.events.on("datavalidated", function () {
		
			var dummyDataItem = series2.dataItems.getIndex(0);
			dummyDataItem.show(0);
			dummyDataItem.slice.draggable = false;
			dummyDataItem.slice.tooltipText = undefined;
		
			for (var i = 1; i < series2.dataItems.length; i++) {
				series2.dataItems.getIndex(i).hide(0);
			}
		})
		
		series1.events.on("datavalidated", function () {
			var dummyDataItem = series1.dataItems.getIndex(0);
			dummyDataItem.hide(0);
			dummyDataItem.slice.draggable = false;
			dummyDataItem.slice.tooltipText = undefined;
		})
		
		</script>
		<script>
		// *************************************************************************************
        // chart 14
        // *************************************************************************************
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv14", am4charts.XYChart3D);
		<?php
		$distinct_ops = $crudops->distinct("Operation");
		$crud_only_array = array();
		foreach($distinct_ops as $distinct_op)
		{
		$crud_only_array[$distinct_op] = $crudops->find(array("Operation"=>$distinct_op))->count();
		}
		asort($crud_only_array);
			
		?>
		
		// Add data
		chart.data = [{
			"type": "CRUD Only",
			<?php
			foreach($crud_only_array as $operation=>$count)
			{ 
			?>
			"<?php echo $operation;?>Only": <?php echo $count; ?>,
			<?php
			}
			?>
		}];
		
		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "type";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 30;
		
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "CRUD Operation";
		valueAxis.renderer.labels.template.adapter.add("text", function (text) {
			return text + "";
		});
		
		// Create series
		
		<?php 
		foreach($crud_only_array as $operation=>$count)
			{
		?>
		var <?php echo $operation?>_series = chart.series.push(new am4charts.ColumnSeries3D());
		<?php echo $operation?>_series.dataFields.valueY = "<?php echo $operation;?>Only";
		<?php echo $operation?>_series.dataFields.categoryX = "type";
		<?php echo $operation?>_series.name = "<?php echo $operation;?> Only";
		<?php echo $operation?>_series.clustered = false;
		<?php echo $operation?>_series.columns.template.tooltipText = "<?php echo $operation;?> Only: [bold]{valueY}[/]";
		//series.columns.template.fillOpacity = 0.9;
		<?php
			}
		?>
    </script>
	
	
	<script>
	// *************************************************************************************
    // chart 16
    // *************************************************************************************
	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	// Create chart instance
	var chart = am4core.create("chartdiv16", am4charts.XYChart3D);
	// Add data
	chart.data = [{
	"year": "No. of programs",
	"income": 1958,
	"color": chart.colors.next()
	}, {
	"year": "Distinct Query",
	"income": 2210,
	"color": chart.colors.next()
	}];
	
	// Create axes
	var categoryAxis6 = chart.yAxes.push(new am4charts.CategoryAxis());
	categoryAxis6.dataFields.category = "year";
	//categoryAxis6.numberFormatter.numberFormat = "#";
	categoryAxis6.renderer.inversed = true;
	
	var  valueAxis8 = chart.xAxes.push(new am4charts.ValueAxis()); 
	
	// Create series
	var series5 = chart.series.push(new am4charts.ColumnSeries3D());
	series5.dataFields.valueX = "income";
	series5.dataFields.categoryY = "year";
	series5.name = "Income";
	series5.columns.template.propertyFields.fill = "color";
	series5.columns.template.tooltipText = "{valueX}";
	series5.columns.template.column3D.stroke = am4core.color("#fff");
	series5.columns.template.column3D.strokeOpacity = 0.2
	</script>
	
	<script>
	am4core.useTheme(am4themes_animated);
	var chart = am4core.create("chartdiv15", am4charts.XYChart);
	<?php
	$appName =  $MI_col->aggregate(array('$group'=>array('_id'=>'$Application_Name',
														'Count'=>array('$sum'=>1))),
								array('$sort'=>array('Count'=>-1)));
	?>
	chart.data = [
	<?php 
	for($i=0; $i<=4; $i++){
		//$temp = utf8_encode($appName['result'][$i]['_id']);
		echo "{";
		echo '"country":"'.$appName['result'][$i]['_id'].'",';
		echo '"visits":"'.$appName['result'][$i]['Count'].'"';
		echo "},";
	}
	?>
	];
	
	var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
	categoryAxis.dataFields.category = "country";
	categoryAxis.renderer.grid.template.location = 0;
	categoryAxis.renderer.minGridDistance = 30;
	
	categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
	if (target.dataItem && target.dataItem.index & 2 == 2) {
		return dy + 25;
	}
	return dy;
	});
	
	var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
	
	// Create series
	var series = chart.series.push(new am4charts.ColumnSeries());
	series.dataFields.valueY = "visits";
	series.dataFields.categoryX = "country";
	series.name = "Visits";
	series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
	series.columns.template.fillOpacity = .8;
	
	var columnTemplate = series.columns.template;
	columnTemplate.strokeWidth = 2;
	columnTemplate.strokeOpacity = 1;
	
	</script>
</body>

</html>