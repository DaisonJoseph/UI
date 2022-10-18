<?php require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
        
<style>
.amcharts-chart-div .cur
{
    cursor : pointer;
}
 
    
h1{
  color: #396;
  font-weight: 100;
  font-size: 50px;
  margin: 40px 0px 20px;
}
.overflow{
    /* overflow: hidden; */
    display: flex;
    justify-content: center;
    align-items: center;
}

.bars, .charts, .pie, .primary-font{
    font-family: "Arial" !important;
}

#clockdiv{
 
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 300;
    text-align: center;
    font-size: 55px;
    padding: 10px;
}


#clockdiv > div{
    margin: auto;
    padding: 10px;
    border-radius: 8px;
    background: white;
    display: inline-block;
}
.size{
    height: 80px;
    border-radius: 50%
}
#clockdiv div > span{
    height: 90px;
    padding: 10px;
    border-radius: 10px;
    background: #1F618D;
    display: inline-block;
}


.smalltext{
    padding-top: 5px;
    font-size: 20px;
    flex-wrap: wrap;
    color: black;
    margin-top: 2%;
    font-family: 'Do Hyeon', sans-serif;
}
#defectByStatus{
  width: 100%;
  height: 500px;
  margin: auto;
}


.dropdown{
    margin-left: 1290px;
    margin-top: -20px;
    border-radius: 3px;
    /* padding-right: 2px; */
}

/* .dropdown-menu{
   background-color: ivory;
   color: grey;
} */

</style>
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
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-check-circle"></i>
                                <span class="title">DAMM-IT</span>
                            </a>
                            <ul class="sub-menu">
                                	
                                <li class="nav-item">
                                    <a href="DAMM-IT.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Test Exec View</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="defects.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Defect Overview</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="reoverview.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Resource Overview</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                                <li class="nav-item active open">
                                    <a href="portfolio.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Portfolio View</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="reportShowcase.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Report Showcase</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="coveragetable.php" class="nav-link nav-toggle">
                                        <!-- <i class="fa fa-check-circle"></i> -->
                                        <span class="title">Coverage Report</span>
                                        <!-- <span class="selected"></span> -->
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="http://in-pnq-coe35:8089/CommandCentre/index" class="nav-link nav-toggle">
                                <i class="fa"> <img src="dcc_SGP_icon.ico" alt="dcc" height="17px" width="17px"> </i>
                                <span class="title">DCC</span>
                            </a>
                        </li>					 -->
                         <!-- <li class="nav-item">
                            <a href="clientinfo.php" class="nav-link nav-toggle">
                                <i class="fa fa-info"></i>
                                <span class="title">Client Information</span>
                            </a>
                        </li> -->
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
                       <!-- <div class="row" style="margin-top:-5px">
                            
						</div> -->
						<div class="row">
                            <div class="col-sm-12">
                                <div class="portlet light bordered grey-mint">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-white bold">Portfolio View</span>
                                        </div>
                                            <div class="tools">
                                               <a href="" class="collapse"> </a>
                                           </div>
                                            <!-- Dropdown -->
                                            <!-- <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select month-year
                                                        <span class="caret"></span>
                                                    </button> -->
                                                    <!-- <ul class="dropdown-menu" style="width: 300px; height: 200px; overflow: auto">
                                                        <li>
                                                            <a href="#">Jan-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Jan-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Jan-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Jan-2018</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Feb-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Feb-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Feb-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Feb-2018</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Mar-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Mar-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Mar-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Mar-2018</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Apr-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Apr-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Apr-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">May-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">May-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">May-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">June-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">June-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">June-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">July-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">July-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">July-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Aug-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Aug-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Aug-2017</a>
                                                        </li>
                                                         <li>
                                                            <a href="#">Sept-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Sept-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Sept-2017</a>
                                                        </li>
                                                         <li>
                                                            <a href="#">Oct-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Oct-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Oct-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Nov-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Nov-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Nov-2017</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Dec-2015</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Dec-2016</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Dec-2017</a>
                                                        </li>
                                                    </ul> -->
                                                <!-- </div> -->
                                            <!-- </div> -->
                                        <!-- </div> -->
                                        <!-- <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
										<div class="row">
											<br>
											<div class="col-sm-4">
												<div class="portlet light" style="background-color:#ffffff">
													<div class="portlet-body">
															<div id="OTD" class="chart text-center" style="height:350px; width:100%"></div>
													</div>
												</div>
											</div>
											
                                             <div class="col-sm-4">
												<div class="portlet light" style="background-color:#ffffff">
													<div class="portlet-body">
														<div id="DAR" class="chart text-center" style="height:350px"></div>
													</div>
												</div>
                                                <!-- <br> -->
											</div>
                                            <div class="col-sm-4">
												<div class="portlet light" style="background-color:#ffffff">
													<div class="portlet-body">
														<div id="DRE" class="chart text-center" style="height:350px"></div>
													</div>
												</div>
											</div>
                                            
											<!-- <div class="col-sm-12">
												<div class="portlet light" style="background-color:#f1e8f0">
													<div class="portlet-body">
														<div id="OTDtrend" class="chart text-center" style="height:300px"></div>
													</div>
												</div>
											</div> 
                                            <div class="col-sm-12">
												<div class="portlet light" style="background-color:#f1e8f0">
													<div class="portlet-body">
														<div id="DARtrend" class="chart text-center" style="height:300px"></div>
													</div>
												</div>
											</div> 
                                            <div class="col-sm-12">
												<div class="portlet light" style="background-color:#f1e8f0">
													<div class="portlet-body">
														<div id="DREtrend" class="chart text-center" style="height:300px"></div>
													</div>
												</div>
											</div>  -->
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
                
						
                        <script>
                            $(function() {
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
            </div>
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; DevOps Tool By
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
    <!-- <script src="../assets/drilldown/drilldown.js" type="text/javascript"></script> -->
    <!-- <script src="../assets/drilldown/data.js" type="text/javascript"></script> -->
    <!-- <script src="../assets/drilldown/highcharts.js" type="text/javascript"></script> -->
	<script src="../assets/global/plugins/amcharts/amcharts/funnel.js" type="text/javascript" ></script>
    <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/xy.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/gauge.js" type="text/javascript"></script>
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
    <!-- <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> -->
    <!-- <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
	<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/"; ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script> -->

    <?php include 'portfolioCharts.php'; ?> 
	</body>
</html>
