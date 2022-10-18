<?php 
    require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            overflow-x: hidden;
        }

        .chartdiv {
            height: 250px;
            position: relative;
            left: 45px;
            top: 10px;
        }
        @-webkit-keyframes mymove {
            from {top: 0px;}
            to {top: 35px;}
        }

        @keyframes mymove {
            from {top: 0px;}
            to {top: 35px;}
        }
    
        .home-scrolldown i {
           padding-left: 9px;
        }
        .home-scrolldown a{
            transform: rotate(90deg)!important;
            transform-origin: left top 0!important;
                    -webkit-animation: mymove infinite; /* Safari 4.0 - 8.0 */
         -webkit-animation-duration: 2s; /* Safari 4.0 - 8.0 */
         animation: mymove infinite;
         animation-duration: 2s;
      
        }
        .home-scrolldown a:hover,
        .home-scrolldown a:focus {
            color: #44c455 !important;
            text-decoration: none;
        }

      
        .scroll-icon {
            display: inline-block;
            font-family:  sans-serif;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: .3rem;
            color: #FFFFFF !important;
            background: transparent;
            position: relative;
            left:130px;
        }

        .scroll-icon i {
            font-size: 2.4rem;
            position: relative;
            bottom: -6px;
        }
        @media only screen and (max-width: 500px) {
                .home-social-list,
                .home-scrolldown {
                    display: none;
                }}
    </style>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/pages/css/client.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" type="image/x-icon"/>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-sidebar-closed page-sidebar-fixed">
    <div class="page-wrapper">
        <?php include 'header.php' ?>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse" style="margin-top: 50px;">
                    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top : 0px">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item start active open">
                            <a href="clientinfo.php" class="nav-link nav-toggle">
                                <i class="fa fa-info"></i>
                                <span class="title">Client Information</span>
                                <span class="selected"></span>
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
                                <i class="fa  fa-upload"></i>
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
                <div class="page-content" style="background-color:#fff"><br />
                    <div class="row margin-bottom-40 about-header">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <img src="../assets/global/img/clientlogo.png" width="400px" height="120px" />
                            <h2><i><b>For businesses today, the need for speed has never been greater. To remain competitive, enterprises need to meet end users’
                            expectations for responsive and intuitive apps . Digitally-built enterprises are embracing technologies
                            that allow them to do this by increasing their agility and their ability to innovate and develop
                            apps on the fly.</b></i></h2>
                        </div>

                        <div class="home-scrolldown pull-right">
                            <a href="#about" class="scroll-icon smoothscroll">
                                <span>Scroll Down</span>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div >
                    <section id="about">
                    <div class="row" >
                        <div class="col-lg-12 col-xs-12 col-sm-12" >
                            <div class="portlet dark">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="heading">Amount of Revenue</div>
                                            <div class="subheading">(for the year 2015,2016,2017)</div>
                                            <div id="chartdiv" class="chartdiv"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="heading">Amount of IT Spending</div>
                                            <div class="subheading">(for the year 2015,2016,2017)</div>
                                            <div id="chartdiv1" class="chartdiv"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="heading">No. of Emp</div>
                                            <div class="subheading">(for the year 2015,2016,2017)</div>
                                            <div id="chartdiv2" class="chartdiv"></div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <div class="row margin-bottom-40 stories-header"  data-auto-height="true" title="Cost of quality is a methodology that allows an organization to determine the extent to which its resources are used
                    for activities that prevent poor quality.">
                        <div class="col-md-12">
                            <h1>Client Message</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"> </div>
                        <div class="col-md-11">
                            <div class="portlet light">
                                <div class="portlet-body text">
                                    Well, for technology companies, C-level executives have almost always taken an interest in the mechanics of the delivery
                                    of software. I think what we can say is changing is captured well by Marc Andreessen's
                                    observation that "software is eating the world," meaning every business to some extent
                                    is becoming a software company. Financial institutions, brick and mortar retail companies,
                                    all of these and those in between kinds of companies are developing apps now, both web
                                    apps and mobile apps. Any time you have an app, software development is seen as a critical
                                    part of day-to-day business strategy — even for non-traditional software companies. Because
                                    of the exploding role software development has taken on in everyday business, C-level
                                    executives are definitely taking a deeper interest in how these things can be delivered
                                    in an effective way
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                        <div class="col-md-12">
                            <h1>Stakeholders</h1>
                        </div>
                    </div>
                    <div class="row margin-bottom-20 stories-cont">
                        <div class="col-lg-3 col-md-6">
                            <div class="portlet light bordered">
                                <div class="photo">
                                    <img src="../assets/layouts/layout/img/avatar4.jpg" alt="" class="img-responsive" />                                    </div>
                                <div class="title">
                                    <span> Richard White </span>
                                    <div class="desc">
                                        <span><i>DevOps Orchestrator</i></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="portlet light bordered">
                                <div class="photo">
                                    <img src="../assets/layouts/layout/img/avatar5.jpg" alt="" class="img-responsive" />                                    </div>
                                <div class="title">
                                    <span> Sagar Ambani </span>
                                </div>
                                <div class="desc">
                                    <span><i>Spearhead in DevOps</i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="portlet light bordered">
                                <div class="photo">
                                    <img src="../assets/layouts/layout/img/avatar7.jpg" alt="" class="img-responsive" />                                    </div>
                                <div class="title">
                                    <span> Jacob Lee </span>
                                </div>
                                <div class="desc">
                                    <span><i>DevOps Champion</i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="portlet light bordered">
                                <div class="photo">
                                    <img src="../assets/layouts/layout/img/avatar7.jpg" alt="" class="img-responsive" />                                    </div>
                                <div class="title">
                                    <span> Edward Cullen </span>
                                </div>
                                <div class="desc">
                                    <span><i>Brain Behind DevOps</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                        <div class="col-md-12">
                            <h1>Business Drivers</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mt-widget-1">
                                                <div class="mt-icon">
                                                    <a href="#"> </a>
                                                </div>
                                                <div class="card-icon">
                                                    <i class="fa fa-suitcase font-blue theme-font"></i>
                                                </div>
                                                <div class="mt-body">
                                                    <p class="mt-user-title"><i>"Reduce the time to market by 20%."</i></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-widget-1">
                                                <div class="mt-icon">
                                                    <a href="#">
                                                        </a>
                                                </div>
                                                <div class="card-icon">
                                                    <i class="fa fa-money font-purple-wisteria theme-font"></i>
                                                </div>
                                                <div class="mt-body">
                                                    <p class="mt-user-title"> <i>"Lower Total Cost of Ownership."</i> </p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-widget-1">
                                                <div class="mt-icon">
                                                    <a href="#">
                                                        </a>
                                                </div>
                                                <div class="card-icon">
                                                    <i class="fa fa-cogs font-green-haze theme-font"></i>
                                                </div>
                                                <div class="mt-body">
                                                    <p class="mt-user-title"> <i>"Better Aligned Systems than your Competitors."</i> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-widget-1">
                                                <div class="mt-icon">
                                                    <a href="#">
                                                        </a>
                                                </div>
                                                <div class="card-icon">
                                                    <i class="fa fa-line-chart font-red-sunglo theme-font"></i>
                                                </div>
                                                <div class="mt-body">
                                                    <p class="mt-user-title"> <i>"Maximize Business Outcomes."</i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>     
        <script>
            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "columnWidth": 1,
                "theme": "light",
                "marginRight": 150,
                "dataProvider": [{

                    "Year": "2015",
                    "value": 100,
                    "color": "#E7505A"
                }, {
                    "Year": "2016",
                    "value": 200,
                    "color": "#32C5D2"
                }, {
                    "Year": "2017",
                    "value": 300,
                    "color": "#67809F"
                }],
                "valueAxes": [{
                    "labelsEnabled": false,
                    "axisAlpha": 0,
                    "position": "left",
                    "gridThickness": 0
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "fixedColumnWidth": 17,
                    "cornerRadiusTop": 10,
                    "valueField": "value"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "Year",
                "columnWidth": 0,
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left"
                }
            });

            var chart = AmCharts.makeChart("chartdiv1", {
                "type": "serial",
                "columnWidth": 1,
                "theme": "light",
                "marginRight": 150,
                "dataProvider": [{
                    "Year": "2015",
                    "value": 300,
                    "color": "#E7505A"
                }, {
                    "Year": "2016",
                    "value": 200,
                    "color": "#32C5D2"
                }, {
                    "Year": "2017",
                    "value": 100,
                    "color": "#67809F"
                }],
                "valueAxes": [{
                    "labelsEnabled": false,
                    "axisAlpha": 0,
                    "position": "left",
                    "gridThickness": 0
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "fixedColumnWidth": 17,
                    "cornerRadiusTop": 10,
                    "valueField": "value"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "Year",
                "columnWidth": 0,
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left"
                }
            });

            var chart = AmCharts.makeChart("chartdiv2", {
                "type": "serial",
                "columnWidth": 1,
                "theme": "light",
                "marginRight": 150,
                "dataProvider": [{
                    "Year": "2015",
                    "value": 10,
                    "color": "#E7505A"
                }, {
                    "Year": "2016",
                    "value": 20,
                    "color": "#32C5D2"
                }, {
                    "Year": "2017",
                    "value": 100,
                    "color": "#67809F"
                }],
                "valueAxes": [{
                    "labelsEnabled": false,
                    "axisAlpha": 0,
                    "position": "left",
                    "gridThickness": 0
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "fixedColumnWidth": 17,
                    "cornerRadiusTop": 10,
                    "valueField": "value"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "Year",
                "columnWidth": 0,
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left"
                }
            });
        </script>
        <script>
            $(document).ready(function () {

                $("a").on('click', function (event) {


                    if (this.hash !== "") {

                        event.preventDefault();


                        var hash = this.hash;


                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 800, function () {
                            window.location.hash = hash;
                        });
                    } 
                });
            });

        </script>
</body>

</html>