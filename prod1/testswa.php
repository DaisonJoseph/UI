<?php require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<style>
	.amcharts-chart-div .cur{
		cursor : pointer;
	}
</style>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"  type="text/javascript" ></script>
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/global/css/scroll.css" type="text/css">
    <link rel="stylesheet" href="new 1.css" type="text/css">
    <link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" type="image/x-icon" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
    <div class="page-wrapper">
      <?php include 'header.php'; ?>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse" style="margin-top: 50px;">
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top : 0px">
                       <li class="nav-item">
                            <a href="index.php" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item start active open">
                            <a href="testing.php" class="nav-link nav-toggle">
                                <i class="fa fa-check-circle"></i>
                                <span class="title">Testing</span>
                                <span class="selected"></span>
                            </a>
                        </li>						
                        <li class="nav-item">
                            <a href="clientinfo.php" class="nav-link nav-toggle">
                                <i class="fa fa-info"></i>
                                <span class="title">Client Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-puzzle-piece"></i>
                                <span class="title">DevOps Assessment</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="assessment.php" class="nav-link">
                                        <span class="title">Assessment</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="assessreport.php" class="nav-link ">
                                        <span class="title">Assessment Report</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="toolspage.php" class="nav-link ">
                                            <span class="title">Tools</span>
                                        </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="roi.php" class="nav-link nav-toggle">
                                <i class="fa fa-line-chart"></i>
                                <span class="title">ROI</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="monitoring.php" class="nav-link nav-toggle">
                                <i class="fa fa-upload"></i>
                                <span class="title">Mass Upload</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">More</h3>
                        </li>
                        <li class="nav-item">
                            <a href="http://34.197.209.70/landingpage/index.html" class="nav-link nav-toggle">
                                <i class="fa fa-archive"></i>
                                <span class="title">Cap360 Suite</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:legacymodernization.fssbu@capgemini.com" class="nav-link nav-toggle">
                                <i class="fa fa-phone"></i>
                                <span class="title">Contact Us</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="about-us.php" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title">About Us</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
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
                       <div class="row" style="margin-top:-5px">
                            <div class="col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#firstscroll" data-toggle="tooltip" data-placement="bottom" title="TCO is an financial estimate of direct and indirect cost of owning an IT application that includes hardware and software acquisition, management and support, communications, end-user expenses and the opportunity cost of downtime, training and other productivity losses.">
                                    <div class="visual">
                                        <i class="fa fa-percent"></i>
                                    </div>
                                    <div class="details">
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <div class="number">
                                            <!--style="padding-left:160px;font-size:20px;color:white"-->
                                            <span data-counter="counterup" data-value="50">0</span><span>%</span>
                                        </div>
                                        <div class="desc"><b> Percentage of Testing Completed  </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#secondscroll" data-toggle="tooltip"  data-placement="bottom" title="Number of deploys across enterprise last quarter.">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="50">0</span><span>%</span></div>
                                        <div class="desc"> <b> Percentage of Testing Yet to be Completed  </div>
                                    </div>
                                </a>
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
						
                        class="row">
							<div class="col-sm-6 col-xs-12">
                            <a data-toggle="modal" href="#" id="Portfolio">
                                <!--responsive-->
                                <div class="col-lg-3 col-sm-6 col-xs-12" id="mydiv">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high1">
                                        <h4 class="widget-thumb-heading">Testcases Executed Percentage</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-blue fa fa-briefcase"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="40">0</span>%
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
                            <a data-toggle="modal" href="#" id="Applications">
                                <!--responsive-->
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase " id="high2">
                                        <h4 class="widget-thumb-heading">Testcases Not Executed Percentage </h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red fa fa-desktop"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle">   </span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="80">0</span>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
							</div>
							<div class="col-sm-6 col-xs-12">
                            <a data-toggle="modal" href="#" id="People">
                                <!--responsive-->
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase" id="high3">
                                        <h4 class="widget-thumb-heading">Testcases Executed</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-users" style="background-color:#98b4bb"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="600">0</span>%
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
							<a data-toggle="modal" href="#" id="People">
                                <!--responsive-->
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase" id="high4">
                                        <h4 class="widget-thumb-heading">Testcases Not Executed</h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon fa fa-users" style="background-color:#98b4bb"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"></span>
                                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="400">0</span>%
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </a>
                        </div>
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
                        <div class="row">
                            <div class="col-lg-8 col-xs-12 col-sm-12">
                                <div class="portlet light bordered" id="secondscroll">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Deployment Frequency</span>
                                            	 <span class="caption-helper">..Monthly stats</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body" onclick="on()">
                                        <div class="gauri">
                                            <div id="chartpoo" class="gauri1" data-toggle="tooltip" data-placement="left" title="Click To Drill"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered" id="firstscroll">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Total Cost of Ownership</span>
                                            <span class="caption-helper">..in $ Million</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="donut_chart" class="chart text-center" style="height:250px"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-12">-->
                        <div class="row">
                            <div class="col-lg-8 col-xs-12 col-sm-12">
                                <!-- BEGIN PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-dark bold"> Service Outage Cost</span>
	                                        	 <span class="caption-helper">..Quarterly</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="series_chart_div" class="chart text-center" style="height:280px;width:100%"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <!-- BEGIN PORTLET-->
                                <div class="portlet light bordered" id="thirdscroll">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Cost of Quality</span>
											<span class="caption-helper">..in $ Thousand</span>

                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="barchart" class="chart" style="height:280px" align="center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w3-content w3-display-container">
                            <div class="row">
                                <div class="mySlides">
                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cursor font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold">Deployment Metrics</span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body" style="height:115px">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="The time taken for any change from Analysis through development, testing and implementation.">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_bar5"></div>
                                                            <span>&nbsp;&nbsp; Change Lead Time </span>
                                                        </div>
                                                    </div>
                                                    <div class=" col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Ratio of successful deployment count to total deployment count.">
                                                        <div class="easy-pie-chart">
                                                            <div class="number transactions" data-percent="55">
                                                                <span>55</span>% </div>
                                                            <span>Deployment Success Rate  </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="The time taken to deploy components once the components are ready for deployment.">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_bar"></div>
                                                            <span>&nbsp;&nbsp; Deployment Lead Time </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold">QA Metrics</span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body" style="height:115px">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Ratio of the number of requirements tested to the total number of requirements.">
                                                        <div class="easy-pie-chart">
                                                            <div class="number visits" data-percent="85">
                                                                <span>85</span>% </div>
                                                            <span>Requirement Coverage Ratio</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Ratio of QA duration in the whole SDLC">
                                                        <div class="easy-pie-chart">
                                                            <div class="number bounce" data-percent="35">
                                                                <span>35</span>% </div>
                                                            <span>QA Lead Time Ratio</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="the number of defects detected during a phase/stage that are injected during that same phase divided by the total number of defects injected during that phase.">
                                                        <div class="easy-pie-chart">
                                                            <div class="number bounce" data-percent="98">
                                                                <span>98</span>% </div>
                                                            <span>Defect Detection Efficiency (Shift Left)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mySlides">
                                    <div class="col-lg-6 col-xs-12 col-sm-12" data-toggle="tooltip" data-placement="bottom" title="">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cursor font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold">Operational Metrics</span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body" style="height:115px">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Number of instances missed SLA.">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_bar2"></div>
                                                            <span>&nbsp;&nbsp; SLA Miss</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Number of incidents/problems resolved in the first attempt divided by the total number of incidents/problems.">
                                                        <div class="easy-pie-chart">
                                                            <div class="number transactions" data-percent="98.9">
                                                                <span>98.9</span>% </div>
                                                            <span>Quality of Resolution (First-time Right)  </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Number of incident tickets">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_line"></div>
                                                            <span>&nbsp; Incident Volume </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12" >
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cursor font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold">Build Metrics</span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body" style="height:115px">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Average time taken for the creation of build.">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_bar6"></div>
                                                            <span>&nbsp;&nbsp; Total Build Time </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Ratio of successful builds to the total number of builds.">
                                                        <div class="easy-pie-chart">
                                                            <div class="number transactions" data-percent="55">
                                                                <span>55</span>% </div>
                                                            <span>Successful Build Rate</span>
                                                        </div>
                                                    </div>
                                                    <div class="margin-bottom-10 visible-sm"> </div>
                                                    <div class="col-lg-4 col-sm-4 col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Average time taken for fixing the build issues">
                                                        <div class="sparkline-chart">
                                                            <div class="number" id="sparkline_line1"></div>
                                                            <span>&nbsp; Build Repair Rate</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="w3-button w3-white w3-display-left but" onclick="plusDivs(-1)">&#10094;</button>
                                <button class="w3-button w3-white w3-display-right but" onclick="plusDivs(1)">&#10095;</button>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:-23px; ">
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <!-- BEGIN REGIONAL STATS PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-share font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">Portfolio-ALC Support Footprint</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="region_statistics_loading">
                                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                                        <div id="region_statistics_content" class="display-none" style="height:300px">
                                            <div class="btn-toolbar">
                                                <div class="btn-group pull-right"><br />
                                                    <a href="" class="btn btn-circle grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Select Portfolio
															<span class="fa fa-angle-down"> </span>
														</a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;" id="regional_stat_world"> Investments </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" id="regional_stat_usa"> Cards </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" id="regional_stat_europe"> Retail Banking </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" id="regional_stat_russia"> Trade Finance </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" id="regional_stat_germany"> Loan </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="vmap_world" class="vmaps display-none"> </div>
                                            <div id="vmap_world1" class="vmaps display-none"> </div>
                                            <div id="vmap_world2" class="vmaps display-none"> </div>
                                            <div id="vmap_world3" class="vmaps display-none"> </div>
                                            <div id="vmap_world4" class="vmaps display-none"> </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END REGIONAL STATS PORTLET-->
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <!-- BEGIN PORTLET-->
                                <div class="portlet light bordered" id="">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bar-chart font-dark hide"></i>
                                            <span class="caption-subject font-dark bold">DevOps Maturity</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="assessmentradarchart" class="chart" style="height: 220px;"> </div>
                                        <div id="chart-container" class="chart text-center" id="chartdiv_2" style="height:80px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-sm-12">
                                <div class="portlet light bordered scroll scroll2">
                                    <div class="portlet-title">
                                        <div class="caption content">
                                            <i class="icon-directions font-green hide"></i>
                                            <span class="caption-subject bold font-dark">Road Map</span>
                                            <span class="caption-helper hide">For DevOps</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="cd-horizontal-timeline mt-timeline-horizontal" data-spacing="120" style="height:300px">
                                            <div class="timeline mt-timeline-square">
                                                <div class="events-wrapper">
                                                    <div class="events">
                                                        <ol>
                                                            <li>
                                                                <a href="#0" data-date="01/01/2016" class="border-after-blue bg-after-blue ">DevOps Assessment</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/03/2016" class="border-after-blue bg-after-blue ">&nbsp; Recommendation</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/05/2016" class="border-after-blue bg-after-blue">ROI evalutation</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/07/2016" class="border-after-blue bg-after-blue">DevOps Kick-off</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/09/2016" class="border-after-blue bg-after-blue selected">DevOps Level 1</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/11/2016" class="border-after-blue bg-after-blue">DevOps Level 2</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/01/2017" class="border-after-blue bg-after-blue">DevOps Level 3</a>
                                                            </li>
                                                            <li>
                                                                <a href="#0" data-date="01/03/2017" class="border-after-blue bg-after-blue">DevOps Level 4</a>
                                                            </li>
                                                        </ol>
                                                        <span class="filling-line bg-blue" aria-hidden="true"></span>
                                                    </div>
                                                    <!-- .events -->
                                                </div>
                                                <!-- .events-wrapper -->
                                                <ul class="cd-timeline-navigation mt-ht-nav-icon">
                                                    <li>
                                                        <a href="#0" class="prev inactive btn blue md-skip">
                                                            <i class="fa fa-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0" class="next btn blue md-skip">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- .cd-timeline-navigation -->
                                            </div>
                                            <!-- .timeline -->
                                            <div class="events-content">
                                                <ol>
                                                    <li data-date="01/01/2016">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Assessment Start</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">September 2016</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p> DevOps Assessment has been started for the in-scope portfolio. Meetings with the SMEs will be scheduled to gather system and operational details for the assessment. DevOps Assessment has been started for the in-scope portfolio. Meetings with the SMEs will be scheduled to gather system and operational details for the assessment. DevOps Assessment has been started for the in-scope portfolio. Meetings with the SMEs will be scheduled to gather system and operational details for the assessment.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/03/2016">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">Recommendation</h2>
                                                        </div>
                                                        <div class="mt-author">
                                                            <br />
                                                            <div class="mt-author-datetime font-grey-mint">January 2017</div>
                                                        </div>
                                                        <div class="clearfix"></div>
														<div class="mt-content border-grey-steel">
                                                            <p> The Assessment Page is complete Recommendations have been added to the Assessment Page </p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/05/2016">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">ROI Evaluation</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">March 2017</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>For the recommendations, ROI analysis will be performed considering the current TCO.</p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/07/2016">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Kick-Off</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">May 2017</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>Based on ROI evaluation, the appropriate DevOps solution will be choosen and DevOps project will be kicked-off.</p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/09/2016" class="selected">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Level 1 - In progress</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">July 2017</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>As part of DevOps Maturity Level 1, Test Execution and Test Data Setup will be automated for the 30% of the test cases. </p>
                                                            <p>Deployment will be automated.</p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/11/2016">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Level 2</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">January 2018</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>As part of DevOps Maturity Level 2, Test Execution and Test Data Setup will be automated for 50% of the test cases. </p>
                                                            <p>Continuous Deployment will be provisioned along with deployment automation.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/01/2017">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Level 3</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">July 2018</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>As part of DevOps Maturity Level 3, Test Execution and Test Data Setup will be automated for 70% of the test cases.</p>
                                                            <p>Dev and Test regions will be offloaded to Microfocus.</p>
                                                        </div>
                                                    </li>
                                                    <li data-date="01/03/2017">
                                                        <div class="mt-title">
                                                            <h2 class="mt-content-title">DevOps Level 4</h2>
                                                        </div>
                                                        <div class="mt-author"><br />
                                                            <div class="mt-author-datetime font-grey-mint">October 2018</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="mt-content border-grey-steel">
                                                            <p>Testing and Deployment will be automated and continuous to achieve seamless operations.</p>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                            <!-- .events-content -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/xy.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata1.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata2.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata3.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata4.js" type="text/javascript"></script>
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/jquery1.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/jquery3.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/jquery5.js" type="text/javascript"></script>
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
                colors: ['#52D0E6', '#1981A4', '#65909A', '2F4F4F','98F5FF'],
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

    </script><!--!!!!!!!!DISPLAYED!!!!!!!!-->
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

    </script><!--!!!!!!!!DISPLAYED!!!!!!!!-->
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

    </script><!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        Highcharts.chart('donut_chart', {
            chart: {
                type: 'pie'
            },
            legend: {
                enabled: true,
                align: 'right',
                layout: 'vertical',
                verticalAlign: 'middle'
            },
            plotOptions: {
                pie: {
                    showInLegend: true
                },
                series: {
                    innerSize: '60%',
                    dataLabels: {
                        enabled: false,
                        format: '{point.name}: {point.y:.1f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:08px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{}</span><b>{point.y:.2f}</b><br/>'
            },
            series: [{
                name: 'Portfolio',
                colorByPoint: true,
                data: [{
                    name: 'Investments',
                    y: 56.33,
                    drilldown: 'Investments'
                }, {
                    name: 'Cards',
                    y: 24.03,
                    drilldown: 'Cards'
                }, {
                    name: 'Retail Banking',
                    y: 10.38,
                    drilldown: 'Retail Banking'
                }, {
                    name: 'Trade Finance',
                    y: 4.77,
                    drilldown: 'Trade Finance'
                }, {
                    name: 'Loan',
                    y: 10,
                    drilldown: 'Loan'
                }]
            }],
            drilldown: {
                series: [{
                    name: 'Investments',
                    innerSize: '60%',
                    id: 'Investments',
                    data: [
                        ['Infrastructure Cost', 45],
                        ['Operating Cost', 56],
                        ['Personnel Cost', 23]
                    ]
                }, {
                    innerSize: '60%',
                    name: 'Cards',
                    id: 'Cards',
                    data: [
                        ['Infrastructure Cost', 45],
                        ['Operating Cost', 56],
                        ['Personnel Cost', 23]
                    ]
                }, {
                    innerSize: '60%',
                    name: 'Retail Banking',
                    id: 'Retail Banking',
                    data: [
                        ['Infrastructure Cost', 45],
                        ['Operating Cost', 56],
                        ['Personnel Cost', 23]
                    ]
                }, {
                    innerSize: '60%',
                    name: 'Trade Finance',
                    id: 'Trade Finance',
                    data: [
                        ['Infrastructure Cost', 45],
                        ['Operating Cost', 56],
                        ['Personnel Cost', 23]
                    ]
                }, {
                    innerSize: '60%',
                    name: 'Loan',
                    id: 'Loan',
                    data: [
                        ['Infrastructure Cost', 45],
                        ['Operating Cost', 56],
                        ['Personnel Cost', 23]
                    ]
                }]
            }
        });
    </script><!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        $('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                }
            });

    </script>
    <script>
        Highcharts.chart('barchart', {
            chart: {
                type: 'bar',
                events: {
                    drilldown: function(e) {
                        if (!e.seriesOptions) {

                            var chart = this,
                                drilldowns = {
                                    'Investments': {
                                        name: 'Investments',
                                        data: [
                                            ['Prevention Cost', 40],
                                            ['Appraisal Cost', 20],
                                            ['Internal Failure Cost', 25],
                                            ['External Failure Cost', 30]
                                        ]
                                    },
                                    'Cards': {
                                        name: 'Cards',
                                        data: [
                                            ['Prevention Cost', 30],
                                            ['Appraisal Cost', 20],
                                            ['Internal Failure Cost', 25],
                                            ['External Failure Cost', 10]
                                        ]
                                    },
                                    'Retail Banking': {
                                        name: 'Retail Banking',
                                        data: [
                                            ['Prevention Cost', 25],
                                            ['Appraisal Cost', 10],
                                            ['Internal Failure Cost', 5],
                                            ['External Failure Cost', 20]
                                        ]
                                    },
                                    'Trade Finance': {
                                        name: 'Trade Finance',
                                        data: [
                                            ['Prevention Cost', 20],
                                            ['Appraisal Cost', 15],
                                            ['Internal Failure Cost', 10],
                                            ['External Failure Cost', 20]
                                        ]
                                    },
                                    'Loan': {
                                        name: 'Loan',
                                        data: [
                                            ['Prevention Cost', 10],
                                            ['Appraisal Cost', 8],
                                            ['Internal Failure Cost', 6],
                                            ['External Failure Cost', 10]
                                        ]
                                    }
                                },
                                series = drilldowns[e.point.name];
                            //Show the loading label
                            chart.showLoading('');
                            setTimeout(function() {
                                chart.hideLoading();
                                chart.addSeriesAsDrilldown(e.point, series);
                            }, 1000);
                        }
                    }
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },

            legend: {
                enabled: false
            },

            plotOptions: {
                series: {
                    borderWidth: 0,
                    borderRadius: 3,
                    dataLabels: {
                        enabled: true
                    }
                }
            },
			tooltip: {
					formatter: function() {
						return   this.y ;
					}
				},

            series: [{
                name: '',
                colorByPoint: true,
                data: [{
                        name: 'Investments',
                        y: 180,
                        drilldown: true
                    }, {
                        name: 'Cards',
                        y: 140,
                        drilldown: true
                    }, {
                        name: 'Retail Banking',
                        y: 100,
                        drilldown: true
                    },
                    {
                        name: 'Trade Finance',
                        y: 80,
                        drilldown: true
                    },
                    {
                        name: 'Loan',
                        y: 49,
                        drilldown: true
                    }
                ]
            }],

            drilldown: {
                series: [],
                activeAxisLabelStyle: {
                    textDecoration: 'none',
                }
            }
        });

    </script>
    <script>
        var dataSets = [
            //first db
            [{
                "year": "Jan '16",
                "value": 75,
                "value1": 54,
                "value3": 180

            }, {
                "year": "Feb '16",
                "value": 80,
                "value1": 54,
                "value3": 220
            }, {
                "year": "Mar '16",
                "value": 85,
                "value1": 52,
                "value3": 190
            }, {
                "year": "Apr '16",
                "value": 105,
                "value1": 50,
                "value3": 260
            }, {
                "year": "May '16",
                "value": 90,
                "value1": 48,
                "value3": 220
            }, {
                "year": "Jun '16",
                "value": 120,
                "value1": 46,
                "value3": 300
            }, {
                "year": "Jul '16",
                "value": 130,
                "value1": 45,
                "value3": 260
            }, {
                "year": "Aug '16",
                "value": 175,
                "value1": 44,
                "value3": 300
            }, {
                "year": "Sep '16",
                "value": 160,
                "value1": 43,
                "value3": 270
            }, {
                "year": "Oct '16",
                "value": 200,
                "value1": 42,
                "value3": 300
            }, {
                "year": "Nov '16",
                "value": 190,
                "value1": 41,
                "value3": 250
            }, {
                "year": "Dec '16",
                "value": 225,
                "value1": 40,
                "value3": 300
            }],
            //second db
            [{
                "year": "Jan 17",
                "value": 30,
                "value1": 65,
                "value3": 280

            }, {
                "year": "Feb 17",
                "value": 20,
                "value1": 335,
                "value3": 210
            }, {
                "year": "Mar 17",
                "value": 75,
                "value1": 30,
                "value3": 190
            }, {
                "year": "Apr 17",
                "value": 05,
                "value1": 28,
                "value3": 260
            }, {
                "year": "May 17",
                "value": 840,
                "value1": 26,
                "value3": 220
            }, {
                "year": "Jun 17",
                "value": 20,
                "value1": 222,
                "value3": 700
            }, {
                "year": "Jul 17",
                "value": 230,
                "value1": 20,
                "value3": 560
            }, {
                "year": "Aug 17",
                "value": 175,
                "value1": 8,
                "value3": 300
            }, {
                "year": "Sep 17",
                "value": 160,
                "value1": 16,
                "value3": 270
            }, {
                "year": "Oct 17",
                "value": 200,
                "value1": 16,
                "value3": 300
            }, {
                "year": "Nov 17",
                "value": 190,
                "value1": 14,
                "value3": 250
            }, {
                "year": "Dec 17",
                "value": 225,
                "value1": 15,
                "value3": 300
            }]
        ];
        var chart1 = AmCharts.makeChart("chartpoo", {
            "type": "serial",
            "theme": "light",
            "marginRight": 30,
            "legend": {
                "equalWidths": false,
                "switchable": false,
                "markerSize": 10,
                "fontSize": 11,
            },
            dataProvider: dataSets[0],
            "valueAxes": [{
                "gridAlpha": 0.07,
                "position": "left"
            }],
            "graphs": [{
                    "id": "g3",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "title": "Total CRs",
                    "lineColor": "#65909a",
                    "lineAlpha": 1,
                    "fillAlphas": 0.4,
                    "negativeLineColor": "#637bb6",
                    "type": "smoothedLine",
                    "valueField": "value3",
                    "disableToggle": true
                }, {
                    "id": "g1",
                    "title": "Deployment",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "lineColor": "#98f5ff",
                    "lineAlpha": 1,
                    "fillAlphas": 0.4,
                    "type": "smoothedLine",
                    "negativeLineColor": "#637bb6",
                    "valueField": "value",
                    "disableToggle": true
                },
                {
                    "id": "g2",
                    "title": "Failure",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "lineColor": "#00688b",
                    "lineAlpha": 1,
                    "fillAlphas": 0.4,
                    "negativeLineColor": "#637bb6",
                    "type": "smoothedLine",
                    "valueField": "value1",
                    "disableToggle": true
                }
            ],
            "plotAreaBorderAlpha": 0,
            //    labelsEnabled: false,
            autoMargins: false,
            marginTop: 10,
            marginBottom: 25,
            marginLeft: 40,
            marginRight: 0,
            "chartCursor": {
                "categoryBalloonDateFormat": "MMYY",
                "cursorAlpha": 0,
                "valueLineEnabled": false,
                "valueLineBalloonEnabled": false,
                "valueLineAlpha": 0.5,
                "fullWidth": true
            },
            "categoryField": "year",
            "categoryAxis": {
                "startOnAxis": true,
                "axisColor": "#DADADA",
                "gridAlpha": 0.07
            }
        });
        
        var chart2 = AmCharts.makeChart("chartpoo1", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment Frequency"
            }],
            "legend": {
                "equalWidths": false,
                "switchable": false,
                "markerSize": 10,
                "fontSize": 10.5,
            },
            dataProvider: dataSets[0],

            "valueAxes": [{
                "gridAlpha": 0.07,
                "position": "left"
            }],
            "graphs": [{
                    "id": "g3",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "title": "Total CRs",
                    "lineColor": "#65909a",
                    "lineAlpha": 1,
                    "fillAlphas": 0.5,
                    "type": "smoothedLine",
                    "valueField": "value3",
                    "disableToggle": true
                }, {
                    "id": "g1",
                    "title": "Deployment",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "lineColor": "#98f5ff","lineAlpha": 1,
                    "fillAlphas": 0.5,
                    "type": "smoothedLine",

                    "valueField": "value",
                    "disableToggle": true
                },
                {
                    "id": "g2",
                    "title": "Failure",
                    "balloonText": "[[category]]<br><b><span style='font-size:9px;'>[[value]]</span></b>",
                    "lineColor": "#00688b",
					"lineAlpha": 1,
                    "fillAlphas": 0.5,
                    "type": "smoothedLine",
                    "valueField": "value1",
                    "disableToggle": true
                }
            ],
            "plotAreaBorderAlpha": 0,
            //    labelsEnabled: false,
            autoMargins: true,
            "chartCursor": {
                "categoryBalloonDateFormat": "MMYY",
                "cursorAlpha": 0,
                "valueLineEnabled": false,
                "valueLineBalloonEnabled": false,
                "valueLineAlpha": 0.5,
                "fullWidth": true
            },
            "categoryField": "year",
            "categoryAxis": {
                "startOnAxis": true,
                "gridAlpha": 0.07
            }
        });

        function setDataset(index) {
            alert(index);
            chart1.dataProvider = dataSets[Number(index)];
            alert(dataSets[index]);
            chart1.validateData();
        }

    </script><!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("batchchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },
            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Batch",
                "visits": 35,
                "color": "#e7505a"
            }, {
                "country": "Online",
                "visits": 16,
                "color": "#49a2df"
            }, {
                "country": "Both",
                "visits": 25,
                "color": "#888888"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",

        });
    </script>
<!--!!!!!!!DISPLAYED-->
    <script>
        var chart = AmCharts.makeChart("techchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },

            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "title": "new",
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Waterfall",
                "visits": 60,
                "color": "#e7505a"
            }, {
                "country": "Agile",
                "visits": 16,
                "color": "#888888"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });
    </script>
<!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("criticalchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },

            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],

            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Larger",
                "visits": 15,
                "color": "#e7505a"
            }, {
                "country": "Lowest",
                "visits": 25,
                "color": "#888888"
            }, {
                "country": "Moderate",
                "visits": 36,
                "color": "#49a2df"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });
    </script>
<!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("donut_chart1", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Internal",
                "visits": 250,
                "color": "#39b7cd"
            }, {
                "country": "Capgemini",
                "visits": 225,
                "color": "#e7505a"
            }, {
                "country": "Adroit IT",
                "visits": 175,
                "color": "#888888"
            }, {
                "country": "Capterra",
                "visits": 120,
                "color": "#49a2df"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });

    </script>
<!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("toolsvendor", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],

            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "In-Built",
                "visits": 19,
                "color": "#39b7cd"
            }, {
                "country": "IBM",
                "visits": 17,
                "color": "#e7505a"
            }, {
                "country": "MicroFocus",
                "visits": 12,
                "color": "#888888"
            }, {
                "country": "Microsoft",
                "visits": 8,
                "color": "#49a2df"
            }, {
                "country": "SonarQube",
                "visits": 13
            }, {
                "country": "Atlassian",
                "visits": 12
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });
    </script>
<!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("expdonut", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "India",
                "visits": 300,
                "color": "#e7505a"
            }, {
                "country": "Germany",
                "visits": 150,
                "color": "#888888"
            }, {
                "country": "Poland",
                "visits": 100,
                "color": "#49a2df"
            }, {
                "country": "Netherlands",
                "visits": 100,
                "color": "#39b7cd"
            }, {
                "country": "UK",
                "visits": 100,
                "color": "#808000"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });

    </script>
<!--!!!!!!!!DISPLAYED!!!!!!!!-->
    <script>
        var chart = AmCharts.makeChart("cicdroi", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "enabled": false,
                "valueWidth": 10,
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "id": "Gains from new functionality",
                "value": 186000000,
                "color": "#738989"
            }, {
                "id": "Gains from headcount waste",
                "value": 4968360,
                "color": "#0A6A8B"
            }, {
                "id": "Gains from increased quality",
                "value": 114231771,
                "color": "#39B7CD"
            }, {
                "id": "Gains from flexibility environment",
                "value": 8680000,
                "color": "#B1FFFF"
            }],
            "valueField": "value",
            "titleField": "id",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });
    </script>

    <script>
        var chart = Highcharts.chart('applicationbarchart', {

            title: {
                text: '',
                align: 'left',
                style: {
                    fontWeight: 'bold',
                    fontSize: 14
                }
            },
			
			tooltip: {
					formatter: function() {
						return   this.y ;
					}
				},
            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['Mainframe', 'Unix', 'J2EE', 'Windows', 'ETL', 'Others']

            },

            series: [{
                type: 'bar',
                colorByPoint: true,
                data: [25, 20, 15, 10, 3, 3],
                showInLegend: false,
                pointPadding: 0,
                groupPadding: 0.1,
                columnSpacing: 0,
                borderRadius: 4
            }]
        });
        $('#plain').click(function() {
            chart.update({
                chart: {
                    inverted: false,
                    polar: false
                },
                subtitle: {
                    text: ''
                }
            });
        });

    </script>
    <script>
        var chart = Highcharts.chart('peoplebarchart', {

            title: {
                text: ''
            },
			
			
			tooltip: {
					formatter: function() {
						return   this.y ;
					}
				},

            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['Operations & Support', 'Development', 'QA', 'Business Analysis',
                    'Others'
                ]
            },

            series: [{
                type: 'bar',
                colorByPoint: true,
                data: [300, 100, 175, 85, 90],
                showInLegend: false,
                borderRadius: 3,
                pointPadding: -0.25
            }]
        });
        $('#plain').click(function() {
            chart.update({
                chart: {
                    inverted: false,
                    polar: false
                },
                subtitle: {
                    text: 'Plain'
                }
            });
        });

    </script>
    <script>
        var chart = Highcharts.chart('toolsbarchart', {
            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['IBM ADDI', 'MF Analyzer', 'Informatica', 'Tableau', 'Jira']
            },

			
			tooltip: {
					formatter: function() {
						return   this.y ;
					}
				},
            series: [{
                type: 'bar',
                colorByPoint: true,
                data: [130, 120, 105, 75, 20],
                showInLegend: false,
                borderRadius: 4,
                pointPadding: -0.25
            }]
        });
        $('#plain').click(function() {
            chart.update({
                chart: {
                    inverted: false,
                    polar: false
                },
                subtitle: {
                    text: 'Plain'
                }
            });
        });

    </script>
    <script>
        var chart = Highcharts.chart('skillsbarchart', {

            title: {
                text: ''
            },
		tooltip: {
					formatter: function() {
						return   this.y ;
					}
				},
            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['Mainframe', 'J2EE', 'ETL', 'Unix', 'Business', 'Project Management']
            },

            series: [{
                type: 'bar',
                colorByPoint: true,
                data: [175, 200, 160, 120, 50, 45],
                showInLegend: false,
                borderRadius: 3,
                pointPadding: -0.2
            }]
        });
        $('#plain').click(function() {
            chart.update({
                chart: {
                    inverted: true,
                    polar: false
                },
                subtitle: {
                    text: 'Plain'
                }
            });
        });

    </script>
    <script>
        var chartData = [{
            "title": "Onsite",
            "color": "#1981a4",
            "value": 30,
            "url": "#",
            // "description":"click to drill-down",
            "data": [{
                    "title": "UK",
                    "value": 1,
                    "color": " #738989"
                },
                {
                    "title": "USA",
                    "value": 2,
                    "color": " #39B7CD"
                },
                {
                    "title": "Philippines",
                    "value": 3,
                    "color": " #65909A"
                },
                {
                    "title": "Germany",
                    "value": 4,
                    "color": " #00688B"
                },
            ]
        }, {
            "title": "Offshore",
            "value": 70,
            "color": "#98f5ff",
            "url": "#",
            //  "description":"click to drill-down",
            "data": [{
                    "title": "Chennai",
                    "value": 4,
                    "color": " #738989"
                },
                {
                    "title": "Banglore",
                    "value": 3,
                    "color": " #39B7CD"
                },
                {
                    "title": "Pune",
                    "value": 1,
                    "color": " #65909A"
                },
                {
                    "title": "Mumbai",
                    "value": 4,
                    "color": " #00688B"
                },
                {
                    "title": "Hyderabad",
                    "value": 2,
                    "color": " #98F5FF"
                },
            ]
        }];

        // create pie chart
        var chart = AmCharts.makeChart("chart", {
            "type": "pie",
            "radius": "42%",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": ''
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "innerRadius": '60%',
            "dataProvider": chartData,
            "valueField": "value",
            "colorField": "color",
            "titleField": "title",
            "pullOutOnlyOne": true,
            "titles": [{
                "text": "Departments"
            }],
            "allLabels": []
        });
        chart.drillLevels = [{
            "title": "Departments",
            "data": chartData
        }];
        chart.addListener("clickSlice", function(event) {
            var chart = event.chart;
            if (event.dataItem.dataContext.data !== undefined) {

                // save for back button
                chart.drillLevels.push(event.dataItem.dataContext);

                // replace data
                chart.dataProvider = event.dataItem.dataContext.data;

                // replace title
                chart.titles[0].text = event.dataItem.dataContext.title;

                // add back link
                // let's add a label to go back to yearly data
                event.chart.addLabel(
                    0, 25,
                    "< Go back",
                    undefined,
                    undefined,
                    undefined,
                    undefined,
                    undefined,
                    undefined,
                    'javascript:drillUp();');

                // take in data and animate
                chart.validateData();
                chart.animateAgain();
            }
        });

        function drillUp() {

            // get level
            chart.drillLevels.pop();
            var level = chart.drillLevels[chart.drillLevels.length - 1];

            // replace data
            chart.dataProvider = level.data;

            // replace title
            chart.titles[0].text = level.title;

            // remove labels
            if (chart.drillLevels.length === 1)
                chart.clearLabels();

            // take in data and animate
            chart.validateData();
            chart.animateAgain();
        }

    </script>
    <script>
        var chart = AmCharts.makeChart("vendorschart1", {
            "type": "serial",
            "theme": "light",
            "depth3D": 20,
            "angle": 30,
            "legend": {
                "horizontalGap": 10,
                "useGraphSettings": true,
                "markerSize": 5,
                "position": 'bottom',
                "color": "#000"
            },
            "dataProvider": [{
                "Services": "AO",
                "Capgemini": 10,
                "Adroit IT": 10,
                "Capterra": 8
            }, {
                "Services": "AD",
                "Capgemini": 10,
                "Adroit IT": 10,
                "Capterra": 7
            }, {
                "Services": "AM",
                "Capgemini": 5,
                "Adroit IT": 6,
                "Capterra": 10
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capgemini",
                "type": "column",
                "fillColors": "#98F5FF",
                "valueField": "Capgemini",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Adroit IT",
                "type": "column",
                "fillColors": "#65909A",
                "valueField": "Adroit IT",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capterra",
                "type": "column",
                "fillColors": "#00688B",
                "valueField": "Capterra",
                "fixedColumnWidth": 100
            }],
            "categoryField": "Services",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            }
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("vendorschart2", {
            "type": "serial",
            "theme": "light",
            "depth3D": 20,
            "angle": 30,
            "legend": {
                "horizontalGap": 10,
                "useGraphSettings": true,
                "markerSize": 5,
                "position": 'bottom'
            },
            "dataProvider": [{
                "Services": "AO",
                "Capgemini": 100,
                "Adroit IT": 133,
                "Capterra": 75
            }, {
                "Services": "AD",
                "Capgemini": 64,
                "Adroit IT": 75,
                "Capterra": 78
            }, {
                "Services": "AM",
                "Capgemini": 75,
                "Adroit IT": 50,
                "Capterra": 100
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capgemini",
                "type": "column",
                "fillColors": "#39B7CD",
                "valueField": "Capgemini",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Adroit IT",
                "type": "column",
                "fillColors": "#65909A",
                "valueField": "Adroit IT",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capterra",
                "type": "column",
                "fillColors": "#00688B",
                "valueField": "Capterra",
                "fixedColumnWidth": 100
            }],
            "categoryField": "Services",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            }
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("almpiechart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": 0,
            "labelsEnabled": false,
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },
            "autoMargins": false,
            "marginTop": 10,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 0,
            "dataProvider": [{
                "country": "Development",
                "visits": 11,
                "color": "#39b7cd"
            }, {
                "country": "Testing",
                "visits": 15,
                "color": "#e7505a"
            }, {
                "country": "Deployment",
                "visits": 20,
                "color": "#888888"
            }, {
                "country": "Collaboration",
                "visits": 5,
                "color": "#49a2df"

            }, {
                "country": "Operations",
                "visits": 30,
                "color": "#00688B"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 5,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("leadtime", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Change Lead Time by Portfolio(2016)"
            }],
            "valueAxes": [{
                "position": "left",
				"minimum": 0
            }],
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 1,
                "cursorColor": "#258cbb",
                "limitToGraph": "g1",
                "valueLineAlpha": 0.2,
            },
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Loan",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value]]</span>"
            }, {
                "id": "g2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Investment",
                "useLineColorForBulletBorder": true,
                "valueField": "value1",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value1]]</span>"
            }, {
                "id": "g3",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Trade Finance",
                "useLineColorForBulletBorder": true,
                "valueField": "value2",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value2]]</span>"
            }, {
                "id": "g4",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Cards",
                "useLineColorForBulletBorder": true,
                "valueField": "value3",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value3]]</span>"
            }, {
                "id": "g5",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Retail Banking",
                "useLineColorForBulletBorder": true,
                "valueField": "value4",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value4]]</span>"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "dataProvider": [{
                    "date": "Jan",
                    "value": 21,
                    "value1": 17,
                    "value2": 16,
                    "value3": 18,
                    "value4": 7
                }, {
                    "date": "Feb",
                    "value": 19,
                    "value1": 20,
                    "value2": 18,
                    "value3": 14,
                    "value4": 15
                }, {
                    "date": "Mar",
                    "value": 13,
                    "value1": 19,
                    "value2": 14,
                    "value3": 18,
                    "value4": 12
                },
                {
                    "date": "Apr",
                    "value": 16,
                    "value1": 20,
                    "value2": 15,
                    "value3": 11,
                    "value4": 15
                }, {
                    "date": "May",
                    "value": 18,
                    "value1": 15,
                    "value2": 17,
                    "value3": 11,
                    "value4": 12
                }, {
                    "date": "Jun",
                    "value": 23,
                    "value1": 16,
                    "value2": 24,
                    "value3": 20,
                    "value4": 23
                }, {
                    "date": "Jul",
                    "value": 24,
                    "value1": 19,
                    "value2": 26,
                    "value3": 12,
                    "value4": 19
                }, {
                    "date": "Aug",
                    "value": 25,
                    "value1": 24,
                    "value2": 17,
                    "value3": 15,
                    "value4": 16
                }, {
                    "date": "Sep",
                    "value": 17,
                    "value1": 22,
                    "value2": 16,
                    "value3": 14,
                    "value4": 14
                }, {
                    "date": "Oct",
                    "value": 20,
                    "value1": 25,
                    "value2": 19,
                    "value3": 11,
                    "value4": 19
                }, {
                    "date": "Nov",
                    "value": 18,
                    "value1": 22,
                    "value2": 21,
                    "value3": 14,
                    "value4": 20
                }, {
                    "date": "Dec",
                    "value": 25,
                    "value1": 19,
                    "value2": 18,
                    "value3": 27,
                    "value4": 22
                }
            ],
            "allLabels": [{
                "text": "Duration in days",
                "rotation": 270,
                "x": "10",
                "y": "100",
                //"width": "50%",
                "size": 10,
                //"bold": true,
                "align": "right"
            }]
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("depduration", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment Duration by Portfolio(2016)"
            }],
            "valueAxes": [{
                "position": "left","minimum": 0
            }],
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 1,
                "cursorColor": "#258cbb",
                "limitToGraph": "g1",
                "valueLineAlpha": 0.2,
            },
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Loan",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value]]</span>"
            }, {
                "id": "g2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Investment",
                "useLineColorForBulletBorder": true,
                "valueField": "value1",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value1]]</span>"
            }, {
                "id": "g3",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Trade Finance",
                "useLineColorForBulletBorder": true,
                "valueField": "value2",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value2]]</span>"
            }, {
                "id": "g4",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Cards",
                "useLineColorForBulletBorder": true,
                "valueField": "value3",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value3]]</span>"
            }, {
                "id": "g5",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Retail Banking",
                "useLineColorForBulletBorder": true,
                "valueField": "value4",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value4]]</span>"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "dashLength": 1,
                "minorGridEnabled": true,

            },
            "dataProvider": [{
                "date": "Jan",
                "value": 13,
                "value1": 13,
                "value2": 14,
                "value3": 18,
                "value4": 7
            }, {
                "date": "Feb",
                "value": 11,
                "value1": 13,
                "value2": 16,
                "value3": 14,
                "value4": 15
            }, {
                "date": "Mar",
                "value": 15,
                "value1": 22,
                "value2": 12,
                "value3": 18,
                "value4": 12
            }, {
                "date": "Apr",
                "value": 16,
                "value1": 12,
                "value2": 12,
                "value3": 11,
                "value4": 15
            }, {
                "date": "May",
                "value": 18,
                "value1": 22,
                "value2": 15,
                "value3": 11,
                "value4": 12
            }, {
                "date": "Jun",
                "value": 13,
                "value1": 24,
                "value2": 26,
                "value3": 20,
                "value4": 29
            }, {
                "date": "Jul",
                "value": 23,
                "value1": 32,
                "value2": 21,
                "value3": 12,
                "value4": 12
            }, {
                "date": "Aug",
                "value": 21,
                "value1": 22,
                "value2": 13,
                "value3": 11,
                "value4": 12
            }, {
                "date": "Sep",
                "value": 12,
                "value1": 22,
                "value2": 13,
                "value3": 11,
                "value4": 12
            }, {
                "date": "Oct",
                "value": 17,
                "value1": 14,
                "value2": 17,
                "value3": 12,
                "value4": 19
            }, {
                "date": "Nov",
                "value": 11,
                "value1": 22,
                "value2": 17,
                "value3": 12,
                "value4": 19
            }, {
                "date": "Dec",
                "value": 28,
                "value1": 22,
                "value2": 14,
                "value3": 30,
                "value4": 19
            }],
            "allLabels": [{
                "text": "Duration in mins",
                "rotation": 270,
                "x": "10",
                "y": "100",
                //"width": "50%",
                "size": 10,
                //	"bold": true,
                "align": "right"
            }]
        });

    </script>

    <script>
        var chart = AmCharts.makeChart("vendorpie2", {
            "type": "pie",
            "theme": "light",
            "innerRadius": 70,
            "labelsEnabled": false,
            "titles": [{
                "fontSize": 10,
                "text": "Deployment by Portfolio (Q4 2016)",
                "switchable": false
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 0,
            "dataProvider": [{
                "country": "Investments",
                "visits": 40
            }, {
                "country": "Cards",
                "visits": 60
            }, {
                "country": "Retail",
                "visits": 30
            }, {
                "country": "Trade Finance",
                "visits": 50
            }, {
                "country": "Loan",
                "visits": 45
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "startDuration": 2,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>"

        });

    </script>
    <script>
        var chart = AmCharts.makeChart("vendorpie", {
            "type": "pie",
            "theme": "light",
            "innerRadius": 50,
            "titles": [{
                "fontSize": 10,
                "text": "Deployed Components by Portfolio (Q4 2016)",
                "switchable": false
            }],
            "legend": {
                "enabled": false,
                "position": "bottom",
                "valueText": '',
                "switchable": false,
                "markerSize": 10,
                "fontSize": 10,
                "spacing": 1,
            },
            "labelsEnabled": false,
            "autoMargins": false,
            "marginTop": 20,
            "marginBottom": 20,
            "marginLeft": 20,
            "marginRight": 20,
			"pullOutRadius": 0,
            "dataProvider": [{
                "country": "Investments",
                "visits": 62
            }, {
                "country": "Cards",
                "visits": 36
            }, {
                "country": "Retail",
                "visits": 50
            }, {
                "country": "Trade Finance",
                "visits": 20
            }, {
                "country": "Loan",
                "visits": 32
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>"

        });

    </script>
    <script>
        var chart = AmCharts.makeChart("envpie", {
            "type": "pie",
            "theme": "light",
            "innerRadius": 50,
            "labelsEnabled": false,
            "titles": [{
                "fontSize": 10,
                "text": "Deployed Components by Environment (Q4 2016)",
                "switchable": false
            }],
            "legend": {
                "enabled":false,
                "position": "bottom",
                "valueText": '',
                "switchable": false,
                "markerSize": 10,
                "fontSize": 10,
                "spacing": 1
            },
            "autoMargins": false,
            "marginTop": 20,
            "marginBottom": 20,
            "marginLeft": 20,
            "marginRight": 20,
			"pullOutRadius": 0,
            "dataProvider": [{
                "country": "Pre-Prod",
                "visits": 62,
                "color": "#98f5ff"
            }, {
                "country": "Prod",
                "visits": 26,
                "color": "#2f4f4f"
            }, {
                "country": "Test",
                "visits": 40,
                "color": "#00689b"
            }, {
                "country": "Development",
                "visits": 10,
                "color": "#92aeb5"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",

            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",

        });

    </script>
    <script>
        var chart = AmCharts.makeChart("techpie", {
            "type": "pie",
            "theme": "light",
            "innerRadius": 50,
            "labelsEnabled": false,
            "titles": [{
                "fontSize": 10,
                "text": "Deployed Components by Technology (Q4 2016)",
                "switchable": false
            }],
            "legend": {
                "enabled": false,
                "position": "bottom",
                "valueText": '',
                "switchable": false,
                "markerSize": 10,
                "fontSize": 10,
                "spacing": 1
            },
            "autoMargins": false,
            "marginTop": 20,
            "marginBottom": 20,
            "marginLeft": 20,
            "marginRight": 20,
            "pullOutRadius": 0,
            "dataProvider": [{
                "country": "Mainframe",
                "visits": 62,
                "color": "#98f5ff"
            }, {
                "country": "Windows",
                "visits": 36,
                "color": "#2f4f4f"
            }, {
                "country": "Unix",
                "visits": 50,
                "color": "#00689b"
            }, {
                "country": "J2EE",
                "visits": 20,
                "color": "#92aeb5"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",

        });

    </script>
    <script>
        var chart = AmCharts.makeChart("myChart1", {
            "type": "serial",
            "addClassNames": true,
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 75,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "balloon": {
                "adjustBorderColor": false,
                "horizontalPadding": 10,
                "verticalPadding": 8,
                "color": "#ffffff"
            },
            "dataProvider": [{
                "year": 'Year 1',
                "income": 7200000,
                "Current": 9961701.6,
                "expenses": -2761701.6
            }, {
                "year": 'Year 2',
                "income": 7200000,
                "Current": 6490831.4,
                "expenses": 709168.6
            }, {
                "year": 'Year 3',
                "income": 7200000,
                "Current": 3720993.68,
                "expenses": 3479006.32
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left"
            }],
            "startDuration": 0,
            "graphs": [{
                "alphaField": "alpha",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='-size:12px;'>[[value]]</span> [[additional]]</span>",
                "fillAlphas": 1,
                "title": "Current Cost",
                "type": "column",
                "valueField": "income",
                "fillColors": "#39B7CD",
                "lineColor": "#65909A",
                "dashLengthField": "dashLengthColumn"
            }, {
                "alphaField": "alpha",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                "fillAlphas": 1,
                "title": "Yearly Cost After Migration",
                "type": "column",
                "valueField": "Current",
                "lineColor": "#65909A",
                "dashLengthField": "dashLengthColumn",
                "fillColors": "#738989"
            }, {
                "id": "graph2",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                "bullet": "round",
                "lineThickness": 3,
                "bulletSize": 7,
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "useLineColorForBulletBorder": true,
                "bulletBorderThickness": 3,
                "fillAlphas": 0,
                "lineAlpha": 1,
                "title": "Yearly Profit",
                "lineColor": "#65909A",
                "valueField": "expenses",
                "dashLengthField": "dashLengthLine"
            }],
            "categoryField": "year",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("myChart2", {
            "type": "serial",
            "addClassNames": true,
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 75,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "balloon": {
                "adjustBorderColor": false,
                "horizontalPadding": 10,
                "verticalPadding": 8,
                "color": "#ffffff"
            },

            "dataProvider": [{
                "year": 'Year 1',
                "income": 3686400,
                "Current": 4693514,
                "expenses": 4693514
            }, {
                "year": 'Year 2',
                "income": 3686400,
                "Current": 4442887,
                "expenses": 2992704
            }, {
                "year": 'Year 3',
                "income": 3686400,
                "Current": 4387451,
                "expenses": 1692200
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
				"minimum":0
            }],
            "startDuration": 0,
            "graphs": [{
                "alphaField": "alpha",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                "fillAlphas": 1,
                "title": "Without automation",
                "type": "column",
                "valueField": "income",
                "dashLengthField": "dashLengthColumn",
                "fillColors": "#738989",
                "lineColor": "#65909A"
            }, {
                "alphaField": "alpha",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                "fillAlphas": 1,
                "title": "With Maturity Level 1",
                "type": "column",
                "valueField": "Current",
                "dashLengthField": "dashLengthColumn",
                "fillColors": "#98B4BB",
                "lineColor": "#65909A"
            }, {
                "id": "graph2",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                "bullet": "round",
                "lineThickness": 3,
                "bulletSize": 7,
                "lineColor": "#65909A",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "useLineColorForBulletBorder": true,
                "bulletBorderThickness": 3,
                "fillAlphas": 0,
                "lineAlpha": 1,
                "title": "With DevOps Progressing",
                "valueField": "expenses",
                "dashLengthField": "dashLengthLine"
            }],
            "categoryField": "year",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });
    </script>
    <script>
        var chart = AmCharts.makeChart("vendorpie3", {
            "type": "pie",
            "theme": "light",
            "titles": [{
                "text": "Deployment Failure by Portfolio (Q4 2016)",
                "fontSize": 10
            }],
            "innerRadius": 70,
            "labelsEnabled": false,
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 0,
            "dataProvider": [{
                "country": "Investments",
                "visits": 11,
                "color": "#98f5ff"
            }, {
                "country": "Cards",
                "visits": 3,
                "color": "#2f4f4f"
            }, {
                "country": "Retail",
                "visits": 8,
                "color": "#00689b"
            }, {
                "country": "Trade Finance",
                "visits": 13,
                "color": "#92aeb5"
            }, {
                "country": "Loan",
                "visits": 5,
                "color": "#39b7cd"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "startDuration": 2,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",

        });

    </script>
    <script src="../assets/pages/scripts/dashboard.js" type="text/javascript"></script>
    <script type="text/javascript">
        var chartData = [{
                "months": [{
                    "category": "Capgemini",
                    "low": 1,
                    "medium": 2,
                    "high": 3
                }, {
                    "category": "Adroit IT",
                    "low": 4,
                    "medium": 5,
                    "high": 6
                }, {
                    "category": "Capterra",
                    "low": 6,
                    "medium": 7,
                    "high": 8
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 2,
                    "color": "#41bfd5",
                    "projects2": 650000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#e7505a",
                    "projects2": 255000
                }, {
                    "type": "Hardware",
                    "category2": 2,
                    "color": "#65909a",
                    "projects2": 400000
                }],
                "months3": [{
                    "a": 5,
                    "b": 2,
                    "color": "#41BFD5",
                    "valuea": 3,
                    "Period": "Q1-2016"
                }, {
                    "a": 10,
                    "color": "#41BFD5",
                    "b": 5,
                    "valuea": 5,
                    "Period": "Q2-2016"
                }, {
                    "a": 3,
                    "b": 1,
                    "color": "#41BFD5",
                    "valuea": 2,
                    "Period": "Q3-2016"
                }, {
                    "a": 2,
                    "b": 1,
                    "valuea": 1,
                    "color": "#41BFD5",
                    "Period": "Q4-2016"
                }]
            },
            {
                "color": "#41BFD5",
                "department": "Investment",
                "projects": 25,
                "url": "#",
                "description": "click to drill-down",
                "months": [{
                    "category": "Capgemini",
                    "low": 5,
                    "medium": 3,
                    "high": 1
                }, {
                    "category": "Adroit IT",
                    "low": 2,
                    "medium": 3,
                    "high": 1
                }, {
                    "category": "Capterra",
                    "low": 6,
                    "medium": 2,
                    "high": 2
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 2,
                    "color": "#41BFD5",
                    "projects2": 1000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#65909A",
                    "projects2": 9000
                }, {
                    "type": "Hardware",
                    "category2": 2,
                    "color": "#e7505a",
                    "projects2": 10000
                }],
                "months3": [{
                    "a": 5,
                    "b": 2,
                    "color": "#41BFD5",
                    "valuea": 3,
                    "Period": "Q1-2016"
                }, {
                    "a": 10,
                    "color": "#41BFD5",
                    "b": 5,
                    "valuea": 5,
                    "Period": "Q2-2016"
                }, {
                    "a": 3,
                    "b": 1,
                    "color": "#41BFD5",
                    "valuea": 2,
                    "Period": "Q3-2016"
                }, {
                    "a": 2,
                    "b": 1,
                    "valuea": 1,
                    "color": "#41BFD5",
                    "Period": "Q4-2016"
                }]
            },
            {
                "color": "#00688B",
                "department": "Loan",
                "projects": 15,
                "url": "#",
                "description": "click to drill-down",
                "months": [{
                    "category": "Capgemini",
                    "low": 2,
                    "medium": 3,
                    "high": 1,
                }, {
                    "category": "Adroit IT",
                    "low": 2,
                    "medium": 2,
                    "high": 2
                }, {
                    "category": "Capterra",
                    "low": 1,
                    "medium": 1,
                    "high": 1
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 3,
                    "color": "#41BFD5",
                    "projects2": 100000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#65909A",
                    "projects2": 70000
                }, {
                    "type": "Hardware",
                    "category2": 1,
                    "color": "#e7505a",
                    "projects2": 100000
                }],
                "months3": [{
                    "a": 100,
                    "color": "#41BFD5",
                    "b": 10,
                    "valuea": 90,
                    "Period": "Q1-2016"
                }, {
                    "a": 50,
                    "b": 15,
                    "color": "#41BFD5",
                    "valuea": 35,
                    "Period": "Q2-2016"
                }, {
                    "a": 50,
                    "b": 20,
                    "color": "#41BFD5",
                    "valuea": 30,
                    "Period": "Q3-2016"
                }, {
                    "a": 70,
                    "b": 30,
                    "color": "#41BFD5",
                    "valuea": 40,
                    "Period": "Q4-2016"
                }]
            },
            {
                "color": "#65909A",
                "department": "Retail",
                "projects": 22,
                "url": "#",
                "description": "click to drill-down",
                "months": [{
                    "category": "Capgemini",
                    "low": 6,
                    "medium": 3,
                    "high": 1
                }, {
                    "category": "Adroit IT",
                    "low": 2,
                    "medium": 3,
                    "high": 1
                }, {
                    "category": "Capterra",
                    "low": 2,
                    "medium": 3,
                    "high": 1
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 1,
                    "color": "#41BFD5",
                    "projects2": 300000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#e7505a",
                    "projects2": 100000
                }, {
                    "type": "Hardware",
                    "category2": 2,
                    "color": "#65909A",
                    "projects2": 200000
                }],
                "months3": [{
                    "a": 200,
                    "b": 50,
                    "color": "#41BFD5",
                    "valuea": 150,
                    "Period": "Q1-2016"
                }, {
                    "a": 100,
                    "b": 50,
                    "color": "#41BFD5",
                    "valuea": 50,
                    "Period": "Q2-2016"
                }, {
                    "a": 150,
                    "b": 75,
                    "color": "#41BFD5",
                    "valuea": 75,
                    "Period": "Q3-2016"
                }, {
                    "a": 150,
                    "b": 85,
                    "color": "#41BFD5",
                    "valuea": 65,
                    "Period": "Q4-2016"
                }]
            },
            {
                "color": "#e7505a",
                "department": "Trade Finance",
                "projects": 3,
                "url": "#",
                "description": "click to drill-down",
                "months": [{
                    "category": "Capgemini",
                    "low": 1,
                    "medium": 0,
                    "high": 0
                }, {
                    "category": "Adroit IT",
                    "low": 0,
                    "medium": 0,
                    "high": 1
                }, {
                    "category": "Capterra",
                    "low": 0,
                    "medium": 1,
                    "high": 0
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 1,
                    "color": "#41BFD5",
                    "projects2": 200000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#e7505a",
                    "projects2": 50000
                }, {
                    "type": "Hardware",
                    "category2": 2,
                    "color": "#65909A",
                    "projects2": 56000
                }],
                "months3": [{
                    "a": 110,
                    "b": 20,
                    "color": "#41BFD5",
                    "valuea": 90,
                    "Period": "Q1-2016"
                }, {
                    "a": 60,
                    "b": 25,
                    "color": "#41BFD5",
                    "valuea": 35,
                    "Period": "Q2-2016"
                }, {
                    "a": 85,
                    "b": 15,
                    "color": "#41BFD5",
                    "valuea": 70,
                    "Period": "Q3-2016"
                }, {
                    "a": 55,
                    "b": 10,
                    "color": "#41BFD5",
                    "valuea": 45,
                    "Period": "Q4-2016"
                }]
            },
            {
                "color": "#738989",
                "department": "Cards",
                "projects": 11,
                "url": "#",
                "description": "click to drill-down",
                "months": [{
                    "category": "Capgemini",
                    "low": 1,
                    "medium": 2,
                    "high": 1
                }, {
                    "category": "Adroit IT",
                    "low": 2,
                    "medium": 3,
                    "high": 1
                }, {
                    "category": "Capterra",
                    "low": 4,
                    "medium": 0,
                    "high": 0
                }],
                "months2": [{
                    "type": "Services",
                    "category2": 1,
                    "color": "#41BFD5",
                    "projects2": 50000
                }, {
                    "type": "People",
                    "category2": 1,
                    "color": "#e7505a",
                    "projects2": 25000
                }, {
                    "type": "Hardware",
                    "category2": 2,
                    "color": "#65909A",
                    "projects2": 25000
                }],
                "months3": [{
                    "a": 25,
                    "b": 12,
                    "color": "#41BFD5",
                    "valuea": 13,
                    "Period": "Q1-2016"
                }, {
                    "a": 30,
                    "b": 11,
                    "color": "#41BFD5",
                    "valuea": 19,
                    "Period": "Q2-2016"
                }, {
                    "a": 10,
                    "b": 5,
                    "color": "#41BFD5",
                    "valuea": 5,
                    "Period": "Q3-2016"
                }, {
                    "a": 35,
                    "b": 20,
                    "color": "#41BFD5",
                    "valuea": 15,
                    "Period": "Q4-2016"
                }]
            }
        ];
        // aggregate collective data
        var collectiveData = [];
        for (var x in chartData) {
            var dataPoint = chartData[x];
            if (0 == x) {
                for (var y in dataPoint.months) {
                    collectiveData.push({
                        "category": dataPoint.months[y].category,
                        "low": dataPoint.months[y].low,
                        "medium": dataPoint.months[y].medium,
                        "high": dataPoint.months[y].high
                    });
                }
            } else {
                for (var y in dataPoint.months) {
                    //   collectiveData[y].projects += dataPoint.months[y].projects;
                }
            }
        }
        var collectiveData2 = [];
        for (var x in chartData) {
            var dataPoint = chartData[x];
            if (0 == x) {
                for (var y in dataPoint.months2) {
                    collectiveData2.push({
                        "category2": dataPoint.months2[y].category2,
                        "type": dataPoint.months2[y].type,
                        "projects2": dataPoint.months2[y].projects2
                    });
                }
            } else {
                for (var y in dataPoint.months2) {
                    //   collectiveData2[y].projects2 += dataPoint.months2[y].projects2;
                }
            }
        }
        var collectiveData3 = [];
        for (var x in chartData) {
            var dataPoint = chartData[x];
            if (0 == x) {
                for (var y in dataPoint.months3) {
                    collectiveData3.push({
                        "a": dataPoint.months3[y].a,
                        "b": dataPoint.months3[y].b,
                        "Period": dataPoint.months3[y].Period,
                        "valuea": dataPoint.months3[y].valuea
                    });
                }
            } else {
                for (var y in dataPoint.months3) {
                    //         collectiveData3[y].projects3 += dataPoint.months3[y].projects3;
                }
            }
        }

        // create pie chart
        var chart = AmCharts.makeChart("port1", {
            "type": "pie",
            "theme": "light",
            "titles": [{
                "text": "Click on Slices",
                "bold": false,
                "size": 10
            }],
            labelsEnabled: false,
            autoMargins: false,
            marginTop: 0,
			
            marginBottom: 0,
            marginLeft: 0,
            marginRight: 0,
            pullOutRadius: 5,
            "dataProvider": chartData,
            "valueField": "projects",
            "titleField": "department",
            "colorField": "color",
            "labelsEnabled": false,
            "pullOutOnlyOne": true
            //labelsEnabled: false,

        });

        // create column chart
        var chart2 = AmCharts.makeChart("port2", {
            "type": "serial",
            marginTop: 10,
            marginBottom: 10,
            marginLeft: 10,
            marginRight: 10,
            //  pullOutRadius: 5,
            "titles": [{
                "text": "All departments"
            }],
            "dataProvider": collectiveData,
            "startDuration": 1,
            "bulletBorderThickness": 0,
            "graphs": [{
                "balloonText": "[[title]]: [[value]]",
                "title": "low",
                "type": "column",
                "fillAlphas": 0.8,
                "fillColors": "#65909A",
                "lineColor": "#65909A",
                "valueField": "low"

            }, {
                "balloonText": "[[title]]: [[value]]",
                "title": "medium",
                "type": "column",
                "fillAlphas": 0.8,
                "fillColors": "#00688B",
                "lineColor": "#00688B",
                "valueField": "medium"
            }, {
                "balloonText": "[[title]]: [[value]]",
                "title": "high",
                "type": "column",
                "fillAlphas": 0.8,
                "fillColors": "#e7505a",
                "lineColor": "#e7505a",
                "valueField": "high"
            }],
            "categoryField": "category",
            "categoryAxis": {

                "gridPosition": "start",
                "autoGridCount": false,
                "gridCount": 20
            },
            "valueAxes": [{
                "integersOnly": true,
                "stackType": "regular",
            }]
        });

        var chart5 = AmCharts.makeChart("port5", {
            "type": "xy",
            marginTop: 0,
            marginBottom: 40,
            marginLeft: 40,
            marginRight: 15,
            "titles": [{
                "text": "All departments"
            }],
			  "allLabels": [{
				"text": "Revenue in $",
				"rotation": 270,
				"x": "5",
				"y": "80",
				"width": "50%",
				"size": 10,
				"align": "right"
			  },{
				"text": "Spending in $",
				"x": "!100",
				"y": "!12",
				"width": "50%",
				"size": 10,
				"align": "right"
			  }],
            "startDuration": 1,
            "dataProvider": collectiveData3,
            "valueAxes": [{
                "position": "bottom",
                "axisAlpha": 0
            }, {
                "minMaxMultiplier": 1.2,
                "axisAlpha": 0,
                "position": "left"
            }],
            "graphs": [{
                "balloonText": "Spending:<b>[[x]]</b> Revenue:<b>[[y]]</b><br>Profit:<b>[[value]]</b> Period: [[Period]]",
                "bullet": "bubble",
                "lineAlpha": 0,
                "valueField": "valuea",
                "xField": "b",
                "yField": "a",
                "fillAlphas": 0,
                "colorField": "color",
                "bulletBorderAlpha": 0.2,
                "minBulletSize": 10,
                "maxBulletSize": 30
            }],
            "balloon": {
                "fixedPosition": true
            }
        });

        var chart6 = AmCharts.makeChart("port6", {
            "type": "pie",
            labelsEnabled: false,
            autoMargins: false,
            marginTop: 0,
            marginBottom: 0,
            marginLeft: 0,
            marginRight: 0,
            pullOutRadius: 5,
            "theme": "dark",
            "colorField": "color",
            "innerRadius": "60%",
            "labelsEnabled": false,
            "titles": [{
                "text": "All departments"
            }],
            "startDuration": 1,
            "dataProvider": collectiveData2,
            "balloonText": "[[type]]: $[[value]]",
            "valueField": "projects2",
            "titleField": "type",
            "balloon": {
                "drop": true,
                "adjustBorderColor": true,
                //    "color": "#8E44AD",
                "fontSize": 10
            }
        });


        chart.addListener("pullOutSlice", function(event) {
            chart2.dataProvider = event.dataItem.dataContext.months;
            chart2.titles[0].text = event.dataItem.dataContext.department;
            chart2.validateData();
            chart2.animateAgain();
            chart5.dataProvider = event.dataItem.dataContext.months3;
            chart5.titles[0].text = event.dataItem.dataContext.department;
            chart5.validateData();
            chart5.animateAgain();
            chart6.dataProvider = event.dataItem.dataContext.months2;
            chart6.titles[0].text = event.dataItem.dataContext.department;
            chart6.validateData();
            chart6.animateAgain();
        });

        chart.addListener("pullInSlice", function(event) {
            chart2.dataProvider = collectiveData;
            chart2.titles[0].text = "All departments";
            chart2.validateData();
            chart2.animateAgain();
            chart6.dataProvider = collectiveData2;
            chart6.titles[0].text = "All departments";
            chart6.validateData();
            chart6.animateAgain();
            chart5.dataProvider = collectiveData3;
            chart5.titles[0].text = "All departments";
            chart5.validateData();
            chart5.animateAgain();
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("bubblecomp", {
            "type": "xy",
            "theme": "light",
            "dataDateFormat": "YYYY-MM-DD",
            "startDuration": 1.5,
             autoMargins: false,
                marginTop: 15,
                marginBottom: 25,
                marginLeft: 32,
                marginRight: 10,
            "titles": [{
                "text": "Deployed Components Count"
            }],
            "legend": [{
                "enabled": true,
                "marker": 2,
                "markerSize": 8,
            }],

            "balloon": {
                "adjustBorderColor": false,
                "shadowAlpha": 0,
                "fixedPosition": true
            },
            "graphs": [{
                "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
                "bullet": "round",
                "bulletAlpha": 0.5,
                "id": "AmGraph-1",
                "title": "Dev",
                "lineAlpha": 0,
                "fillAlphas": 0,
                "valueField": "aValue",
                "xField": "date",
                "yField": "ay"
            }, {
                "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
                "bullet": "round",
                "bulletAlpha": 0.5,
                "id": "AmGraph-2",
                "title": "Test",
                "lineAlpha": 0,
                "fillAlphas": 0,
                "valueField": "bValue",
                "xField": "date",
                "yField": "by"
            }, {
                "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
                "bullet": "round",
                "bulletAlpha": 0.5,
                "id": "AmGraph-3",
                "title": "Pre-Prod",
                "lineAlpha": 0,
                "fillAlphas": 0,
                "valueField": "cValue",
                "xField": "date",
                "yField": "cy"
            }, {
                "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
                "bullet": "round",
                "bulletAlpha": 0.5,
                "id": "AmGraph-4",
                "title": "Prod",
                "lineAlpha": 0,
                "fillAlphas": 0,
                "valueField": "dValue",
                "xField": "date",
                "yField": "dy"
            }],
            "valueAxes": [{
                "id": "ValueAxis-1",
                "axisAlpha": 0
            }, {
                "id": "ValueAxis-2",
                "axisAlpha": 0,
                "position": "bottom",
                "type": "date",
                "minimumDate": new Date(2015, 11, 31),
                "maximumDate": new Date(2016, 12, 31)
            }],
            "dataProvider": [{
                "date": "2016-01-01",
                "ay": 40,
                "by": 30,
                "cy": 20,
                "dy": 10,
                "aValue": 400,
                "bValue": 350,
                "cValue": 215,
                "dValue": 150
            }, {
                "date": "2016-02-01",
                "ay": 43,
                "by": 36,
                "cy": 22,
                "dy": 16,
                "aValue": 434,
                "bValue": 367,
                "cValue": 212,
                "dValue": 165
            }, {
                "date": "2016-03-01",
                "ay": 44,
                "by": 35,
                "cy": 22,
                "dy": 17,
                "aValue": 433,
                "bValue": 366,
                "cValue": 224,
                "dValue": 167
            }, {
                "date": "2016-04-01",
                "ay": 73,
                "by": 45,
                "cy": 67,
                "dy": 29,
                "aValue": 734,
                "bValue": 234,
                "cValue": 546,
                "dValue": 234
            }, {
                "date": "2016-05-01",
                "ay": 34,
                "by": 54,
                "cy": 63,
                "dy": 23,
                "aValue": 343,
                "bValue": 293,
                "cValue": 784,
                "dValue": 234
            }, {
                "date": "2016-06-01",
                "ay": 34,
                "by": 56,
                "cy": 93,
                "dy": 23,
                "aValue": 124,
                "bValue": 384,
                "cValue": 934,
                "dValue": 873
            }, {
                "date": "2016-07-01",
                "ay": 12,
                "by": 65,
                "cy": 55,
                "dy": 66,
                "aValue": 345,
                "bValue": 665,
                "cValue": 778,
                "dValue": 990
            }, {
                "date": "2016-08-01",
                "ay": 63,
                "by": 23,
                "cy": 76,
                "dy": 23,
                "aValue": 738,
                "bValue": 234,
                "cValue": 657,
                "dValue": 564
            }, {
                "date": "2016-09-01",
                "ay": 34,
                "by": 56,
                "cy": 67,
                "dy": 89,
                "aValue": 211,
                "bValue": 342,
                "cValue": 564,
                "dValue": 786
            }, {
                "date": "2016-10-01",
                "ay": 32,
                "by": 76,
                "cy": 54,
                "dy": 98,
                "aValue": 322,
                "bValue": 544,
                "cValue": 655,
                "dValue": 877
            }, {
                "date": "2016-11-01",
                "ay": 24,
                "by": 46,
                "cy": 57,
                "dy": 80,
                "aValue": 244,
                "bValue": 466,
                "cValue": 688,
                "dValue": 577
            }, {
                "date": "2016-12-01",
                "ay": 34,
                "by": 54,
                "cy": 25,
                "dy": 26,
                "aValue": 322,
                "bValue": 454,
                "cValue": 676,
                "dValue": 878
            }]
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("negativechart", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment and Failure by Application (Q4 2016)"
            }],
            "rotate": true,
            "marginBottom": 0,
            "dataProvider": [{
                "age": "PLIS",
                "Failure": -1,
                "Deployment": 07
            }, {
                "age": "STAT",
                "Failure": -2,
                "Deployment": 09
            }, {
                "age": "Carestat",
                "Failure": -3,
                "Deployment": 06
            }, {
                "age": "Finance",
                "Failure": -5,
                "Deployment": 08
            }, {
                "age": "Producer",
                "Failure": -4,
                "Deployment": 10
            }, {
                "age": "Informatica",
                "Failure": -8,
                "Deployment": 13
            }, {
                "age": "Bridging(FSC/TAM)",
                "Failure": -6,
                "Deployment": 19
            }, {
                "age": "AMI",
                "Failure": -8,
                "Deployment": 25
            }, {
                "age": "Download",
                "Failure": -9,
                "Deployment": 30
            }, {
                "age": "Advanced Claims",
                "Failure": -12,
                "Deployment": 36
            }, {
                "age": "Texas Town Code Service",
                "Failure": -12,
                "Deployment": 44
            }, {
                "age": "Quoting Producer Service",
                "Failure": -13,
                "Deployment": 48
            }, {
                "age": "EPICS",
                "Failure": -13,
                "Deployment": 51
            }, {
                "age": "BillingCenter",
                "Failure": -9,
                "Deployment": 48
            }, {
                "age": "ClaimCenter",
                "Failure": -8,
                "Deployment": 42
            }, {
                "age": "Audit-Control",
                "Failure": -11,
                "Deployment": 34
            }, {
                "age": "Agency Port",
                "Failure": -4,
                "Deployment": 41
            }, {
                "age": "Inbox",
                "Failure": -2,
                "Deployment": 48
            }],
            "startDuration": 1,
            "graphs": [{
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "Deployment",
                "title": "Deployment",
                "labelText": "[[value]]",
                "clustered": false,
                "labelFunction": function(item) {
                    return Math.abs(item.values.value);
                },
                "balloonFunction": function(item) {
                    return item.category + ": " + Math.abs(item.values.value) + "%";
                }
            }, {
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "Failure",
                "title": "Failure",
                "labelText": "[[value]]",
                "clustered": false,
                "labelFunction": function(item) {
                    return Math.abs(item.values.value);
                },
                "balloonFunction": function(item) {
                    return item.category + ": " + Math.abs(item.values.value) + "%";
                }
            }],
            "categoryField": "age",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0.2,
                "axisAlpha": 0
            },
            "valueAxes": [{
                "gridAlpha": 0,
                "ignoreAxisWidth": true,
                "labelFunction": function(value) {
                    return Math.abs(value) + '%';
                },
                "guides": [{
                    "value": 0,
                    "lineAlpha": 0.2
                }]
            }],
            "balloon": {
                "fixedPosition": true
            },
            "chartCursor": {
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0.05,
                "fullWidth": true
            },
            "allLabels": [{
                "text": "Failure",
                "x": "25%",
                "y": "95%",
                "bold": true,
                "align": "up"
            }, {
                "text": "Deployment",
                "x": "90%",
                "y": "95%",
                "bold": true,
                "align": "up"
            }]

        });

    </script>
    <script>
        var chart = AmCharts.makeChart("deployspeed", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment by Portfolio(Monthly Trend)"
            }],
            "valueAxes": [{
                "position": "left",
				"minimum": 0
            }],
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 1,
                "cursorColor": "#258cbb",
                "limitToGraph": "g1",
                "valueLineAlpha": 0.2,
            },
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Loan",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value]]</span>"
            }, {
                "id": "g2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Investment",
                "useLineColorForBulletBorder": true,
                "valueField": "value1",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value1]]</span>"
            }, {
                "id": "g3",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Retail Banking",
                "useLineColorForBulletBorder": true,
                "valueField": "value2",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value2]]</span>"
            }, {
                "id": "g4",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Cards",
                "useLineColorForBulletBorder": true,
                "valueField": "value3",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value3]]</span>"
            }, {
                "id": "g5",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Trade Finance",
                "useLineColorForBulletBorder": true,
                "valueField": "value4",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value4]]</span>"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "dataProvider": [{
                    "date": "Jan",
                    "value": 19,
                    "value1": 13,
                    "value2": 14,
                    "value3": 18,
                    "value4": 7
                }, {
                    "date": "Feb",
                    "value": 15,
                    "value1": 13,
                    "value2": 16,
                    "value3": 14,
                    "value4": 15
                }, {
                    "date": "Mar",
                    "value": 20,
                    "value1": 22,
                    "value2": 12,
                    "value3": 18,
                    "value4": 12
                },
                {
                    "date": "Apr",
                    "value": 22,
                    "value1": 12,
                    "value2": 17,
                    "value3": 13,
                    "value4": 15
                }, {
                    "date": "May",
                    "value": 13,
                    "value1": 22,
                    "value2": 19,
                    "value3": 15,
                    "value4": 12
                }, {
                    "date": "Jun",
                    "value": 17,
                    "value1": 24,
                    "value2": 21,
                    "value3": 24,
                    "value4": 25
                }, {
                    "date": "Jul",
                    "value": 14,
                    "value1": 28,
                    "value2": 24,
                    "value3": 17,
                    "value4": 18
                }, {
                    "date": "Aug",
                    "value": 10,
                    "value1": 22,
                    "value2": 15,
                    "value3": 14,
                    "value4": 12
                }, {
                    "date": "Sep",
                    "value": 13,
                    "value1": 22,
                    "value2": 15,
                    "value3": 16,
                    "value4": 14
                }, {
                    "date": "Oct",
                    "value": 19,
                    "value1": 14,
                    "value2": 19,
                    "value3": 14,
                    "value4": 21
                }, {
                    "date": "Nov",
                    "value": 19,
                    "value1": 24,
                    "value2": 13,
                    "value3": 17,
                    "value4": 19
                }, {
                    "date": "Dec",
                    "value": 25,
                    "value1": 26,
                    "value2": 18,
                    "value3": 26,
                    "value4": 19
                }
            ]
        });

    </script>
    <script>
        var chart = AmCharts.makeChart("appspeed", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment by Application(Monthly Trend)"
            }],
            "valueAxes": [{
                "position": "left",
				"minimum": 0
            }],
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 1,
                "cursorColor": "#258cbb",
                "limitToGraph": "g1",
                "valueLineAlpha": 0.2,
            },
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "PLIS",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value]]</span>"
            }, {
                "id": "g2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "STAT",
                "useLineColorForBulletBorder": true,
                "valueField": "value1",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value1]]</span>"
            }, {
                "id": "g3",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Finance",
                "useLineColorForBulletBorder": true,
                "valueField": "value2",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value2]]</span>"
            }, {
                "id": "g4",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "Informatica",
                "useLineColorForBulletBorder": true,
                "valueField": "value3",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value3]]</span>"
            }, {
                "id": "g5",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "lineThickness": 2,
                "title": "BillingCenter",
                "useLineColorForBulletBorder": true,
                "valueField": "value4",
                "balloonText": "<span style='font-size:11px;'>[[title]] [[value4]]</span>"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "dataProvider": [{
                    "date": "Jan",
                    "value": 13,
                    "value1": 13,
                    "value2": 14,
                    "value3": 18,
                    "value4": 7
                }, {
                    "date": "Feb",
                    "value": 11,
                    "value1": 13,
                    "value2": 16,
                    "value3": 14,
                    "value4": 15
                }, {
                    "date": "Mar",
                    "value": 15,
                    "value1": 22,
                    "value2": 12,
                    "value3": 18,
                    "value4": 12
                },
                {
                    "date": "Apr",
                    "value": 16,
                    "value1": 12,
                    "value2": 12,
                    "value3": 11,
                    "value4": 15
                }, {
                    "date": "May",
                    "value": 18,
                    "value1": 22,
                    "value2": 15,
                    "value3": 11,
                    "value4": 12
                }, {
                    "date": "Jun",
                    "value": 13,
                    "value1": 24,
                    "value2": 26,
                    "value3": 20,
                    "value4": 29
                }, {
                    "date": "Jul",
                    "value": 23,
                    "value1": 32,
                    "value2": 21,
                    "value3": 12,
                    "value4": 12
                }, {
                    "date": "Aug",
                    "value": 21,
                    "value1": 22,
                    "value2": 13,
                    "value3": 11,
                    "value4": 12
                }, {
                    "date": "Sep",
                    "value": 12,
                    "value1": 22,
                    "value2": 13,
                    "value3": 11,
                    "value4": 12
                }, {
                    "date": "Oct",
                    "value": 17,
                    "value1": 14,
                    "value2": 17,
                    "value3": 12,
                    "value4": 19
                }, {
                    "date": "Nov",
                    "value": 11,
                    "value1": 22,
                    "value2": 17,
                    "value3": 12,
                    "value4": 19
                }, {
                    "date": "Dec",
                    "value": 28,
                    "value1": 22,
                    "value2": 14,
                    "value3": 30,
                    "value4": 19
                }
            ]
        });

        var chart = AmCharts.makeChart("failure4", {
            "type": "serial",
            "theme": "light",
            "labelsEnabled": "false",
            "titles": [{
                "text": "Deployment Failures by Environment (Q4 2016)"
            }],
            "dataProvider": [{
                "country": "Development",
                "visits": 15
            }, {
                "country": "Test",
                "visits": 20
            }, {
                "country": "Pre-Prod",
                "visits": 10
            }, {
                "country": "Production",
                "visits": 3
            }],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            }

        });

    </script>

    <script>
        var chart = AmCharts.makeChart("chartdive", {
            "type": "serial",
            "theme": "none",
            "allLabels": [{
                "text": "Deployments by Technology & by No. of Components (Q4 2016)",
                "align": "center",
                "bold": true,
                "size": 12,
                "y": 10,
                "x": 2
            }],
            "marginTop": 40,
            "legend": {
                "equalWidths": true,
                "position": "bottom",
                "valueAlign": "left",
                "labelWidth": 70,
                "valueWidth": 0,
                "markerSize": 10,
                "align": "left"
            },
            "rotate": "true",
            "columnWidth": 0.6,
            /*Value of 1 will make them wide, 0 will make them thin. You can use anything inbetween as well, such as 0.65.*/
            "dataProvider": [{
                "country": "Investment",
                "visits": 1500,
                "visits1": 2200,
                "visits2": 1600,
                "visits3": 500
            }, {
                "country": "Loan",
                "visits": 1100,
                "visits1": 1500,
                "visits2": 350,
                "visits3": 300
            }, {
                "country": "Retail Banking",
                "visits": 600,
                "visits1": 1900,
                "visits2": 5000,
                "visits3": 500
            }, {
                "country": "Trade Finance",
                "visits": 800,
                "visits1": 1600,
                "visits2": 1000,
                "visits3": 900
            }, {
                "country": "Cards",
                "visits": 9000,
                "visits1": 1300,
                "visits2": 2025,
                "visits3": 2005
            }],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "stackType": "regular"
            }],
            "gridAboveGraphs": true,
            "startDuration": 2,
            "graphs": [{
                "title": "Mainframe",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }, {

                "title": "J2EE",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits1"
            }, {
                "title": "Unix",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits2"
            }, {
                "title": ".Net",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits3"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 10
            }
        });

    </script>

    <script>
        var chart = AmCharts.makeChart("envcomp", {
            "type": "serial",
            "theme": "none",
            "titles": [{
                "text": "Deployed Components By Environment (Q4 2016)"
            }],
            "legend": {
                "equalWidths": false,
                //"periodValueText": "total: [[value.sum]]",
                "markerSize": 10,
                "position": "bottom",
                "valueAlign": "left",
                "labelWidth": 60,
                "valueWidth": 0,
                //"width": 100,
                "align": "center"
            },
            "rotate": "true",
            "columnWidth": 0.6,
            /*Value of 1 will make them wide, 0 will make them thin. You can use anything inbetween as well, such as 0.65.*/
            "dataProvider": [{
                "country": "Pre-Prod",
                "visits": 20,
                "visits1": 22,
                "visits2": 16,
                "visits3": 5
            }, {
                "country": "Prod",
                "visits": 25,
                "visits1": 15,
                "visits2": 30,
                "visits3": 3
            }, {
                "country": "Test",
                "visits": 12,
                "visits1": 19,
                "visits2": 50,
                "visits3": 5
            }, {
                "country": "Development",
                "visits": 15,
                "visits1": 16,
                "visits2": 10,
                "visits3": 09
            }],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "stackType": "regular"
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "title": "Mainframe",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }, {
                "title": "J2EE",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }, {
                "title": "Unix",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }, {
                "title": ".Net",
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            }
        });

        var chart = AmCharts.makeChart("failure1", {
            "type": "serial",
            "theme": "light",
            "titles": [{
                "text": "Deployment Failures - Pareto Chart (Q4 2016)"
            }],
            "dataProvider": [{
                "country": "Insufficient Resources",
                "visits": 12,
                "color": "#49a2df",
                "percent": "30%",
            }, {
                "country": "Change in scopes mid-project",
                "visits": 10,
                "color": "#e7505a",
                "percent": 55
            }, {
                "country": "Wrong Estimation",
                "visits": 8,
                "color": "#888888",
                "percent": 75
            }, {
                "country": "Change in Strategy",
                "visits": 6,
                "color": "#808000",
                "percent": 90
            }, {
                "country": "Change in Environment",
                "visits": 4,
                "color": "#39b7cd",
                "percent": 100
            }],
            "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "position": "left",
                "maximum": 100
            }, {
                "id": "v2",
                "axisAlpha": 0,
                "position": "right",
                "unit": "%",
                "gridAlpha": 0,
                "maximum": 100
            }],
            "startDuration": 1,
            "graphs": [{
                "fillAlphas": 1,
                "colorField": "color",
                "type": "column",
                "balloonText": "<div style='margin:5px; font-size:10px;'><span style='font-size:13px;'>[[category]]</span><br>[[value]]</div>",
                "valueField": "visits"
            }, {
                "valueAxis": "v2",
                "bullet": "round",
                "lineThickness": 3,
                "bulletSize": 7,
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "useLineColorForBulletBorder": true,
                "fillAlphas": 0,
                "lineAlpha": 1,
                "title": "Percent",
                "valueField": "percent"
            }],
            "categoryField": "country",
            "categoryAxis": {
                "labelsEnabled": false,
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });


        var chart = AmCharts.makeChart("failure3", {
            "type": "pie",
            "theme": "light",
            "titles": [{
                "text": "Failure by Top 5 Application (Q4 2016)"
            }],
            "dataProvider": [{
                "title": "PLIS",
                "value": 5
            }, {
                "title": "Billing Center",
                "value": 12
            }, {
                "title": "STAT",
                "value": 8
            }, {
                "title": "Informatica",
                "value": 7
            }, {
                "title": "Finance",
                "value": 8
            }],
            "titleField": "title",
            "valueField": "value",
            "innerRadius": 70,
            "labelsEnabled": false,
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
        });

        var chart = AmCharts.makeChart("failure2", {
            "type": "pie",
            "theme": "light",
            "titles": [{
                "text": "Deployment Failure by Vendor (Q4 2016)"
            }],
            "innerRadius": 70,
            "labelsEnabled": false,
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "title": "Internal",
                "value": 13
            }, {
                "title": "Capgemini",
                "value": 11
            }, {
                "title": "Adroit IT",
                "value": 9
            }, {
                "title": "Capterra",
                "value": 7
            }],
            "titleField": "title",
            "valueField": "value"
        });

        var chart = AmCharts.makeChart("deploybar", {
            "type": "serial",
            "theme": "none",
            "titles": [{
                "text": "Deployment by Vendor (Q4 2016)"
            }],
            "legend": {
                "position": "bottom",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },
            "columnWidth": 0.8,
            "dataProvider": [{
                "country": "Internal",
                "visits": 25,
                "visits1": 10,
                "visits2": 5,
                "visits3": 5
            }, {
                "country": "Capgemini",
                "visits": 25,
                "visits1": 25,
                "visits2": 5,
                "visits3": 5
            }, {
                "country": "Adroit IT",
                "visits": 25,
                "visits1": 25,
                "visits2": 5,
                "visits3": 5
            }, {
                "country": "Capterra",
                "visits": 25,
                "visits1": 15,
                "visits2": 10,
                "visits3": 7
            }],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "stackType": "regular"
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "title": "Development",
                "balloonText": "[[title]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }, {
                "title": "Test",
                "balloonText": "[[title]]: <b> [[value]] </b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits1"
            }, {
                "title": "Pre-Prod",
                "balloonText": "[[title]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits2"
            }, {
                "title": "Production",
                "balloonText": "[[title]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits3"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            }
        });

        var chart = AmCharts.makeChart("deploybar2", {
            "type": "serial",
            "theme": "none",
            "titles": [{
                "text": "Deployment by Environment (Q4 2016)"
            }],
            "columnWidth": 0.8,
            "dataProvider": [{
                "country": "Develop",
                "visits": 100
            }, {
                "country": "Test",
                "visits": 75
            }, {
                "country": "Pre-Prod",
                "visits": 25
            }, {
                "country": "Prod",
                "visits": 22
            }],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
				"minimum": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            }
        });

         var chart = AmCharts.makeChart("assessmentradarchart", {
            "type": "radar",
            "theme": "light",
            "color": "#142C35",
            "fontSize": 10,
            "dataProvider": [{
                "country": "Culture/Organisation",
                "current": 1,
                "desired": 4
            }, {
                "country": "Build,Integration&Release",
                "current": 2,
                "desired": 5
            }, {
                "country": "Data Management",
                "current": 0,
                "desired": 5
            }, {
                "country": "Quality Management",
                "current": 1,
                "desired": 5
            }, {
                "country": "Collaborate/Monitor",
                "current": 1,
                "desired": 4
            }],
            "valueAxes": [{
                "axisTitleOffset": 2,
                "minimum": 0,
                "axisAlpha": 0.2
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "Current: [[value]]",
                "bullet": "round",
                "lineThickness": 2,
                "valueField": "current"
            }, {
                "balloonText": "Desired: [[value]]",
                "bullet": "round",
                "lineThickness": 2,
                "valueField": "desired"
            }],
            "categoryField": "country"

        });
    </script>
    </body>
</html>
